<?php
    if(isset($_POST['input'])) {
        include("../../../class/Pmi.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;
        
        $id_Pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $coordenadaX = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenadax"]);
        $coordenadaY = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenaday"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);
        $zona = mysqli_real_escape_string($Connector->getCon(), $_POST["zona"]);
        $id_municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_municipio"]);
        $calle_ant = mysqli_real_escape_string($Connector->getCon(), $_POST["calle_ant"]);
        $zona_ant = mysqli_real_escape_string($Connector->getCon(), $_POST["zona_ant"]);
        $abreviatura_ant = mysqli_real_escape_string($Connector->getCon(), $_POST["abreviatura_ant"]);

        //Prueba temporal
        $sqlm = mysqli_query($Connector->getCon(), "SELECT nombre FROM municipios WHERE id_municipio='$id_municipio'");
        $rowm = mysqli_fetch_assoc($sqlm);
        $municipio = $rowm['nombre'];

        $PMI = new Pmi($id_Pmi, $calle, $cruce, $colonia, $municipio, $coordenadaX, $coordenadaY, $latitud, $longitud, $zona, $id_municipio);
        $Connector->update("pmi", $PMI->UpdateSQL(),"id_pmi",$id_Pmi);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $querym = mysqli_query($Connector->getCon(), "SELECT abreviatura FROM municipios WHERE id_municipio = '$id_municipio'");
        if (mysqli_num_rows($querym) == 0) {
            $e=1;
        }
        else {
            $rowm = mysqli_fetch_assoc($querym);
            $queryc = mysqli_query($Connector->getCon(), "SELECT nom_cam, ns_cam FROM camara WHERE id_pmi = '$id_Pmi'");
            if (mysqli_num_rows($queryc) != 0) {
                while ($rowc = mysqli_fetch_assoc($queryc)) {
                    $abreviatura_nueva = $rowm["abreviatura"];
                    $ns_cam=$rowc["ns_cam"];
                    $nombre = $rowc["nom_cam"];
                    $pos = strpos($nombre, '_', 0);
                    $pos = strpos($nombre, '_', $pos + 1);
                    $conv = array("$zona_ant" => "$zona", "$abreviatura_ant" => "$abreviatura_nueva", "$calle_ant" => "$calle");
                    $cambio = strtr(substr($nombre, 0, $pos + 1), $conv);
                    $final = $cambio . substr($nombre, $pos + 1, strlen($nombre));
                    $querycm = mysqli_query($Connector->getCon(), "UPDATE camara SET nom_cam='$final' WHERE ns_cam = '$ns_cam'");
                    $querycm = $Connector->getQuery();
                    if (!$querycm) {
                        $e=1;
                    }
                }
            } else {
                $e = 1;
            }
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $com = mysqli_real_escape_string($Connector->getCon(), $_POST["com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'pmi','".$id_Pmi."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                if ($com != $comentario) {
                    $Connector->update("comentarios", "identificador='$id_Pmi', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
                }
            }
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showPMI.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updatePmi.php?id=".$id_Pmi."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updatePmi.php?id=".$id_Pmi."&e=1");
        }
    }
?>