<?php

App::uses('AppController', 'Controller');
App::uses('Day', 'Model');

class ConfigLinesController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->set('title', __('Configuration'));
        $this->set('description', __('Lines'));
        $this->layout = 'base';
        parent::__construct($request, $response);
    }

    public function index() {
        $configs = $this->ConfigLine->find('all');
        $this->set('configs', $configs);
    }

    public function saveEdit($encryptId) {
        $id = Id::d($encryptId);
        $this->ConfigLine->id = $id;
        $this->ConfigLine->save($this->request->data);
        $this->redirect(array('action' => 'index'));
    }

    public function edit($encryptId) {
        $id = Id::d($encryptId);
        $this->ConfigLine->id = $id;
        $configLine = $this->ConfigLine->read();
        $this->set('configLine', $configLine);
        $this->set('description', __('Edit configuration'));
    }

    public function index2() {
        $this->loadModel('Line');
        $lines = $this->Line->getEnabled();
        $this->set('lines', $lines);
        $this->set('title', __('Config'));
        $this->set('description', __('Config'));
    }

}
