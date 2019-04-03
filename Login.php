<?php
    session_start();

    include("SGBD/Connector.php");


    $Connector = new Connector();
    $user = mysqli_real_escape_string($Connector->getCon(), $_POST["inputUser"]);
    $pass = mysqli_real_escape_string($Connector->getCon(), $_POST["inputPassword"]);

    $row = $Connector->Login($user, $pass);
    $_SESSION["name"]=$row['nombre']." ".$row['apellidos'];
    $_SESSION["type"]=$row['tipo'];
    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
    $_SESSION["autentificado"]= "SI";

    switch($row['tipo']) {
        case "super":
            header("Location:Users/Super/index.php");
            break;
        case "admin":
            header("Location:Users/Admin/index.php");
            break;
        case "obra_civil":
            header("Location:Users/ObraCivil/index.php");
            break;
        case "radio":
            header("Location:Users/Radio/index.php");
            break;
        case "it":
            header("Location:Users/IT/index.php");
            break;
        case "instalaciones":
            header("Location:Users/Instalaciones/index.php");
            break;
        case "administrativo":
            header("Location:Users/Administrativo/index.php");
            break;
        default:
            $error="UserNotFound";
            header("Location:index.php?error=".$error);
}
?>