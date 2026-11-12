<?php

include_once 'MotorInterface.php';
/*
 * Molino hidraulico 
 */
class Molino implements MotorInterface
{
    private bool $compuerta;
    private int $presion;
    private int $aspas;
    
    function __construct(int $aspas){
        $this->aspas = $aspas;
        $this->compuerta = false;
    }
    
    public function encender():bool
    {
        if ($this->presion > 0){
        $this->compuerta = true;
        return true;
        }
        else{
            return false;
        }
    }

    public function apagar():bool
    {
        $this->compuerta = false;
        return true;
    }

    public function estaEncendido():bool
    {
        return ( $this->compuerta == true);
    }

    public function infoEstado():string{
        return "Compuerta :".$this->compuerta."\n".
               "Aspas     :".$this->aspas."\n".
               "Presión   :".$this->presion."\n";
    }

    public function darpresion( int $presion){
        $this->presion = $presion;
    }
}

