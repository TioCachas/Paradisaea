<?php
$this->TioCachas->addJsBackbone('production');
$urlToggleStatus = $this->Html->url(array('controller' => 'Productions', 'action' => 'toggleStatus'));
?>
<div id="productions">
    <div class="text-center loader">
        <i class="fa fa-refresh fa-spin fa-5x"></i>
        <p><?php echo __("Buscando producciones..."); ?></p>
    </div>
    <div class="panel panel-primary hidden">
        <div class="panel-heading">
            <?php echo __('Produccion(es)'); ?>
            <a href="<?php echo $this->Html->url(array(
                'controller' => 'Productions', 'action' => 'export', $operation['o']['id'])); ?>">
                <i class="fa fa-download fa-inverse fa-2x pull-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover detail">
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
<?php echo __('No se encontrarón producciones'); ?>
    </div>
</div>
<?php $this->TioCachas->templateSwig('templateRowProduction', 'production'); ?>
<?php $this->TioCachas->templateSwig('templateSumProduction', 'SumProduction'); ?>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var operation = <?php echo json_encode($operation); ?>;
    var urlToggleStatus = <?php echo json_encode($urlToggleStatus); ?>;
</script>
<?php $this->end(); ?>