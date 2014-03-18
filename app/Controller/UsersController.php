<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CrudController', 'Controller');

class UsersController extends CrudController {

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

    /**
     * Arreglo con un elemento que contiene el usuario en sesión.
     * @return JSON arreglo de usuarios
     */
    public function getUsersSesion() {
        $this->request->onlyAllow('get');
        $userSesion = $this->Auth->user();
        $users = array(
            array('uId' => $userSesion['id'], 'uName' => $userSesion['us3r']),
        );
        $this->set('users', $users);
        $this->set(array('users' => $users, '_serialize' => 'users'));
        $this->viewClass = 'Json';
    }

    /**
     * Obtenemos las lineas y turnos a los que tiene acceso un usuario
     */
    public function getLinesAndShifts() {
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

    /// ----------I N I C I O    C R U D ---------------------------------------
    public $_model = 'User';

    /**
     * Interfaz para administracion de usuarios
     */
    public function admin() {
        $this->request->onlyAllow('get');
        $this->set('title', __('Usuarios'));
        $this->set('description', __('Administración'));
    }

    /**
     * Definimos el metodo que utiliza la accion READ para listar los registros
     * @return type
     */
    protected function getRecords() {
        $m = $this->_model;
        $records = $this->$m->getEnabled();
        return $records;
    }

    /**
     * Definimos el metodo que utiliza la accion CREATE para crear un nuevo registro
     * @param object $model
     * @return array
     */
    protected function c($model) {
        return array(
            'name' => trim($model->name),
            'line_id' => $this->Session->read('lineId'),
            'status' => Workstation::STATUS_ENABLED,
        );
    }

    /**
     * Definimos el metodo que utiliza la accion UPDATE para modificar un registro.
     * Retorna una cadena con el id del registro a modificar
     * @param object $model
     * @return string
     */
    protected function id($model) {
        return $model->id;
    }

    /**
     * Definimos el metodo que utiliza la accion UPDATE para actualizar un registro.
     * Retorna un arreglo con los cambios al registro.
     * @param type $model
     * @return type
     */
    protected function u($model) {
        return array(
            'name' => trim($model->name),
        );
    }

    /// ----------F I N    C R U D ---------------------------------------------
}
