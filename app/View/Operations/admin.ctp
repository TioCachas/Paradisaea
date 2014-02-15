<?php
$this->Html->script('controllers/Operations/admin', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Operations/admin', array('block' => 'stylesTop'));
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
<div class="hidden text-center" id="loadingOperations">
    <i class="fa fa-refresh fa-spin fa-5x"></i>
</div>
<div class="panel panel-primary hidden" id="operations">
    <div class="panel-heading"><?php echo __('Operaciones encontradas'); ?></div>
    <div class="table-responsive">
        <?php echo $this->element('Tables/Operations'); ?>
    </div>
</div>
<div class="alert alert-info hidden" id="emptyOperations">
    <?php echo __('No se encontrarón operaciones'); ?>
</div>
