<?php

App::uses('AppModel', 'Model');

class Operation extends AppModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Creamos una operación
     * @param type $userId
     * @param type $lineId
     * @param type $hourId
     * @param type $changeover
     * @param type $technicalLosses
     * @param type $organizationalLosses
     * @param type $qualityLosses
     * @param type $performanceLosses
     * @param type $workDate
     */
    public function insert($userId, $lineId, $hourId, $scrap, $rework, $changeover, $technicalLosses, $organizationalLosses, $qualityLosses, $performanceLosses, $workDate)
    {
        $data = array();
        $data['user_id'] = $userId;
        $data['line_id'] = $lineId;
        $data['hour_id'] = $hourId;
        $data['production'] = 0;
        $data['scrap'] = $scrap;
        $data['rework'] = $rework;
        $data['changeover'] = $changeover;
        $data['technical_losses'] = $technicalLosses;
        $data['organizational_losses'] = $organizationalLosses;
        $data['quality_losses'] = $qualityLosses;
        $data['performance_losses'] = $performanceLosses;
        $data['work_date'] = $workDate;
        $data['status'] = self::STATUS_ENABLED;
        $this->save($data);
        $dt = new DateTime();
        $data['creation_date'] = $dt->format('Y-m-d H:i:s');
        $data['id'] = $this->getLastInsertID();
        return $data;
    }

    /**
     * Cambiamos el estado de una produccion
     * enabled => disabled
     * disabled => enabled
     * @param string $id
     */
    public function toggleStatus($id)
    {
        $this->query('
            UPDATE operations
            SET status = IF(status = 1, ' . self::STATUS_DISABLED . ', ' . self::STATUS_ENABLED . ')
            WHERE id = ?', array(
            $id));
    }

    /**
     * Cambiamos la hora de una operación
     * @param string $id
     * @param string $hourId
     */
    public function changeHour($id, $hourId)
    {
        $this->query('
            UPDATE operations
            SET hour_id = ?
            WHERE id = ?', array(
            $hourId, $id));
    }

    /**
     * Cambiamos la linea a la que pertenece una operacion
     * @param string $id
     * @param string $lineId
     */
    public function changeLine($id, $lineId)
    {
        $this->query('
            UPDATE operations
            SET line_id = ?
            WHERE id = ?', array(
            $lineId, $id));
    }

    /**
     * Obtenemos las operaciones correctas del dia actual para un usuario especifico.
     * @param integer $userId Buscamos las operaciones de este usuario
     * @return array Arreglo con las operaciones del usuario.
     */
    public function getCurrentsByUserId($userId, $statusArray = array(self::STATUS_DISABLED,
        self::STATUS_ENABLED))
    {
        $operations = $this->query('
            SELECT 
                  o.id oId
                , l.name lName
                , o.work_date oWorkDate
                , concat( DATE_FORMAT(h.start, "%H:%i"), " - ", DATE_FORMAT(h.end, "%H:%i") ) hour
                , o.production oProduction
                , o.scrap oScrap
                , o.rework oRework
                , o.changeover oChangeover
                , o.technical_losses oTechnicalLosses
                , o.organizational_losses oOrganizationalLosses
                , o.quality_losses oQualityLosses
                , o.performance_losses oPerformanceLosses
            FROM operations o
            INNER JOIN production_lines l ON l.id = o.line_id
            INNER JOIN hours h ON h.id = o.hour_id
            WHERE 
                    o.status IN (' . implode(',', $statusArray) . ')
                AND o.user_id = ?        
                AND DATE(o.creation_date) = DATE(NOW())
            ORDER BY o.creation_date DESC', array(
            $userId));
        return $this->flatArray($operations);
    }

    /**
     * Obtenemos las operaciones de una linea agrupadas por fecha. Las operaciones
     * deben estar activas y encontrarse entre una fecha inicial y una fecha final.
     * Se incluyen los limites
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return array
     */
    public function getOperationsByLineGroupByDate($lineId, $startDate, $endDate)
    {
        $params = array(
            $lineId,
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d'));
        $operations = $this->query('
            SELECT 
                  work_date dateOperation
                , SUM(production) sumProduction
                , SUM(scrap) sumScrap
                , SUM(rework) sumRework
                , SUM(changeover) sumChangeover
                , SUM(technical_losses) sumTechnicalLosses
                , SUM(organizational_losses) sumOrganizationalLosses	
            FROM operations
            WHERE 
                    status = ' . self::STATUS_ENABLED . '
                    AND line_id = ?
                    AND DATE(creation_date) >= DATE(?)
                    AND DATE(creation_date) <= DATE(?)
            GROUP BY line_id, work_date
            ORDER BY dateOperation', $params);
        return $operations;
    }

    /**
     * Obtenemos las operaciones por dia de trabajo. Las operaciones se ordenan 
     * por linea y fecha de las operaciones (primero las mas recientes)
     * @param type $workDate
     * @return type
     */
    public function getByWorkDate($workDate)
    {
        $params = array($workDate);
        $operations = $this->query("
            SELECT 
                  l.name lName
                , l.id lId
                , CONCAT(h.start, ' - ', h.end) hour
                , CONCAT(u.name, ' ', u.last_name) user
                , h.id hId
                , o.production oProduction
                , o.scrap oScrap
                , o.rework oRework
                , o.changeover oChangeover
                , o.technical_losses oTechnicalLosses
                , o.organizational_losses oOrganizationalLosses
                , o.quality_losses oQualityLosses
                , o.performance_losses oPerformanceLosses
                , o.id oId
                , o.status oStatus
                , o.creation_date oCreationDate
            FROM operations o
            INNER JOIN us3rs_m0n1t0r u ON u.id = o.user_id
            INNER JOIN production_lines l ON o.line_id = l.id
            INNER JOIN hours h ON o.hour_id = h.id
            WHERE o.work_date = ?
            ORDER BY o.creation_date DESC, l.name ASC", $params);
        return $this->flatArray($operations);
    }

    /**
     * Obtenemos los datos de una operacion.
     * @param string $id
     * @return type
     */
    public function getById($id)
    {
        $params = array($id);
        $operations = $this->query("
            SELECT 
                  l.name lName
                , CONCAT(h.start, ' - ', h.end) hour
                , CONCAT(u.name, ' ', u.last_name) user
                , o.production oProduction
                , o.scrap oScrap
                , o.rework oRework
                , o.changeover oChangeover
                , o.technical_losses oTechnicalLosses
                , o.organizational_losses oOrganizationalLosses
                , o.quality_losses oQualityLosses
                , o.performance_losses oPerformanceLosses
                , o.id oId
                , o.status oStatus
                , o.creation_date oCreationDate
            FROM operations o
            INNER JOIN us3rs_m0n1t0r u ON u.id = o.user_id
            INNER JOIN production_lines l ON o.line_id = l.id
            INNER JOIN hours h ON o.hour_id = h.id
            WHERE o.id = ?
            ORDER BY o.creation_date DESC, l.name ASC", $params);
        return $this->flatArray($operations);
    }

    /**
     * Obtenemos el nombre de una operacion. Se forma con la concatenación del nombre
     * de la linea a la que pertenece y al dia de trabajo
     * @param string $id
     * @return string
     */
    public function getName($id)
    {
        $strName = '';
        $operation = $this->query("
            SELECT CONCAT(l.name, '-', o.work_date) name
            FROM operations o
            INNER JOIN production_lines l ON o.line_id = l.id
            WHERE o.id = ?
            LIMIT 1", array(
            $id));
        if (isset($operation[0]))
        {
            $o = $operation[0];
            $strName = $o[0]['name'];
        }
        return $strName;
    }

}
