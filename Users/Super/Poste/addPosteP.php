<?php
    if(isset($_POST['input'])) {
        include("../../../class/Pole.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;
        
        $ns_poste = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_poste"]);
        $altura = mysqli_real_escape_string($Connector->getCon(), $_POST["altura"]);
        $fecha_mont = mysqli_real_escape_string($Connector->getCon(), $_POST["datepickerM"]);
        $fecha_elec = mysqli_real_escape_string($Connector->getCon(), $_POST["datepickerE"]);
        $fecha_base = mysqli_real_escape_string($Connector->getCon(), $_POST["datepickerB"]);
        $fecha_asign = mysqli_real_escape_string($Connector->getCon(), $_POST["datepickerA"]);
        $contratista = mysqli_real_escape_string($Connector->getCon(), $_POST["contratista"]);
        $ns_ups = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_ups"]);
        $ns_gabinete = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_gabinete"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $poste = new Pole($ns_poste, $altura, $fecha_mont, $fecha_elec, $fecha_base, $contratista, $fecha_asign, $ns_ups, $ns_gabinete, $id_pmi);
        $Connector->insert("poste", $poste->getSQL(),"");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'poste','".$ns_poste."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
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