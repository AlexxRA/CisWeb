<?php
    class Sitio
    {
        private $nom_prop;
        private $nom_real;
        private $vlan;

        public function __construct($nom_prop, $nom_real, $vlan)
        {
            $this->nom_prop = $nom_prop;
            $this->nom_real = $nom_real;
            $this->vlan = $vlan;
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
            return "'".$this->nom_prop."','".$this->nom_real."','".$this->vlan."'";
        }

        public function UpdateSQL(){
            return "nom_prop='$this->nom_prop', nom_real='$this->nom_real', vlan='$this->vlan'";
        }

    }
?>