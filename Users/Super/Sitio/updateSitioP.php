<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();
        $e=0;

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nom_prop = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_prop"]);
        $nom_real = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_real"]);
        $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);

        $sitio = new Sitio($id_sitio, $nom_prop, $nom_real, $vlan);
        $Connector->update("sitio", $sitio->UpdateSQL(),"id_sitio",$id_sitio);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'sitio','".$id_sitio."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                header("Location:showSitio.php");
            }
            else{
                header("Location:updateSitio.php?id=".$ns_cam."&e=1");
            }
        } else {
            header("Location:updateSitio.php?id=".$ns_cam."&e=1");
        }
    }
?>