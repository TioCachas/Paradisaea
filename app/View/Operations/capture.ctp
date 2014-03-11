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
    <div class="table-responsive">
        <?php $this->TableOperations->render($users, $workDate); ?>
    </div>
    <?php $this->TioCachas->templateClassSwig('operations-user', 'row'); ?>
    <?php $this->TioCachas->templateClassSwig('operations-user-total', 'total'); ?>
    <div class="wndProductions"></div>
    <div class="chart-wrapper wndTargetVsReal">
        <div class="chart" style="width: 750px;"></div>
    </div>
</div>
<script type="text/javascript">
    var urlCaptureProduction = <?php echo json_encode($urlCreateProduction); ?>;
    var urlList = <?php echo json_encode($urlList); ?>;
    var urlListSingle = <?php echo json_encode($urlListSingle); ?>;
</script>
