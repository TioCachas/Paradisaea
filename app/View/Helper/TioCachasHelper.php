<?php
App::uses('AppHelper', 'View/Helper');

class TioCachasHelper extends AppHelper
{
    public function templateClassSwig($element)
    {
        ?>
        <script type="text/template" class=template">
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

}
