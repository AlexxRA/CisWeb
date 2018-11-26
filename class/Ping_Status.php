<?php
    class Ping_Status{
        private $mac_add;
        private $status;

        public function __construct($mac_add, $status)
        {
            $this->mac_add = $mac_add;
            $this->status = $status;
        }

        public function __destruct(){
        }

        public function getMacAdd()
        {
            return $this->mac_add;
        }

        public function setMacAdd($mac_add)
        {
            $this->mac_add = $mac_add;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getSQL()
        {
            return "'".$this->mac_add . "','" . $this->status."'";
        }

    }

?>