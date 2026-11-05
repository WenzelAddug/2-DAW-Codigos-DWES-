<?php

class Reloj
{
    private $segundos;
    private $formato24;

    // Mejora: alarma
    private $alarma;          // segundos desde las 00:00:00 a los que suena
    private $alarmaActivada;  // true si la alarma esta activada

    public function __construct ( int $hora, int $minutos, int $segundos){
        $this->segundos = $hora * 3600 + $minutos * 60 + $segundos;
        $this->formato24 = true;
        $this->alarma = 0;
        $this->alarmaActivada = false;
    }

    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso

    public function mostrar(){
        $h = (int)($this->segundos / 3600);
        $m = (int)(($this->segundos % 3600) / 60);
        $s = $this->segundos % 60;

        if ($this->formato24) {
            return str_pad($h, 2, "0", STR_PAD_LEFT) . ":" .
                   str_pad($m, 2, "0", STR_PAD_LEFT) . ":" .
                   str_pad($s, 2, "0", STR_PAD_LEFT);
        }

        // formato 12 horas
        if ($h < 12) {
            $ampm = "am";
        } else {
            $ampm = "pm";
        }
        $h = $h % 12;
        if ($h == 0) {
            $h = 12; // las 00 son las 12 am y las 12 son las 12 pm
        }

        return str_pad($h, 2, "0", STR_PAD_LEFT) . ":" .
               str_pad($m, 2, "0", STR_PAD_LEFT) . ":" .
               str_pad($s, 2, "0", STR_PAD_LEFT) . " " . $ampm;
    }

    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
        $this->formato24 = $formato24;
    }

    // Incrementa en un segundo el valor de reloj
    public function tictac (){
        $this->segundos++;
        // si llega a las 24:00:00 vuelve a las 00:00:00
        if ($this->segundos == 86400) {
            $this->segundos = 0;
        }

        if ($this->alarmaActivada && $this->segundos == $this->alarma) {
            echo "<br> RIIIING!! La alarma de las " . $this->mostrar() . " esta sonando <br>";
        }
    }

    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia

    public function comparar ( Reloj $otroreloj){

        return abs($this->segundos - $otroreloj->segundos);
    }

    // ---- MEJORA: RELOJ CON ALARMA ----

    // Fija la alarma a una hora y minutos
    public function fijarAlarma ( int $hora, int $minutos){
        $this->alarma = $hora * 3600 + $minutos * 60;
    }

    // Activa (true) o desactiva (false) la alarma
    public function activarAlarma ( bool $activar){
        $this->alarmaActivada = $activar;
    }
}
