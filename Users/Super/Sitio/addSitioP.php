<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $nom_prop = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_prop"]);
        $nom_real = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_real"]);
        $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);

        $sitio = new Sitio($nom_prop, $nom_real, $vlan);
        $Connector->insert("sitio", $sitio->getSQL(),"(nom_prop, nom_real, vlan)");

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