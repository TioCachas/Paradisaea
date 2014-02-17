<?php

App::uses('AppModel', 'Model');

class Shift extends AppModel {

    /**
     * Leemos todos los turnos
     * @return array
     */
    public function getAll() {
        return $this->find('all');
    }

}
