<?php

App::uses('Controller', 'Controller');
App::uses('Bosch', 'Model');

class ShiftsController extends AppController {

    public $helpers = array('Bosch');

    public function beforeFilter() {
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
        parent::beforeFilter();
    }

    public function __construct($request = null, $response = null) {
        $this->set('title', __('Turnos'));
        $this->set('description', __('Iniciar turno'));
        parent::__construct($request, $response);
    }

    public function config() {
        $user = $this->Auth->user();
        $this->loadModel('UserShift');
        $this->loadModel('UserLine');
        $shifts = $this->UserShift->getByUser($user['id']);
        $lines = $this->UserLine->getByUser($user['id']);
        $this->set('shifts', $shifts);
        $this->set('lines', $lines);
    }

    /**
     * Colocamos la configuracion para la captura en sesion.
     */
    public function setConfig() {
        $this->request->onlyAllow('post');
        $data = $this->request->data;
        if (isset($data['inputLine']) &&
                isset($data['inputShift']) &&
                isset($data['inputModel'])) {
            $lineId = $data['inputLine'];
            $shiftId = $data['inputShift'];
            $modelId = $data['inputModel'];
            $this->loadModel('Line');
            $this->loadModel('ModelB');
            $line = $this->Line->findById($lineId);
            $shift = $this->Shift->findById($shiftId);
            $model = $this->ModelB->findById($modelId);
            if (empty($line) === false &&
                    empty($shift) === false &&
                    empty($model) === false) {
                $bosch = new Bosch();
                $bosch->setConfiguration(new ConfigCapture($shiftId, $shift['Shift']['name'], $lineId, $line['Line']['name'], $modelId, $model['ModelB']['name']));
                $this->Session->write('configuration', $bosch);
                $this->redirect(array('controller' => 'Operations', 'action' => 'capture'));
                return;
            }
        }
        /**
         * Si los paremetros no fueron correctos, hacemos una redireccion para 
         * permitir un nuevo intento.
         */
        $this->redirect('config');
    }

}
