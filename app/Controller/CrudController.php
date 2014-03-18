<?php

App::uses('AppController', 'Controller');

abstract class CrudController extends AppController
{
    public $_model;

    public function beforeFilter()
    {
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        parent::beforeFilter();
    }

    /**
     * A C C I O N E S
     */
    final public function create()
    {
        $this->request->onlyAllow('get');
        $m = $this->_model;
        $models = json_decode($this->request->query['models']);
        $model = $models[0];
        $result = false;
        try
        {
            $data = $this->c($model);
            $newModel = $this->$m->insert($data);
            $result = $newModel[$m];
        }
        catch (PDOException $exc)
        {
            switch ($exc->getCode())
            {
                case 23000:
                    $this->response->statusCode(404);
                    //break;
                default:
                    throw $exc;
            }
        }
        $this->set(array('records' => $result, '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    final public function read()
    {
        $this->request->onlyAllow('get');
        $this->set(array('records' => $this->getRecords(), '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    final public function update()
    {
        $this->request->onlyAllow('get');
        $m = $this->_model;
        $models = json_decode($this->request->query['models']);
        $model = $models[0];
        $result = false;
        try
        {
            $updatedModel = $this->$m->update($this->id($model), $this->u($model));
            $result = $updatedModel[$m];
        }
        catch (PDOException $exc)
        {
            switch ($exc->getCode())
            {
                case 23000:
                    $this->response->statusCode(404);
                    break;
                default:
                    throw $exc;
            }
        }
        $this->set(array('records' => $result, '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    final public function destroy()
    {
        $this->request->onlyAllow('get');
        $m = $this->_model;
        $id = $this->request->query['id'];
        $deletedModel = $this->$m->destroy($id, $m::STATUS_DISABLED);
        $this->set(array('records' => $deletedModel[$m], '_serialize' => 'records'));
        $this->viewClass = 'Json';
    }

    /*
     * P R I V A D O S  para R E D E F I N I R
     */

    abstract protected function c($model);

    abstract protected function u($model);

    abstract protected function id($model);

    abstract protected function getRecords();
}
