<?php
if(isset($_POST['input'])) {
    include("../../../class/ServidorG.php");

    $Connector = new Connector();

    mysqli_autocommit($Connector->getCon(), false);

    $id = mysqli_real_escape_string($Connector->getCon(), $_POST["id"]);
    $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

    $Servidor = new ServidorG($nombre, $abreviatura);
    $Connector->update("servidorg", $Servidor->UpdateSQL(),"id_servidorg", "'$id'");

    $query = $Connector->getQuery();
    if ($query) {
        mysqli_commit($Connector->getCon());
        header("Location: showServidorG.php?e=3");
    }
    else {
        mysqli_rollback($Connector->getCon());
        header("Location:updateServidorG.php?id=".$id."&e=1");
    }
}
?>
