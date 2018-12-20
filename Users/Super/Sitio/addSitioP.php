<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $nom = mysqli_real_escape_string($Connector->getCon(), $_POST["nom"]);
        $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["municipio"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        $sitio = new Sitio($nom, $vlan, $calle, $cruce, $colonia, $municipio, $latitud, $longitud);
        $Connector->insert("sitio", $sitio->getSQL(),"(nom, vlan, calle, cruce, colonia, municipio, latitud, longitud)");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $id_sitio = mysqli_insert_id($Connector->getCon());
            $Connector->insert("comentarios", "'sitio','".$id_sitio."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            }
            else{
                mysqli_rollback($Connector->getCon());
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        } else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
        
    }
?>