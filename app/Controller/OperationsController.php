<?php

App::uses('AppController', 'Controller');
App::uses('Bosch', 'Model');

class OperationsController extends AppController {

    public function beforeFilter() {
        $this->Security->allowedControllers = array('Operations');
        $this->Security->allowedActions = array('index, login');
        $this->Security->csrfCheck = false;
        //$this->Security->allowedControllers = array('Operations');
        //$this->Security->unlockedActions = array('getDashboardCapture');
        parent::beforeFilter();
    }

    public $helpers = array('TableOperations');

    const ERROR_HOUR = 1;
    const ERROR_MODEL = 2;
    const ERROR_INDEX = 3;
    const ERROR_WORKSTATION = 4;
    const ERROR_DEFECTS = 5;

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

    public function getByWorkDateAndUser($workDate = null) {
        $dt = null;
        $user = $this->Auth->user();
        try {
            $dt = new DateTime($workDate);
        } catch (Exception $exc) {
            $dt = new DateTime();
        }
        $operations = $this->Operation->getByWorkDateAndUser($dt->format('Y-m-d'), $user['id']);
        $this->set(array('operations' => $operations, '_serialize' => 'operations'));
        $this->viewClass = 'Json';
    }

    public function getById($operationId = null) {
        $operations = $this->Operation->getById($operationId);
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
        $user = $this->Auth->user();
        try {
            $dt = new DateTime($workDate);
            $operations = $this->Operation->getByWorkDateAndUser($dt->format('Y-m-d'), $user['id']);
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
     * Cambiamos el estatus de una operacion.
     * Retornamos el nuevo estatus de la operacion o null en otros casos.
     * Invocada por AJAX
     */
    public function toggleStatus($operationId) {
        $newStatus = null;
        if ($this->request->is('post') === true) {
            $data = $this->request->data;
            if (isset($data['c']) === true) {
                $comment = trim($data['c']);
                if ($comment !== '') {
                    $user = $this->Auth->user();
                    $this->loadModel('LogOperation');
                    $this->LogOperation->addLog($operationId, $user['id'], $comment);
                    $this->Operation->toggleStatus($operationId);
                    $this->Operation->id = $operationId;
                    $operation = $this->Operation->read();
                    $newStatus = (int) $operation['Operation']['status'];
                }
            }
        }
        $this->set(array('success' => $newStatus, '_serialize' => 'success'));
        $this->viewClass = 'Json';
    }

    /**
     * Cambiamos la hora de una operacion
     * Invocada por AJAX
     * @param string $operationId
     * @result JSON con la nueva hora
     */
    public function changeHour($operationId) {
        $data = $this->request->data;
        $newHour = null;
        if ($this->request->is('post')) {
            if (isset($data['h']) === true && isset($data['c']) === true) {
                $comment = trim($data['c']);
                if ($comment !== '') {
                    $hourId = $data['h'];
                    $user = $this->Auth->user();
                    $this->loadModel('LogOperation');
                    $this->LogOperation->addLog($operationId, $user['id'], $comment);
                    $this->Operation->changeHour($operationId, $hourId);
                    $this->loadModel('Hour');
                    $hour = $this->Hour->findById($hourId);
                    $newHour = $hour['Hour']['start'] . ' - ' . $hour['Hour']['end'];
                }
            }
        }
        $this->set(array('result' => $newHour, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    /**
     * Cambiamos la linea de una oepracion
     * Invocada por AJAX
     * @param string $operationId
     * @result JSON con la nueva linea
     */
    public function changeLine($operationId) {
        $data = $this->request->data;
        $newLine = null;
        if ($this->request->is('post')) {
            if (isset($data['l']) === true && isset($data['c']) === true) {
                $comment = trim($data['c']);
                if ($comment !== '') {
                    $lineId = $data['l'];
                    $user = $this->Auth->user();
                    $this->loadModel('LogOperation');
                    $this->LogOperation->addLog($operationId, $user['id'], $comment);
                    $this->Operation->changeLine($operationId, $lineId);
                    $this->loadModel('Line');
                    $line = $this->Line->findById($lineId);
                    $newLine = $line['Line']['name'];
                }
            }
        }
        $this->set(array('result' => $newLine, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    public function capture($workDate = null) {
        $userSesion = $this->Auth->user();
        $users = array(array('uId' => $userSesion['id'], 'uName' => $userSesion['us3r']));
        $workDate = $workDate === null ? strftime('%Y-%m-%d') : $workDate;
        $this->set('users', $users);
        $this->set('workDate', $workDate);
        $this->set('title', __('Pizarra de captura'));
        $this->set('description', __('Piezas ok, scrap, retrabajo, perdidas'));
    }

    public function error($codeError) {
        $this->set('title', __('Error'));
        $this->set('description', __('Error en la operacion'));
        $this->set('codeError', $codeError);
    }

    public function getDashboardCapture() {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $result = false;
        if (isset($params['u']) && isset($params['l']) && isset($params['s']) && isset($params['w'])) {
            $userId = $params['u'];
            $lineId = $params['l'];
            $shiftId = $params['s'];
            $workDate = $params['w'];
            $this->Operation->createDashboardCapture($userId, $lineId, $workDate);
            $operations = $this->Operation->getDashboardCapture($lineId, $shiftId, $workDate);
            $sum = array(
                'lName' => '',
                'hour' => 'Total turno',
                'target' => 0,
                'pzOK' => 0,
                'oTarget' => 0,
                'oProduction' => 0,
                'oScrap' => 0,
                'oRework' => 0,
                'oChangeover' => 0,
                'oTechnicalLosses' => 0,
                'oOrganizationalLosses' => 0,
                'oQualityLosses' => 0,
                'oPerformanceLosses' => 0,
            );
            $targetAcumulado = 0;
            $piezasOKAcumulado = 0;
            $scrapAcumulado = 0;
            $reworkAcumulado = 0;
            array_walk($operations, function(&$o) use(&$sum, &$targetAcumulado, &$piezasOKAcumulado, &$scrapAcumulado, &$reworkAcumulado) {
                $o['sumTarget'] = $targetAcumulado = $targetAcumulado + $o['oTarget'];
                $o['sumPzOk'] = $piezasOKAcumulado = $piezasOKAcumulado + $o['oProduction'];
                $o['sumScrap'] = $scrapAcumulado = $scrapAcumulado + $o['oScrap'];
                $o['sumRework'] = $reworkAcumulado = $reworkAcumulado + $o['oRework'];

                $sum['sumTarget'] = $o['sumTarget'];
                $sum['sumPzOk'] = $o['sumPzOk'];
                $sum['oTarget'] += $o['oTarget'];
                $sum['oProduction'] += $o['oProduction'];
                $sum['oScrap'] += $o['oScrap'];
                $sum['oRework'] += $o['oRework'];
                $sum['oChangeover'] += $o['oChangeover'];
                $sum['oTechnicalLosses'] += $o['oTechnicalLosses'];
                $sum['oOrganizationalLosses'] += $o['oOrganizationalLosses'];
                $sum['oQualityLosses'] += $o['oQualityLosses'];
                $sum['oPerformanceLosses'] += $o['oPerformanceLosses'];
            });
            $result = array();
            $result['operations'] = $operations;
            $result['sum'] = $sum;
        }
        $this->set(array('result' => $result, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

    public function getDashboardCaptureSingle() {
        $this->request->onlyAllow('get');
        $params = $this->request->query;
        $operation = false;
        if (isset($params['o']) && isset($params['l']) && isset($params['s']) && isset($params['w'])) {
            $operationId = $params['o'];
            $lineId = $params['l'];
            $shiftId = $params['s'];
            $workDate = $params['w'];
            $operations = $this->Operation->getDashboardCapture($lineId, $shiftId, $workDate);
            $targetAcumulado = 0;
            $piezasOKAcumulado = 0;
            $scrapAcumulado = 0;
            $reworkAcumulado = 0;
            array_walk($operations, function(&$o) use(&$sum, &$targetAcumulado, &$piezasOKAcumulado, &$scrapAcumulado, &$reworkAcumulado) {
                $o['sumTarget'] = $targetAcumulado = $targetAcumulado + $o['oTarget'];
                $o['sumPzOk'] = $piezasOKAcumulado = $piezasOKAcumulado + $o['oProduction'];
                $o['sumScrap'] = $scrapAcumulado = $scrapAcumulado + $o['oScrap'];
                $o['sumRework'] = $reworkAcumulado = $reworkAcumulado + $o['oRework'];
            });
            $operationsFilter = array_filter($operations, function($e)use($operationId) {
                return $e['oId'] == $operationId;
            });
            if (count($operationsFilter) > 0) {
                $operation = reset($operationsFilter);
            }
        }
        $this->set(array('result' => $operation, '_serialize' => 'result'));
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
        $hourId = $this->request->data('hour');
        $workDate = $this->request->data('workDate');
        $changeover = $this->request->data('changeover');
        $technicalLosses = $this->request->data('technicalLosses');
        $organizationalLosses = $this->request->data('organizationalLosses');
        $qualityLosses = $this->request->data('qualityLosses');
        $performanceLosses = $this->request->data('performanceLosses');
        $target = $this->request->data('target');
        $scrap = $this->request->data('scrap');
        $rework = $this->request->data('rework');
        $this->loadModel('ProductModel');
        $this->loadModel('Hour');
        $this->loadModel('Line');
        $line = $this->Line->findById($lineId);
        $hour = $this->Hour->findById($hourId);
        try {
            $newOperation = $this->Operation->insert($userId, $lineId, $hourId, $scrap, $rework, $target, $changeover, $technicalLosses, $organizationalLosses, $qualityLosses, $performanceLosses, $workDate);
            $dtS = new DateTime($hour['Hour']['start']);
            $dtE = new DateTime($hour['Hour']['end']);
            $strHour = $dtS->format('H:i') . ' - ' . $dtE->format('H:i');
            $result = array('success' => false, 'data' => null, 'msg' => '');
            $operation = array(
                'lName' => $line['Line']['name'],
                'hour' => $strHour,
                'user' => $userSesion['name'] . ' ' . $userSesion['last_name'],
                'oProduction' => $newOperation['production'],
                'oScrap' => $newOperation['scrap'],
                'oRework' => $newOperation['rework'],
                'oTarget' => $newOperation['target'],
                'oChangeover' => $newOperation['changeover'],
                'oTechnicalLosses' => $newOperation['technical_losses'],
                'oOrganizationalLosses' => $newOperation['organizational_losses'],
                'oQualityLosses' => $newOperation['quality_losses'],
                'oPerformanceLosses' => $newOperation['performance_losses'],
                'oId' => $newOperation['id'],
                'oStatus' => $newOperation['status'],
                'oWorkDate' => $newOperation['work_date'],
                'oCreationDate' => $newOperation['creation_date'],
                'hId' => $hour['Hour']['id'],
            );
            $result['data'] = $operation;
            $result['success'] = true;
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23000:
                    $result['msg'] = __('Solo puede existir una operacion por combinacion de dia de trabajo, linea y hora');
                    break;
            }
        }
        $this->set(array('result' => $result, '_serialize' => 'result'));
        $this->viewClass = 'Json';
    }

}
