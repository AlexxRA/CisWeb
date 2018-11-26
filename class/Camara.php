<?php
    class Camara {
        private $name;
        private $ip_add;
        private $mac_add;
        private $mac_switch;
        private $ns;
        private $firmware;
        private $status_vms;
        private $status_citymind;
        private $user;
        private $password;
        private $type;

        public function __construct($name,$ip_add,$mac_add,$mac_switch,$ns,$firmware,$status_vms,$status_citymind,$user,$password,$type){
            $this->name=$name;
            $this->ip_add=$ip_add;
            $this->mac_add=$mac_add;
            $this->mac_switch=$mac_switch;
            $this->ns=$ns;
            $this->firmware=$firmware;
            $this->status_vms=$status_vms;
            $this->status_citymind=$status_citymind;
            $this->user=$user;
            $this->password=$password;
            $this->type=$type;
        }

        public function __destruct(){

        }

        public function setName($name){$this->name = $name;}
        public function setIpAdd($ip_add){$this->ip_add = $ip_add;}
        public function setMacAdd($mac_add){$this->mac_add = $mac_add;}
        public function setMacSwitch($mac_switch){$this->mac_switch = $mac_switch;}
        public function setNs($ns){$this->ns = $ns;}
        public function setFirmware($firmware){$this->firmware = $firmware;}
        public function setStatusVms($status_vms){$this->status_vms = $status_vms;}
        public function setStatusCitymind($status_citymind){$this->status_citymind = $status_citymind;}
        public function setUser($user){$this->user = $user;}
        public function setPassword($password){$this->password = $password;}
        public function setType($type){$this->type = $type;}

        public function getName(){return $this->name;}
        public function getIpAdd(){return $this->ip_add;}
        public function getMacAdd(){return $this->mac_add;}
        public function getMacSwitch(){return $this->mac_switch;}
        public function getNs(){return $this->ns;}
        public function getPassword(){return $this->password;}
        public function getStatusCitymind(){return $this->status_citymind;}
        public function getStatusVms(){return $this->status_vms;}
        public function getType(){return $this->type;}
        public function getUser(){return $this->user;}
        public function getFirmware(){return $this->firmware;}

        public function getSQL(){
            return "'".$this->name."','".$this->ip_add."','".$this->mac_add."','".$this->mac_switch."','".$this->ns."','".$this->firmware."','".$this->status_vms."','".$this->status_citymind."','".$this->user."','".$this->password."','".$this->type."'";
        }
    }
?>