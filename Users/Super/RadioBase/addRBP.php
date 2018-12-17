<?php
    if(isset($_POST['input'])) {
        include("../../../class/RadioBase.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;
        
        $id_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["id_rb"]);
        $dist_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["dist_rb"]);
        $rss_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["rss_rb"]);
        $ip_rb = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_rb"]);
        $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $RB = new RadioBase($id_rb, $dist_rb, $rss_rb, $ip_rb, $id_pmi, $id_sector);
        $Connector->insert("radiobase", $RB->getSQL(),"");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'radiobase','".$id_rb."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
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