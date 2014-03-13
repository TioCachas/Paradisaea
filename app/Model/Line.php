<?php

App::uses('AppModel', 'Model');

class Line extends AppModel {

    public $useTable = 'production_lines';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Cambiamos el estado de una linea
     * enabled => disabled
     * disabled => enabled
     * @param string $id
     */
    public function toggleStatus($id) {
        $this->query('
            UPDATE production_lines
            SET status = IF(status = 1, ' . self::STATUS_DISABLED . ', ' . self::STATUS_ENABLED . ')
            WHERE id = ?', array(
            $id));
    }

    /**
     * Obtenemos los registros habilitados
     * @return type
     */
    public function getEnabled() {
        $order = array('name' => 'ASC');
        $records = $this->findAllByStatus(self::STATUS_ENABLED, array(), $order);
        return $this->flatArray($records);
    }

    /**
     * Obtenemos todas las lineas que pertenezcan a un area especificada y con 
     * estatus especifico.
     * @param string $areaId
     * @param integer $status
     * @return array
     */
    public function getByAreaIdAndStatus($areaId, $status = self::STATUS_ENABLED) {
        $order = array('name' => 'ASC');
        $lines = $this->findAllByAreaIdAndStatus($areaId, $status, array(), $order);
        return $lines;
    }

    /**
     * Obtenemos las lineas que pertenencen a la misma area a donde pertenece la
     * linea pasada como parametro y que esten habilitadas.
     * @param string $lineId
     * @return array
     */
    public function getSelfAreaEnabled($lineId) {
        $lines = $this->query("
            SELECT Line.*
            FROM production_lines l
            INNER JOIN production_lines Line ON Line.area_id = l.area_id
            WHERE l.id = ?
            AND Line.status = " . self::STATUS_ENABLED, array(
            $lineId));
        return $lines;
    }

    /**
     * Insertamos un registro
     * @param array $newData
     * @return array
     */
    public function insert($newData) {
        return $this->save($newData);
    }

    /**
     * Actualizamos un registro
     * @param string $id
     * @param array $modifyData
     * @return array
     */
    public function update($id, $modifyData) {
        $this->id = $id;
        return $this->save($modifyData);
    }

}
