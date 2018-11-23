<?php
    session_start();

    include("SGBD/Connector.php");


    $Connector = new Connector();
    $user = mysqli_real_escape_string($Connector->getCon(), $_POST["inputUser"]);
    $pass = mysqli_real_escape_string($Connector->getCon(), $_POST["inputPassword"]);

    $row = $Connector->Login($user, $pass);
    $_SESSION["name"]=$row['name'];
    $_SESSION["type"]=$row['type'];

    switch($row['type']) {
        case "Admin":
            header("Location:Users/Admin/index.php");
            break;
        case "IT":
            header("Location:Users/IT/index.php");
            break;
        case "Instalador":
            header("Location:Users/Instalador/index.php");
            break;
        case "Radio":
            header("Location:#");
            break;
        case "Obra Civil":
            header("Location:#");
            break;
        case "Relaciones Publicas":
            header("Location:#");
            break;
        default:
            $error="UserNotFound";
            header("Location:index.php?error=".$error);
    }
?>