<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class ProductionsController extends AppController {

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

}
