<?php

App::uses('AppModel', 'Model');

class UserLine extends AppModel
{
    public $useTable = 'users_lines';

    /**
     * Obtenemos las lineas que puede manejar un usuario
     * @param string $userId
     * @return array
     */
    public function getByUser($userId)
    {
        $mls = $this->query('
            SELECT 
                  l.name line
                , l.id
            FROM users_lines ul
            INNER JOIN production_lines l ON ul.line_id = l.id
            WHERE user_id = ?
            ORDER BY l.name ASC', array(
            $userId));
        return $this->flatArray($mls);
    }

}
