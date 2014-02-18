<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Controller', 'Controller');

class UsersController extends AppController {

    public function changePassForm() {
        $this->set('title', __('Cambiar contraseña'));
        $this->set('description', __('Modifica tu contraseña'));
    }

    public function changePass() {
        $data = $this->request->data;
        $passwordHasher = new SimplePasswordHasher();
        $pass = $passwordHasher->hash($data['pass']);
        $userSesion = $this->Auth->user();
        $userId = $userSesion['id'];
        $userBD = $this->User->findById($userId);
        $passBD = $userBD['User']['p4ss'];
        $success = true;
        $msg = __('La constraseña ha sido cambiada con exito.');
        if ($passBD == $pass) {
            if ($data['newPass1'] == $data['newPass2']) {
                $newPass = $data['newPass1'];
                $this->User->changePass($userId, $newPass);
            } else {
                $success = false;
                $msg = __('La nueva contraseña y su confirmacion no coinciden.');
            }
        } else {
            $success = false;
            $msg = __('Tu contraseña no es correcta.');
        }
        $this->set('title', __('Cambiar contraseña'));
        $this->set('description', __('Modifica tu contraseña'));
        $this->set('success', $success);
        $this->set('msg', $msg);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function test() {
        $passwordHasher = new SimplePasswordHasher();
        $pass = $passwordHasher->hash('a');
        var_dump($pass);
    }

}
