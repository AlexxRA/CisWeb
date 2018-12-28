<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sector.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

        $sector = new sector($nombre, $id_sitio);
        $Connector->update("sector", $sector->UpdateSQL(),"id_sector",$id_sector);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'sector','".$id_sector."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showSector.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateSector.php?id=".$ns_cam."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateSector.php?id=".$ns_cam."&e=1");
        }
    }
?>