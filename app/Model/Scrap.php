<?php

App::uses('Crud', 'Model');

class Scrap extends Crud
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Cambiamos el estado de un registro
     * enabled => disabled
     * disabled => enabled
     * @param string $id
     */
    public function toggleStatus($id)
    {
        $this->query('
            UPDATE scraps
            SET status = IF(status = 1, ' . self::STATUS_DISABLED . ', ' . self::STATUS_ENABLED . ')
            WHERE id = ?', array(
            $id));
    }
    
    /**
     * Obtenemos los registros asociados a una operacion y que cumplan con los 
     * requisitos de estatus (activos, inactivos o activos e inactivos juntos).
     * @param type $operationId
     * @param type $statusArray
     * @return type
     */
    public function getEnabledByOperationId($operationId) {
        $filters = array(
            'conditions' => array(
                'status' => self::STATUS_ENABLED,
                'operation_id' => $operationId,
            ),
            'order' => 'creation_date DESC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

}
