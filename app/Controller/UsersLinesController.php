<?php

App::uses('Controller', 'Controller');

class UsersLinesController extends AppController
{
    /**
     * Obtenemos el arreglo con las líneas que permite manejar el usuario que
     * recibe como parámetro
     */
    public function getLinesByUser()
    {
        $this->request->onlyAllow('get');
        $filter = $this->request->query['filter']['filters'][0];
        $this->loadModel('UserLine');
        $lines = $this->UserLine->getByUser($filter['value']);
        $this->set(array('lines' => $lines, '_serialize' => 'lines'));
        $this->viewClass = 'Json';
    }

}
