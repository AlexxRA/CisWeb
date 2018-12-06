<?php

    class Sector
    {
        private $id_sector;
        private $nombre;
        private $id_sitio;

        public function __construct($id_sector, $nombre, $id_sitio)
        {
            $this->id_sector = $id_sector;
            $this->nombre = $nombre;
            $this->id_sitio = $id_sitio;
        }

        public function getIdSector()
        {
            return $this->id_sector;
        }

        public function setIdSector($id_sector)
        {
            $this->id_sector = $id_sector;
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
            return "'".$this->id_sector."','".$this->nombre."','".$this->id_sitio."'";
        }

        public function UpdateSQL(){
            return "id_sector='$this->id_sector', nombre='$this->nombre', id_sitio='$this->id_sitio'";
        }
    }

?>