<?php
$this->Html->script('vendors/jquery.jcryption.3.0', array('block' => 'scriptBottom'));
$this->Html->script('elements/login', array('block' => 'scriptBottom'));
$urlLogin = array('controller' => 'Sesion', 'action' => 'login');
$usernameInput = array('placeholder' => __("Usuario"), 'class' => 'form-control',
    'label' => __('Usuario'), 'type' => 'text');
$passwordInput = array('placeholder' => __("Contraseña"), 'class' => 'form-control',
    'label' => __('Contraseña'), 'type' => 'password');
$optionsButton = array('class' => 'btn btn-primary btn-lg');
$urlGetPublicKey = $this->Html->url(array('controller' => 'JCryption', 'action' => 'getPublicKey'));
$urlHandshake = $this->Html->url(array('controller' => 'JCryption', 'action' => 'handshake'));
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
        <?php echo $this->Form->submit(__('Ingresar'), $optionsButton); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var urlGetPublicKey = <?php echo json_encode($urlGetPublicKey); ?>;
    var urlHandshake = <?php echo json_encode($urlHandshake); ?>;
</script>
<?php $this->end(); ?>