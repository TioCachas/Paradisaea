<?php

App::uses('Controller', 'Controller');

class SesionController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function Index() {
        $this->set('title', __('Login'));
        $this->set('description', __('Panel para ingreso de usuarios'));
    }

    public function Login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
        $this->set('title', __('Acceder'));
        $this->set('description', __('Panel para ingreso de usuarios'));
    }

    public function Logout() {
        $this->Auth->logout();
        $this->Session->destroy();
        $this->set('title', __('Fin de sesión'));
        $this->set('description', __('Tu sesión ha finalizado'));
    }

    public function Welcome() {
        if (!$this->Auth->loggedIn()) {
            $this->Auth->authError = false;
        }
        $this->set('title', __('Bienvenido'));
        $this->set('description', __('Inicio de sesión'));
    }

}
