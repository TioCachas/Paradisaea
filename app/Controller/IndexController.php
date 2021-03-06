<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow();
        parent::beforeFilter();
    }

    public function index() {
        $this->request->onlyAllow('get');
        $this->set('title', __('Robert Bosch San Luis Potosi'));
        $this->layout = 'base';
    }

}
