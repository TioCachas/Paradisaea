<?php

App::uses('AppModel', 'Model');
App::uses('Line', 'Model');

class UserLine extends AppModel
{
    public $useTable = 'users_lines';

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    /**
     * Obtenemos las lineas que puede manejar un usuario
     * @param string $userId
     * @return array
     */
    public function getByUser($userId)
    {
        $mls = $this->query('
            SELECT 
                  l.name lName
                , l.id lId
            FROM users_lines ul
            INNER JOIN production_lines l ON ul.line_id = l.id
            WHERE 
                    ul.user_id = ?
                AND ul.status = ' . self::STATUS_ENABLED . '
                AND l.status = '.Line::STATUS_ENABLED.'
            ORDER BY l.name ASC', array(
            $userId));
        return $this->flatArray($mls);
    }

}
