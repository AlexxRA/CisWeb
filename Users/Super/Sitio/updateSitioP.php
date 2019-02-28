<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nom = mysqli_real_escape_string($Connector->getCon(), $_POST["nom"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $id_municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_municipio"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        //Prueba temporal
        $sqlm = mysqli_query($Connector->getCon(), "SELECT nombre FROM municipios WHERE id_municipio='$id_municipio'");
        $rowm = mysqli_fetch_assoc($sqlm);
        $municipio = $rowm['nombre'];

        $sitio = new Sitio($nom, $calle, $cruce, $colonia, $municipio, $latitud, $longitud, $id_municipio);
        $Connector->update("sitio", $sitio->UpdateSQL(),"id_sitio",$id_sitio);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $com = mysqli_real_escape_string($Connector->getCon(), $_POST["com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'sitio','".$id_sitio."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                if ($com != $comentario) {
                    $Connector->update("comentarios", "identificador='$id_sitio', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
                }
            }
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
