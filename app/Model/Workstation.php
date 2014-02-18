<?php

App::uses('AppModel', 'Model');

class Workstation extends AppModel {

    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Obtenemos los estaciones de trabajo activas para una linea de produccion
     * @param integer $lineId
     * @return array
     */
    public function getEnabledByLine($lineId) {
        $order = array('name' => 'ASC');
        $workstations = $this->findAllByStatusAndLineId(self::STATUS_ENABLED, $lineId, array(), $order);
        return $workstations;
    }

}
