<?php
    class Sitio
    {
        private $nom;
        private $vlan;
        private $calle;
        private $cruce;
        private $colonia;
        private $municipio;
        private $latitud;
        private $longitud;

        public function __construct($nom, $vlan, $calle, $cruce, $colonia, $municipio,  $latitud, $longitud)
        {
            $this->nom = $nom;
            $this->vlan = $vlan;
            $this->calle=$calle;
            $this->cruce=$cruce;
            $this->colonia=$colonia;
            $this->municipio=$municipio;
            $this->latitud=$latitud;
            $this->longitud=$longitud;
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
            return "'".$this->nom."','".$this->vlan."','".$this->calle."','".$this->cruce."','".$this->colonia."','".$this->municipio."','".$this->latitud."','".$this->longitud."'";
        }

        public function UpdateSQL(){
            return "nom='$this->nom', vlan='$this->vlan', calle='$this->calle', cruce='$this->cruce', colonia='$this->colonia', municipio='$this->municipio', latitud='$this->latitud', longitud='$this->longitud'";
        }

    }
?>