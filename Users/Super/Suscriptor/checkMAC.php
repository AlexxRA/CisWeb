<?php
    if (isset($_POST)){
        include("../../../SGBD/Connector.php");

        $Connector = new Connector();
        $ant = 0;

        $mac_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_sus"]);

        if(isset($_POST["mac_act"])){
            $mac_act = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_act"]);
            $ant = 1;
        }

        try{
            $Connector->select("suscriptor","mac_sus","'$mac_sus'");
            $query = $Connector->getQuery();
            $nr=mysqli_num_rows($query);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if($nr==0){
            echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> MAC disponible</div><input id='macchecker' type='hidden' value='1' name='macchecker'>";
        }
        else{
            if($ant == 1){
                if($mac_sus==$mac_act){
                    echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> MAC disponible</div><input id='ipchecker' type='hidden' value='1' name='ipchecker'>";
                }
                else{
                    echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> MAC ya utilizada</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
                }
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> MAC ya utilizada</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
            }
        }
    }
?>