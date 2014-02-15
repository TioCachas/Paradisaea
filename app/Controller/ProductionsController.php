<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class ProductionsController extends AppController
{

    public function admin($operationId)
    {
        $this->loadModel('Operation');
        $operations = $this->Operation->getById($operationId);
        $this->set('operation', $operations[0]);
        $this->set('title', __('Piezas OK'));
        $this->set('description', __('Piezas OK producidas por operacion'));
    }

    /**
     * Invocamos por ajax y regresamos un json con las producciones asociadas
     * a una operacion.
     * @param string $operationId
     */
    public function getByOperation($operationId)
    {
        $productions = $this->Production->getByOperationId($operationId);
        $this->set(array('productions' => $productions, '_serialize' => 'productions'));
        $this->viewClass = 'Json';
    }

    /**
     * Cambiamos el estatus de una produccion
     */
    public function toggleStatus($productionId)
    {
        $this->Production->toggleStatus($productionId);
        $this->set(array('success' => true, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    public function export($operationId)
    {
        $this->loadModel('Operation');
        $nameOperation = $this->Operation->getName($operationId);
        $data = $this->Production->getByOperationId($operationId);
        $dataFlit = array();
        foreach ($data as $d)
        {
            $x = array();
            $x[] = $d['m']['name'];
            $x[] = $d['i']['name'];
            $x[] = $d['p']['value'];
            $x[] = $d['p']['creation_date'];
            $dataFlit[] = $x;
        }
        $_serialize = 'dataFlit';
        $_header = array(
            __('Modelo'),
            __('Index'),
            __('Value'),
            __('Fecha'),);
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('dataFlit', '_serialize', '_header'));
        $nameFile = __('producciones').'-'.$nameOperation.'.csv';
        $this->response->download($nameFile);
    }

}

