<?php

/**
 * Description of Units
 *
 * @author suf5slp
 */
class Units
{
    const MINUTES = 1;
    const UNITS = 2;
    const PERCENT = 3;

    /**
     * Obtenemos el simbolo y nombre de las unidades
     * @param array $type ['symbol'=>'%','name'=>'porcentaje']
     */
    public static function names($type)
    {
        $symbol = '';
        $name = '';
        switch ($type)
        {
            case self::MINUTES:
                $symbol = __('min');
                $name = __('minutos');
                break;
            case self::UNITS:
                $symbol = __('pz');
                $name = __('piezas');
                break;
            case self::PERCENT:
                $symbol = __('%');
                $name = __('porcentaje');
                break;
        }
        return array('symbol' => $symbol, 'name' => $name);
    }

    /**
     * Retornamos el simbolo de una unidad
     * @param integer $type
     * @return string
     */
    public static function symbol($type)
    {
        $unit = self::names($type);
        return ' [' . $unit['symbol'] . ']';
    }

    /**
     * Generamos el codigo de la etiqueta abbr para imprimir la unidad
     * @param type $type
     * @return string
     */
    public static function symbolHtml($type)
    {
        $unit = self::names($type);
        $code = '<abbr class="lowercase" title="' . $unit['name'] . '">' . $unit['symbol'] . '</abbr>';
        return $code;
    }

}
