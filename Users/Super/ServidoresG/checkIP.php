<?php
    if (isset($_POST)){
        include("../../../SGBD/Connector.php");

        $Connector = new Connector();
        $ant = 0;

        $ip_servidorg = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_servidorg"]);

        if(isset($_POST["ip_act"])){
            $ip_act = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_act"]);
            $ant = 1;
        }

        try{
            $Connector->select("servidorg","ip_servidorg","'$ip_servidorg'");
            $query = $Connector->getQuery();
            $nr=mysqli_num_rows($query);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if($nr==0){
             echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> IP disponible</div><input id='ipchecker' type='hidden' value='1' name='ipchecker'>";
        }
        else{
            if($ant == 1){
                if($ip_servidorg==$ip_act){
                    echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> IP disponible</div><input id='ipchecker' type='hidden' value='1' name='ipchecker'>";
                }
                else{
                    echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> IP ya utilizada</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
                }
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> IP ya utilizada</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
            }
        }
    }
?>
