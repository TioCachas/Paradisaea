<?php
$this->Html->script('controllers/Productions/admin', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Productions/admin', array('block' => 'stylesTop'));
?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo __('Operacion'); ?></div>
    <div class="table-responsive">
        <?php echo $this->element('Tables/Operations'); ?>
    </div>
</div>
<?php echo $this->element('Tables/Productions'); ?>
<?php
$urlGetProductions = $this->Html->url(array('controller' => 'Productions', 'action' => 'getByOperation', $operation['o']['id']));
?>
<script type="text/javascript">
    var urlGetProductions = <?php echo json_encode($urlGetProductions); ?>;
</script>
