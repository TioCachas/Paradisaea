<?php

App::uses('Crud', 'Model');

class ModelLine extends Crud
{
    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $useTable = 'models_lines';

    /**
     * Obtenemos los modelos activos que produce una linea
     * @param integer $lineId
     * @return array
     */
    public function getByLine($lineId)
    {
        $mls = $this->query('
            SELECT m.id, m.name
            FROM models_lines ml
            INNER JOIN models m ON m.id = ml.model_id
            WHERE line_id = ? AND ml.status = 1
            ORDER BY m.name ASC', array(
            $lineId));
        return $this->flatArray($mls);
    }

    public function getEnabledByLine($lineId)
    {
        $workstations = $this->findAllByStatusAndLineId(self::STATUS_ENABLED, $lineId);
        return $this->flatArray($workstations);
    }

}
