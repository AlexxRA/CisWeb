<?php
    class Subscriber{
        private $id_add;
        private $mac_add;
        private $ns;

        public function __construct($id_add, $mac_add, $ns)
        {
            $this->id_add = $id_add;
            $this->mac_add = $mac_add;
            $this->ns = $ns;
        }

        public function __destruct()
        {
        }

        public function getIdAdd()
        {
            return $this->id_add;
        }


        public function setIdAdd($id_add)
        {
            $this->id_add = $id_add;
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

        public function getSQL()
        {
            return "'".$this->id_add . "','" . $this->mac_add. "','" . $this->ns."'";
        }

    }
?>