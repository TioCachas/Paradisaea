<?php

App::uses('AppController', 'Controller');

class LinesController extends AppController
{

    /**
     * Regresamos un combo donde se puede seleccionar una nueva linea de produccion
     */
    public function getLinesSelfArea($lineId)
    {
        $lines = $this->Line->getSelfAreaEnabled($lineId);
        $this->set('lines', $lines);
        $this->layout = 'ajax';
    }

}
