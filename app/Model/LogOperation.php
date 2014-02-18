<?php

App::uses('AppModel', 'Model');

class LogOperation extends AppModel
{

    public function addLog($id, $userId, $comment)
    {
        $db = $this->getDataSource();
        $db->fetchAll("INSERT INTO log_operations(id, user_id, line_id, hour_id, production, 
                scrap, rework, changeover, technical_losses, 
                organizational_losses, work_date, creation_date, 
                status, sesion_user_id, comment) 
            SELECT 
                id, user_id, line_id, hour_id, production, 
                scrap, rework, changeover, technical_losses, 
                organizational_losses, work_date, creation_date, 
                status, :userId, :comment
            FROM operations
            WHERE id = :id", array(
            'userId' => $userId, 'comment' => $comment, 'id' => $id));
    }

}
