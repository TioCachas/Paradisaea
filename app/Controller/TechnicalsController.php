<?php

App::uses('CrudController', 'Controller');
App::uses('Technical', 'Model');

class TechnicalsController extends CrudController {

    public function beforeFilter() {
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    public $_model = 'Technical';

    public function admin($operationId) {
        $this->loadModel('Operation');
        $this->Operation->id = $operationId;
        $operation = $this->Operation->read();
        $ws = array();
        $ds = array();
        $lineId = 0;
        if ($operation) {
            $lineId = $operation['Operation']['line_id'];
            $this->loadModel('Workstation');
            $workstations = $this->Workstation->getEnabledByLine($lineId);
            if (count($workstations) > 0) {
                array_walk($workstations, function($workstation) use(&$ws) {
                    $ws[] = array('text' => $workstation['name'], 'value' => $workstation['id']);
                });
                $firstWs = $workstations[0];
                $this->loadModel('Defect');
            }
        }
        $this->loadModel('Defect');
        $defects = $this->Defect->getEnabledByLineId($lineId);
        array_walk($defects, function($defect) use(&$ds) {
                    $ds[] = array('text' => $defect['description'], 'value' => $defect['id']);
                });
        $this->Session->write('operationId', $operationId);
        $this->set('defects', $ds);
        $this->set('workstations', $ws);
        $this->layout = 'empty';
    }

    /*
     * Redifinimos los metodos necesarios para CRUD
     */

    protected function getRecords() {
        $operationId = $this->Session->read('operationId');
        $m = $this->_model;
        $records = $this->$m->getEnabledByOperationId($operationId);
        return $records;
    }

    protected function c($model) {
        return array(
            'operation_id' => $this->Session->read('operationId'),
            'value' => $model->value,
            'workstation_id' => $model->workstation_id,
            'defect_id' => $model->defect_id,
            'status' => Technical::STATUS_ENABLED,
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

//    /**
//     * Listamos y capturas registros de piezas OK para captura
//     * @param string $operationId
//     */
//    public function capture($operationId) {
//        $this->layout = 'empty';
//        $this->request->onlyAllow('get');
//        $this->loadModel('Operation');
//        $this->Operation->id = $operationId;
//        $operation = $this->Operation->read();
//        if (isset($operation['Operation']) === true) {
//            $technicals = $this->Technical->getByOperationId($operationId, array(Technical::STATUS_ENABLED));
//            $this->set('operation', $operation['Operation']);
//            $this->set('technicals', $technicals);
//        }
//    }
//
//    /**
//     * Creamos un nuevo registro.
//     * AJAX
//     * @return JSON con el registro creado
//     */
//    public function create() {
//        $this->request->onlyAllow('get');
//        $params = $this->request->query;
//        $newRecord = false;
//        if (isset($params['o']) && isset($params['v']) && isset($params['c'])) {
//            $value = $params['v'];
//            $operationId = $params['o'];
//            $comment = $params['c'];
//            $newRecord = $this->Technical->insert($operationId, $value, $comment);
//        }
//        $this->set(array('record' => $newRecord, '_serialize' => 'record'));
//        $this->viewClass = 'Json';
//    }
//
//    /**
//     * Eliminamos logicamente un registro
//     * AJAX
//     * @return JSON true si el registro se elimino correctamente, false en otros 
//     * casos
//     */
//    public function delete() {
//        $this->request->onlyAllow('get');
//        $params = $this->request->query;
//        $success = false;
//        if (isset($params['i'])) {
//            $pId = $params['i'];
//            $this->Technical->toggleStatus($pId);
//            $success = true;
//        }
//        $this->set(array('success' => $success, '_serialize' => 'success'));
//        $this->viewClass = 'Json';
//    }
}
