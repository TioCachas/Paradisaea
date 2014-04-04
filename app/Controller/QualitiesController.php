<?php

App::uses('CrudController', 'Controller');
App::uses('Quality', 'Model');

class QualitiesController extends CrudController
{
    /// --------------I N I C I O   C R U D-------------------------------------
    public $_model = 'Quality';

    public function admin($operationId)
    {
        $this->request->onlyAllow('get');
        $this->loadModel('Operation');
        $this->Operation->id = $operationId;
        $operation = $this->Operation->read();
        if (isset($operation['Operation']) === true)
        {
            $this->Session->write('operationId', $operationId);
            $appBosch = new stdClass();
            $this->set('appBosch', $appBosch);
        }
        $this->layout = 'empty';
    }

    /**
     * Definimos como extrae los datos para READ
     */
    protected function getRecords()
    {
        $operationId = $this->Session->read('operationId');
        $m = $this->_model;
        $records = $this->$m->getEnabledByOperationId($operationId);
        return $records;
    }

    /**
     * Definimos como crear un record nuevo para CREATE
     * @param array $model
     * @return array
     */
    protected function c($model)
    {
        $m = $this->_model;
        return array(
            'operation_id' => $this->Session->read('operationId'),
            'comment' => trim($model->comment),
            'status' => $m::STATUS_ENABLED,
        );
    }

    /**
     * Definimos como actualizar un registro para UPDATE
     * @param array $model
     * @return array
     */
    protected function u($model)
    {
        return array(
            'comment' => trim($model->comment),
        );
    }

    /// ------------------F I N   C R U D---------------------------------------
}
