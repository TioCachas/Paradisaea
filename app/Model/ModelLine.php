<?php

App::uses('AppModel', 'Model');
App::uses('ProductModel', 'Model');
App::uses('Line', 'Model');

class ModelLine extends AppModel {

    public $useTable = 'models_lines';

    /**
     * Obtenemos los modelos activos que produce una linea
     * @param integer $lineId
     * @return array
     */
    public function getByLine($lineId) {
        $mls = $this->query('
            SELECT m.id, m.name
            FROM models_lines ml
            INNER JOIN models m ON m.id = ml.model_id
            WHERE line_id = ?
            ORDER BY m.name ASC', array($lineId));
        return $mls;
    }

}
