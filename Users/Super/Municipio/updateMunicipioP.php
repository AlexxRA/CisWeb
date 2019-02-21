<?php
if(isset($_POST['input'])) {
    include("../../../class/Municipio.php");

    $Connector = new Connector();

    mysqli_autocommit($Connector->getCon(), false);

    $id = mysqli_real_escape_string($Connector->getCon(), $_POST["id"]);
    $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);
    $abreviatura = mysqli_real_escape_string($Connector->getCon(), $_POST["abreviatura"]);

    $Municipio = new Municipio($nombre, $abreviatura);
    $Connector->update("municipios", $Municipio->UpdateSQL(),"id_municipio", "'$id'");

    $query = $Connector->getQuery();
    if ($query) {
        mysqli_commit($Connector->getCon());
        header("Location: showMunicipio.php?e=3");
    }
    else {
        mysqli_rollback($Connector->getCon());
        header("Location:updateMunicipio.php?id=".$id."&e=1");
    }
}
?>