<?php

class Municipio
{

    private $nombre;
    private $abreviatura;

    public function __construct($nombre, $abreviatura){

        $this->nombre = $nombre;
        $this->abreviatura = $abreviatura;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    }

    public function getSQL(){
        return "'$this->nombre','$this->abreviatura'";
    }

    public function UpdateSQL(){
        return "nombre='$this->nombre', abreviatura='$this->abreviatura'";
    }

    public function getFields(){
        return "(nombre, abreviatura)";
    }

}

?>