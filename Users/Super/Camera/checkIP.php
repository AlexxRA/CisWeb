<?php
    if (isset($_POST)){
        include("../../../class/Camera.php");
        include("../../../SGBD/Connector.php");

        $Connector = new Connector();

        $ip_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_cam"]);
        try{
            $Connector->select("camara","ip_cam","'$ip_cam'");
            $query = $Connector->getQuery();
            $nr=mysqli_num_rows($query);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if($nr==0){
            //echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, la Camara ya existe</div>";
            echo "<div class='alert alert-success '><i class='fa fa-check'></i> IP disponible</div><input id='ipchecker' type='hidden' value='1' name='ipchecker'>";
        }
        else{
            echo "<div class='alert alert-danger'><i class='fa fa-times'></i> IP ya utilizada</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
        }




    }
?>