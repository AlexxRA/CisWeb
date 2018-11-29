<?php
    if(isset($_POST['input'])) {
        include("../../../class/Pmi.php");
        
        $Connector = new Connector();
        
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
        if ($query) {
            header("Location:showPMI.php?id=".$id_Pmi."&e=0");
        } else {
            header("Location:updatePmi.php?id=".$id_Pmi."&e=1");
        }
    }
?>