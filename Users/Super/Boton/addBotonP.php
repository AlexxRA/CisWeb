<?php
    if(isset($_POST['input'])) {
        include("../../../class/Boton.php");

        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;
        
        $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);
        $ip_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_bt"]);
        $mac_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_bt"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $boton = new Boton($ext, $ip_bt, $mac_bt, $fecha_inst, $id_pmi);
        $Connector->insert("boton", $boton->getSQL(), "");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'boton','".$ext."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location: showBoton.php?e=2");
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