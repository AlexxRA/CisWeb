<?php
    class Connector {

        private $connector;
        private $query;

        function __construct() {
            try {
                $this->connector = mysqli_connect("localhost", "root", "", "cisdb");
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

        public function insert($record, $object) {
            try {
                $this->query= mysqli_query($this->connector,"INSERT INTO ".$record." VALUES (".$object.");");
            } catch (Exception $ex) {
                die("!Error, Query failed: ".$ex);
            }
        }

        public function delete($record, $field, $object) {
            try {
                $this->query= mysqli_query($this->connector,"DELETE FROM ".$record." WHERE ".$field." = ".$object.";");
            } catch (Exception $ex) {
                die("!Error, Query failed: ".$ex);
            }
        }

        public function update($record, $object) {
            try {
                $this->query= mysqli_query($this->connector,"UPDATE ".$record." SET ".$object.";");
            } catch (Exception $ex) {
                die("!Error, Query failed: ".$ex);
            }
        }

        public function getCon(){
            return $this->connector;
        }

        public function Login($usr, $pass){
            $user = mysqli_query($this->connector, "SELECT * FROM user WHERE name='$usr' and password='$pass'");
            $rowUser = mysqli_fetch_array($user);
            return $rowUser;
        }

    } 

?>

