<?php
$this->Html->script('controllers/Operations/capture', array('block' => 'scriptBottom'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$this->Html->css('controllers/Operations/capture', array(
    'block' => 'stylesTop'));
$urlList = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCapture'));
$urlCreateProduction = $this->Html->url(array('controller' => 'Productions', 'action' => 'createForm'));
?>
<!--<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="col-sm-2 control-label text-left" for="workDate"><?php echo __('Dia de trabajo'); ?></label>
        <div class="col-sm-2">
            <input required="requiered" type="text" class="form-control input-lg" id="workDate" name="workDate" placeholder="<?php echo __('Dia de trabajo'); ?>" value="<?php echo $workDate; ?>">
        </div>
    </div>
</form>-->
<br/>
<div id="shift">
    <div class="hidden text-center loader">
        <i class="fa fa-refresh fa-spin fa-5x"></i>
        <p><?php echo __("Buscando operacion(es)..."); ?></p>
    </div>
    <div class="table-responsive hidden detail">
        <?php $this->TableOperations->render($workDate); ?>
    </div>
    <div id="dialog-form" title="Create new user" class='hide'>
        <p class="validateTips">All form fields are required.</p>
        <form>
            <fieldset>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
            </fieldset>
        </form>
    </div>
    <?php $this->TioCachas->templateClassSwig('operations-user'); ?>
</div>
<script type="text/javascript">
    var urlCaptureProduction = <?php echo json_encode($urlCreateProduction); ?>;
    var urlList = <?php echo json_encode($urlList); ?>;
</script>
