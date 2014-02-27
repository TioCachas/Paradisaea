<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $this->set('title', __('Robert Bosch San Luis Potosi'));
        $this->layout = 'base';
    }

}
