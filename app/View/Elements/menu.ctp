<header class="navbar navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class='fa fa-bars fa-2x'></i>
            </button>
            <a href="<?php echo Router::url('/', true); ?>" class="navbar-brand">
                <i class='fa fa-home'></i>
                <?php echo __('Daily Monitor'); ?>
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <?php if ($loggedIn === true): ?>
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
                <?php endif; ?>
                <li>
                    <a href="<?php
                    echo $this->Html->url(array(
                        'controller' => 'Help', 'action' => 'index'));
                    ?>">
                        <i class='fa fa-question'></i>
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
                        <?php if ($bosch->getConfiguration()->getShiftText() !== null): ?>
                            <li>
                                <a href="<?php
                                echo $this->Html->url(array(
                                    'controller' => 'Shifts', 'action' => 'config'));
                                ?>">
                                       <?php echo $bosch->getConfiguration()->getShiftText(); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($bosch->getConfiguration()->getLineText() !== null): ?>
                            <li>
                                <a href="<?php
                                echo $this->Html->url(array(
                                    'controller' => 'Shifts', 'action' => 'config'));
                                ?>">
                                       <?php echo $bosch->getConfiguration()->getLineText(); ?>
                                </a>
                            </li>
                        <?php endif; ?>
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