<?php
namespace pruebas00\taller\POO;
class Coche
{
    // Definir los atributos
    private $modelo;
    private $distanciaTotal;
    private $distanciaParcial;
    private $motor;          // true arrancado, false parado
    private $velocidad;
    private $velocidadMax;

    // Completar los métodos

    function __construct ( String $modelo, int $velocidadMax){
        $this->modelo = $modelo;
        $this->velocidadMax = $velocidadMax;
        $this->distanciaTotal = 0;
        $this->distanciaParcial = 0;
        $this->velocidad = 0;
        $this->motor = false;
    }

    public function  arrancar():bool{
        if ($this->motor) {
            $this->infoError("no se puede arrancar, el coche ya esta arrancado");
            return false;
        }
        $this->motor = true;
        return true;
    }

    public function parar():bool{
        if (!$this->motor) {
            $this->infoError("no se puede parar, el coche ya esta parado");
            return false;
        }
        $this->motor = false;
        $this->distanciaParcial = 0;
        $this->velocidad = 0;
        return true;
    }

    public function acelera( int $cantidad):bool{
        if (!$this->motor) {
            $this->infoError("no se puede acelerar con el coche parado");
            return false;
        }
        if ($this->velocidad + $cantidad > $this->velocidadMax) {
            $this->infoError("no se puede superar la velocidad maxima de ".$this->velocidadMax." km/h");
            return false;
        }
        $this->velocidad += $cantidad;
        return true;
    }

    public function frena ( int $cantidad):bool{
        if (!$this->motor) {
            $this->infoError("no se puede frenar con el coche parado");
            return false;
        }
        if ($this->velocidad == 0) {
            $this->infoError("no se puede frenar, la velocidad ya es 0");
            return false;
        }
        $this->velocidad -= $cantidad;
        // para que no se quede con velocidad negativa
        if ($this->velocidad < 0) {
            $this->velocidad = 0;
        }
        return true;
    }

    public function recorre ():bool{
        if (!$this->motor) {
            $this->infoError("no se puede recorrer con el coche parado");
            return false;
        }
        $this->distanciaParcial += $this->velocidad;
        $this->distanciaTotal += $this->velocidad;
        return true;
    }

    public function info():string{
        if ($this->motor) {
            $estado = "arrancado";
        } else {
            $estado = "parado";
        }
        return "Modelo: ".$this->modelo." | Velocidad: ".$this->velocidad." km/h | Motor: ".$estado.
               " | Km parciales: ".$this->distanciaParcial." | Km totales: ".$this->distanciaTotal;
    }

    public function getKilometros():int{
        return $this->distanciaParcial;
    }

    private function infoError( String $mensaje):void{
        echo "<br> <b>ERROR</b> en el ".$this->modelo.": ".$mensaje;
    }
}
