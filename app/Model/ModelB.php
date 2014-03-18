<?php

App::uses('Crud', 'Model');

class ModelB extends Crud
{
    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $useTable = 'models';

    /**
     * Obtenemos los registros habilitados
     * @param string $lineId
     * @return array
     */
    public function getEnabled()
    {
        $order = array('name' => 'ASC');
        $records = $this->findAllByStatus(self::STATUS_ENABLED, array(), $order);
        return $this->flatArray($records);
    }

}
