<?php
    class User{
        //private $id;
        private $name;
        private $password;
        private $type;

        public function __construct($name, $password, $type){

            $this->name = $name;
            $this->password = $password;
            $this->type = $type;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getType()
        {
            return $this->type;
        }

        public function setType($type)
        {
            $this->type = $type;
        }

        public function getSQL(){
            return "'$this->name',md5('$this->password'),'$this->type'";
        }

        public function getFields(){
            return "(usuario, contra, tipo)";
        }

    }
?>