<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/Pmi.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;
        
        $id_Pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        $calle = mysqli_real_escape_string($Connector->getCon(), $_POST["calle"]);
        $cruce = mysqli_real_escape_string($Connector->getCon(), $_POST["cruce"]);
        $colonia = mysqli_real_escape_string($Connector->getCon(), $_POST["colonia"]);
        $municipio = mysqli_real_escape_string($Connector->getCon(), $_POST["municipio"]);
        $coordenadaX = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenadax"]);
        $coordenadaY = mysqli_real_escape_string($Connector->getCon(), $_POST["coordenaday"]);
        $latitud = mysqli_real_escape_string($Connector->getCon(), $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($Connector->getCon(), $_POST["longitud"]);

        $PMI = new Pmi($id_Pmi, $calle, $cruce, $colonia, $municipio, $coordenadaX, $coordenadaY, $latitud, $longitud, 0);
        $Connector->insert("pmi", $PMI->getSQL(),"");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'pmi','".$id_Pmi."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                mysqli_commit($Connector->getCon());
                header("Location: showPMI.php?e=2");
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