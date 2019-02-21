<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/Municipio.php");

        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);

        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);
        $abreviatura = mysqli_real_escape_string($Connector->getCon(), $_POST["abreviatura"]);

        $Municipio = new Municipio($nombre,$abreviatura);
        $Connector->insert("municipios", $Municipio->getSQL(),$Municipio->getFields());

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showMunicipio.php?e=2");
        }
        else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>