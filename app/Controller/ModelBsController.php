<?php

App::uses('CrudController', 'Controller');
App::uses('ModelB', 'Model');

class ModelBsController extends CrudController
{
    public $_model = 'ModelB';

    public function admin()
    {
        $this->set('title', __('Modelos'));
        $this->set('description', __('Administración'));
    }

    protected function getRecords()
    {
        $this->loadModel('ModelB');
        $records = $this->ModelB->getEnabled();
        return $records;
    }

    protected function c($model)
    {
        return array(
            'name' => trim($model->name),
            'status' => ModelB::STATUS_ENABLED,
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
