<?php

App::uses('AppModel', 'Model');
App::uses('ProductModel', 'Model');

class IndexModel extends AppModel {

    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $useTable = 'indexes_models';

    /**
     * Obtenemos los index que estan asociados al modelo
     * @param integer $lineId
     * @return array
     */
    public function getEnabledByModel($modelId) {
        $mls = $this->query('
            SELECT i.id, i.name
            FROM indexes_models im
            INNER JOIN indexes i ON i.id = im.index_id
            WHERE 
                    i.status = ' . ProductModel::STATUS_ENABLED . '
                AND im.model_id = ?
            ORDER BY i.name ASC', array($modelId));
        return $mls;
    }

}
