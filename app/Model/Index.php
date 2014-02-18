<?php

App::uses('AppModel', 'Model');

class Index extends AppModel {

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
    public function getEnabled() {
        return $this->findAllByStatus(self::STATUS_ENABLED);
    }

}
