<?php
    class User{
        //private $id;
        private $name;
        private $lastname;
        private $user;
        private $password;
        private $type;

        public function __construct($name, $lastname, $user, $password, $type){
            $this->name = $name;
            $this->lastname = $lastname;
            $this->user = $user;
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

        public function getLastname()
        {
            return $this->lastname;
        }

        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function setUser($user)
        {
            $this->user = $user;
        }

        public function getSQL(){
            return "'$this->name','$this->lastname','$this->user',md5('$this->password'),'$this->type'";
        }

        public function getFields(){
            return "(nombre, apellidos, usuario, contra, tipo)";
        }

        public function UpdateSQL(){
            return "nombre='$this->name', apellidos='$this->lastname', usuario='$this->user', contra=md5('$this->password'), tipo='$this->type'";
        }

    }
?>