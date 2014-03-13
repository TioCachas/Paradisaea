<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Workstations/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
$appBosch->urlDefects = $this->Html->url(array('controller' => 'Defects', 'action' => 'admin'));
?>
<div id="example" class="k-content">
    <div id="grid"></div>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
