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

    public function admin($areaId)
    {
        $this->loadModel('Area');
        $this->Area->id = $areaId;
        $area = $this->Area->read();
        $breadcrumb = array(
            $area['Area']['name'] => Router::url(array('controller' => 'Areas', 'action' => 'admin')),
        );
        $this->Session->write('areaId', $areaId);
        $this->set('breadcrumb', $breadcrumb);
        $this->set('title', __('Líneas de producción'));
        $this->set('description', __('Administración'));
    }

    protected function getRecords()
    {
        $areaId = $this->Session->read('areaId');
        $m = $this->_model;
        $records = $this->$m->getByAreaIdAndStatus($areaId);
        return $records;
    }

    protected function c($model)
    {
        $m = $this->_model;
        return array(
            'name' => trim($model->name),
            'area_id' => $this->Session->read('areaId'),
            'status' => $m::STATUS_ENABLED,
        );
    }

    protected function id($model)
    {
        return $model->id;
    }

    protected function u($model)
    {
        return array(
            'name' => trim($model->name),
        );
    }

}
