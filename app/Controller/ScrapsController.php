<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class ScrapsController extends AppController {

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
        if (isset($operation['Operation']) === true) {
            $scraps = $this->Scrap->getByOperationId($operationId, array(Scrap::STATUS_ENABLED));
            $this->set('operation', $operation['Operation']);
            $this->set('scraps', $scraps);
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
            $newRecord = $this->Scrap->insert($operationId, $value, $comment);
        }
        $this->set(array('record' => $newRecord, '_serialize' => 'record'));
        $this->viewClass = 'Json';
    }

    public function delete() {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $success = false;
        if (isset($params['i'])) {
            $pId = $params['i'];
            $this->Scrap->toggleStatus($pId);
            $success = true;
        }
        $this->set(array('success' => $success, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

}
