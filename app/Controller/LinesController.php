<?php

App::uses('CrudController', 'Controller');

class LinesController extends CrudController
{
    public $_model = 'Line';
    /**
     * Regresamos un combo donde se puede seleccionar una nueva linea de produccion
     */
    public function getLinesSelfArea($lineId)
    {
        $lines = $this->Line->getSelfAreaEnabled($lineId);
        $this->set('lines', $lines);
        $this->layout = 'ajax';
    }
    
    public function admin() {
        $this->set('title', __('Lineas de produccion'));
        $this->set('description', __('Administracion de lineas de produccion'));
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
