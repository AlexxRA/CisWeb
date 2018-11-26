<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/User.php");

        $Connector = new Connector();
        $user = mysqli_real_escape_string($Connector->getCon(), $_POST["usuario"]);
        $pass = mysqli_real_escape_string($Connector->getCon(), $_POST["pass"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);

        $User = new User($user, $pass, $tipo);
        $Connector->insert("usuario", $User->getSQL(),$User->getFields());

        $query = $Connector->getQuery();
        //echo $query;
        if ($query) {
            echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>