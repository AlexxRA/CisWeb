<?php
    if(isset($_POST['input'])) {
        include("../../../class/Subscriber.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $ns_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_sus"]);
        $ip_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_sus"]);
        $mac_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_sus"]);
        $azimuth = mysqli_real_escape_string($Connector->getCon(), $_POST["azimuth"]);
        $rss_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_sus"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        $id_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["id_rb"]);
        $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);

        $suscriptor = new Subscriber($ns_sus, $ip_sus, $mac_sus, $azimuth, $rss_sus, $id_pmi, $id_rb, $id_vlan);
        $Connector->insert("suscriptor", $suscriptor->getSQL(),"");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'suscriptor','".$ns_sus."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location: showSuscriptor.php?e=2");
            }
            else{
                mysqli_rollback($Connector->getCon());
                echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        } else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }

    }
?>