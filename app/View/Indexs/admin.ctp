<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Indexs/admin', array('block' => 'scriptBottom'));
$appBosch = new stdClass();
$appBosch->crud = $this->TioCachas->urlsCRUD();
?>
<div id="example" class="k-content">
    <div id="grid"></div>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var appBosch = <?php echo json_encode($appBosch); ?>;
</script>
<?php $this->end(); ?>
