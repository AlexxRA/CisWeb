<?php
    class Sitio
    {
        private $nom;
        private $calle;
        private $cruce;
        private $colonia;
        private $municipio;
        private $latitud;
        private $longitud;
        private $id_municipio;

        public function __construct($nom, $calle, $cruce, $colonia, $municipio,  $latitud, $longitud, $id_municipio)
        {
            $this->nom = $nom;
            $this->calle=$calle;
            $this->cruce=$cruce;
            $this->colonia=$colonia;
            $this->municipio=$municipio;
            $this->latitud=$latitud;
            $this->longitud=$longitud;
            $this->id_municipio=$id_municipio;
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

        public function getIdMunicipio()
        {
            return $this->id_municipio;
        }

        public function setIdMunicipio($id_municipio)
        {
            $this->id_municipio = $id_municipio;
        }

        public function getSQL()
        {
            return "'".$this->nom."','".$this->calle."','".$this->cruce."','".$this->colonia."','".$this->municipio."','".$this->latitud."','".$this->longitud."','".$this->id_municipio."'";
        }

        public function UpdateSQL(){
            return "nom='$this->nom', calle='$this->calle', cruce='$this->cruce', colonia='$this->colonia', municipio='$this->municipio', latitud='$this->latitud', longitud='$this->longitud', id_municipio='$this->id_municipio'";
        }

    }
?>
