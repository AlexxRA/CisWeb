<?php
    class BaseRadio{
        private $name;
        private $ip_add;
        private $mac_add;
        private $ns;
        private $mac_sub;

        public function __construct($name, $ip_add, $mac_add, $ns, $mac_sub)
        {
            $this->name = $name;
            $this->ip_add = $ip_add;
            $this->mac_add = $mac_add;
            $this->ns = $ns;
            $this->mac_sub = $mac_sub;
        }

        public function __destruct(){
        }

        public function getName()
        {
            return $this->name;
        }


        public function setName($name)
        {
            $this->name = $name;
        }


        public function getIpAdd()
        {
            return $this->ip_add;
        }


        public function setIpAdd($ip_add)
        {
            $this->ip_add = $ip_add;
        }


        public function getMacAdd()
        {
            return $this->mac_add;
        }


        public function setMacAdd($mac_add)
        {
            $this->mac_add = $mac_add;
        }


        public function getNs()
        {
            return $this->ns;
        }


        public function setNs($ns)
        {
            $this->ns = $ns;
        }


        public function getMacSub()
        {
            return $this->mac_sub;
        }


        public function setMacSub($mac_sub)
        {
            $this->mac_sub = $mac_sub;
        }

        public function getSQL()
        {
            return "'".$this->name . "','" . $this->ip_add. "','" . $this->mac_add. "','" . $this->ns. "','" . $this->mac_sub."'";
        }


    }
?>