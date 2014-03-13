<?php

App::uses('CrudController', 'Controller');

class DefectsController extends CrudController {

    public $_model = 'Defect';

    public function admin() {
        $this->set('title', __('Defectos'));
        $this->set('description', __('Defectos por estacion de trabajo'));
    }

    protected function getRecords() {
        $records = $this->Defect->getEnabledByWorkstation('fa267cc3-aa26-11e3-8645-fc4dd44a2aac');
        return $records;
    }

    protected function c($model) {
        return array(
            'name' => $model->wName,
            'workstation_id' => 'fa267cc3-aa26-11e3-8645-fc4dd44a2aac',
            'status' => Defect::STATUS_ENABLED,
        );
    }

    protected function id($model) {
        return $model->id;
    }

    protected function u($model) {
        return array(
            'code' => $model->code,
            'description' => $model->description,
        );
    }

}
