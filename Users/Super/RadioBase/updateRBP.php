<?php
    if(isset($_POST['input'])) {
        include("../../../class/RadioBase.php");
        
        $Connector = new Connector();

        $id_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["id_rb"]);
        $dist_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["dist_rb"]);
        $rss_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_rb"]);
        $ip_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_rb"]);
        $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $RB = new RadioBase($id_rb, $dist_rb, $rss_rb, $ip_rb, $id_pmi, $id_sector);
        $Connector->update("radiobase", $RB->UpdateSQL(),"id_rb",$id_rb);

        $query = $Connector->getQuery();
        if ($query) {
            header("Location:showRB.php");
        } else {
            header("Location:updateRB.php?id=".$id_rb."&e=1");
        }
    }
?>