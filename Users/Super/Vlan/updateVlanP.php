<?php
if(isset($_POST['input'])) {
    include("../../../class/Vlan.php");

    $Connector = new Connector();

    mysqli_autocommit($Connector->getCon(), false);

    $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);
    $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);

    $Vlan = new Vlan($id_vlan,$id_sitio);
    $Connector->update("vlan", $Vlan->UpdateSQL(),"id_vlan", "'$id_vlan'");

    $query = $Connector->getQuery();
    if ($query) {
        mysqli_commit($Connector->getCon());
        header("Location: showVlan.php?e=3");
    }
    else {
        mysqli_rollback($Connector->getCon());
        header("Location:updateVlan.php?id=".$id."&e=1");
    }
}
?>