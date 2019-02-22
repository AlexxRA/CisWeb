<?php
    if (isset($_POST)){
        include("../../../SGBD/Connector.php");

        $Connector = new Connector();
        $ant = 0;

        $num_cam= mysqli_real_escape_string($Connector->getCon(), $_POST["num_cam"]);
        $id_pmi= mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        if(isset($_POST["num_act"])){
            $num_act = mysqli_real_escape_string($Connector->getCon(), $_POST["num_act"]);
            $ant = 1;
        }

        try{
            $sql = "SELECT num_cam";
            $sql.= " FROM camara";
            $sql.= " WHERE id_pmi = '".$id_pmi."' and num_cam='".$num_cam."'";
            $query=mysqli_query($Connector->getCon(), $sql) or die("ajax_grid_data.php: get InventoryItems");
            $nr=mysqli_num_rows($query);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if($nr==0){
            echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Numero disponible</div><input id='numCamChecker' type='hidden' value='1' name='numCamChecker'>";
        }
        else{
            if($ant == 1){
                if($num_cam==$num_act){
                    echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Numero disponible</div><input id='numCamChecker' type='hidden' value='1' name='numCamChecker'>";
                }
                else{
                    echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Numero ya asignado</div><input id='numCamChecker' type='hidden' value='0' name='numCamChecker'>";
                }
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Numero ya asignado</div><input id='numCamChecker' type='hidden' value='0' name='numCamChecker'>";
            }
        }
    }

?>