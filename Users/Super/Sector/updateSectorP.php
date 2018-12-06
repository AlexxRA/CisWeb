<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sector.php");
        
        $Connector = new Connector();

        $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

        $sector = new sector($id_sector, $nombre, $id_sitio);
        $Connector->update("sector", $sector->UpdateSQL(),"id_sector",$id_sector);

        $query = $Connector->getQuery();
        if ($query) {
            header("Location:showSector.php");
        } else {
            header("Location:updateSector.php?id=".$ns_cam."&e=1");
        }
    }
?>