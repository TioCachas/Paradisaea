<?php
App::uses('AppHelper', 'View/Helper');
App::uses('UserLine', 'Model');

class BoschHelper extends AppHelper
{

    public function userShifts($shifts)
    {
        array_walk($shifts, function($shift) {
                    ?>
                    <option value="<?php echo $shift['sId'] ?>">
                        <?php echo $shift['sName'] ?>
                    </option>
                    <?php
                });
    }
    
    public function userLines($lines)
    {
        array_walk($lines, function($line) {
                    ?>
                    <option value="<?php echo $line['lId'] ?>">
                        <?php echo $line['lName'] ?>
                    </option>
                    <?php
                });
    }

    public function shifts($shifts)
    {
        foreach ($shifts as $k => $shift)
        {
            ?>
            <option value="<?php echo $shift['Shift']['id'] ?>">
                <?php echo $shift['Shift']['name'] ?>
            </option>
            <?php
        }
    }

    public function lines($lines)
    {
        foreach ($lines as $k => $line)
        {
            ?>
            <option value="<?php echo $line['Line']['id'] ?>">
                <?php echo $line['Line']['name'] ?>
            </option>
            <?php
        }
    }

    /**
     * Imprimimos las etiquetas options para una lista de estaciones de trabajo
     * @param array $workstations
     */
    public function workstations($workstations)
    {
        foreach ($workstations as $k => $workstation)
        {
            ?>
            <option value="<?php echo $workstation['Workstation']['id']; ?>">
                <?php echo $workstation['Workstation']['name'] ?>
            </option>
            <?php
        }
    }

    /**
     * Imprimimos las etiquetas options para una lista de defectos
     * @param array $defects
     */
    public function defects($defects)
    {
        foreach ($defects as $k => $defect)
        {
            ?>
            <option value="<?php echo $defect['Defect']['id']; ?>">
                <?php echo $defect['Defect']['name'] ?>
            </option>
            <?php
        }
    }

    public function models($models)
    {
        foreach ($models as $k => $model)
        {
            ?>
            <option value="<?php echo $model['id'] ?>">
                <?php echo $model['name'] ?>
            </option>
            <?php
        }
    }

    public function indexes($indexes)
    {
        foreach ($indexes as $k => $index)
        {
            ?>
            <option value="<?php echo $index['id'] ?>">
                <?php echo $index['name'] ?>
            </option>
            <?php
        }
    }

    public function hours($hours)
    {
        foreach ($hours as $k => $hour)
        {
            $dt = new DateTime();
            $dtS = new DateTime($hour['Hour']['start']);
            $dtE = new DateTime($hour['Hour']['end']);
            $str = $dtS->format('H:i') . ' - ' . $dtE->format('H:i');
            ?>
            <option value="<?php echo $hour['Hour']['id'] ?>">
                <?php echo $str; ?>
            </option>
            <?php
        }
    }

    /**
     * Obtenemos las lineas que puede manejar un usuario y creamos los options para
     * un elemento select.
     * @param string $userId
     */
    public function getLinesByUser($userId)
    {
        $userLineModel = new UserLine();
        $lines = $userLineModel->getByUser($userId);
        foreach ($lines as $k => $line)
        {
            ?>
            <option value="<?php echo $line['id']; ?>">
                <?php echo $line['line']; ?>
            </option>
            <?php
        }
    }

}
