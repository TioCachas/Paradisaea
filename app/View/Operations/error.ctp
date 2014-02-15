<?php
switch ($codeError) {
    case OperationsController::ERROR_HOUR:
        ?>
        <div class="alert alert-warning">
            <?php echo __('No se han definido horas para este turno.'); ?>
        </div>
        <?php
        break;
    case OperationsController::ERROR_MODEL:
        ?>
        <div class="alert alert-warning">
            <?php echo __('No se han definido modelos para esta linea.'); ?>
        </div>
    <?php
}