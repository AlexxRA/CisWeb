<?php

    class Sector
    {
        private $nombre;
        private $id_sitio;

        public function __construct($nombre, $id_sitio)
        {
            $this->nombre = $nombre;
            $this->id_sitio = $id_sitio;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        public function getIdSitio()
        {
            return $this->id_sitio;
        }

        public function setIdSitio($id_sitio)
        {
            $this->id_sitio = $id_sitio;
        }

        public function getSQL()
        {
            return "'".$this->nombre."','".$this->id_sitio."'";
        }

        public function UpdateSQL(){
            return "nombre='$this->nombre', id_sitio='$this->id_sitio'";
        }
    }

?>