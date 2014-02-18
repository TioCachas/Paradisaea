<?php

App::uses('AppModel', 'Model');

class LogProduction extends AppModel {

    /**
     * Respaldamos production identificada por su id
     * @param type $id
     * @param type $userId
     * @param type $comment
     */
    public function addLog($id, $userId, $comment) {
        $db = $this->getDataSource();
        $db->fetchAll("INSERT INTO log_productions(
                id, operation_id, model_id, index_id, value, status, creation_date,
                sesion_user_id, comment) 
            SELECT 
                id, operation_id, model_id, index_id, value, status, creation_date,
                :userId, :comment
            FROM productions
            WHERE id = :id", array(
            'userId' => $userId, 'comment' => $comment, 'id' => $id));
    }

}
