<form role="form" method="post" action="<?php echo $this->Html->url(array('action' => 'saveEdit', $configLine['ConfigLine']['id'])); ?>">
    <div class="form-group">
        <label class="control-label">Day</label>
        <p class="form-control-static">
            <?php echo Day::name($configLine['ConfigLine']['day']); ?>
        </p>
    </div>
    <?php $text1 = __('Planed Operating Time [minutes]'); ?>
    <div class = "form-group">
        <label for="pot" class="control-label"><?php echo $text1; ?></label>
        <input value="<?php echo $configLine['ConfigLine']['planed_operating_time'] ?>" type="text" class="form-control input-lg" id="pot"  name='pot' placeholder="<?php echo $text1; ?>">
    </div>
    <?php $text2 = __('Target [units]'); ?>
    <div class = "form-group">
        <label for="target" class="control-label"><?php echo $text2; ?></label>
        <input value="<?php echo $configLine['ConfigLine']['target'] ?>" type="text" class="form-control input-lg" id="target"  name='target' placeholder="<?php echo $text2; ?>">
    </div>
    <?php $text3 = __('OEE-Target [%]'); ?>
    <div class = "form-group">
        <label for="oeeTarget" class="control-label"><?php echo $text3; ?></label>
        <input value="<?php echo $configLine['ConfigLine']['oee_target'] ?>" type="text" class="form-control input-lg" id="oeeTarget"  name='oeeTarget' placeholder="<?php echo $text3; ?>">
    </div>
    <div class = "form-group">
        <button type="submit" class="btn btn-primary btn-lg">
            <?php echo __('Save'); ?>
        </button>
    </div>
</form>