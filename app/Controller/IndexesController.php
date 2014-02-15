<?php

App::uses('AppController', 'Controller');

class IndexesController extends AppController {

    /**
     * @param type $modelId
     */
    public function getOptions($modelId) {
        $this->loadModel('IndexModel');
        $indexes = $this->IndexModel->getEnabledByModel($modelId);
        $this->set('indexes', $indexes);
        $this->layout = 'ajax';
    }

}
