<?php

App::uses('CrudController', 'Controller');

class WorkstationsController extends CrudController {
    
    public $_model = 'Workstation';

    public function admin($lineId) {
        $areaId = $this->Session->read('areaId');
        $this->loadModel('Area');
        $this->loadModel('Line');
        $this->Area->id = $areaId;
        $area = $this->Area->read();
        $this->Line->id = $lineId;
        $line = $this->Line->read();
        $breadcrumb = array(
            $area['Area']['name'] => Router::url(array('controller' => 'Areas', 'action' => 'admin')),
            $line['Line']['name'] => Router::url(array('controller' => 'Lines', 'action' => 'admin', $areaId)),
        );
        $this->Session->write('lineId', $lineId);
        $this->set('breadcrumb', $breadcrumb);
        $this->set('title', __('Estaciones de trabajo'));
        $this->set('description', __('Administración'));
    }

    /*
     * Redifinimos los metodos necesarios para CRUD
     */

    protected function getRecords() {
        $lineId = $this->Session->read('lineId');
        $m = $this->_model;
        $records = $this->$m->getEnabledByLine($lineId);
        return $records;
    }

    protected function c($model) {
        return array(
            'name' => trim($model->name),
            'line_id' => $this->Session->read('lineId'),
            'status' => Workstation::STATUS_ENABLED,
        );
    }

    protected function id($model) {
        return $model->id;
    }

    protected function u($model) {
        return array(
            'name' => trim($model->name),
        );
    }

}
