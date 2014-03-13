<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Areas/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
$appBosch->urlLines = $this->Html->url(array('controller' => 'Lines', 'action' => 'admin'));
?>
<div id="grid"></div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
