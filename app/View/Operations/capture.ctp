<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Operations/capture', array('block' => 'scriptBottom'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$this->Html->css('controllers/Operations/capture', array(
    'block' => 'stylesTop'));
$urlList = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCapture'));
$urlListSingle = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCaptureSingle'));
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
    <?php $this->TioCachas->templateClassSwig('operations-user', 'row'); ?>
    <?php $this->TioCachas->templateClassSwig('operations-user-total', 'total'); ?>
    <div class="wndProductions"></div>
</div>
<div class="chart-wrapper" id='windowChart'>
    <div id="chart" style="width: 750px;"></div>
</div>

<script type="text/javascript">
    var urlCaptureProduction = <?php echo json_encode($urlCreateProduction); ?>;
    var urlList = <?php echo json_encode($urlList); ?>;
    var urlListSingle = <?php echo json_encode($urlListSingle); ?>;
</script>
