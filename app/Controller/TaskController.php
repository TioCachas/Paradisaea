<?php

App::uses('AppController', 'Controller');

class TaskController extends AppController {

    public function __constructor() {
        $this->loadModel('Category');
    }

    public function operationsByDay() {
        
    }

}
