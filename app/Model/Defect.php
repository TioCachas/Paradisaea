<?php

App::uses('AppModel', 'Model');

class Defect extends AppModel {

    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * obtenemos los defectos que puede generar una linea de trabajo
     * @param integer $workstationId
     * @return array
     */
    public function getEnabledByWorkstation($workstationId) {
        $order = array('code' => 'ASC');
        $defects = $this->findAllByStatusAndWorkstationId(self::STATUS_ENABLED, $workstationId, array(), $order);
        return $this->flatArray($defects);
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
