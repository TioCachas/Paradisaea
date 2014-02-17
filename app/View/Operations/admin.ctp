<?php
$this->Html->script('controllers/Operations/admin', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Operations/admin', array('block' => 'stylesTop'));
$urlGetOperations = $this->Html->url(array('controller' => 'Operations', 'action' => 'getByWorkDate'));
$urlExportOperations = $this->Html->url(array('controller' => 'Operations', 'action' => 'exportByWorkDate'));
?>
<form class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="workDate"><?php echo __('Fecha'); ?></label>
        <input type="text" class="form-control input-lg" id="workDate" placeholder="<?php echo __('Fecha'); ?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" id="alternate" disabled="disabled">
    </div>
</form>
<br/>
<div id="operations">
    <?php echo $this->element('Tables/Operations'); ?>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var urlGetOperations = <?php echo json_encode($urlGetOperations); ?>;
    var urlExportOperations = <?php echo json_encode($urlExportOperations); ?>;
</script>
<?php $this->end(); ?>