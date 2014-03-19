<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Technicals/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
$appBosch->workstations = $workstations;
$appBosch->defects = $defects;
$appBosch->urlDefects = $this->Html->url(array('controller' => 'Defects', 'action' => 'getByWorkstationAndType'));
$appBosch->type = Defect::TYPE_TECHNICAL;
?>
<div id="grid"></div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
