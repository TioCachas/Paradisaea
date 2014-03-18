<?php

App::uses('CrudController', 'Controller');
App::uses('ModelLine', 'Model');

class ModelLinesController extends CrudController
{
    public $_model = 'ModelLine';

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

    public function admin($lineId)
    {
        $areaId = $this->Session->read('areaId');
        $this->loadModel('Area');
        $this->loadModel('Line');
        $this->loadModel('ModelB');
        $this->Area->id = $areaId;
        $area = $this->Area->read();
        $this->Line->id = $lineId;
        $line = $this->Line->read();
        $breadcrumb = array(
            $area['Area']['name'] => Router::url(array('controller' => 'Areas', 'action' => 'admin')),
            $line['Line']['name'] => Router::url(array('controller' => 'Lines', 'action' => 'admin',
                $areaId)),
        );
        $models = $this->ModelB->getEnabled();
        $comboModels = array();
        array_walk($models, function($model) use(&$comboModels) {
                    $o = new stdClass();
                    $o->text = $model['name'];
                    $o->value = $model['id'];
                    $comboModels[] = $o;
                });
        $this->Session->write('lineId', $lineId);
        $this->set('models', $comboModels);
        $this->set('breadcrumb', $breadcrumb);
        $this->set('title', __('Modelos por línea'));
        $this->set('description', __('Administración'));
    }

    protected function c($model)
    {
        return array(
            'model_id' => $model->model_id,
            'line_id' => $this->Session->read('lineId'),
            'status' => ModelLine::STATUS_ENABLED,
        );
    }

    protected function id($model)
    {
        return $model->id;
    }

    protected function u($model)
    {
        return array(
            'model_id' => $model->model_id,
        );
    }

    protected function getRecords()
    {
        $lineId = $this->Session->read('lineId');
        $m = $this->_model;
        $records = $this->ModelLine->getEnabledByLine($lineId);
        return $records;
    }

}
