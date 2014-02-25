<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../" class="navbar-brand">
                <?php echo __('Daily Monitor'); ?>
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">
                        <i class='fa fa-home'></i>
                        <?php echo __('Inicio'); ?>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class='fa fa-user'></i>
                        <?php echo __('Operaciones'); ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php
                            echo $this->Html->url(array(
                                'controller' => 'Operations', 'action' => 'capture'));
                            ?>">
                                <i class='fa fa-cogs'></i>
                                <?php echo __('Crear'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php
                            echo $this->Html->url(array(
                                'controller' => 'Operations', 'action' => 'admin'));
                            ?>">
                                <i class='fa fa-edit'></i>
                                <?php echo __('Administrar'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <?php echo __('Ayuda'); ?>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if ($loggedIn === true): ?>
                    <?php
                    $bosch = $this->Session->read('configuration');
                    if ($bosch instanceof Bosch):
                        ?>
                        <form class="navbar-form navbar-left" role="search">
                            <select class="form-group" id="selectLineInMenu">
                                <?php $this->Bosch->getLinesByUser($authUser['id']); ?>
                            </select>
                        </form>
                        <form class="navbar-form navbar-left" role="search">
                            <select class="form-group" id="selectModelInMenu">
                                <option></option>
                            </select>
                        </form>
                    <?php endif; ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class='fa fa-user'></i>
                            <?php echo $authUser['name'] ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php
                                echo $this->Html->url(array(
                                    'controller' => 'Shifts', 'action' => 'config'));
                                ?>">
                                    <i class='fa fa-cogs'></i>
                                    <?php echo __('Turno'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php
                                echo $this->Html->url(array(
                                    'controller' => 'Users', 'action' => 'changePassForm'));
                                ?>">
                                    <i class='fa fa-edit'></i>
                                    <?php echo __('Cambiar contraseña'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php
                                echo
                                $this->Html->url(array(
                                    'controller' => 'Sesion', 'action' => 'Logout'));
                                ?>">
                                    <i class='fa fa-sign-out'></i>
                                    <?php echo __('Cerrar sesion'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php
                        echo $this->Html->url(array(
                            'controller' => 'Sesion', 'action' => 'index'));
                        ?>">
                            <i class='fa fa-sign-in'></i>
                            <?php echo __('Ingresar'); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<?php
$this->start('jsVars');
$urlGetModels = $this->Html->url(array('controller' => 'ModelsLines', 'action' => 'getByLine'));
?>
<script type="text/javascript">
    var __urlGetModels = <?php echo json_encode($urlGetModels); ?>;
</script>
<?php $this->end(); ?>