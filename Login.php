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

    //$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
    //$_SESSION['SKey'] = uniqid(mt_rand(), true);
    //$_SESSION['IPaddress'] = ExtractUserIpAddress();
    //$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

    switch($row['tipo']) {
        case "super":
            header("Location:Users/Super/index.php");
            break;
        case "obra_civil":
            header("Location:Users/Super/index.php");
            break;
        case "radio":
            header("Location:Users/Super/index.php");
            break;
        case "it":
            header("Location:Users/Super/index.php");
            break;
        case "botones":
            header("Location:Users/Super/index.php");
            break;
        default:
            $error="UserNotFound";
            header("Location:index.php?error=".$error);
}
?>