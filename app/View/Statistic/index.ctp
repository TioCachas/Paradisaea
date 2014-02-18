<?php $this->Html->css('controllers/Statistic/index', array('block' => 'stylesTop')); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php echo __('Estadísticas semana actual'); ?>
    </div>
    <div class="panel-body">
        <?php echo $week; ?>
    </div>
</div>
<style type="text/css">
    td.tableInternal{
        padding: 0px !important;
    }
    .inner-table {
        overflow-x:scroll;
    }
</style>

