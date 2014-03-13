<?php

App::uses('AppModel', 'Model');

class Area extends AppModel {

    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

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
    public function update($id, $modifyData)
    {
        $this->id = $id;
        return $this->save($modifyData);
    }

}
