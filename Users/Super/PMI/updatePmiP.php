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
        $municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["municipio"]);
        $coordenadaX = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenadax"]);
        $coordenadaY = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenaday"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        $PMI = new Pmi($id_Pmi, $calle, $cruce, $colonia, $municipio, $coordenadaX, $coordenadaY, $latitud, $longitud, 0);
        $Connector->update("pmi", $PMI->UpdateSQL(),"id_pmi",$id_Pmi);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'pmi','".$id_Pmi."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                $Connector->update("comentarios", "identificador='$id_Pmi', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
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