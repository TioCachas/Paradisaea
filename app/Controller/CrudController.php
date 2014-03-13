<?php

App::uses('AppController', 'Controller');

abstract class CrudController extends AppController {

    public $_model;

    public function beforeFilter() {
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    /*
     * A C C I O N E S
     */

    public function create() {
        $this->request->onlyAllow('get');
        $m = $this->_model;
        $models = json_decode($this->request->query['models']);
        $model = $models[0];
        try {
            $this->$m->insert($this->c($model));
        } catch (PDOException $exc) {
            switch($exc->getCode()) {
                case 23000:
            }
        }
        $this->set(array('records' => false, '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    public function read() {
        $this->request->onlyAllow('get');
        $this->set(array('records' => $this->getRecords(), '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    public function update() {
        $this->request->onlyAllow('get');
        $m = $this->_model;
        $models = json_decode($this->request->query['models']);
        $model = $models[0];
        $this->$m->update($this->id($model), $this->u($model));
        $this->set(array('records' => $this->getRecords(), '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    /*
     * P R I V A D O S  para R E D E F I N I R
     */

    protected function c($model) {
        return array();
    }

    protected function u($model) {
        return array();
    }

    protected function id($model) {
        return null;
    }

    protected function getRecords() {
        return array();
    }

}
