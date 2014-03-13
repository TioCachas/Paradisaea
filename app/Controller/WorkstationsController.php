<?php

App::uses('CrudController', 'Controller');
App::uses('Workstation', 'Model');

class WorkstationsController extends CrudController {

    public function admin() {
        $this->set('title', __('Estaciones de trabajo'));
        $this->set('description', __('Administra las estaciones de trabajo'));
    }

    /*
     * Redifinimos los metodos necesarios para CRUD
     */

    protected function getRecords() {
        $workstations = $this->Workstation->getEnabledByLineDetail('aed09b6e-912d-11e3-8702-642737866159');
        return $workstations;
    }

    protected function c($model) {
        return array(
            'name' => $model->wName,
            'line_id' => 'aed09b6e-912d-11e3-8702-642737866159',
            'status' => Workstation::STATUS_ENABLED,
        );
    }

    protected function id($model) {
        return $model->wId;
    }

    protected function d($model) {
        return array(
            'name' => $model->wName,
        );
    }

}
