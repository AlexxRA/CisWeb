<?php

class Vlan
{

    private $id_vlan;
    private $id_sitio;

    public function __construct($id_vlan, $id_sitio){

        $this->id_vlan = $id_vlan;
        $this->id_sitio = $id_sitio;
    }

    public function getSQL(){
        return "'$this->id_vlan','$this->id_sitio'";
    }

    public function UpdateSQL(){
        return "id_vlan='$this->id_vlan', id_sitio='$this->id_sitio'";
    }

    public function getFields(){
        return "(id_vlan, id_sitio)";
    }

}

?>