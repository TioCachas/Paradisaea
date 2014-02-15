<?php

App::uses('AppController', 'Controller');

class DefectsController extends AppController {

    /**
     * Esta accion se encarga de generar las opciones para un combo de defectos
     * por estacion de trabajo
     * @param integer $encryptId
     */
    public function getOptions($encryptId) {
        $id = Id::d($encryptId);
        $defects = $this->Defect->getEnabledByWorkstation($id);
        $this->set('defects', $defects);
        $this->layout = 'ajax';
    }

}
