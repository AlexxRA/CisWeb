<?php
if(isset($_POST['input'])) {
    include("../../../class/User.php");

    $Connector = new Connector();

    mysqli_autocommit($Connector->getCon(), false);

    $id = mysqli_real_escape_string($Connector->getCon(), $_POST["id"]);
    $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);
    $apellido = mysqli_real_escape_string($Connector->getCon(), $_POST["apellidos"]);
    $user = mysqli_real_escape_string($Connector->getCon(), $_POST["usuario"]);
    $pass = mysqli_real_escape_string($Connector->getCon(), $_POST["pass"]);
    $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);

    $User = new User($nombre, $apellido, $user, $pass, $tipo);
    $Connector->update("usuario", $User->UpdateSQL(),"id_usu", "'$id'");

    $query = $Connector->getQuery();
    if ($query) {
        mysqli_commit($Connector->getCon());
        header("Location: showUser.php?e=3");
    }
    else {
        mysqli_rollback($Connector->getCon());
        header("Location:updateUser.php?id=".$id."&e=1");
    }
}
?>