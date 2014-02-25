<?php

App::uses('AppController', 'Controller');

class CaptureController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'capture';
    }

}
