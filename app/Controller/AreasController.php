<?php

App::uses('CrudController', 'Controller');

class AreasController extends CrudController {

    public $_model = 'Area';

    public function admin() {
        $this->set('title', __('Áreas'));
        $this->set('description', __('Administración de áreas'));
    }

    protected function getRecords() {
        $m = $this->_model;
        $records = $this->$m->getEnabled();
        return $records;
    }

    protected function c($model) {
        $m = $this->_model;
        return array(
            'name' => $model->name,
            'status' => $m::STATUS_ENABLED,
        );
    }

    protected function id($model) {
        return $model->id;
    }

    protected function u($model) {
        return array(
            'name' => $model->name,
        );
    }

}
