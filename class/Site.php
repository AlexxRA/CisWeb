<?php
    class Site
    {
        private $id_sitio;
        private $nom_prop;
        private $nom_real;

        public function __construct($id_sitio, $nom_prop, $nom_real)
        {
            $this->id_sitio = $id_sitio;
            $this->nom_prop = $nom_prop;
            $this->nom_real = $nom_real;
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

        public function getSQL()
        {
            return "'".$this->id_sitio."','".$this->nom_prop."','".$this->nom_real."'";
        }

        public function UpdateSQL(){
            return "id_sitio='$this->id_sitio', nom_prop='$this->nom_prop', nom_real='$this->nom_real'";
        }

    }
?>