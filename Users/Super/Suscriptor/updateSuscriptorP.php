<?php
    if(isset($_POST['input'])) {
        include("../../../class/Subscriber.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id = mysqli_real_escape_string($Connector->getCon(), $_POST["id"]);
        $ns_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_sus"]);
        $ip_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_sus"]);
        $mac_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_sus"]);
        $azimuth = mysqli_real_escape_string($Connector->getCon(), $_POST["azimuth"]);
        $rss_sus = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_sus"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        $id_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["id_rb"]);

        $suscriptor = new Subscriber($ns_sus, $ip_sus, $mac_sus, $azimuth, $rss_sus, $id_pmi, $id_rb);
        $Connector->update("suscriptor", $suscriptor->UpdateSQL(),"ns_sus","'$id'");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $com = mysqli_real_escape_string($Connector->getCon(), $_POST["com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'suscriptor','".$ns_sus."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                if ($com != $comentario) {
                    $Connector->update("comentarios", "identificador='$ns_sus', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
                }
            }
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showSuscriptor.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateSuscriptor.php?id=".$id."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateSuscriptor.php?id=".$id."&e=1");
        }
    }
?>