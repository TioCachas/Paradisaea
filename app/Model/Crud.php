<?php

App::uses('AppModel', 'Model');

abstract class Crud extends AppModel
{

    /**
     * Obtenemos los registros habilitados
     * @return type
     */
    abstract public function getEnabled();

    /**
     * Insertamos un registro
     * @param array $newData
     * @return array
     */
    final public function insert($newData)
    {
        $newData['id'] = null;
        return $this->save($newData);
    }

    /**
     * Actualizamos un registro
     * @param string $id
     * @param array $modifyData
     * @return array
     */
    final public function update($id, $modifyData)
    {
        $this->id = $id;
        return $this->save($modifyData);
    }

    /**
     * Deshabilitamos un registro
     * @param string $id
     * @param int $status
     * @return array
     */
    final public function destroy($id, $status)
    {
        $modifyData = array();
        $modifyData['id'] = $id;
        $modifyData['status'] = $status;
        return $this->save($modifyData);
    }

}
