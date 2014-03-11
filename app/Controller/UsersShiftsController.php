<?php

App::uses('Controller', 'Controller');

class UsersShiftsController extends AppController
{
    /**
     * Obtenemos el arreglo con las líneas que permite manejar el usuario que
     * recibe como parámetro
     */
    public function getShiftsByUser()
    {
        $this->request->onlyAllow('get');
        $filter = $this->request->query['filter']['filters'][0];
        $this->loadModel('UserShift');
        $shifts = $this->UserShift->getByUser($filter['value']);
        $this->set(array('shifts' => $shifts, '_serialize' => 'shifts'));
        $this->viewClass = 'Json';
    }

}
