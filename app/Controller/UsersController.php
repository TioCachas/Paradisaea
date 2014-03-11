<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Controller', 'Controller');

class UsersController extends AppController
{

    public function changePassForm()
    {
        $this->set('title', __('Cambiar contraseña'));
        $this->set('description', __('Modifica tu contraseña'));
    }

    public function changePass()
    {
        $data = $this->request->data;
        $passwordHasher = new SimplePasswordHasher();
        $pass = $passwordHasher->hash($data['pass']);
        $userSesion = $this->Auth->user();
        $userId = $userSesion['id'];
        $userBD = $this->User->findById($userId);
        $passBD = $userBD['User']['p4ss'];
        $success = true;
        $msg = __('La constraseña ha sido cambiada con exito.');
        if ($passBD == $pass)
        {
            if ($data['newPass1'] == $data['newPass2'])
            {
                $newPass = $data['newPass1'];
                $this->User->changePass($userId, $newPass);
            }
            else
            {
                $success = false;
                $msg = __('La nueva contraseña y su confirmacion no coinciden.');
            }
        }
        else
        {
            $success = false;
            $msg = __('Tu contraseña no es correcta.');
        }
        $this->set('title', __('Cambiar contraseña'));
        $this->set('description', __('Modifica tu contraseña'));
        $this->set('success', $success);
        $this->set('msg', $msg);
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function test()
    {
        $passwordHasher = new SimplePasswordHasher();
        $pass = $passwordHasher->hash('a');
        var_dump($pass);
    }

    /**
     * Arreglo con un elemento que contiene el usuario en sesión.
     * @return JSON arreglo de usuarios
     */
    public function getUsersSesion()
    {
        $this->request->onlyAllow('get');
        $userSesion = $this->Auth->user();
        $users = array(
            array('uId' => $userSesion['id'], 'uName' => $userSesion['us3r']),
            array('uId' => '14652d6a-9a3f-11e3-a2d4-fc4dd44a2aac', 'uName' => 'LOE1SLP'));
        $this->set('users', $users);
        $this->set(array('users' => $users, '_serialize' => 'users'));
        $this->viewClass = 'Json';
    }

    /**
     * Obtenemos las lineas y turnos a los que tiene acceso un usuario
     */
    public function getLinesAndShifts()
    {
        $this->request->onlyAllow('get');
        $result = array();
        $params = $this->request->query;
        $this->loadModel('UserLine');
        $result['lines'] = $this->UserLine->getByUser($params['u']);
        $this->loadModel('UserShift');
        $result['shifts'] = $this->UserShift->getByUser($params['u']);
        $this->set(array('result' => $result, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

}
