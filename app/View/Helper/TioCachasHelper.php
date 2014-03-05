<?php
App::uses('AppHelper', 'View/Helper');

class TioCachasHelper extends AppHelper {

    /**
     * Agregamos los JS y CSS necesarios para Kendo
     */
    public function addKendo() {
        $this->_View->Html->script('vendors/kendo/kendo.all.min', array('block' => 'scriptBottom'));
        $this->_View->Html->css('vendors/kendo/kendo.common.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.default.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.dataviz.min', array('block' => 'stylesTop'));
        $this->_View->Html->css('vendors/kendo/kendo.dataviz.default.min', array('block' => 'stylesTop'));
    }

    public function templateClassSwig($element, $otherClass = null) {
        ?>
        <script type="text/template" class="template <?php echo $otherClass; ?>">
            <?php echo $this->_View->element('Swig/' . $element); ?>
        </script>
        <?php
    }

    public function templateSwig($id, $element) {
        ?>
        <script type="text/template" id="<?php echo $id; ?>">
        <?php echo $this->_View->element('Swig/' . $element); ?>
        </script>
        <?php
    }

    public function addJsBackbone($model, $includeView = true, $includeModel = true, $includeController = true) {
        if ($includeModel === true) {
            $this->_View->Html->script('backbone/models/model-' . $model, array(
                'block' => 'scriptBottom'));
        }
        if ($includeController === true) {
            $this->_View->Html->script('backbone/collections/collection-' . $model, array(
                'block' => 'scriptBottom'));
        }
        if ($includeView === true) {
            $this->_View->Html->script('backbone/views/view-' . $model, array(
                'block' => 'scriptBottom'));
        }
    }

}
