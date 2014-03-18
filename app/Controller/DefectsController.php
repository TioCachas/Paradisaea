<?php

App::uses('CrudController', 'Controller');

class DefectsController extends CrudController
{
    public $_model = 'Defect';

    public function admin($workstationId)
    {
        $areaId = $this->Session->read('areaId');
        $lineId = $this->Session->read('lineId');
        $this->loadModel('Area');
        $this->loadModel('Line');
        $this->loadModel('Workstation');
        $this->Area->id = $areaId;
        $area = $this->Area->read();
        $this->Line->id = $lineId;
        $line = $this->Line->read();
        $this->Workstation->id = $workstationId;
        $workstation = $this->Workstation->read();
        $breadcrumb = array(
            $area['Area']['name'] => Router::url(array('controller' => 'Areas', 'action' => 'admin')),
            $line['Line']['name'] => Router::url(array('controller' => 'Lines', 'action' => 'admin',
                $areaId)),
            $workstation['Workstation']['name'] => Router::url(array('controller' => 'Workstations', 'action' => 'admin',
                $lineId)),
        );
        $this->Session->write('workstationId', $workstationId);
        $this->set('breadcrumb', $breadcrumb);
        $this->set('title', __('Defectos'));
        $this->set('description', __('Administración'));
    }

    protected function getRecords()
    {
        $workstationId = $this->Session->read('workstationId');
        $m = $this->_model;
        $records = $this->Defect->getEnabledByWorkstation($workstationId);
        return $records;
    }

    protected function c($model)
    {
        $workstationId = $this->Session->read('workstationId');
        return array(
            'code' => trim($model->code),
            'description' => trim($model->description),
            'workstation_id' => $workstationId,
            'status' => Defect::STATUS_ENABLED,
        );
    }

    protected function id($model)
    {
        return $model->id;
    }

    protected function u($model)
    {
        return array(
            'code' => trim($model->code),
            'description' => trim($model->description),
        );
    }

}
