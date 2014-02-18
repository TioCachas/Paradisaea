<?php
App::uses('StatisticDay', 'Model');

class StatisticDays {

    private $operations = array();
    private $configLines;
    private $oee;
    private $qualityLosses;
    private $changeoverLosses;
    private $technicalLosses;
    private $organizationalLosses;

    public function __construct($configLines, DateTime $startDate, DateTime $endDate, array $operationsGroupByDate) {
        $this->configLines = $configLines;
        $this->createWeek($startDate, $endDate, $operationsGroupByDate);
        $this->oee = array(
            'min' => 0,
            'max' => 0,
            'avg' => 0);
        $this->qualityLosses = array(
            'min' => 0,
            'max' => 0,
            'avg' => 0);
        $this->changeoverLosses = array(
            'min' => 0,
            'max' => 0,
            'avg' => 0);
        $this->technicalLosses = array(
            'min' => 0,
            'max' => 0,
            'avg' => 0);
        $this->organizationalLosses = array(
            'min' => 0,
            'max' => 0,
            'avg' => 0);
        $this->calculeMinMaxAvg();
    }

    private function createWeek($startDate, $endDate, $operationsGroupByDate) {
        for (; $startDate <= $endDate; $startDate->modify('1 day')) {
            $keyOperations = $startDate->format('Y-m-d');
            $day = $startDate->format('w');
            $config = $this->configLines[$day];
            $pot = $config['planed_operating_time'];
            $target = $config['target'];
            $oeeTarget = $config['oee_target'];
            $this->operations[$keyOperations] = null; // Creamos toda el periodo de tiempo
            foreach ($operationsGroupByDate as $key => $operationsByDate) {
                if ($keyOperations == $operationsByDate['operations']['dateOperation']) {
                    $statisticDay = new StatisticDay($operationsByDate, $pot, $target, $oeeTarget);
                    $this->operations[$keyOperations] = $statisticDay;
                    break;
                }
            }
        }
    }

    private function calculeMinMaxAvg() {
        $oee = array();
        $qualityLosses = array();
        $changeoverLosses = array();
        $technicalLosses = array();
        $organizationalLosses = array();
        foreach ($this->operations as $day) {
            if ($day instanceof StatisticDay) {
                $oee[] = $day->oee;
                $qualityLosses[] = $day->qualityLosses;
                $changeoverLosses[] = $day->changeoverLosses;
                $technicalLosses[] = $day->technicalLosses;
                $organizationalLosses[] = $day->organizationalLosses;
            }
        }
        /// Min
        $this->oee['min'] = min($oee);
        $this->qualityLosses['min'] = min($qualityLosses);
        $this->changeoverLosses['min'] = min($changeoverLosses);
        $this->technicalLosses['min'] = min($technicalLosses);
        $this->organizationalLosses['min'] = min($organizationalLosses);
        /// Max
        $this->oee['max'] = max($oee);
        $this->qualityLosses['max'] = max($qualityLosses);
        $this->changeoverLosses['max'] = max($changeoverLosses);
        $this->technicalLosses['max'] = max($technicalLosses);
        $this->organizationalLosses['max'] = max($organizationalLosses);
        // avg
        $this->oee['avg'] = array_sum($oee) / count($oee);
        $this->qualityLosses['avg'] = array_sum($qualityLosses) / count($qualityLosses);
        $this->changeoverLosses['avg'] = array_sum($changeoverLosses) / count($changeoverLosses);
        $this->technicalLosses['avg'] = array_sum($technicalLosses) / count($technicalLosses);
        $this->organizationalLosses['avg'] = array_sum($organizationalLosses) / count($organizationalLosses);
    }

    public function __toString() {
        ?>
        <div class="table-responsive">
            <table class="table table-condensed table-striped table-hover">
                <tbody>
                    <?php $this->titles(); ?>
                    <?php $this->echoRow(__('Planed Operating Time'), 'pot', Units::MINUTES); ?>
                    <?php $this->echoRow(__('Target'), 'target', Units::UNITS); ?>
                    <?php $this->echoRow(__('Actual'), 'production', Units::UNITS); ?>
                    <?php $this->echoRow(__('OEE'), 'oee', Units::PERCENT, true, true, true); ?>
                    <?php $this->echoRow(__('Scrap'), 'scrap', Units::UNITS); ?>
                    <?php $this->echoRow(__('Rework'), 'rework', Units::UNITS); ?>
                    <?php $this->echoRow(__('Quality losses'), 'qualityLosses', Units::PERCENT, true, true, true); ?>
                    <?php $this->echoRow(__('Changeover [min]'), 'changeoverMin', Units::MINUTES); ?>
                    <?php $this->echoRow(__('Changeover losses [%]'), 'changeoverLosses', Units::PERCENT, true, true, true); ?>
                    <?php $this->echoRow(__('Technical losses [min]'), 'technicalLossesMin', Units::MINUTES); ?>
                    <?php $this->echoRow(__('Technical losses [%]'), 'technicalLosses', Units::PERCENT, true, true, true); ?>
                    <?php $this->echoRow(__('Organizational losses [min]'), 'organizationalLossesMin', Units::MINUTES); ?>
                    <?php $this->echoRow(__('Organizational losses [%]'), 'organizationalLosses', Units::PERCENT, true, true, true); ?>
                    <?php $this->echoRow(__('Performance losses [%]'), 'performanceLosses', Units::PERCENT); ?>
                    <?php $this->echoRow(__('OEE-Target [%]'), 'oeeTarget', Units::PERCENT); ?>
                </tbody>
            </table>
        </div>
        <?php
        return '';
    }

    private function titles() {
        ?>
        <tr>
            <td style='width: 17%;'><?php echo __('Day'); ?></td>
            <td rowspan='17' colspan='1' class='tableInternal' style="width: 60%">
                <div class="inner-table">
                    <?php $this->echoInternalTable(); ?>
                </div>
            </td>
            <td style='width: 7%'><?php echo __('Avg'); ?></td>
            <td style='width: 7%'><?php echo __('Min'); ?></td>
            <td style='width: 7%'><?php echo __('Max'); ?></td>
        </tr>
        <?php
    }

    private function echoInternalTable() {
        ?>
        <table class='table table-condensed table-hover table-striped'>
            <tbody>
                <tr>
                    <?php
                    foreach ($this->operations as $key => $day):
                        $dt = new DateTime($key);
                        $day = $dt->format('d');
                        ?>
                        <th><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php $this->echoRowInternal(__('Planed Operating Time'), 'pot', Units::MINUTES); ?>
                <?php $this->echoRowInternal(__('Target'), 'target', Units::UNITS); ?>
                <?php $this->echoRowInternal(__('Actual'), 'production', Units::UNITS); ?>
                <?php $this->echoRowInternal(__('OEE'), 'oee', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('Scrap'), 'scrap', Units::UNITS); ?>
                <?php $this->echoRowInternal(__('Rework'), 'rework', Units::UNITS); ?>
                <?php $this->echoRowInternal(__('Quality losses'), 'qualityLosses', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('Changeover [min]'), 'changeoverMin', Units::MINUTES); ?>
                <?php $this->echoRowInternal(__('Changeover losses [%]'), 'changeoverLosses', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('Technical losses [min]'), 'technicalLossesMin', Units::MINUTES); ?>
                <?php $this->echoRowInternal(__('Technical losses [%]'), 'technicalLosses', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('Organizational losses [min]'), 'organizationalLossesMin', Units::MINUTES); ?>
                <?php $this->echoRowInternal(__('Organizational losses [%]'), 'organizationalLosses', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('Performance losses [%]'), 'performanceLosses', Units::PERCENT); ?>
                <?php $this->echoRowInternal(__('OEE-Target [%]'), 'oeeTarget', Units::PERCENT); ?>
            </tbody>
        </table>
        <?php
    }

    private function echoRow($title, $field, $unitId, $avg = false, $min = false, $max = false) {
        ?>
        <tr>
            <td><?php echo $title; ?></td>
            <td>
                <?php if ($avg === true): ?>
                    <?php
                    $value = $this->$field;
                    $value = $value['avg'];
                    if ($unitId != Units::PERCENT) {
                        echo $value;
                    } else {
                        echo round($value * 100, 2);
                    }
                    $unit = Units::names($unitId);
                    ?>
                    <abbr title="<?php echo $unit['name'] ?>"><?php echo $unit['symbol'] ?></abbr>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($min === true): ?>
                    <?php
                    $value = $this->$field;
                    $value = $value['min'];
                    if ($unitId != Units::PERCENT) {
                        echo $value;
                    } else {
                        echo round($value * 100, 2);
                    }
                    $unit = Units::names($unitId);
                    ?>
                    <abbr title="<?php echo $unit['name'] ?>"><?php echo $unit['symbol'] ?></abbr>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($max === true): ?>
                    <?php
                    $value = $this->$field;
                    $value = $value['max'];
                    if ($unitId != Units::PERCENT) {
                        echo $value;
                    } else {
                        echo round($value * 100, 2);
                    }
                    $unit = Units::names($unitId);
                    ?>
                    <abbr title="<?php echo $unit['name'] ?>"><?php echo $unit['symbol'] ?></abbr>
                <?php endif; ?>
            </td>
        </tr>
        <?php
    }

    private function echoRowInternal($title, $field, $unitId) {
        ?>
        <tr>
            <?php
            foreach ($this->operations as $day):
                if ($day instanceof StatisticDay):
                    $value = $day->$field;
                    $title = '';
                    $names = Units::names($unitId);
                    if ($unitId == Units::PERCENT) {
                        $value = round($value * 100, 2);
                        $title = $value . ' ' . $names['symbol'];
                    } else {
                        $title = $value . ' ' . $names['name'];
                    }
                    ?>
                    <td title='<?php echo $title; ?>'>
                        <?php echo $value; ?>
                    </td>
                    <?php
                else:
                    ?>
                    <td></td>
                <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php
    }

}
