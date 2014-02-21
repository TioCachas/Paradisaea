<?php
App::uses('AppHelper', 'View/Helper');

class TableOperationsHelper extends AppHelper {

    public function render() {
        $minutesSymbol = Units::symbol(Units::MINUTES);
        ?>
        <table class="table table-bordered table-condensed table-hover" id='tableRecords'>
            <thead>
                <tr class="text-center">
                    <th title="<?php echo __('Hora'); ?>">
                        <i class="fa fa-clock-o"></i>
                    </th>
                    <th title="<?php echo __('Piezas objetivo'); ?>">
                        <i class="fa fa-flag"></i>
                    </th>
                    <th title="<?php echo __('Acumulado piezas objetivo'); ?>">
                        <i class="fa fa-plus-square"></i>
                        <i class="fa fa-flag"></i>
                    </th>
                    <th class="production" title="<?php echo __('Piezas OK'); ?>">
                        <i class="fa fa-check"></i>
                    </th>
                    <th class="sumProduction" title="<?php echo __('Acumulado piezas OK'); ?>">
                        <i class="fa fa-plus-square"></i>
                        <i class="fa fa-check"></i>
                    </th>
                    <th class="scrap" title="<?php echo __('Scrap'); ?>">
                        <i class="fa fa-trash-o"></i>
                    </th>
                    <th class="rework" title="<?php echo __('Retrabajo'); ?>">
                        <i class="fa fa-repeat"></i>
                    </th>
                    <th class="changeoverLosses" title="<?php echo __('Cambio de modelo') . $minutesSymbol; ?>">
                        <i class="fa fa-exchange"></i>
                    </th>
                    <th class="techicalLosses" title="<?php echo __('Tecnicas') . $minutesSymbol; ?>">
                        <i class="fa fa-wrench fa-inverse"></i>
                    </th>
                    <th class="organizationalLosses" title="<?php echo __('Organizacional') . $minutesSymbol; ?>">
                        <i class="fa fa-users fa-inverse"></i>
                    </th>
                    <th class="qualityLosses" title="<?php echo __('Calidad') . $minutesSymbol; ?>">
                        <i class="fa fa-thumbs-o-down"></i>
                    </th>
                    <th class="performanceLosses" title="<?php echo __('Desempeño') . $minutesSymbol; ?>">
                        <i class="fa fa-bar-chart-o fa-inverse"></i>
                    </th>
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
