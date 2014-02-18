<?php

App::uses('AppModel', 'Model');

class ConfigLine extends AppModel {

    /**
     * Buscamos la configuracion de una linea de produccion y la regresamos en 
     * un arreglo asociativo donde el dia es el key del arreglo y como value es
     * la configuracion para ese dia.
     * @param integer $lineId
     * @return array
     */
    public function getByLine($lineId) {
        $configs = $this->findAllByLineId($lineId);
        $c = array();
        foreach ($configs as $cnfg) {
            $c[$cnfg['ConfigLine']['day']] = $cnfg['ConfigLine'];
        }
        return $c;
    }

}
