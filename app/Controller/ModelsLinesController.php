<?php

App::uses('Controller', 'Controller');

class ModelsLinesController extends AppController
{

    public function beforeFilter()
    {
        $this->Security->unlockedActions = array('getByLine');
        parent::beforeFilter();
    }

    /**
     * Obtenemos las lines de produccion para el usuario logueado
     * @param string $line
     * @return JSON
     */
    public function getByLine($line)
    {
        $this->request->onlyAllow('get');
        $this->loadModel('ModelLine');
        $models = $this->ModelLine->getByLine($line);
        $options = array();
        array_walk($models, function($m) use(&$options) {
                    $options[] = array('value' => $m['id'], 'text' => $m['name']);
                });
        $this->set(array('models' => $options, '_serialize' => 'models'));
        $this->viewClass = 'Json';
    }

}
