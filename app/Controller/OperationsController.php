<?php

App::uses('Controller', 'Controller');
App::uses('Bosch', 'Model');

class OperationsController extends AppController {

    public $helpers = array('TableOperations');

    const ERROR_HOUR = 1;
    const ERROR_MODEL = 2;
    const ERROR_INDEX = 3;
    const ERROR_WORKSTATION = 4;

//    public function beforeFilter() {
//        $bosch = $this->Session->read('configuration');
//        if (($bosch instanceof Bosch) === false) {
//            $this->redirect(array('controller' => 'Shifts', 'action' => 'config'));
//        }
//        parent::beforeFilter();
//    }

    public function admin() {
        $this->set('title', __('Operaciones'));
        $this->set('description', __('Administración de operaciones'));
    }

    /**
     * Buscamos las operaciones de un dia de trabajo.
     * Invocado por AJAX
     * @param string $workDate Fecha válida en formato Y-m-d
     */
    public function getByWorkDate($workDate = null) {
        $dt = null;
        try {
            $dt = new DateTime($workDate);
        } catch (Exception $exc) {
            $dt = new DateTime();
        }
        $operations = $this->Operation->getByWorkDate($dt->format('Y-m-d'));
        $this->set(array('operations' => $operations, '_serialize' => 'operations'));
        $this->viewClass = 'Json';
    }

    /**
     * Exportamos las operaciones HABILITADAS de un dia de trabajo
     * Invocada por AJAX
     * @param string $workDate Debe contener una fecha en formato valido (Y-m-d)
     * en caso de que el valor del parametro sea incorrecto se retorna un archivo
     * sin operaciones.
     */
    public function exportByWorkDate($workDate = null) {
        $dt = null;
        $operations = null;
        try {
            $dt = new DateTime($workDate);
            $operations = $this->Operation->getByWorkDate($dt->format('Y-m-d'));
        } catch (Exception $exc) {
            $operations = array();
        }
        $dataFlit = array();
        foreach ($operations as $o) {
            if ($o['oStatus'] == 1) {
                $x = array();
                $x[] = $o['lName'];
                $x[] = $o['hour'];
                $x[] = $o['user'];
                $x[] = $o['oProduction'];
                $x[] = $o['oScrap'];
                $x[] = $o['oRework'];
                $x[] = $o['oChangeover'];
                $x[] = $o['oTechnicalLosses'];
                $x[] = $o['oOrganizationalLosses'];
                $x[] = $o['oQualityLosses'];
                $x[] = $o['oPerformanceLosses'];
                $x[] = $o['oCreationDate'];
                $dataFlit[] = $x;
            }
        }
        $_serialize = 'dataFlit';
        $_header = array(
            __('Linea'),
            __('Hora de trabajo'),
            __('Usuario'),
            __('Piezas OK'),
            __('Scrap'),
            __('Retrabajo'),
            __('Perdidas por cambio de modelo'),
            __('Perdidas tecnicas'),
            __('Perdidas organizacionales'),
            __('Perdidas de calidad'),
            __('Perdidas de desempeño'),
            __('Fecha de captura'),);
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('dataFlit', '_serialize', '_header'));
        $nameFile = __('operaciones') . '-' . $workDate . '.csv';
        $this->response->download($nameFile);
    }

    /**
     * Cambiamos el estatus de una produccion
     * Invocada por AJAX
     */
    public function toggleStatus($operationId) {
        $user = $this->Auth->user();
        $this->loadModel('LogOperation');
        $this->LogOperation->addLog($operationId, $user['id'], '');
        $this->Operation->toggleStatus($operationId);
        $this->set(array('success' => true, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    public function changeHour($operationId) {
        $data = $this->request->data;
        $result = false;
        if (isset($data['h']) === true && isset($data['c']) === true) {
            $user = $this->Auth->user();
            $hourId = $data['h'];
            $comment = trim($data['c']);
            $this->loadModel('LogOperation');
            $this->LogOperation->addLog($operationId, $user['id'], $comment);
            $this->Operation->changeHour($operationId, $hourId);
            $this->loadModel('Hour');
            $hour = $this->Hour->findById($hourId);
            $result = $hour['Hour']['start'] . ' - ' . $hour['Hour']['end'];
        }
        $this->set(array('result' => $result, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    public function changeLine($operationId) {
        $data = $this->request->data;
        $result = false;
        if (isset($data['l']) === true) {
            $user = $this->Auth->user();
            $this->loadModel('LogOperation');
            $this->LogOperation->addLog($operationId, $user['id'], '');
            $lineId = $data['l'];
            $this->Operation->changeLine($operationId, $lineId);
            $this->loadModel('Line');
            $line = $this->Line->findById($lineId);
            $result = $line['Line']['name'];
        }
        $this->set(array('result' => $result, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    public function form() {
        $bosch = $this->Session->read('configuration');
        $userSesion = $this->Auth->user();
        $userId = $userSesion['id'];
        $this->loadModel('Hour');
        $lineId = $bosch->getConfiguration()->getShift();
        $hours = $this->Hour->getEnabledByShift($lineId);
        if (empty($hours) === true) {
            $this->redirect(array('action' => 'error', self::ERROR_HOUR));
            return;
        }
        $this->loadModel('ModelLine');
        $models = $this->ModelLine->getEnabledByLine($lineId);
        if (empty($models) === true) {
            $this->redirect(array('action' => 'error', self::ERROR_MODEL));
            return;
        }
        $firstModel = $models[0];
        $this->loadModel('IndexModel');
        $indexes = $this->IndexModel->getEnabledByModel($firstModel['m']['id']);
        if (empty($indexes) === true) {
            $this->redirect(array('action' => 'error', self::ERROR_INDEX));
            return;
        }
        $this->loadModel('Workstation');
        $workstations = $this->Workstation->getEnabledByLine($lineId);
        if (empty($workstations) === true) {
            $this->redirect(array('action' => 'error', self::ERROR_WORKSTATION));
            return;
        }
        $firstWorkstation = $workstations[0];
        $this->loadModel('Defect');
        $defects = $this->Defect->getEnabledByWorkstation($firstWorkstation['Workstation']['id']);
        if (empty($defects) === true) {
            $this->redirect(array('action' => 'error', self::ERROR_DEFECTS));
            return;
        }
        $this->set('hours', $hours);
        $this->set('models', $models);
        $this->set('indexes', $indexes);
        $this->set('workstations', $workstations);
        $this->set('defects', $defects);
        $this->set('title', __('Captura de operacion'));
        $this->set('description', __('Ingresa la produccion y scrap'));
    }

    public function error($codeError) {
        $this->set('title', __('Error'));
        $this->set('description', __('Error en la operacion'));
        $this->set('codeError', $codeError);
    }

    public function get() {
        $userSesion = $this->Auth->user();
        $userId = $userSesion['id'];
        $operations = $this->Operation->getCurrentsByUserId($userId);
        $this->set(array('operations' => $operations, '_serialize' => 'operations'));
        $this->viewClass = 'Json';
    }

    public function delete($id) {
        $this->Operation->delete($id);
        $this->set(array('success' => true, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    public function create() {
        $bosch = $this->Session->read('configuration');
        $lineId = $bosch->getConfiguration()->getLine();
        $userSesion = $this->Auth->user();
        $userId = $userSesion['id'];
        $production = $this->request->data('production');
        $scrap = $this->request->data('scrap');
        $rework = $this->request->data('rework');
        $hourId = $this->request->data('hour');
        $modelId = $this->request->data('model');
        $changeover = $this->request->data('changeover');
        $technicalLosses = $this->request->data('technicalLosses');
        $organizationalLosses = $this->request->data('organizationalLosses');
        $this->loadModel('ProductModel');
        $this->loadModel('Hour');
        $this->loadModel('Line');
        $line = $this->Line->findById($lineId);
        $hour = $this->Hour->findById($hourId);
        $model = $this->ProductModel->findById($modelId);
        $this->Operation->insert($hourId, $modelId, $production, $scrap, $rework, $userId, $lineId, $changeover, $technicalLosses, $organizationalLosses);
        $dt = new DateTime();
        $dtS = new DateTime($hour['Hour']['start']);
        $dtE = new DateTime($hour['Hour']['end']);
        $strHour = $dtS->format('H:i') . ' - ' . $dtE->format('H:i');
        $operation = array(
            'o' => array(
                'production' => $production,
                'scrap' => $scrap,
                'rework' => $rework,
                'changeover' => $changeover,
                'technical_losses' => $technicalLosses,
                'organizational_losses' => $organizationalLosses,
            ),
            0 => array('hour' => $strHour),
            'm' => array('model' => $model['ProductModel']['name']),
            'l' => array('line' => $line['Line']['name']),
        );
        $this->set(array('operation' => $operation, '_serialize' => 'operation'));
        $this->viewClass = 'Json';
    }

}
