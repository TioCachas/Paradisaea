<?php
App::uses('Hour', 'Model');
$hourModel = new Hour();
$hours = $hourModel->getAll();
$this->TioCachas->addJsBackbone('operation');
$this->Html->script('elements/operations', array('block' => 'scriptBottom'));
$this->Html->css('losses', array('block' => 'stylesTop'));
$urlChangeHour = $this->Html->url(array('controller' => 'Operations', 'action' => 'changeHour'));
$urlChangeLine = $this->Html->url(array('controller' => 'Operations', 'action' => 'changeLine'));
$urlGetLines = $this->Html->url(array('controller' => 'Lines', 'action' => 'getLinesSelfArea'));
$urlToggleStatus = $this->Html->url(array('controller' => 'Operations', 'action' => 'toggleStatus'));
$minutesSymbol = Units::symbol(Units::MINUTES);
?>
<div class="hidden text-center loader">
    <i class="fa fa-refresh fa-spin fa-5x"></i>
    <p><?php echo __("Buscando operacion(es)..."); ?></p>
</div>
<div class="panel panel-primary hidden detail">
    <div class="panel-heading">
        <?php echo __('Operacion(es)'); ?>
        <i class="fa fa-download fa-inverse fa-2x pull-right cursorPointer" title="<?php echo __("Descargar operaciones habilitadas"); ?>"></i>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr class="text-center">
                    <th colspan="4"></th>
                    <th colspan="3"><?php echo __('Piezas'); ?></th>
                    <th colspan="5"><?php echo __('Perdidas'); ?></th>
                    <th colspan="1" rowspan="2"></th>
                </tr>
                <tr class="text-center">
                    <th><?php echo __('Línea'); ?></th>
                    <th title="<?php echo __('Hora de trabajo'); ?>">
                        <i class="fa fa-clock-o fa-2x"></i>
                    </th>
                    <th title="<?php echo __('Capturado por'); ?>">
                        <i class="fa fa-user fa-2x"></i>
                    </th>
                    <th title="<?php echo __('Dia de trabajo'); ?>">
                        <i class="fa fa-calendar fa-2x"></i>
                    </th>
                    <th class="production" title="<?php echo __('Piezas OK'); ?>">
                        <i class="fa fa-check fa-2x"></i>
                    </th>
                    <th class="scrap" title="<?php echo __('Scrap'); ?>">
                        <i class="fa fa-trash-o fa-2x"></i>
                    </th>
                    <th class="reword" title="<?php echo __('Retrabajo'); ?>">
                        <i class="fa fa-repeat fa-2x"></i>
                    </th>
                    <th class="changeoverLosses" title="<?php echo __('Cambio de modelo') . $minutesSymbol; ?>">
                        <i class="fa fa-exchange fa-inverse fa-2x"></i>
                    </th>
                    <th class="techicalLosses" title="<?php echo __('Tecnicas') . $minutesSymbol; ?>">
                        <i class="fa fa-wrench fa-inverse fa-2x"></i>
                    </th>
                    <th class="organizationalLosses" title="<?php echo __('Organizacional') . $minutesSymbol; ?>">
                        <i class="fa fa-users fa-inverse fa-2x"></i>
                    </th>
                    <th class="qualityLosses" title="<?php echo __('Calidad') . $minutesSymbol; ?>">
                        <i class="fa fa-thumbs-o-down fa-inverse fa-2x"></i>
                    </th>
                    <th class="performanceLosses" title="<?php echo __('Desempeño') . $minutesSymbol; ?>">
                        <i class="fa fa-bar-chart-o fa-inverse fa-2x"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui se insertan las operaciones por ajax-->
            </tbody>
        </table>
    </div>
</div>
<div class="alert alert-info hidden empty">
    <?php echo __('No se encontrarón operaciones'); ?>
</div>
<div class="modal fade hour" tabindex="-1" role="dialog" aria-labelledby="modalHours" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo __('Cambiar hora'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="hour">
                            <?php echo __('Hora de trabajo'); ?>
                        </label>
                        <select class="form-control input-lg hour">
                            <?php echo $this->Bosch->hours($hours); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">
                            <?php echo __('Comentario'); ?>
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
<!--Dialogo de cambio de estatus-->
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
                            <?php echo __('Comentario'); ?>
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo __('Cambiar linea de produccion'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <select class="form-control input-lg">
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="save btn btn-primary"><?php echo __('Guardar cambios'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->TioCachas->templateSwig('rowOperation', 'operations'); ?>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var urlToggleStatus = <?php echo json_encode($urlToggleStatus); ?>;
    var urlChangeHour = <?php echo json_encode($urlChangeHour); ?>;
    var urlChangeLine = <?php echo json_encode($urlChangeLine); ?>;
    var urlGetLines = <?php echo json_encode($urlGetLines); ?>;
    var selectedModel = null;
</script>
<?php $this->end(); ?>