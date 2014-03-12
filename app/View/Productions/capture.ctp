<?php
$this->Html->script('controllers/Productions/capture', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Productions/capture', array('block' => 'stylesTop'));
$this->TioCachas->templateSwig('templateRow', 'production-user');
$urlDelete = $this->Html->url(array('action' => 'delete'));
$urlCreate = $this->Html->url(array('action' => 'create'));
$units = Units::symbolHtml(Units::UNITS);
?>
<div>
    <form id="newProduction" action="<?php echo $urlCreate; ?>">
        <ul>
            <li>
                <label class="required" for="model"><?php echo __('Modelo'); ?>:</label>
                <span><?php echo $model; ?></span>
            </li>
            <li>
                <label for="index"><?php echo __('Index'); ?>:</label>
                <select name="index" id="index" required data-required-msg="Seleccionar index">
                    <?php $this->Bosch->indexes($indexes); ?>
                </select>
                <span class="k-invalid-msg" data-for="index"></span>
            </li>
            <li>
                <label for="value"><?php echo __('Valor'); ?>:</label>
                <input data-decimals="0" id="value" requiered name="value" type="text" min="1" max="1000" required data-max-msg="Ingresa un valor entre 0 y 1000" />
                <div class="k-invalid-msg" data-for="value"></div>
            </li>
            <li class="accept">
                <button class="k-button" type="submit">Agregar</button>
                <i class="fa fa-refresh fa-spin hidden"></i>
            </li>
        </ul>
    </form>
</div>
<br/>
<div class="table-responsive" id="productions">
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th><?php echo __('Modelo'); ?></th>
                <th><?php echo __('Index'); ?></th>
                <th><?php echo __('Valor'); ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productions as $p): ?>
                <tr data-id="<?php echo $p['pId']; ?>">
                    <td><?php echo $p['mName']; ?></td>
                    <td><?php echo $p['iName']; ?></td>
                    <td><?php echo $p['pValue'] . ' ' . $units; ?></td>
                    <td>
                        <i class="fa fa-times" title="<?php echo __('Eliminar'); ?>"></i>
                        <i class="fa fa-refresh fa-spin hidden"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->start('jsVars'); ?>
<script type="text/javascript">
    var oId = <?php echo json_encode($operation['id']); ?>;
    var mName = <?php echo json_encode($model); ?>;
    var urlDelete = <?php echo json_encode($urlDelete); ?>;
</script>
<?php $this->end(); ?>
