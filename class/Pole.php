<?php
    class Pole
    {
        private $ns_poste;
        private $altura;
        private $fecha_mont;
        private $fecha_elec;
        private $fecha_base;
        private $contratista;
        private $fecha_asign;
        private $ns_ups;
        private $ns_gabinete;
        private $id_pmi;

        public function __construct($ns_poste, $altura, $fecha_mont, $fecha_elec, $fecha_base, $contratista, $fecha_asign, $ns_ups, $ns_gabinete, $id_pmi)
        {
            $this->ns_poste = $ns_poste;
            $this->altura = $altura;
            $this->fecha_mont = $fecha_mont;
            $this->fecha_elec = $fecha_elec;
            $this->fecha_base = $fecha_base;
            $this->contratista = $contratista;
            $this->fecha_asign = $fecha_asign;
            $this->ns_ups = $ns_ups;
            $this->ns_gabinete = $ns_gabinete;
            $this->id_pmi = $id_pmi;
        }

        public function getNsPoste()
        {
            return $this->ns_poste;
        }

        public function setNsPoste($ns_poste)
        {
            $this->ns_poste = $ns_poste;
        }

        public function getAltura()
        {
            return $this->altura;
        }

        public function setAltura($altura)
        {
            $this->altura = $altura;
        }

        public function getFechaMont()
        {
            return $this->fecha_mont;
        }

        public function setFechaMont($fecha_mont)
        {
            $this->fecha_mont = $fecha_mont;
        }

        public function getFechaElec()
        {
            return $this->fecha_elec;
        }

        public function setFechaElec($fecha_elec)
        {
            $this->fecha_elec = $fecha_elec;
        }

        public function getFechaBase()
        {
            return $this->fecha_base;
        }

        public function setFechaBase($fecha_base)
        {
            $this->fecha_base = $fecha_base;
        }

        public function getContratista()
        {
            return $this->contratista;
        }

        public function setContratista($contratista)
        {
            $this->contratista = $contratista;
        }

        public function getFechaAsign()
        {
            return $this->fecha_asign;
        }

        public function setFechaAsign($fecha_asign)
        {
            $this->fecha_asign = $fecha_asign;
        }

        public function getNsUps()
        {
            return $this->ns_ups;
        }

        public function setNsUps($ns_ups)
        {
            $this->ns_ups = $ns_ups;
        }

        public function getNsGabinete()
        {
            return $this->ns_gabinete;
        }

        public function setNsGabinete($ns_gabinete)
        {
            $this->ns_gabinete = $ns_gabinete;
        }

        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }

        public function getSQL()
        {
            return "'".$this->ns_poste."','".$this->altura."','".$this->fecha_mont."','".$this->fecha_elec."','".$this->fecha_base."','".$this->contratista."','".$this->fecha_asign."','".$this->ns_ups."','".$this->ns_gabinete."','".$this->id_pmi."'";
        }

        public function UpdateSQL(){
            return "ns_poste='$this->ns_poste', altura='$this->altura', fecha_mont='$this->fecha_mont', fecha_elec='$this->fecha_elec', fecha_base='$this->fecha_base', contratista='$this->contratista', fecha_asign='$this->fecha_asign', ns_ups='$this->ns_ups', ns_gabinete='$this->ns_gabinete', id_pmi='$this->id_pmi'";
        }
        
    }
?>