<?php
$labelPass = __('Contraseña');
$labelNewPass1 = __('Nueva contraseña');
$labelNewPass2 = __('Confirmar contraseña');
?>
<form class="form-horizontal" role="form" action="<?php echo $this->Html->url(array('action' => 'changePass')); ?>" method='post'>
    <div class="form-group">
        <label for="pass" class="col-sm-2 control-label">
            <?php echo $labelPass; ?>
        </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="pass" name='pass' placeholder="<?php echo $labelPass; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="newPass1" class="col-sm-2 control-label">
            <?php echo $labelNewPass1; ?>
        </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="newPass1" name="newPass1" placeholder="<?php echo $labelNewPass1; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="newPass2" class="col-sm-2 control-label">
            <?php echo $labelNewPass2; ?>
        </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="newPass2" name="newPass2" placeholder="<?php echo $labelNewPass2; ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
                <?php echo __('Cambiar contraseña'); ?>
            </button>
        </div>
    </div>
</form>