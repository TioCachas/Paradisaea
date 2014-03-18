<?php

App::uses('Crud', 'Model');

class Index extends Crud
{
    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $useTable = 'indexes';

    /**
     * Obtenemos todos los indexes que estan habilitados
     * @return type
     */
    public function getEnabledByModelId($modelId)
    {
        $order = array('name' => 'ASC');
        $records = $this->findAllByStatusAndModelId(self::STATUS_ENABLED, $modelId, array(), $order);
        return $this->flatArray($records);
    }

}
