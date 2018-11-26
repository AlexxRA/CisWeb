<?php
    class Adress{
        private $street;
        private $suburb;
        private $city;
        private $zone;
        private $id_pole;

        public function __construct($street, $suburb, $city, $zone, $id_pole)
        {
            $this->street = $street;
            $this->suburb = $suburb;
            $this->city = $city;
            $this->zone = $zone;
            $this->id_pole = $id_pole;
        }

        public function __destruct(){
        }


        public function getStreet()
        {
            return $this->street;
        }

        public function setStreet($street)
        {
            $this->street = $street;
        }

        public function getSuburb()
        {
            return $this->suburb;
        }

        public function setSuburb($suburb)
        {
            $this->suburb = $suburb;
        }

        public function getCity()
        {
            return $this->city;
        }

        public function setCity($city)
        {
            $this->city = $city;
        }

        public function getZone()
        {
            return $this->zone;
        }

        public function setZone($zone)
        {
            $this->zone = $zone;
        }

        public function getIdPole()
        {
            return $this->id_pole;
        }

        public function setIdPole($id_pole)
        {
            $this->id_pole = $id_pole;
        }

        public function getSQL()
        {
            return "'".$this->street . "','" . $this->suburb. "','" . $this->city. "','" . $this->zone. "','" . $this->id_pole."'";
        }
    }
?>