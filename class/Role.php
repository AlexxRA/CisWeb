<?php
    class Role{
        private $id_user;
        private $role;

        public function __construct($id_user, $role)
        {
            $this->id_user = $id_user;
            $this->role = $role;
        }

        public function __destruct(){
        }
        
        public function getIdUser()
        {
            return $this->id_user;
        }

        public function setIdUser($id_user)
        {
            $this->id_user = $id_user;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function setRole($role)
        {
            $this->role = $role;
        }

        public function getSQL()
        {
            return "'".$this->id_user . "','" . $this->role."'";
        }


    }

?>