<?php

App::uses('CrudController', 'Controller');
App::uses('Technical', 'Model');

class TechnicalsController extends CrudController {

    /// --------------I N I C I O   C R U D-------------------------------------
    public $_model = 'Technical';

    public function admin($operationId) {
        $this->request->onlyAllow('get');
        $this->loadModel('Operation');
        $this->Operation->id = $operationId;
        $operation = $this->Operation->read();
        if (isset($operation['Operation']) === true) {
            $lineId = $operation['Operation']['line_id'];
            $this->loadModel('Workstation');
            $workstationsByLine = $this->Workstation->getEnabledByLine($lineId);
            if (count($workstationsByLine) > 0) {
                $wsl = array();
                foreach ($workstationsByLine as $workstation) {
                    $wsl[] = array('text' => $workstation['name'], 'value' => $workstation['id']);
                }
                $this->loadModel('Defect');
                $defectsByLine = $this->Defect->getEnabledByLineId($lineId);
                if (count($defectsByLine) > 0) {
                    $dsl = array();
                    $defectsByFirstWorkstation = array();
                    $firstWorkstationId = $workstationsByLine[0]['id'];
                    foreach ($defectsByLine as $defect) {
                        $text = '[' . $defect['code'] . '] ' . $defect['description'];
                        $o = array('text' => $text, 'value' => $defect['id']);
                        $dsl[] = $o;
                        if ($defect['workstation_id'] == $firstWorkstationId) {
                            $defectsByFirstWorkstation[] = $o;
                        }
                    }
                    $this->Session->write('operationId', $operationId);
                    $appBosch = new stdClass();
                    $appBosch->workstationsByLine = $wsl; // Estaciones de trabajo en la linea
                    $appBosch->defectsByLine = $dsl; // Defectos por linea
                    $appBosch->defectsByFirstWorkstation = $defectsByFirstWorkstation;
                    $appBosch->type = Defect::TYPE_TECHNICAL;
                    /**
                     * Esta variable permite bloquear la acción de actualizar una 
                     * operación. Esto puede ocurrir por las siguientes razones:
                     * 1) No se ha cargado la lista de defectos
                     * 2) No se ha seleccionado un defecto
                     * Revisar los comentarios en JS para cada uso para entender 
                     * el funcionamiento general de esta variable.
                     * Boolean
                     */
                    $appBosch->blockEdit = false;
                    $this->set('appBosch', $appBosch);
                }
            }
        }
        $this->layout = 'empty';
    }

    /**
     * Definimos como extrae los datos para READ
     */
    protected function getRecords() {
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
    protected function c($model) {
        $m = $this->_model;
        return array(
            'operation_id' => $this->Session->read('operationId'),
            'value' => (int)$model->value,
            'workstation_id' => $model->workstation_id,
            'defect_id' => $model->defect_id,
            'status' => $m::STATUS_ENABLED,
        );
    }

    /**
     * Definimos como actualizar un registro para UPDATE
     * @param array $model
     * @return array
     */
    protected function u($model) {
        return array(
            'value' => (int)$model->value,
            'workstation_id' => $model->workstation_id,
            'defect_id' => $model->defect_id,
        );
    }

    /// ------------------F I N   C R U D---------------------------------------
}
