<?php $this->Html->script('controllers/categories/index.js', array('block' => 'scriptBottom')); ?>
<?php foreach ($categories as $k => $category): ?>
    <div class="panel panel-primary" id='tableRecords'>
        <div class="panel-heading">
            <?php echo __('Tabla de categorias'); ?>
        </div>
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th><?php echo __('Nombre categoria'); ?></th>
                    <th><?php echo __('Acciones'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $category['Category']['name']; ?></td>
                    <td>
                        <a href='<?php echo $this->Html->url(array('action' => 'editForm')); ?>' title='<?php echo __('Editar'); ?>'><i class='fa fa-pencil fa-lg'></i></a>
                        <span rid='<?php echo $category['Category']['id']; ?>' url='<?php echo $this->Html->url(array('action' => 'delete', $category['Category']['id'])); ?>' class='delete' title='<?php echo __('Eliminar'); ?>'><i class='fa fa-times fa-lg'></i></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>
<div id='empty' class='hidden alert alert-info'>
    No existen categorias activas.
</div>
<script>
    var msgConfirm = <?php echo json_encode(__('Estas seguro que deseas eliminar la categoria?')); ?>;
    var totalRecords = <?php echo json_encode(count($categories)); ?>;
</script>
