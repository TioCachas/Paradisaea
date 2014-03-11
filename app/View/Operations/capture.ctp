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
$urlTechnicalCapture = $this->Html->url(array('controller' => 'Technicals', 'action' => 'capture'));
$urlOrganizationalCapture = $this->Html->url(array('controller' => 'Organizationals', 'action' => 'capture'));
$urlQualityCapture = $this->Html->url(array('controller' => 'Qualities', 'action' => 'capture'));
$urlPerformanceCapture = $this->Html->url(array('controller' => 'Performance', 'action' => 'capture'));
?>
<div id="shift">
    <div class="table-responsive">
        <?php $this->TableOperations->render($users, $workDate); ?>
    </div>
    <?php $this->TioCachas->templateClassSwig('operations-user', 'row'); ?>
    <?php $this->TioCachas->templateClassSwig('operations-user-total', 'total'); ?>
    <div class="wndProductions"></div>
    <div class="wndScrap"></div>
    <div class="wndRework"></div>
    <div class="wndChangeover"></div>
    <div class="wndTechnical"></div>
    <div class="wndOrganizational"></div>
    <div class="wndQuality"></div>
    <div class="wndPerformance"></div>
    <div class="chart-wrapper wndTargetVsReal">
        <div class="chart" style="width: 750px;"></div>
    </div>
</div>
<script type="text/javascript">
    var urlList = <?php echo json_encode($urlList); ?>;
    var urlListSingle = <?php echo json_encode($urlListSingle); ?>;
    var urlGetLinesAndShifts = <?php echo json_encode($urlGetLinesAndShifts); ?>;
    var urlProductionsCapture = <?php echo json_encode($urlProductionsCapture); ?>;
    var urlScrapCapture = <?php echo json_encode($urlScrapCapture); ?>;
    var urlReworkCapture = <?php echo json_encode($urlReworkCapture); ?>;
    var urlChangeoverCapture = <?php echo json_encode($urlChangeoverCapture); ?>;
    var urlTechnicalCapture = <?php echo json_encode($urlTechnicalCapture); ?>;
    var urlOrganizationalCapture = <?php echo json_encode($urlOrganizationalCapture); ?>;
    var urlQualityCapture = <?php echo json_encode($urlQualityCapture); ?>;
    var urlPerformanceCapture = <?php echo json_encode($urlPerformanceCapture); ?>;
</script>
