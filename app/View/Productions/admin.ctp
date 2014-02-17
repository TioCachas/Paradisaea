<?php
$this->Html->script('controllers/Productions/admin', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Productions/admin', array('block' => 'stylesTop'));
$urlGetOperations = $this->Html->url(array('controller' => 'Operations', 'action' => 'getById', $operationId));
$urlExportProductions = $this->Html->url(array('controller' => 'Productions', 'action' => 'exportByOperation', $operationId));
$urlGetProductions = $this->Html->url(array('controller' => 'Productions', 'action' => 'getByOperation', $operationId));
?>
<div id="operations">
    <?php echo $this->element('Tables/Operations'); ?>
</div>
<div id="productions">
    <?php echo $this->element('Tables/Productions'); ?>
</div>
<script type="text/javascript">
    var urlGetOperations = <?php echo json_encode($urlGetOperations); ?>;
    var urlExportOperations = <?php echo json_encode($urlExportProductions); ?>;
    var urlGetProductions = <?php echo json_encode($urlGetProductions); ?>;
</script>
