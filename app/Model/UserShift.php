<?php

App::uses('AppModel', 'Model');
App::uses('Shift', 'Model');

class UserShift extends AppModel
{
    public $useTable = 'users_shifts';

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    /**
     * Obtenemos los turnos de un usuario
     * @param string $userId uuid
     * @return array
     */
    public function getByUser($userId)
    {
        $results = $this->query('
            SELECT 
                  s.name sName
                , s.id sId
            FROM users_shifts us
            INNER JOIN shifts s ON us.shift_id = s.id
            WHERE 
                    us.user_id = ?
                AND us.status = ' . self::STATUS_ENABLED . '
            ORDER BY s.number ASC', array(
            $userId));
        return $this->flatArray($results);
    }

}
