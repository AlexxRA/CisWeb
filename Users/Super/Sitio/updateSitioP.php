<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nom = mysqli_real_escape_string($Connector->getCon(), $_POST["nom"]);
        $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["municipio"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        $sitio = new Sitio($nom, $vlan, $calle, $cruce, $colonia, $municipio, $latitud, $longitud);
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
                mysqli_commit($Connector->getCon());
                header("Location:showSitio.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateSitio.php?id=".$id_sitio."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateSitio.php?id=".$id_sitio."&e=1");
        }
    }
?>