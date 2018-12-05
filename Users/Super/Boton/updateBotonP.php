<?php
    if(isset($_POST['input'])) {
        include("../../../class/Boton.php");
        
        $Connector = new Connector();

        $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);
        $ip_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_bt"]);
        $mac_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_bt"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $boton = new Boton($ext, $ip_bt, $mac_bt, $fecha_inst, $id_pmi);
        $Connector->update("boton", $boton->UpdateSQL(),"ext", "'$ext'");

        $query = $Connector->getQuery();
        if ($query) {
            header("Location:showBoton.php");
        } else {
            header("Location:updateBoton.php?id=".$ext."&e=1");
        }
    }
?>