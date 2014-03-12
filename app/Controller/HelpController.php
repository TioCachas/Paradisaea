<?php

App::uses('AppController', 'Controller');

class HelpController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow();
        parent::beforeFilter();
    }

    public function index() {
        $this->request->onlyAllow('get');
        $this->set('title', __('Ayuda'));
        $this->layout = 'base';
    }

}
