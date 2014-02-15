<?php

App::uses('AppModel', 'Model');

class ProductModel extends AppModel {

    public $useTable = 'models';
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Inhabilitamos una operacion, al cambiar su estatus
     * @param integer $id Id de la operacion que queremos deshabilitar
     */
    public function disabled($id) {
        $this->query('
            UPDATE models
            SET status = ' . self::STATUS_DISABLED . '
            WHERE id = ?', array($id));
    }

    public function getEnabled() {
        return $this->findAllByStatus(self::STATUS_ENABLED);
    }

}
