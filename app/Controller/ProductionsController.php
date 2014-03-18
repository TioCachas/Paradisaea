<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class ProductionsController extends AppController {

    public function beforeFilter() {
        //$this->Security->allowedControllers(array('capture'=>'Operations'));
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    public function admin($operationId) {
        $this->loadModel('Operation');
        $this->set('operationId', $operationId);
        $this->set('title', __('Piezas OK'));
        $this->set('description', __('Piezas OK producidas por operacion'));
    }

    /**
     * Invocamos por ajax y regresamos un json con las producciones asociadas
     * a una operacion.
     * @param string $operationId
     */
    public function getByOperation($operationId) {
        $productions = $this->Production->getByOperationId($operationId);
        $this->set(array('productions' => $productions, '_serialize' => 'productions'));
        $this->viewClass = 'Json';
    }

    /**
     * Cambiamos el estatus de una produccion
     * Invocada por AJAX
     * @param string $productionId
     * @return JSON El nuevo estatus de la operacion
     */
    public function toggleStatus($productionId) {
        $newStatus = null;
        if ($this->request->is('post') === true) {
            $data = $this->request->data;
            if (isset($data['c']) === true) {
                $comment = trim($data['c']);
                if ($comment !== '') {
                    $user = $this->Auth->user();
                    $this->Production->toggleStatus($productionId);
                    $this->Production->id = $productionId;
                    $production = $this->Production->read();
                    $newStatus = (int) $production['Production']['status'];
                }
            }
        }
        $this->set(array('success' => $newStatus, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    /**
     * Exportamos las piezas OK que esten habilitadas
     * @param string $operationId
     */
    public function exportByOperation($operationId) {
        $this->loadModel('Operation');
        $nameOperation = $this->Operation->getName($operationId);
        $data = $this->Production->getByOperationId($operationId);
        $dataFlit = array();
        foreach ($data as $d) {
            if ($d['pStatus'] == Production::STATUS_ENABLED) {
                $x = array();
                $x[] = $d['mName'];
                $x[] = $d['iName'];
                $x[] = $d['pValue'];
                $x[] = $d['pCreationDate'];
                $dataFlit[] = $x;
            }
        }
        $_serialize = 'dataFlit';
        $_header = array(
            __('Modelo'),
            __('Index'),
            __('Value'),
            __('Fecha'),);
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('dataFlit', '_serialize', '_header'));
        $nameFile = __('producciones') . '-' . $nameOperation . '.csv';
        $this->response->download($nameFile);
    }

    /**
     * Listamos y capturas registros de piezas OK para captura
     * @param string $operationId
     */
    public function capture($operationId) {
        $this->layout = 'empty';
        $this->request->onlyAllow(array('get', 'post'));
        $this->loadModel('Operation');
        $this->Operation->id = $operationId;
        $operation = $this->Operation->read();
        if (isset($operation['Operation']) === true) {
            $bosch = $this->Session->read('configuration');
            $this->loadModel('ModelLine');
            $modelId = $bosch->getConfiguration()->getModel();
            $modelText = $bosch->getConfiguration()->getModelText();
            $this->loadModel('Index');
            $indexes = $this->Index->getEnabledByModelId($modelId);
            $this->loadModel('Production');
            $productions = $this->Production->getByOperationId($operationId, array(Production::STATUS_ENABLED));
            $this->set('operation', $operation['Operation']);
            $this->set('modelId', $modelId);
            $this->set('productions', $productions);
            $this->set('model', $modelText);
            $this->set('indexes', $indexes);
            $this->set('title', __('Piezas OK'));
            $this->set('description', __('Crear registro de piezas OK'));
        }
    }
    
    public function create()
    {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $newOperation = false;
        if(isset($params['i']) && isset($params['v']) && isset($params['o']))
        {
            $this->loadModel('ModelB');
            $this->loadModel('Index');
            $bosch = $this->Session->read('configuration');
            $this->ModelB->id = $bosch->getConfiguration()->getModel();
            $model = $this->ModelB->read();
            $this->Index->id = $params['i'];
            $index = $this->Index->read();
            $value = $params['v'];
            $operationId = $params['o'];
            $newOperation = $this->Production->insert($operationId, $model['ModelB']['id'], $index['Index']['id'], $value);
            $newOperation['mName'] = $model['ModelB']['name'];
            $newOperation['iName'] = $index['Index']['name'];
        }
        $this->set(array('operation' => $newOperation, '_serialize' => 'operation'));
        $this->viewClass = 'Json';
    }
    
    public function delete()
    {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $success = false;
        if(isset($params['i']))
        {
            $pId = $params['i'];
            $this->Production->toggleStatus($pId);
            $success = true;
        }
        $this->set(array('success' => $success, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    public function getByOperationAndHour() {
        $this->loadModel('Production');
        $productions = $this->Production->getByOperationId($operationId, Production::STATUS_ENABLED);
    }

    /**
     * Buscamos los registros de piezas ok que se encuentren habilitados
     * Invocada por AJAX
     * @param integer $operationId
     * @result JSON
     */
    public function getByOperationForUser($operationId) {
        $productions = $this->Production->getByOperationId($operationId, array(Production::STATUS_ENABLED));
        $this->set(array('productions' => $productions, '_serialize' => 'productions'));
        $this->viewClass = 'Json';
    }

}
