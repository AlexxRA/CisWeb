<?php
    class Observation{
        private $id_obs;
        private $description;

        public function __construct($id_obs, $description)
        {
            $this->id_obs = $id_obs;
            $this->description = $description;
        }

        public function __destruct(){
        }

        public function getIdObs()
        {
            return $this->id_obs;
        }

        public function setIdObs($id_obs)
        {
            $this->id_obs = $id_obs;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function getSQL()
        {
            return "'".$this->id_obs . "','" . $this->description."'";
        }
    }
?>