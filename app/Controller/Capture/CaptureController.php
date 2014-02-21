<?php

App::uses('AppController', 'Controller');

class CaptureController extends AppController {

    protected $line;
    protected $shift;

    public function __construct($request = null, $response = null) {
        $bosch = $this->Session->read('configuration');
        $this->line = $bosch->getConfiguration()->getLine();
        $this->shift = $bosch->getConfiguration()->getShift();
        parent::__construct($request, $response);
    }

}
