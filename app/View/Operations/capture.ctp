<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Operations/capture', array('block' => 'scriptBottom'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$this->Html->css('controllers/Operations/capture', array(
    'block' => 'stylesTop'));
$urlList = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCapture'));
$urlListSingle = $this->Html->url(array('controller' => 'Operations', 'action' => 'getDashboardCaptureSingle'));
$urlGetLinesAndShifts = $this->Html->url(array('controller' => 'Users', 'action' => 'getLinesAndShifts'));
$urlProductionsCapture = $this->Html->url(array('controller' => 'Productions', 'action' => 'capture'));
$urlScrapCapture = $this->Html->url(array('controller' => 'Scraps', 'action' => 'capture'));
$urlReworkCapture = $this->Html->url(array('controller' => 'Reworks', 'action' => 'capture'));
$urlChangeoverCapture = $this->Html->url(array('controller' => 'Changeovers', 'action' => 'capture'));
$urlTechnicalCapture = $this->Html->url(array('controller' => 'Technicals', 'action' => 'admin'));
$urlOrganizationalCapture = $this->Html->url(array('controller' => 'Organizationals', 'action' => 'admin'));
$urlQualityCapture = $this->Html->url(array('controller' => 'Qualities', 'action' => 'admin'));
$urlPerformanceCapture = $this->Html->url(array('controller' => 'Performance', 'action' => 'capture'));
$urlCapture = array(
    'productions' => $urlProductionsCapture,
    'scrap' => $urlScrapCapture,
    'rework' => $urlReworkCapture,
    'changeover' => $urlChangeoverCapture,
    'technical' => $urlTechnicalCapture,
    'organizational' => $urlOrganizationalCapture,
    'quality' => $urlQualityCapture,
    'performance' => $urlPerformanceCapture,
);
?>
<div id="shift">
    <div class="table-responsive">
        <?php $this->TableOperations->render($users, $workDate); ?>
    </div>
    <?php $this->TioCachas->templateClassSwig('operations-user', 'row'); ?>
    <?php $this->TioCachas->templateClassSwig('operations-user-total', 'total'); ?>
    <div class="wndCapture"></div>
    <div class="chart-wrapper wndTargetVsReal">
        <div class="chart" style="width: 750px;"></div>
    </div>
</div>
<script type="text/javascript">
    var urlList = <?php echo json_encode($urlList); ?>;
    var urlListSingle = <?php echo json_encode($urlListSingle); ?>;
    var urlGetLinesAndShifts = <?php echo json_encode($urlGetLinesAndShifts); ?>;
    var urlCapture = <?php echo json_encode($urlCapture); ?>;
</script>
