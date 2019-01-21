<?php
    if(isset($_POST['input'])) {
        include("../../../class/RadioBase.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $dist_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["dist_rb"]);
        $rss_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_rb"]);
        $ip_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_rb"]);

        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        $sector = mysqli_real_escape_string($Connector->getCon(), $_POST["sector"]);

        $RB = new RadioBase($dist_rb, $rss_rb, $ip_rb, $id_sitio, $sector);
        $Connector->insert("radiobase", $RB->getSQL(),"(dist_rb, rss_rb, ip_rb, sector, id_sitio)");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $id_rb = mysqli_insert_id($Connector->getCon());
            $Connector->insert("comentarios", "'radiobase','".$id_rb."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location: showRB.php?e=2");
            }
            else{
                mysqli_rollback($Connector->getCon());
                echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        } else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable  mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
        
    }
?>