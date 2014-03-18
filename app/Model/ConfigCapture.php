<?php

/**
 * Este objeto guarda la linea, turno y el modelo. Datos necesarios para iniciar
 * un turno de trabajo.
 */
class ConfigCapture {

    private $shift;
    private $line;
    private $shiftText = null;
    private $lineText = null;
    private $model;
    private $modelText = null;

    public function __construct($shift, $shiftText, $line, $lineText, $model, $modelText) {
        $this->shift = $shift;
        $this->line = $line;
        $this->shiftText = $shiftText;
        $this->lineText = $lineText;
        $this->model = $model;
        $this->modelText = $modelText;
    }

    /**
     * Obtenemos el nombre del turno
     * @return string
     */
    public function getShiftText() {
        return $this->shiftText;
    }

    /**
     * Obtenemos el nombre de la linea
     * @return string
     */
    public function getLineText() {
        return $this->lineText;
    }

    /**
     * Obtenemos el nombre del modelo
     * @return string
     */
    public function getModelText() {
        return $this->modelText;
    }
    
    /**
     * Obtenemos el id de la linea sobre la que se esta trabajando
     * @return type
     */
    public function getLine() {
        return $this->line;
    }
    
    public function setLine($lineId)
    {
        $this->line = $lineId;
    }
    
    public function setLineText($textLine)
    {
        $this->lineText = $textLine;
    }

    /**
     * Obtenemos el id del turno en el que se esta trabajando
     * @return type
     */
    public function getShift() {
        return $this->shift;
    }

    /**
     * Obtenemos el id del modelo que se esta produciendo
     * @return type
     */
    public function getModel() {
        return $this->model;
    }

}
