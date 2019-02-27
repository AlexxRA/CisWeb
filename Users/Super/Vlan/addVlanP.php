<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/Vlan.php");

        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);

        $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);
        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);

        $Vlan = new Vlan($id_vlan,$id_sitio);
        $Connector->insert("vlan", $Vlan->getSQL(),$Vlan->getFields());

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showVlan.php?e=2");
        }
        else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>