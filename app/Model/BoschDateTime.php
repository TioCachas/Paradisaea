<?php

class BoschDateTime extends DateTime {

    /**
     * Obtenemos el lunes inicial de una semana y el domingo final de la semana.
     * @param DateTime $date Si es null se toma el dia actual. Esta fecha sirve
     * como referencia para calcular el lunes inicial y el domingo final apartir
     * de la fecha que llega como parametro.
     * @return array ['startDate'=> monday, 'endDate'=> sunday]
     */
    public function currentWeek($date = null) {
        $startDay = new DateTime($date); // inicio de la semana
        $endDay = new DateTime($date); // fin de la semana
        // Si no es lunes
        if ($startDay->format('w') != 1) {
            $startDay = $startDay->modify('last monday');
        }
        // Si no es domingo
        if ($endDay->format('w') != 0) {
            $endDay = $endDay->modify('next sunday');
        }
        return array('startDate' => $startDay, 'endDate' => $endDay);
    }

    /**
     * Calculamos el primer y ultimo dia de la fecha que reciva como parametro.
     * @param DateTime $date
     * @return array ['startDate'=> monday, 'endDate'=> sunday]
     */
    public function currentMonth($date = null) {
        $startDay = new DateTime($date); // inicio de la semana
        $endDay = new DateTime($date); // fin de la semana
        $startDay->modify('first day of this month');
        $endDay->modify('last day of this month');
        return array('startDate' => $startDay, 'endDate' => $endDay);
    }

}
