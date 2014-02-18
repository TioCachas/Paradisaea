<?php
App::uses('AppHelper', 'View/Helper');

class TableOperationsHelper extends AppHelper {

    public function render() {
        ?>
        <table class="table table-bordered table-condensed table-striped" id='tableRecords'>
            <thead>
                <tr>
                    <th><?php echo __('Linea'); ?></th>
                    <th><?php echo __('Dia de trabajo'); ?></th>
                    <th><?php echo __('Hora'); ?></th>
                    <th><?php echo __('Produccion'); ?></th>
                    <th><?php echo __('Scrap'); ?></th>
                    <th><?php echo __('Retrabajo'); ?></th>
                    <th><?php echo __('Cambio de modelo'); ?></th>
                    <th><?php echo __('Perdidas tecnicas'); ?></th>
                    <th><?php echo __('Perdidas organizacionales'); ?></th>
                    <th><?php echo __('Perdidas de calidad'); ?></th>
                    <th><?php echo __('Perdidas de rendimiento'); ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <?php
    }

    public function byCurrentDay() {
        ?>
        <table class="table table-bordered table-condensed table-striped" id='tableByCurrentDay'>
            <thead>
                <tr>
                    <th><?php echo __('Modelo'); ?></th>
                    <th><?php echo __('Produccion'); ?></th>
                    <th><?php echo __('Scrap'); ?></th>
                    <th><?php echo __('Retrabajo'); ?></th>
                    <th><?php echo __('Changeover'); ?></th>
                    <th><?php echo __('Technical losses'); ?></th>
                    <th><?php echo __('Organizational losses'); ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <?php
    }

}
