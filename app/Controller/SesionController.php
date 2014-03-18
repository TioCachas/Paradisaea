<?php

App::uses('Controller', 'Controller');

class SesionController extends AppController
{

    public function beforeFilter()
    {
        $this->Auth->allow(array('index', 'login'));
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    public function index()
    {
        $this->request->onlyAllow('get');
        $this->set('title', __('Login'));
        $this->set('description', __('Panel para ingreso de usuarios'));
    }

    public function login()
    {
        $this->request->onlyAllow('post');
        $ip = $this->request->clientIp();
        $userAgent = $this->request->header('User-Agent');
        
        if ($this->Auth->login())
        {
            $user = $this->Auth->user();
            $this->loadModel('Category');
            $category = $this->Category->getById($user['category_id']);
            $this->redirect(array('controller'=>$category['Category']['controller'], 'action'=>$category['Category']['action']), null, true);
            return;
        }
        $this->set('title', __('Acceder'));
        $this->set('description', __('Panel para ingreso de usuarios'));
    }

    public function logout()
    {
        $this->request->onlyAllow('get');
        $this->Auth->logout();
        $this->Session->destroy();
        $this->set('title', __('Fin de sesión'));
        $this->set('description', __('Tu sesión ha finalizado'));
    }

    public function welcome()
    {
        $this->request->onlyAllow('get');
        $this->set('title', __('Bienvenido'));
        $this->set('description', __('Inicio de sesión'));
    }
    
    private function addLog()
    {
        
    }

}
