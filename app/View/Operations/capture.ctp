<?php
$this->Html->script('controllers/Operations/form', array('block' => 'scriptBottom'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$this->Html->css('controllers/Operations/form', array(
    'block' => 'stylesTop'));
$urlList = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCapture'));
$urlCreateProduction = $this->Html->url(array('controller' => 'Productions', 'action' => 'createForm'));
?>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="col-sm-2 control-label text-left" for="workDate"><?php echo __('Dia de trabajo'); ?></label>
        <div class="col-sm-2">
            <input required="requiered" type="text" class="form-control input-lg" id="workDate" name="workDate" placeholder="<?php echo __('Dia de trabajo'); ?>" value="<?php echo $workDate; ?>">
        </div>
    </div>
</form>
<br/>
<div id="shift">
    <div class="hidden text-center loader">
        <i class="fa fa-refresh fa-spin fa-5x"></i>
        <p><?php echo __("Buscando operacion(es)..."); ?></p>
    </div>
    <div class="panel panel-primary hidden detail">
        <div class="panel-heading">
            <?php echo __('Operacion(es)'); ?>
        </div>
        <div class="table-responsive">
            <?php $this->TableOperations->render(); ?>
        </div>
    </div>
    <?php $this->TioCachas->templateClassSwig('operations-user'); ?>
</div>

<script type="text/javascript">
    var urlCaptureProduction = <?php echo json_encode($urlCreateProduction); ?>;
    var urlList = <?php echo json_encode($urlList); ?>;
</script>
