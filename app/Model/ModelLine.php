<?php

App::uses('AppModel', 'Model');
App::uses('ProductModel', 'Model');
App::uses('Line', 'Model');

class ModelLine extends AppModel {

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
    public function getEnabledByLine($lineId) {
        $mls = $this->query('
            SELECT m.id, m.name
            FROM models_lines ml
            INNER JOIN models m ON m.id = ml.model_id
            WHERE 
                    m.status = ' . ProductModel::STATUS_ENABLED . '
                AND line_id = ?
            ORDER BY m.name ASC', array($lineId));
        return $mls;
    }

}
