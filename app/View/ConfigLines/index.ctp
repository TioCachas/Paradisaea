<?php $this->Html->css('controllers/ConfigLines/index', array('block' => 'stylesTop')); ?>
<div class="panel panel-primary" id='tableRecords'>
    <div class="panel-heading">
        <?php echo __('Configuration by day'); ?>
    </div>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th><?php echo __('Day'); ?></th>
                <th><?php echo __('Planed Operating Time [minutes]'); ?></th>
                <th><?php echo __('Target [units]'); ?></th>
                <th><?php echo __('OEE-Target [%]'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($configs as $k => $config):
                $encryptId = Id::e($config['ConfigLine']['id']);
                ?>
                <tr>
                    <td><?php echo Day::name($config['ConfigLine']['day']); ?></td>
                    <td><?php echo $config['ConfigLine']['planed_operating_time']; ?></td>
                    <td><?php echo $config['ConfigLine']['target']; ?></td>
                    <td><?php echo $config['ConfigLine']['oee_target']; ?></td>
                    <td>
                        <a href="<?php echo $this->Html->url(array('action' => 'edit', $encryptId)); ?>">
                            <i title="<?php echo __('Editar'); ?>" class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>