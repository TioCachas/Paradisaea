<?php
$this->Html->script('controllers/Shifts/config', array('block' => 'scriptBottom'));
echo $this->Form->create(array('url' => array('action' => 'setConfig'), 'method' => 'post',
    'class' => 'form-horizontal',
    'role' => 'form'));
$urlGetModels = $this->Html->url(array('controller' => 'ModelLines', 'action' => 'getByLine'));
?>
<div class="form-group">
    <label for="inputShift" class="col-sm-2 col-lg-1 control-label">
        <?php echo __('Turno'); ?>
    </label>
    <div class="col-sm-9 col-lg-5">
        <select id="inputShift" name='inputShift' class="form-control input-lg">
            <?php $this->Bosch->userShifts($shifts); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="inputLine" class="col-sm-2 col-lg-1 control-label">
        <?php echo __('Línea'); ?>
    </label>
    <div class="col-sm-9 col-lg-5">
        <select id="inputLine" name='inputLine' class="form-control input-lg">
            <?php $this->Bosch->userLines($lines); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="inputModel" class="col-sm-2 col-lg-1 control-label">
        <?php echo __('Modelo'); ?>
    </label>
    <div class="col-sm-9 col-lg-5">
        <select id="inputModel" name='inputModel' class="form-control input-lg">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="inputModel" class="col-sm-2 col-lg-1 control-label">
    </label>
    <div class="col-sm-9 col-lg-5">
        <button class='btn btn-primary btn-lg' disabled="disabled">
            <?php echo __('Iniciar turno'); ?>
        </button>
    </div>
</div>
<?php
$this->Form->end();
$this->start('jsVars');
?>
<script type="text/javascript">
    var urlGetModels = <?php echo json_encode($urlGetModels); ?>;
</script>
<?php $this->end(); ?>