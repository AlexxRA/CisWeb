<?php
    if(isset($_POST['input'])) {
        include("../../../class/Switches.php");
        
        $Connector = new Connector();

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
        if ($query) {
            header("Location:showSwitch.php");
        } else {
            header("Location:updateSwitch.php?id=".$ns_sw."&e=1");
        }
    }
?>