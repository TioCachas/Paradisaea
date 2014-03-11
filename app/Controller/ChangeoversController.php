<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class ChangeoversController extends AppController {

    public function beforeFilter() {
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    /**
     * Listamos y capturas registros de piezas OK para captura
     * @param string $operationId
     */
    public function capture($operationId) {
        $this->layout = 'empty';
        $this->request->onlyAllow('get');
        $this->loadModel('Operation');
        $this->Operation->id = $operationId;
        $operation = $this->Operation->read();
        $bosch = $this->Session->read('configuration');
        $lineId = $bosch->getConfiguration()->getLine();
        $modelId = $bosch->getConfiguration()->getModel();
        $this->loadModel('ModelLine');
        $models = $this->ModelLine->getByLine($lineId);
        $models = array_filter($models, function($model)use($modelId) {
            return $model['id'] != $modelId;
        });
        if (isset($operation['Operation']) === true) {
            $changeovers = $this->Changeover->getByOperationId($operationId, array(Changeover::STATUS_ENABLED));
            $this->set('operation', $operation['Operation']);
            $this->set('changeovers', $changeovers);
            $this->set('models', $models);
        }
    }

    /**
     * Creamos un nuevo registro.
     * AJAX
     * @return JSON con el registro creado
     */
    public function create() {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $newRecord = false;
        if (isset($params['o']) && isset($params['v']) && isset($params['c'])) {
            $value = $params['v'];
            $operationId = $params['o'];
            $comment = $params['c'];
            $newRecord = $this->Changeover->insert($operationId, $value, $comment);
        }
        $this->set(array('record' => $newRecord, '_serialize' => 'record'));
        $this->viewClass = 'Json';
    }

    /**
     * Eliminamos logicamente un registro
     * AJAX
     * @return JSON true si el registro se elimino correctamente, false en otros 
     * casos
     */
    public function delete() {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $success = false;
        if (isset($params['i'])) {
            $pId = $params['i'];
            $this->Changeover->toggleStatus($pId);
            $success = true;
        }
        $this->set(array('success' => $success, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

}
