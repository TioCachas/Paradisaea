<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $this->set('title', __('Bosch'));
        $this->set('description', __('Sistema para Bosch'));
        $this->layout = 'base';
    }

}
