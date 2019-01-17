<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/User.php");

        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);

        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);
        $apellido = mysqli_real_escape_string($Connector->getCon(), $_POST["apellidos"]);
        $user = mysqli_real_escape_string($Connector->getCon(), $_POST["usuario"]);
        $pass = mysqli_real_escape_string($Connector->getCon(), $_POST["pass"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);

        $User = new User($nombre, $apellido, $user, $pass, $tipo);
        $Connector->insert("usuario", $User->getSQL(),$User->getFields());

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showUser.php?e=2");
        }
        else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>