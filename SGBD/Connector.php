<?php
    class Connector {

        private $connector;
        private $query;

        function __construct() {
            try {
                $this->connector = mysqli_connect("localhost", "root", "", "cis_db");
            } catch (Exception $ex) {
                die("!Connection failed -> ".$ex);
            }
        }

        function __destruct() {
            $this->connector->close();
        }

        public function checkStatus() {
            if ($this->connector->connect_errno) {
                echo("Fallo al conectar a MySQL");
            }
        }

        public function select($record, $object, $data) {
            $this->query= mysqli_query($this->connector,"SELECT * FROM ".$record." WHERE ".$object." = ".$data.";");
        }

        public function insert($record, $object, $fields) {
            if(!$fields){
                $this->query= mysqli_query($this->connector,"INSERT INTO ".$record." VALUES (".$object.");");
                echo "INSERT INTO ".$record." VALUES (".$object.");";
            }
            else{
                $this->query= mysqli_query($this->connector,"INSERT INTO ".$record." ".$fields." VALUES (".$object.");");
            }
        }

        public function delete($record, $field, $object) {
            try {
                $this->query= mysqli_query($this->connector,"DELETE FROM ".$record." WHERE ".$field." = ".$object.";");
            } catch (Exception $ex) {
                die("!Error, Query failed: ".$ex);
            }
        }

        public function update($record, $object, $field, $data) {
            try {
                $this->query= mysqli_query($this->connector,"UPDATE ".$record." SET ".$object." WHERE ".$field." = ".$data.";");
            } catch (Exception $ex) {
                die("!Error, Query failed: ".$ex);
            }
        }

        public function getCon(){
            return $this->connector;
        }

        public function getQuery(){
            return $this->query;
        }

        public function Login($usr, $pass){
            $user = mysqli_query($this->connector, "SELECT * FROM usuario WHERE usuario='$usr' and contra=md5('$pass')");
            $rowUser = mysqli_fetch_array($user);
            return $rowUser;
        }

    } 

?>

