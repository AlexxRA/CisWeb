<?php
    class Switches{
        private $ip_add;
        private $mac_add;
        private $nss;
<<<<<<< HEAD
=======
        private $id_pole;
>>>>>>> b7a45d510db7e89cfdb4f3ba745612c8b4c9acc5
        private $user;
        private $password;
        private $arm;
        private $case;

<<<<<<< HEAD
        public function __construct($ip_add, $mac_add, $nss, $user, $password, $arm, $case)
=======
        public function __construct($ip_add, $mac_add, $nss, $id_pole, $user, $password, $arm, $case)
>>>>>>> b7a45d510db7e89cfdb4f3ba745612c8b4c9acc5
        {
            $this->ip_add = $ip_add;
            $this->mac_add = $mac_add;
            $this->nss = $nss;
<<<<<<< HEAD
=======
            $this->id_pole= $id_pole;
>>>>>>> b7a45d510db7e89cfdb4f3ba745612c8b4c9acc5
            $this->user = $user;
            $this->password = $password;
            $this->arm = $arm;
            $this->case = $case;
        }

        public function __destruct(){
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

        public function getNss()
        {
            return $this->nss;
        }

        public function setNss($nss)
        {
            $this->nss = $nss;
        }

<<<<<<< HEAD
=======
        public function getIdPole()
        {
            return $this->id_pole;
        }

        public function setIdPole($id_pole)
        {
            $this->nss = $id_pole;
        }

>>>>>>> b7a45d510db7e89cfdb4f3ba745612c8b4c9acc5
        public function getUser()
        {
            return $this->user;
        }

        public function setUser($user)
        {
            $this->user = $user;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getArm()
        {
            return $this->arm;
        }

        public function setArm($arm)
        {
            $this->arm = $arm;
        }

        public function getCase()
        {
            return $this->case;
        }

        public function setCase($case)
        {
            $this->case = $case;
        }

<<<<<<< HEAD
=======
        public function getSQL()
        {
            return "'".$this->ip_add . "','" . $this->mac_add. "','" .$this->nss. "','" .$this->id_pole. "','" .$this->user. "','" .$this->password. "','" .$this->arm. "','" .$this->case."'";
        }
>>>>>>> b7a45d510db7e89cfdb4f3ba745612c8b4c9acc5

    }

?>