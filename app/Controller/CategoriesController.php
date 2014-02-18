<?php

App::uses('Controller', 'Controller');
App::uses('Category', 'Model');

class CategoriesController extends AppController {

    public function __constructor() {
        $this->loadModel('Category');
    }

    public function index() {
        //$this->set('categories', $this->Category->find(array('status' => Category::STATUS_ACTIVE)));
        $this->set('categories', $this->Category->find('all'));
    }

    public function create() {
        
    }

    public function editForm() {
        
    }

    public function delete($id) {
        if ($this->request->is('get') === true) {
            $record = $this->Category->findById($id);
            $record['Category']['status'] = Category::STATUS_INACTIVE;
            $this->Category->id = $id;
            $this->Category->save($record);
        }
        $this->set(array('id' => $id, '_serialize' => 'id'));
        $this->viewClass = 'Json';
    }

}
