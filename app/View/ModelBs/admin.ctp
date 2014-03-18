<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/ModelBs/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
$appBosch->urlIndex = $this->Html->url(array('controller' => 'Index', 'action' => 'admin'));
?>
<div id="example" class="k-content">
    <div id="grid"></div>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
