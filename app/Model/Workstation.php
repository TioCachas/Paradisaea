<?php

App::uses('Crud', 'Model');
App::uses('Defect', 'Model');

class Workstation extends Crud
{
    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**
     * Tipos de estacion
     */
    const TYPE_CHANGEOVER = 1;
    const TYPE_TECHNICAL = 2;
    const TYPE_PERFORMANCE = 3;
    const TYPE_ORGANIZATIONAL = 4;
    const TYPE_QUALITY = 5;
    const TYPE_SCRAP = 6;
    const TYPE_REWORK = 7;

    /**
     * Obtenemos los estaciones de trabajo activas para una linea de produccion
     * @param integer $lineId
     * @return array
     */
    public function getEnabledByLine($lineId)
    {
        $order = array('name' => 'ASC');
        $workstations = $this->findAllByStatusAndLineId(self::STATUS_ENABLED, $lineId, array(
                ), $order);
        return $this->flatArray($workstations);
    }

    /**
     * Obtenemos las estaciones de trabajo activas por tipo
     * @param type $lineId
     * @param type $type
     * @return type
     */
    public function getEnabledByLineAndType($lineId, $type)
    {
        $filters = array(
            'conditions' => array(
                'status' => self::STATUS_ENABLED,
                'line_id' => $lineId,
                'type' => $type,
            ),
            'order' => 'name ASC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

    public function getEnabledByLineAndType2($lineId, $type)
    {
        $filters = array(
            'joins' => array(
                array('table' => 'defects',
                    'alias' => 'Defect',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Workstation.id = Defect.workstation_id',
                        'Defect.status = '.Defect::STATUS_ENABLED,
                        'Defect.type = '.$type
                    )
                )
            ),
            'conditions' => array(
                'Workstation.status' => self::STATUS_ENABLED,
                'Workstation.line_id' => $lineId,
            ),
            'group' => array(
                'Workstation.id'
            ),
            'order' => 'name ASC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

    /**
     * Obtenemos las estaciones de trabajo de una linea
     * @param string $lineId
     * @return array
     */
    public function getByLine($lineId)
    {
        $order = array('name' => 'ASC');
        $workstations = $this->findAllByLineId($lineId, array(), $order);
        return $workstations;
    }

    /**
     * Obtenemos las estaciones de trabajo de una linea con detalles sobre la linea
     * @param string $lineId
     */
    public function getEnabledByLineDetail($lineId)
    {
        $params = array(
            'lId' => $lineId,
        );
        $records = $this->query('
            SELECT 
                  w.id wId
                , w.name wName
                , w.status wStatus
                , l.name lName
                , l.id lId
            FROM workstations w
            INNER JOIN production_lines l ON w.line_id = l.id
            WHERE 
                    w.line_id = :lId
                AND w.status = ' . self::STATUS_ENABLED . '
            ORDER BY w.name ASC', $params);
        return $this->flatArray($records);
    }

}
