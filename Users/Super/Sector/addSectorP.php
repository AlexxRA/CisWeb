<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sector.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

        $sector = new sector($nombre, $id_sitio);
        $Connector->insert("sector", $sector->getSQL(),"(nombre, id_sitio)");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $id_sector = mysqli_insert_id($Connector->getCon());
            $Connector->insert("comentarios", "'sector','".$id_sector."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location: showSector.php?e=2");
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