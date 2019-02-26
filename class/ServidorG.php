<?php

class ServidorG
{

    private $nombre;

    public function __construct($nombre){

        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getSQL(){
        return "'$this->nombre'";
    }

    public function UpdateSQL(){
        return "nombre='$this->nombre'";
    }

    public function getFields(){
        return "(nombre)";
    }

}

?>
