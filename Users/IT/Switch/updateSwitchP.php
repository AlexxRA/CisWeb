<?php
    if(isset($_POST['input'])) {
        include("../../../class/Switches.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $ns_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_sw"]);
        $ip_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_sw"]);
        $mac_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_sw"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);
        $conexion = mysqli_real_escape_string($Connector->getCon(), $_POST["conexion"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $SW = new Switches($ns_sw, $ip_sw, $mac_sw, $tipo, $conexion, $fecha_inst, $id_pmi);
        $Connector->update("switch", $SW->UpdateSQL(),"ns_sw", "'$ns_sw'");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'switch','".$ns_sw."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location:showSwitch.php?e=3");
            }
            else{
                mysqli_rollback($Connector->getCon());
                header("Location:updateSwitch.php?id=".$ns_sw."&e=1");
            }
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateSwitch.php?id=".$ns_sw."&e=1");
        }
    }
?>