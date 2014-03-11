<?php

App::uses('AppModel', 'Model');

class Scrap extends AppModel
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
    public function getByOperationId($operationId, $statusArray = array(self::STATUS_ENABLED,
        self::STATUS_DISABLED))
    {
        $params = array($operationId);
        $operations = $this->query("
            SELECT 
                s.id sId
              , s.value sValue
              , s.comment sComment
            FROM scraps s
            WHERE s.operation_id = ? AND s.status IN (" . implode(',', $statusArray) . ")
            ORDER BY s.creation_date DESC", $params);
        return $this->flatArray($operations);
    }

    /**
     * Insertamos un registro
     * @param type $operationId
     * @param type $value
     * @param type $comment
     * @return array
     */
    public function insert($operationId, $value, $comment)
    {
        $data = array();
        $data['operation_id'] = $operationId;
        $data['value'] = $value;
        $data['comment'] = $comment;
        $data['status'] = self::STATUS_ENABLED;
        $newRecord = $this->save($data);
        return $newRecord['Scrap'];
    }

}
