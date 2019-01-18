<?php
    if(isset($_POST['input'])) {
        include("../../../class/RadioBase.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["id_rb"]);
        $dist_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["dist_rb"]);
        $rss_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_rb"]);
        $ip_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_rb"]);

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $sector = mysqli_real_escape_string($Connector->getCon(), $_POST["sector"]);

        $RB = new RadioBase($dist_rb, $rss_rb, $ip_rb, $id_sitio, $sector);

        $Connector->update("radiobase", $RB->UpdateSQL(),"id_rb",$id_rb);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'radiobase','".$id_rb."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                $Connector->update("comentarios", "identificador='$id_rb', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
            }
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showRB.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateRB.php?id=".$id_rb."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateRB.php?id=".$id_rb."&e=1");
        }
    }
?>