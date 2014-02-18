<?php

class StatisticDay {

    public $date;
    public $pot; // Planed Operating Time [min]
    public $target; // Target(based on 100% OEE)
    public $production; // units
    public $oee; // %
    public $scrap; // units
    public $rework; // rework
    public $qualityLosses; // %
    public $changeoverMin; // min
    public $changeoverLosses; // %
    public $technicalLossesMin; // %
    public $technicalLosses; // %
    public $organizationalLossesMin; // %
    public $organizationalLosses; // %
    public $performanceLosses; // %
    public $oeeTarget; // 

    public function __construct($operations, $pot, $target, $oeeTarget) {
        $dt = new DateTime($this->date);
        $this->date = $operations['operations']['dateOperation'];
        $this->pot = $pot;
        $this->target = $target;
        $this->production = $operations[0]['sumProduction'];
        $this->oee = $this->production / $this->target;
        $this->scrap = $operations[0]['sumScrap'];
        $this->rework = $operations[0]['sumRework'];
        $this->qualityLosses = ($this->scrap + $this->rework) / $this->target;
        $this->changeoverMin = $operations[0]['sumChangeover'];
        $this->changeoverLosses = $this->changeoverMin / $this->pot;
        $this->technicalLossesMin = $operations[0]['sumTechnicalLosses'];
        $this->technicalLosses = $this->technicalLossesMin / $this->pot;
        $this->organizationalLossesMin = $operations[0]['sumOrganizationalLosses'];
        $this->organizationalLosses = $this->organizationalLossesMin / $this->pot;
        $this->performanceLosses = 1 - ($this->oee + $this->qualityLosses + $this->changeoverLosses + $this->technicalLosses + $this->organizationalLosses);
        $this->oeeTarget = $oeeTarget;
    }

}
