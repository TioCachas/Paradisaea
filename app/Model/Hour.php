<?php

App::uses('AppModel', 'Model');

class Hour extends AppModel
{

    /**
     * Obtenemos las horas activas para un turno especifico
     * @param integer $shiftId
     * @return array
     */
    public function getEnabledByShift($shiftId)
    {
        return $this->findAllShiftId($shiftId, array(
                        ), array('id' => 'asc'));
    }
    
    /**
     * Obtenemos todas las horas ordenadas de mayor a menor por su hora de inicio
     * @return array
     */
    public function getAll()
    {
        return $this->find('all',array('order' => 'start ASC'));
    }

}
