<?php

/**
 * Description of Day
 *
 * @author suf5slp
 */
class Day {

    /**
     * Retornamos el nombre del dia segun un valor entero que indica el dia de la
     * semana. Lunes: 1, martes: 2, miercoles: 3 ...
     * @param integer $i
     * @return string
     */
    public static function name($i) {
        $name = __('Desconocido');
        switch ($i) {
            case '1':
                $name = __('Lunes');
                break;
            case '2':
                $name = __('Martes');
                break;
            case '3':
                $name = __('Miércoles');
                break;
            case '4':
                $name = __('Jueves');
                break;
            case '5':
                $name = __('Viernes');
                break;
            case '6':
                $name = __('Sábado');
                break;
            case '0':
                $name = __('Domingo');
                break;
        }
        return $name;
    }

}
