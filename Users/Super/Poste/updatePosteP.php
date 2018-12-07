<?php
    if(isset($_POST['input'])) {
        include("../../../class/Pole.php");
        
        $Connector = new Connector();
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
        $Connector->update("poste", $poste->UpdateSQL(),"ns_poste",$ns_poste);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'poste','".$ns_poste."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($e!=1){
                header("Location:showPoste.php");
            }
            else{
                header("Location:updatePoste.php?id=".$ns_poste."&e=1");
            }
        } else {
            header("Location:updatePoste.php?id=".$ns_poste."&e=1");
        }
    }
?>