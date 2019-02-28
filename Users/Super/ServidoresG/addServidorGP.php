<?php
    if(isset($_POST['input'])) {
        include("../../../class/ServidorG.php");

        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);

        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);
        $ubicacion = mysqli_real_escape_string($Connector->getCon(), $_POST["ubicacion"]);
        $ip_servidorg = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_servidorg"]);
        $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);

        $Servidor = new ServidorG($nombre, $ubicacion, $ip_servidorg, $id_vlan);
        $Connector->insert("servidorg", $Servidor->getSQL(),$Servidor->getFields());

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showServidorG.php?e=2");
        }
        else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>
