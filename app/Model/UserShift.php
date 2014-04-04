<?php

App::uses('AppModel', 'Model');
App::uses('Shift', 'Model');

class UserShift extends AppModel {

    public $useTable = 'users_shifts';

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    /**
     * Obtenemos los turnos de un usuario
     * @param string $userId uuid
     * @return array
     */
    public function getByUser($userId) {
        $filters = array(
            'fields' => array(
                'Shift.name as sName',
                'Shift.id as sId',
            ),
            'joins' => array(
                array('table' => 'shifts',
                    'alias' => 'Shift',
                    'type' => 'INNER',
                    'conditions' => array(
                        'UserShift.shift_id = Shift.id',
                    )
                )
            ),
            'conditions' => array(
                'UserShift.user_id' => $userId,
                'UserShift.status' => self::STATUS_ENABLED,
            ),
            'order' => 'Shift.number ASC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

}
