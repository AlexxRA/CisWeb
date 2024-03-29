<?php
    class Pmi{
        private $id_Pmi;
        private $calle;
        private $cruce;
        private $colonia;
        private $municipio;
        private $coordenadaX;
        private $coordenadaY;
        private $latitud;
        private $longitud;
        private $zona;
        private $id_municipio;

        public function __construct($id_Pmi, $calle, $cruce, $colonia, $municipio, $coordenadaX, $coordenadaY, $latitud, $longitud, $zona, $id_municipio){

            $this->id_Pmi = $id_Pmi;
            $this->calle = $calle;
            $this->cruce = $cruce;
            $this->colonia = $colonia;
            $this->municipio= $municipio;
            $this->coordenadaX = $coordenadaX;
            $this->coordenadaY = $coordenadaY;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
            $this->zona = $zona;
            $this->id_municipio = $id_municipio;
        }

        public function getZona()
        {
            return $this->zona;
        }

        public function setZona($zona)
        {
            $this->zona = $zona;
        }

        public function getIdMunicipio()
        {
            return $this->id_municipio;
        }

        public function setIdMunicipio($id_municipio)
        {
            $this->id_municipio = $id_municipio;
        }

        public function getIdPmi()
        {
            return $this->id_Pmi;
        }

        public function setIdPmi($id_Pmi)
        {
            $this->id_Pmi = $id_Pmi;
        }

        public function getCalle()
        {
            return $this->calle;
        }

        public function setCalle($calle)
        {
            $this->calle = $calle;
        }

        public function getCruce()
        {
            return $this->cruce;
        }

        public function setCruce($cruce)
        {
            $this->cruce = $cruce;
        }

        public function getColonia()
        {
            return $this->colonia;
        }

        public function setColonia($colonia)
        {
            $this->colonia = $colonia;
        }

        public function getMunicipio()
        {
            return $this->municipio;
        }

        public function setMunicipio($municipio)
        {
            $this->municipio = $municipio;
        }

        public function getCoordenadaX()
        {
            return $this->coordenadaX;
        }

        public function setCoordenadaX($coordenadaX)
        {
            $this->coordenadaX = $coordenadaX;
        }

        public function getCoordenadaY()
        {
            return $this->coordenadaY;
        }

        public function setCoordenadaY($coordenadaY)
        {
            $this->coordenadaY = $coordenadaY;
        }

        public function getLatitud()
        {
            return $this->latitud;
        }

        public function setLatitud($latitud)
        {
            $this->latitud = $latitud;
        }

        public function getLongitud()
        {
            return $this->longitud;
        }

        public function setLongitud($longitud)
        {
            $this->longitud = $longitud;
        }


        public function getSQL(){
            return "'$this->id_Pmi','$this->calle','$this->cruce','$this->colonia','$this->coordenadaX','$this->coordenadaY','$this->latitud','$this->longitud','$this->municipio','$this->zona','$this->id_municipio'";
        }
        
        public function UpdateSQL(){
            return "id_pmi='$this->id_Pmi', calle='$this->calle', cruce='$this->cruce', colonia='$this->colonia', coordX='$this->coordenadaX', coordY='$this->coordenadaY', latitud='$this->latitud', longitud='$this->longitud', municipio='$this->municipio', zona='$this->zona', id_municipio='$this->id_municipio'";
        }


    }
?>