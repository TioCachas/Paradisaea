<?php
App::uses('AppHelper', 'View/Helper');

class TioCachasHelper extends AppHelper
{

    /**
     * Agregamos los JS y CSS necesarios para Kendo
     */
    public function addKendo()
    {
        $this->_View->Html->script('vendors/kendo/kendo.all.min', array('block' => 'scriptBottom'));
        $this->_View->Html->css('vendors/kendo/kendo.common.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.bootstrap.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.dataviz.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.dataviz.bootstrap.min', array(
            'block' => 'stylesTop'));
        $cultures = array('es-MX');
        array_walk($cultures, function($culture) {
                    $this->_View->Html->script('vendors/kendo/cultures/kendo.culture.' . $culture . '.min', array(
                        'block' => 'scriptBottom'));
                });
    }

    public function templateClassSwig($element, $otherClass = null)
    {
        ?>
        <script type="text/template" class="template <?php echo $otherClass; ?>">
            <?php echo $this->_View->element('Swig/' . $element); ?>
        </script>
        <?php
    }

    public function templateSwig($id, $element)
    {
        ?>
        <script type="text/template" id="<?php echo $id; ?>">
        <?php echo $this->_View->element('Swig/' . $element); ?>
        </script>
        <?php
    }

    public function addJsBackbone($model, $includeView = true, $includeModel = true, $includeController = true)
    {
        if ($includeModel === true)
        {
            $this->_View->Html->script('backbone/models/model-' . $model, array(
                'block' => 'scriptBottom'));
        }
        if ($includeController === true)
        {
            $this->_View->Html->script('backbone/collections/collection-' . $model, array(
                'block' => 'scriptBottom'));
        }
        if ($includeView === true)
        {
            $this->_View->Html->script('backbone/views/view-' . $model, array(
                'block' => 'scriptBottom'));
        }
    }
    
    /**
     * Generamos un arreglo con URL hacia acciones CRUD contenidas en el mismo 
     * URL para CREATE
     * URL para READ
     * URL para UPDATE
     * URL para DELETE
     * controlador.
     * @return array
     */
    public function urlsCRUD()
    {
        $urlCreate = $this->_View->Html->url(array('action'=>'create'));
        $urlRead = $this->_View->Html->url(array('action'=>'read'));
        $urlUpdate = $this->_View->Html->url(array('action'=>'update'));
        $urlDelete = $this->_View->Html->url(array('action'=>'destroy'));
        $array = array(
            'create' => $urlCreate,
            'read' => $urlRead,
            'update' => $urlUpdate,
            'delete' => $urlDelete,
        );
        return $array;
    }

}
