<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $nom = mysqli_real_escape_string($Connector->getCon(), $_POST["nom"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $id_municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_municipio"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        //Prueba temporal
        $sqlm = mysqli_query($Connector->getCon(), "SELECT nombre FROM municipios WHERE id_municipio='$id_municipio'");
        $rowm = mysqli_fetch_assoc($sqlm);
        $municipio = $rowm['nombre'];

        $sitio = new Sitio($nom, $calle, $cruce, $colonia, $municipio, $latitud, $longitud, $id_municipio);
        $Connector->insert("sitio", $sitio->getSQL(),"(nom, calle, cruce, colonia, municipio, latitud, longitud, id_municipio)");

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
                header("Location: showSitio.php?e=2");
            }
            else{
                mysqli_rollback($Connector->getCon());
                echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        } else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
        
    }
?>
