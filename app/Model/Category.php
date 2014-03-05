<?php

App::uses('AppModel', 'Model');

class Category extends AppModel {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $useTable = 'categories';
    
    /**
     * Obtenemos la categoria identificada por su ID
     * @param string $id
     * @return array
     */
    public function getById($id)
    {
        $this->id = $id;
        return $this->read();
    }

}
