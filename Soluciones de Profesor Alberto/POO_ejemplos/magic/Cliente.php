<?php

class Cliente {

    private int $id;
    private string $nombre;


    public function __get(string $atributo){

        if ( property_exists($this, $atributo)){
            return  $this->$atributo;
       }
       else{
           return "El valor no está definido";
       }

    }    

    public function __set(string $atributo, mixed $valor){
        $this->$atributo = $valor;
  }
}

$cli = new Cliente();
$cli->id = 31;
$cli->nombre = " Pepe";
echo "\n".$cli->id.":".$cli->nombre3;
echo "\n";
