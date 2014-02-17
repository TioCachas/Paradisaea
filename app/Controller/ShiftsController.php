<?php

App::uses('Controller', 'Controller');
App::uses('Bosch', 'Model');

class ShiftsController extends AppController {

    public $helpers = array('Bosch');

    public function __construct($request = null, $response = null) {
        $this->set('title', __('Turnos'));
        $this->set('description', __('Selecciona turno y línea de producción'));
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

    public function setConfig() {
        $urlReferer = $this->Session->read('referer');
        $this->loadModel('Line');
        $shiftId = $this->request->data('inputShift');
        $lineId = $this->request->data('inputLine');
        $shift = $this->Shift->findById($shiftId);
        $line = $this->Line->findById($lineId);
        $bosch = new Bosch();
        $bosch->setConfiguration(new Configuration($shiftId, $shift['Shift']['name'], $lineId, $line['Line']['name']));
        $this->Session->write('configuration', $bosch);
        if($urlReferer !== null)
        {
            $this->redirect($urlReferer);
            return;
        }
    }

}
