<?php
    class Camera {
        private $ns_cam;
        private $ip_cam;
        //private $id_cam;
        private $tipo;
        private $num_cam;
        //private $dir_cam;
        private $ori_cam;
        private $inc_cam;
        private $nom_cam;
        private $rec_server;
        private $id_device;
        private $firmware;
        private $vms;
        private $user_cam;
        private $pass_cam;
        private $fecha_inst;
        private $id_pmi;

        public function __construct($ns_cam, $ip_cam, $tipo, $num_cam, $ori_cam, $inc_cam, $nom_cam, $rec_server, $id_device, $firmware, $vms, $user_cam, $pass_cam, $fecha_inst, $id_pmi)
        {
            $this->ns_cam = $ns_cam;
            $this->ip_cam = $ip_cam;
            $this->tipo = $tipo;
            $this->num_cam = $num_cam;
            $this->ori_cam = $ori_cam;
            $this->inc_cam = $inc_cam;
            $this->rec_server = $rec_server;
            $this->id_device = $id_device;
            $this->firmware = $firmware;
            $this->vms = $vms;
            $this->user_cam = $user_cam;
            $this->pass_cam = $pass_cam;
            $this->fecha_inst = $fecha_inst;
            $this->id_pmi = $id_pmi;
            $this->nom_cam = $nom_cam;
        }

        public function getNsCam()
        {
            return $this->ns_cam;
        }

        public function setNsCam($ns_cam)
        {
            $this->ns_cam = $ns_cam;
        }

        public function getIpCam()
        {
            return $this->ip_cam;
        }

        public function setIpCam($ip_cam)
        {
            $this->ip_cam = $ip_cam;
        }


        public function getTipo()
        {
            return $this->tipo;
        }

        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        public function getNumCam()
        {
            return $this->num_cam;
        }

        public function setNumCam($num_cam)
        {
            $this->num_cam = $num_cam;
        }

        public function getOriCam()
        {
            return $this->ori_cam;
        }

        public function setOriCam($ori_cam)
        {
            $this->ori_cam = $ori_cam;
        }

        public function getIncCam()
        {
            return $this->inc_cam;
        }

        public function setIncCam($inc_cam)
        {
            $this->inc_cam = $inc_cam;
        }

        public function getNomCam()
        {
            return $this->nom_cam;
        }

        public function setNomCam($nom_cam)
        {
            $this->nom_cam = $nom_cam;
        }

        public function getRecServer()
        {
            return $this->rec_server;
        }

        public function setRecServer($rec_server)
        {
            $this->rec_server = $rec_server;
        }

        public function getIdDevice()
        {
            return $this->id_device;
        }

        public function setIdDevice($id_device)
        {
            $this->id_device = $id_device;
        }

        public function getFirmware()
        {
            return $this->firmware;
        }

        public function setFirmware($firmware)
        {
            $this->firmware = $firmware;
        }

        public function getVms()
        {
            return $this->vms;
        }

        public function setVms($vms)
        {
            $this->vms = $vms;
        }

        public function getUserCam()
        {
            return $this->user_cam;
        }

        public function setUserCam($user_cam)
        {
            $this->user_cam = $user_cam;
        }

        public function getPassCam()
        {
            return $this->pass_cam;
        }

        public function setPassCam($pass_cam)
        {
            $this->pass_cam = $pass_cam;
        }

        public function getFechaInst()
        {
            return $this->fecha_inst;
        }

        public function setFechaInst($fecha_inst)
        {
            $this->fecha_inst = $fecha_inst;
        }

        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }

        public function getSQL(){
            return "'".$this->ns_cam."','".$this->ip_cam."','".$this->tipo."','".$this->num_cam."','".$this->ori_cam."','".$this->inc_cam."','".$this->nom_cam."','".$this->rec_server."','".$this->id_device."','".$this->firmware."','".$this->vms."','".$this->user_cam."','".$this->pass_cam."','".$this->fecha_inst."','".$this->id_pmi."'";
        }

        public function UpdateSQL(){
            return "ns_cam='$this->ns_cam', ip_cam='$this->ip_cam', tipo='$this->tipo', num_cam='$this->num_cam', ori_cam='$this->ori_cam', inc_cam='$this->inc_cam', nom_cam='$this->nom_cam', rec_server='$this->rec_server', firmware='$this->firmware', vms='$this->vms', user_cam='$this->user_cam', pass_cam='$this->pass_cam', fecha_inst='$this->fecha_inst', id_pmi='$this->id_pmi'";
        }

    }
?>