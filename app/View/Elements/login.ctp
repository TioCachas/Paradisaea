<?php
$urlLogin = array('controller' => 'Sesion', 'action' => 'login');
$usernameInput = array('placeholder' => __("Usuario"), 'class' => 'form-control', 'label' => __('Usuario'), 'type' => 'text');
$passwordInput = array('placeholder' => __("Contraseña"), 'class' => 'form-control', 'label' => __('Contraseña'), 'type' => 'password');
$button = array('class' => 'btn btn-primary btn-lg', 'label' => __('Ingresar'));
?>
<div class="col-lg-6">
    <?php
    echo $this->Form->create('User', array(
        'role' => 'form', 'url' => $urlLogin));
    ?>
    <div class="form-group">
        <?php echo $this->Form->input('us3r', $usernameInput); ?>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('p4ss', $passwordInput); ?>
    </div>
    <div class='float-right'>
        <?php echo $this->Form->end($button); ?>
    </div>
</div>