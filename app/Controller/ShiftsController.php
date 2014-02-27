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
        $this->loadModel('Shift');
        $this->loadModel('Line');
        $shifts = $this->Shift->getAll();
        $lines = $this->Line->getEnabled();
        $this->set('shifts', $shifts);
        $this->set('lines', $lines);
        $this->Session->write('referer', $this->request->referer(true));
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
                $bosch->setConfiguration(new ConfigCapture($shiftId, $shift['Shift']['name'], $lineId, $line['Line']['name'], $model, $model['ModelB']['id']));
                $this->Session->write('configuration', $bosch);
                $this->checkReferer();
                return;
            }
        }
        /**
         * Si los paremetros no fueron correctos, hacemos una redireccion para 
         * permitir un nuevo intento.
         */
        $this->redirect('config');
    }

    /**
     * Realizamos una redireccion en caso de que exista un referer.
     */
    private function checkReferer() {
        $urlReferer = $this->Session->read('referer');
        if ($urlReferer !== null) {
            $this->redirect($urlReferer);
        }
    }

}
