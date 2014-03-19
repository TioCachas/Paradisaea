<?php

App::uses('Crud', 'Model');

class Defect extends Crud {

    /**
     * Al Agregar/eliminar/actualizar las constantes de los modelos implica ir
     * y actualizar los comentarios en los campos de la tabla asociada a este modelo.
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const TYPE_CHANGEOVER = 1;
    const TYPE_TECHNICAL = 2;
    const TYPE_PERFORMANCE = 3;
    const TYPE_ORGANIZATIONAL = 4;
    const TYPE_QUALITY = 5;

    /**
     * Creamos un arreglo con los tipos de pérdida
     * IMPORTANTE! En caso de modificar los datos retornados por esta funcion es
     * necesario ir a actualizar la funcion typesTextAndValue
     * @return type
     */
    static public function types() {
        $types = array(
            self::TYPE_CHANGEOVER => __('Pérdida por cambio de modelo'),
            self::TYPE_TECHNICAL => __('Pérdida técnicas'),
            self::TYPE_PERFORMANCE => __('Pérdida de desempeño'),
            self::TYPE_ORGANIZATIONAL => __('Pérdida organizacional'),
            self::TYPE_QUALITY => __('Pérdida de calidad'),
        );
        return $types;
    }

    /**
     * Creamos un arreglo con los tipos de pérdida, con el siguiente formato
     * 'value' => 'valor', 'text' => 'texto'
     * IMPORTANTE! En caso de modificar los datos retornados por esta funcion es
     * necesario ir a actualizar la funcion types
     * @return array
     */
    static public function typesTextAndValue() {
        $types = array(
            array('value' => self::TYPE_CHANGEOVER, 'text' => __('Pérdida por cambio de modelo')),
            array('value' => self::TYPE_TECHNICAL, 'text' => __('Pérdida técnicas')),
            array('value' => self::TYPE_PERFORMANCE, 'text' => __('Pérdida de desempeño')),
            array('value' => self::TYPE_ORGANIZATIONAL, 'text' => __('Pérdida organizacional')),
            array('value' => self::TYPE_QUALITY, 'text' => __('Pérdida de calidad')),
        );
        return $types;
    }

    /**
     * obtenemos los defectos que puede generar una linea de trabajo
     * @param string $workstationId
     * @return array
     */
    public function getEnabledByWorkstation($workstationId) {
        $order = array('creation_date' => 'DESC');
        $defects = $this->findAllByStatusAndWorkstationId(self::STATUS_ENABLED, $workstationId, array(), $order);
        return $this->flatArray($defects);
    }
    
    public function getEnabledByWorkstationAndType($workstationId, $type) {
        $filters = array(
            'conditions' => array(
                'status' => self::STATUS_ENABLED,
                'workstation_id' => $workstationId,
                'type' => $type,
            ),
            'order' => 'creation_date ASC',
        );
        $records = $this->find('all', $filters);
        return $this->flatArray($records);
    }

    /**
     * Obtenemos todos los defectos habilitados de una linea
     * @param type $operationId
     * @return type
     */
    public function getEnabledByLineId($lineId) {
        $params = array($lineId);
        $records = $this->query('
            SELECT d.* 
            FROM defects d
            INNER JOIN workstations w ON d.workstation_id = w.id
            WHERE w.line_id = ?', $params);
        return $this->flatArray($records);
    }

}
