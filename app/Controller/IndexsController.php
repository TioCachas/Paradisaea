<?php

App::uses('CrudController', 'Controller');
App::uses('Index', 'Model');

class IndexsController extends CrudController
{
    public $_model = 'Index';

    /**
     * @param type $modelId
     */
    public function getOptions($modelId)
    {
        $this->loadModel('IndexModel');
        $indexes = $this->IndexModel->getEnabledByModel($modelId);
        $this->set('indexes', $indexes);
        $this->layout = 'ajax';
    }

    public function admin($modelId)
    {
        $this->loadModel('ModelB');
        $this->ModelB->id = $modelId;
        $modelB = $this->ModelB->read();
        $breadcrumb = array(
            $modelB['ModelB']['name'] => Router::url(array('controller' => 'ModelBs',
                'action' => 'admin')),
        );
        $this->Session->write('modelId', $modelId);
        $this->set('breadcrumb', $breadcrumb);
        $this->set('title', __('Index'));
        $this->set('description', __('Administración'));
    }

    protected function getRecords()
    {
        $modelId = $this->Session->read('modelId');
        $records = $this->Index->getEnabledByModelId($modelId);
        return $records;
    }

    protected function c($model)
    {
        $modelId = $this->Session->read('modelId');
        return array(
            'name' => trim($model->name),
            'model_id' => $modelId,
            'status' => Index::STATUS_ENABLED,
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
