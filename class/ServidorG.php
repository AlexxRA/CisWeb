<?php

class ServidorG
{

    private $nombre;
    private $ubicacion;
    private $ip_servidorg;
    private $id_vlan;

    public function __construct($nombre, $ubicacion, $ip_servidorg, $id_vlan){
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->ip_servidorg = $ip_servidorg;
        $this->id_vlan = $id_vlan;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    public function getIpServidorg()
    {
        return $this->ip_servidorg;
    }

    public function setIpServidorg($ip_servidorg)
    {
        $this->ip_servidorg = $ip_servidorg;
    }

    public function getIdVlan()
    {
        return $this->id_vlan;
    }

    public function setIdVlan($id_vlan)
    {
        $this->id_vlan = $id_vlan;
    }

    public function getSQL(){
        return "'$this->nombre','$this->ubicacion','$this->ip_servidorg','$this->id_vlan'";
    }

    public function UpdateSQL(){
        return "nombre='$this->nombre', ubicacion='$this->ubicacion', ip_servidorg='$this->ip_servidorg', id_vlan='$this->id_vlan'";
    }

    public function getFields(){
        return "(nombre, ubicacion, ip_servidorg, id_vlan)";
    }

}

?>
