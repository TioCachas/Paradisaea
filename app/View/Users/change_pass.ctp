<?php if ($success === true): ?>
    <div class='alert alert-success'>
        <?php echo $msg; ?>
    </div>
<?php else: ?>
    <div class='alert alert-danger'>
        <?php echo $msg; ?>
    </div>
    <?php echo $this->element('changePass'); ?>
<?php endif; 

