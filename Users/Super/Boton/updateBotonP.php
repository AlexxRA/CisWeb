<?php
    if(isset($_POST['input'])) {
        include("../../../class/Boton.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);
        $ip_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_bt"]);
        $mac_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_bt"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $boton = new Boton($ext, $ip_bt, $mac_bt, $fecha_inst, $id_pmi);
        $Connector->update("boton", $boton->UpdateSQL(),"ext", "'$ext'");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'boton','".$ext."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showBoton.php");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateBoton.php?id=".$ext."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateBoton.php?id=".$ext."&e=1");
        }
    }
?>