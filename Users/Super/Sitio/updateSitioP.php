<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nom_prop = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_prop"]);
        $nom_real = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_real"]);
        $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);

        $sitio = new Sitio($id_sitio, $nom_prop, $nom_real, $vlan);
        $Connector->update("sitio", $sitio->UpdateSQL(),"id_sitio",$id_sitio);

        $query = $Connector->getQuery();
        if ($query) {
            header("Location:showSitio.php");
        } else {
            header("Location:updateSitio.php?id=".$ns_cam."&e=1");
        }
    }
?>