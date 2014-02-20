<?php

App::uses('AppModel', 'Model');

class Hour extends AppModel {

    /**
     * Obtenemos las horas para un turno especifico
     * @param integer $shiftId
     * @return array
     */
    public function getByShift($shiftId) {
        return $this->findAllByShiftId($shiftId, array(), array('number' => 'ASC'));
    }

    /**
     * Obtenemos todas las horas ordenadas de mayor a menor por su hora de inicio
     * @return array
     */
    public function getAll() {
        return $this->find('all', array('order' => 'number ASC'));
    }

}
