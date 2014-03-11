<?php
App::uses('AppHelper', 'View/Helper');

class TableOperationsHelper extends AppHelper
{

    public function render($users, $workDate)
    {
        ?>
        <table class="table table-bordered table-condensed noTextTransform dashboardCapture">
            <thead>
                <tr class="header">
                    <th colspan="15" class="tools">
                        <?php echo __('Hoja de seguimiento de piezas por hora'); ?>
                        <input type="text" class="form-control pull-right" name="workDate" placeholder="<?php echo __('Dia de trabajo'); ?>" value="<?php echo $workDate; ?>">
                        <input class="shifts" />
                        <input class="lines" />
                        <select class="users">
                            <?php
                            array_walk($users, function($user) {
                                        echo '<option value=' . $user['uId'] . '>' . $user['uName'] . '</option>';
                                    });
                            ?>
                        </select>
                        <i class = 'fa fa-bar-chart-o'></i>
                    </th>
                </tr>
                <tr class = "subheader">
                    <th colspan = "2"><?php echo __('Hora');
                            ?></th>
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
                        <?php echo __('Avance'); ?>
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
                <?php if (count($users) == 0): ?>
                    <tr class="error users">
                        <td colspan="15" class="text-center">
                            <i class="fa fa-info-circle fa-5x"></i>
                            <br/>
                            <?php echo __("No se encontrarón usuarios"); ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr class="error lines hidden">
                        <td colspan="15" class="text-center">
                            <i class="fa fa-info-circle fa-5x"></i>
                            <br/>
                            <?php echo __("El usuario no tiene líneas asignadas"); ?>
                        </td>
                    </tr>
                    <tr class="error shifts hidden">
                        <td colspan="15" class="text-center">
                            <i class="fa fa-info-circle fa-5x"></i>
                            <br/>
                            <?php echo __("El usuario no tiene turnos asignados"); ?>
                        </td>
                    </tr>
                    <tr class="loader operations hidden">
                        <td colspan="15" class="text-center">
                            <i class="fa fa-refresh fa-spin fa-5x"></i>
                            <br/>
                            <?php echo __("Generando pizarra de captura..."); ?>
                        </td>
                    </tr>
                    <tr class="loader linesAndShifts">
                        <td colspan="15" class="text-center">
                            <i class="fa fa-refresh fa-spin fa-5x"></i>
                            <br/>
                            <?php echo __("Cargando líneas y turnos disponibles..."); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <?php
    }

    public function byCurrentDay()
    {
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
