<?php

$this->TioCachas->addKendo();
$this->Html->script('controllers/Lines/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
$appBosch->urlWorkstations = $this->Html->url(array('controller' => 'Workstations', 'action' => 'admin'));
$appBosch->urlModels = $this->Html->url(array('controller' => 'ModelLines', 'action' => 'admin'));
?>
<div id="grid"></div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
