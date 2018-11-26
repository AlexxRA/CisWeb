<?php
    class Pmi{
        private $id_Pmi;
        private $calle;
        private $cruce;
        private $colonia;
        private $municipio;
        private $cordenadaX;
        private $cordenadaY;
        private $latitud;
        private $longitud;
        private $num_cam;

        public function __construct($id_Pmi, $calle, $cruce, $colonia, $municipio, $cordenadaX, $cordenadaY, $latitud, $longitud, $num_cam){

            $this -> id_Pmi = $id_Pmi;
            $this -> calle = $calle;
            $this -> cruce = $cruce;
            $this -> colonia = $colonia;
            $this -> municipio= $municipio;
            $this -> cordenadaX = $cordenadaX;
            $this -> cordenadaY = $cordenadaY;
            $this -> latitud = $latitud;
            $this -> longitud = $longitud;
            $this -> num_cam = $num_cam;
        }

        public function getSQL(){
            return "'$this->name',md5('$this->password'),'$this->type'";
        }

        public function getFields(){
            return "(usuario, contra, tipo)";
        }

    }
?>