<?php

class Configuration {

    private $shift;
    private $line;
    private $shiftText = null;
    private $lineText = null;

    public function __construct($shift, $shiftText, $line, $lineText) {
        $this->shift = $shift;
        $this->line = $line;
        $this->shiftText = $shiftText;
        $this->lineText = $lineText;
    }

    public function getShiftText() {
        return $this->shiftText;
    }

    public function getLineText() {
        return $this->lineText;
    }
    
    public function getLine()
    {
        return $this->line;
    }
    
    public function getShift()
    {
        return $this->shift;
    }

}
