<?php
$this->Html->script('controllers/Shifts/config', array('block' => 'scriptBottom'));
$urlForm = $this->Html->url(array('action' => 'setConfig'));
?>
<form class="form-horizontal" role="form" method="post" action="<?php echo $urlForm; ?>">
    <div class="form-group">
        <label for="inputShift" class="col-sm-2 col-lg-1 control-label">
            <?php echo __('Turno'); ?>
        </label>
        <div class="col-sm-9 col-lg-5">
            <select id="inputShift" name='inputShift' class="form-control input-lg">
                <?php $this->Bosch->shifts($shifts); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputLine" class="col-sm-2 col-lg-1 control-label">
            <?php echo __('Línea'); ?>
        </label>
        <div class="col-sm-9 col-lg-5">
            <select id="inputLine" name='inputLine' class="form-control input-lg">
                <?php $this->Bosch->lines($lines); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-lg-offset-1 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg">
                <?php echo __('Iniciar turno'); ?>
            </button>
        </div>
    </div>
</form>