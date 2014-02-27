<?php
$this->Html->script('controllers/Operations/capture', array('block' => 'scriptBottom'));
$this->Html->script('vendors/kendo/kendo.all.min', array('block' => 'scriptBottom'));
$this->Html->css('vendors/kendo/kendo.common.min', array('block' => 'stylesTop'));
$this->Html->css('vendors/kendo/kendo.default.min', array('block' => 'stylesTop'));
$this->Html->css('vendors/kendo/kendo.dataviz.min', array('block' => 'stylesTop'));
$this->Html->css('vendors/kendo/kendo.dataviz.default.min', array('block' => 'stylesTop'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$this->Html->css('controllers/Operations/capture', array(
    'block' => 'stylesTop'));
$urlList = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCapture'));
$urlCreateProduction = $this->Html->url(array('controller' => 'Productions', 'action' => 'createForm'));
?>
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
<div class="chart-wrapper" id='windowChart'>
    <div id="chart"></div>
</div>
<script type="text/javascript">
    var urlCaptureProduction = <?php echo json_encode($urlCreateProduction); ?>;
    var urlList = <?php echo json_encode($urlList); ?>;
</script>
