<?php
$this->TioCachas->addJsBackbone('production-user');
//$this->Html->script('elements/productions', array('block' => 'scriptBottom'));
?>
<div class="text-center hidden loader">
    <i class="fa fa-refresh fa-spin fa-5x"></i>
    <p><?php echo __("Buscando pieza(s) OK..."); ?></p>
</div>
<div class="panel panel-primary hidden detail">
    <div class="panel-heading">
        <?php echo __('Pieza(s) OK'); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr class="text-center">
                    <th><?php echo __('Modelo'); ?></th>
                    <th><?php echo __('Index'); ?></th>
                    <th><?php echo __('Valor'); ?></th>
                    <th><?php echo __('Fecha'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="alert alert-info hidden empty">
    <?php echo __('No se encontrarón pieza(s) OK'); ?>
</div>
<div class="modal fade status" tabindex="-1" role="dialog" aria-labelledby="modalStatus" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo __('Activar/Desactivar'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="comment">
                            <?php echo __('Justificacion'); ?>
                        </label>
                        <textarea class="comment form-control" rows="3"></textarea>
                        <p><?php echo __('Campo obligatorio'); ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="save btn btn-primary"><?php echo __('Guardar cambios'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->TioCachas->templateSwig('templateRowProduction', 'production'); ?>
<?php $this->start('jsVars'); ?>
<?php
$urlToggleStatus = $this->Html->url(array('controller' => 'Productions', 'action' => 'toggleStatus'));
?>
<script type="text/javascript">
    window.routers = {
        productions: {
            toggleStatus: <?php echo json_encode($urlToggleStatus); ?>
        }
    };
</script>
<?php $this->end(); ?>