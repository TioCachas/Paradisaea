<?php
$this->TioCachas->addKendo();
$this->Html->script('controllers/Scraps/capture', array('block' => 'scriptBottom'));
$this->Html->css('controllers/Scraps/capture', array('block' => 'stylesTop'));
$units = Units::symbolHtml(Units::UNITS);
$urlCreate = $this->Html->url(array('action' => 'create'));
$urlDelete = $this->Html->url(array('action' => 'delete'));
$this->TioCachas->templateSwig('templateRow', 'scrap-user');
?>
<div>
    <form id="newRecord" action="<?php echo $urlCreate; ?>">
        <ul>
            <li>
                <label for="value"><?php echo __('Valor'); ?>:</label>
                <input id="value" requiered name="value" type="text" min="1" max="1000" required data-max-msg="Ingresa un valor entre 0 y 1000" />
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
            <?php foreach ($scraps as $s): ?>
                <tr data-id="<?php echo $s['sId']; ?>">
                    <td><?php echo $s['sValue'] . ' ' . $units; ?></td>
                    <td><?php echo $s['sComment']; ?></td>
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
