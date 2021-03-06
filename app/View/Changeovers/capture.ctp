<?php
$this->Html->script('controllers/Changeovers/capture', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Changeovers/capture', array('block' => 'stylesTop'));
$urlCreate = $this->Html->url(array('action' => 'create'));
$urlDelete = $this->Html->url(array('action' => 'delete'));
$this->TioCachas->templateSwig('templateRow', 'changeover-user');
$units = Units::symbolHtml(Units::MINUTES);
?>
<div>
    <?php if (count($models) > 0): ?>
        <form id="newRecord" action="<?php echo $urlCreate; ?>">
            <ul>
                <li>
                    <label for="model"><?php echo __('Modelo'); ?>:</label>
                    <select name="model" id="model">
                        <?php foreach ($models as $model): ?>
                            <option value="<?php echo $model['id']; ?>"><?php echo $model['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="k-invalid-msg" data-for="model"></div>
                </li>
                <li>
                    <label for="value"><?php echo __('Minutos'); ?>:</label>
                    <input id="value" requiered name="value" type="text" min="1" max="1000" required data-max-msg="Ingresa un valor entre 0 y 1000" value="5"/>
                    <div class="k-invalid-msg" data-for="value"></div>
                </li>
                <li>
                    <label for="comment"><?php echo __('Comentario'); ?>:</label>
                    <textarea id="comment" type="text" requiered required></textarea>
                    <div class="k-invalid-msg" data-for="comment"></div>
                </li>
                <li class="accept">
                    <button class="k-button" type="submit">Agregar</button>
                    <i class="fa fa-refresh fa-spin hidden"></i>
                </li>
            </ul>
        </form>
    <?php else: ?>
        <div class="alert alert-info">
            <?php echo __('No es posible hacer un cambio de modelo ya que esta linea solo produce un modelo'); ?>
        </div>
    <?php endif; ?>
</div>
<br/>
<div class="table-responsive" id="records">
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th><?php echo __('Value'); ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($changeovers as $co): ?>
                <tr data-id="<?php echo $co['coId']; ?>">
                    <td><?php echo $co['coValue'] . ' ' . $units; ?></td>
                    <td><?php echo $co['coComment']; ?></td>
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
    var urlDelete = <?php echo json_encode($urlDelete); ?>;
</script>
<?php $this->end(); ?>
