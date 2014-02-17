<?php

App::uses('AppModel', 'Model');

class Production extends AppModel {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Cambiamos el estado de una produccion
     * enabled => disabled
     * disabled => enabled
     * @param string $id
     */
    public function toggleStatus($id)
    {
        $this->query('
            UPDATE productions
            SET status = IF(status = 1, '.self::STATUS_DISABLED.', '.self::STATUS_ENABLED.')
            WHERE id = ?', array($id));
    }

    /**
     * Obtenemos las producciones de una operacion ordenadas por la fecha
     * de creacion de la operacion y por el nombre del modelo
     * @param integer $operationId
     * @return array
     */
    public function getByOperationId($operationId) {
        $params = array($operationId);
        $operations = $this->query("
            SELECT 
                p.id pId
              , p.value pValue
              , p.status pStatus
              , p.creation_date pCreationDate
              , p.operation_id pOperationId -- Lo devolvemos para tener una referencia a la operacion
              , m.name mName
              , i.name iName
            FROM productions p
            INNER JOIN models m ON p.model_id = m.id
            INNER JOIN indexes i ON p.index_id = i.id
            WHERE p.operation_id = ?
            ORDER BY p.creation_date DESC, m.name ASC", $params);
        return $this->flatArray($operations);
    }

}
