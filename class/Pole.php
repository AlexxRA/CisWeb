<?php
    class Pole{
        private $id;
        private  $ns;
        private  $height;
        private  $mac_sub;
        private  $serie_ups;
        private  $state_loca;
        private  $latitude;
        private  $longitude;
        private  $x;
        private  $y;
        private  $elect;
        private  $mac_radio;

        public function __construct($id, $ns, $height, $mac_sub, $serie_ups, $state_loca, $latitude, $longitude, $x, $y, $elect, $mac_radio)
        {
            $this->id = $id;
            $this->ns = $ns;
            $this->height = $height;
            $this->mac_sub = $mac_sub;
            $this->serie_ups = $serie_ups;
            $this->state_loca = $state_loca;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->x = $x;
            $this->y = $y;
            $this->elect = $elect;
            $this->mac_radio = $mac_radio;
        }

        public function __destruct(){
        }


        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getNs()
        {
            return $this->ns;
        }

        public function setNs($ns)
        {
            $this->ns = $ns;
        }

        public function getHeight()
        {
            return $this->height;
        }

        public function setHeight($height)
        {
            $this->height = $height;
        }

        public function getMacSub()
        {
            return $this->mac_sub;
        }

        public function setMacSub($mac_sub)
        {
            $this->mac_sub = $mac_sub;
        }

        public function getSerieUps()
        {
            return $this->serie_ups;
        }

        public function setSerieUps($serie_ups)
        {
            $this->serie_ups = $serie_ups;
        }

        public function getStateLoca()
        {
            return $this->state_loca;
        }

        public function setStateLoca($state_loca)
        {
            $this->state_loca = $state_loca;
        }

        public function getLatitude()
        {
            return $this->latitude;
        }

        public function setLatitude($latitude)
        {
            $this->latitude = $latitude;
        }

        public function getLongitude()
        {
            return $this->longitude;
        }

        public function setLongitude($longitude)
        {
            $this->longitude = $longitude;
        }

        public function getX()
        {
            return $this->x;
        }

        public function setX($x)
        {
            $this->x = $x;
        }

        public function getY()
        {
            return $this->y;
        }

        public function setY($y)
        {
            $this->y = $y;
        }

        public function getElect()
        {
            return $this->elect;
        }

        public function setElect($elect)
        {
            $this->elect = $elect;
        }

        public function getMacRadio()
        {
            return $this->mac_radio;
        }

        public function setMacRadio($mac_radio)
        {
            $this->mac_radio = $mac_radio;
        }

        public function getSQL()
        {
            return "'".$this->id . "','" . $this->ns . "','" . $this->height . "','" . $this->mac_sub . "','" . $this->serie_ups . "','" . $this->state_loca . "','" . $this->latitude . "','" . $this->longitude . "','" . $this->x . "','" . $this->y . "','" . $this->elect . "','" . $this->mac_radio."'";
        }

        
    }
?>