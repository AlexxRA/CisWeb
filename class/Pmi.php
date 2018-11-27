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
        private $num_cam;

        public function __construct($id_Pmi, $calle, $cruce, $colonia, $municipio, $coordenadaX, $coordenadaY, $latitud, $longitud, $num_cam){

            $this->id_Pmi = $id_Pmi;
            $this->calle = $calle;
            $this->cruce = $cruce;
            $this->colonia = $colonia;
            $this->municipio= $municipio;
            $this->coordenadaX = $coordenadaX;
            $this->coordenadaY = $coordenadaY;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
            $this->num_cam = $num_cam;
        }

        public function getSQL(){
            return "'$this->id_Pmi','$this->calle','$this->cruce','$this->colonia','$this->coordenadaX','$this->coordenadaY','$this->latitud','$this->longitud','$this->municipio','$this->num_cam'";
        }
        
        public function UpdateSQL(){
            return "id_pmi='$this->id_Pmi', calle='$this->calle', cruce='$this->cruce', colonia='$this->colonia', coordX='$this->coordenadaX', coordY='$this->coordenadaY', latitud='$this->latitud', longitud='$this->longitud', municipio='$this->municipio', num_cam='$this->num_cam'";
        }

    }
?>