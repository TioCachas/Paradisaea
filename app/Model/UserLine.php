<?php

App::uses('AppModel', 'Model');
App::uses('Line', 'Model');

class UserLine extends AppModel {

    public $useTable = 'users_lines';

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    /**
     * Obtenemos las lineas que puede manejar un usuario
     * @param string $userId
     * @return array
     */
    public function getByUser($userId) {
        $filters = array(
            'fields' => array(
                'Line.name as lName',
                'Line.id as lId',
            ),
            'joins' => array(
                array('table' => 'lines',
                    'alias' => 'Line',
                    'type' => 'INNER',
                    'conditions' => array(
                        'UserLine.line_id = Line.id',
                        'Line.status' => Line::STATUS_ENABLED,
                    )
                )
            ),
            'conditions' => array(
                'UserLine.user_id' => $userId,
                'UserLine.status' => self::STATUS_ENABLED,
            ),
            'order' => 'Line.name ASC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

}
