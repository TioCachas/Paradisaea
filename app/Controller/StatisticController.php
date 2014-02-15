<?php

App::uses('Controller', 'Controller');
App::uses('Day', 'Model');
App::uses('StatisticDay', 'Model');
App::uses('StatisticDays', 'Model');
App::uses('Bosch', 'Model');

class StatisticController extends AppController {

    public function __constructor() {

        $this->layout = 'base';
    }

    public function beforeFilter() {
        $bosch = $this->Session->read('configuration');
        if (($bosch instanceof Bosch) === false) {
            $this->redirect(array('controller' => 'Shifts', 'action' => 'config'));
        }
        parent::beforeFilter();
    }

    public function index() {
        $this->loadModel('Operation');
        $this->loadModel('ConfigLine');
        $dt = new BoschDateTime();
        $dates = $dt->currentMonth();
        $bosch = $this->Session->read('configuration');
        $lineId = $bosch->getConfiguration()->getLine();
        $configLines = $this->ConfigLine->getByLine($lineId);
        $operationsGroupByDate = $this->Operation->getOperationsByLineGroupByDate($lineId, $dates['startDate'], $dates['endDate']);
        $sw = new StatisticDays($configLines, $dates['startDate'], $dates['endDate'], $operationsGroupByDate);
        $this->set('week', $sw);
        $this->set('title', __('Estadisticas'));
        $this->set('description', __('Estadisticas'));
    }

    public function byCurrentWeek() {
        $this->set('description', __('Estadisticas'));
    }

}
