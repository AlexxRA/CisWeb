<?php
    if (isset($_POST)){
        include("../../../SGBD/Connector.php");

        $Connector = new Connector();
        $ant = 0;

        $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);

        if(isset($_POST["ext_act"])){
            $ext_act = mysqli_real_escape_string($Connector->getCon(), $_POST["ext_act"]);
            $ant = 1;
        }

        try{
            $Connector->select("boton","ext","'$ext'");
            $query = $Connector->getQuery();
            $nr=mysqli_num_rows($query);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if($nr==0){
            echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Extension disponible</div><input id='extchecker' type='hidden' value='1' name='extchecker'>";
        }
        else {
            if ($ant == 1) {
                if ($ext == $ext_act) {
                    echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Extension disponible</div><input id='extchecker' type='hidden' value='1' name='ipchecker'>";
                } else {
                    echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Extension ya agregada</div><input id='extchecker' type='hidden' value='0' name='ipchecker'>";
                }
            } else {
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Extension ya agregada</div><input id='extchecker' type='hidden' value='0' name='extchecker'>";
            }
        }
    }
?>