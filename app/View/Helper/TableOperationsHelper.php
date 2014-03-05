<?php
App::uses('AppHelper', 'View/Helper');

class TableOperationsHelper extends AppHelper {

    public function render($workDate) {
        $minutesSymbol = Units::symbol(Units::MINUTES);
        ?>
        <table class="table table-bordered table-condensed noTextTransform bosch" id='dashboardCapture'>
            <thead>
                <tr class="header">
                    <th colspan="8"><?php echo __('Hoja de seguimiento de piezas por hora'); ?></th>
                    <th colspan="5">
                        <i class='fa fa-bar-chart-o pull-right fa-2x'></i>
                    </th>
                    <th colspan="2">
                        <input type="text" class="pull-right form-control" id="workDate" name="workDate" placeholder="<?php echo __('Dia de trabajo'); ?>" value="<?php echo $workDate; ?>">
                    </th>
                </tr>
                <tr class="subheader">
                    <th colspan="2"><?php echo __('Hora'); ?></th>
                    <th colspan="1" rowspan="2"><?php echo __('Modelo'); ?></th>
                    <th colspan="2"><?php echo __('Objetivo (basado en 100% de OEE)'); ?></th>
                    <th colspan="2"><?php echo __('Actual'); ?></th>
                    <th colspan="1"><?php echo __('Piezas/hora'); ?></th>
                    <th colspan="2"><?php echo __('Calidad [piezas]'); ?></th>
                    <th colspan="5"><?php echo __('Disponibilidad de perdidas [minutos]'); ?></th>
                </tr>
                <tr class="text-center subheader">
                    <th>
                        <?php echo __('Inicio'); ?>
                    </th>
                    <th>
                        <?php echo __('Fin'); ?>
                    </th>
                    <th>
                        <?php echo __('Piezas'); ?>
                    </th>
                    <th>
                        <?php echo __('Acumulado'); ?>
                    </th>
                    <th>
                        <?php echo __('Piezas'); ?>
                    </th>
                    <th>
                        <?php echo __('Acumulado'); ?>
                    </th>
                    <th>
                        <?php echo __('Avence'); ?>
                    </th>
                    <th class='scrap'>
                        <?php echo __('Scrap / Acumulado'); ?>
                    </th>
                    <th class='rework'>
                        <?php echo __('Retrabajo / Acumulado'); ?>
                    </th>
                    <th class='changeoverLosses'>
                        <?php echo __('Cambio de modelo'); ?>
                    </th>
                    <th class='techicalLosses'>
                        <?php echo __('Tecnicas'); ?>
                    </th>
                    <th class='organizationalLosses'>
                        <?php echo __('Organizacional'); ?>
                    </th>
                    <th class='qualityLosses'>
                        <?php echo __('Calidad'); ?>
                    </th>
                    <th class='performanceLosses'>
                        <?php echo __('Desempeño'); ?>
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
