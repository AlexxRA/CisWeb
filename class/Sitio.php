<?php
    class Sitio
    {
        private $id_sitio;
        private $nom_prop;
        private $nom_real;
        private $vlan;

        public function __construct($id_sitio, $nom_prop, $nom_real, $vlan)
        {
            $this->id_sitio = $id_sitio;
            $this->nom_prop = $nom_prop;
            $this->nom_real = $nom_real;
            $this->vlan = $vlan;
        }

        public function getIdSitio()
        {
            return $this->id_sitio;
        }

        public function setIdSitio($id_sitio)
        {
            $this->id_sitio = $id_sitio;
        }

        public function getNomProp()
        {
            return $this->nom_prop;
        }

        public function setNomProp($nom_prop)
        {
            $this->nom_prop = $nom_prop;
        }

        public function getNomReal()
        {
            return $this->nom_real;
        }

        public function setNomReal($nom_real)
        {
            $this->nom_real = $nom_real;
        }

        public function getVlan()
        {
            return $this->vlan;
        }

        public function setVlan($vlan)
        {
            $this->vlan = $vlan;
        }

        public function getSQL()
        {
            return "'".$this->id_sitio."','".$this->nom_prop."','".$this->nom_real."','".$this->vlan."'";
        }

        public function UpdateSQL(){
            return "id_sitio='$this->id_sitio', nom_prop='$this->nom_prop', nom_real='$this->nom_real', vlan='$this->vlan'";
        }

    }
?>