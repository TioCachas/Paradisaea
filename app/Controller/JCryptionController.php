<?php

App::uses('Controller', 'Controller');

class JCryptionController extends AppController
{

    public function beforeFilter()
    {
        $this->Auth->allow(array('getPublicKey', 'handshake'));
        $this->Security->allowedControllers = array('Sesion');
        $this->Security->allowedActions = array('index');
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    /**
     * Obtenemos la clave publica
     */
    public function getPublicKey()
    {
        $this->request->onlyAllow('get');
        $arrOutput = array(
            "publickey" => file_get_contents('rsa_1024_pub.pem')
        );
        $this->set(array('result' => $arrOutput, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    public function handshake()
    {
        $this->request->onlyAllow('post');
        $data = $this->request->data;
        if(isset($data['key']) === true) {
            $key = $data['key'];
            $privateKey = file_get_contents('rsa_1024_pri.pem');
            openssl_private_decrypt($key, $decrypted, $privateKey);
            var_dump($decrypted);
            // Decrypt the client's request
            $cmd = sprintf("openssl rsautl -decrypt -inkey rsa_1024_priv.pem");
            $descriptorspec = array(
                0 => array("pipe", "r"), // stdin is a pipe that the child will read from
                1 => array("pipe", "w")  // stdout is a pipe that the child will write to
            );
            $process = proc_open($cmd, $descriptorspec, $pipes);
            if (is_resource($process))
            {
                fwrite($pipes[0], base64_decode($key));
                fclose($pipes[0]);

                $key = stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                proc_close($process);
            }
            // Save the AES key into the session
            $_SESSION["key"] = $key;

            // JSON encode the challenge
            $cmd = sprintf("openssl enc -aes-256-cbc -pass pass:'$key' -a -e");
            $process = proc_open($cmd, $descriptorspec, $pipes);
            if (is_resource($process))
            {
                fwrite($pipes[0], $key);
                fclose($pipes[0]);

                // we have to trim all newlines and whitespaces by ourself
                $challenge = trim(str_replace("\n", "", stream_get_contents($pipes[1])));
                fclose($pipes[1]);
                proc_close($process);
            }
        }
        $this->set(array('challenge' => $challenge, '_serialize' => 'challenge'));
        $this->viewClass = 'Json';
    }

}
