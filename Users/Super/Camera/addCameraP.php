<?php
    if(isset($_POST['input'])) {
        include("../../../class/Camera.php");
        
        $Connector = new Connector();
        $ConnectorPMI = new Connector();
        $ConnectorMunicipio = new Connector();
        $nom_cam="";

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $ns_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_cam"]);
        $ip_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_cam"]);
        //$id_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["id_cam"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);
        $num_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["num_cam"]);
        //$dir_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["dir_cam"]);
        $ori_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ori_cam"]);
        $inc_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["inc_cam"]);
        //$nom_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_cam"]);
        $rec_server = mysqli_real_escape_string($Connector->getCon(), $_POST["rec_serv"]);
        $id_device = mysqli_real_escape_string($Connector->getCon(), $_POST["id_device"]);
        $firmware = mysqli_real_escape_string($Connector->getCon(), $_POST["firmware"]);
        $vms = mysqli_real_escape_string($Connector->getCon(), $_POST["vms"]);
        $user_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["user_cam"]);
        $pass_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["pass_cam"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $ConnectorPMI->select("pmi","id_pmi",$id_pmi);
        $queryPMI=$ConnectorPMI->getQuery();
        while($rowPMI=mysqli_fetch_array($queryPMI)){
            $ConnectorMunicipio->select("municipio","id_municipio",$rowPMI["id_municipio"]);
            $queryMunicipio=$ConnectorMunicipio->getQuery();
            while($rowMunicipio=mysqli_fetch_array($queryMunicipio)){
                $nom_cam.=$rowMunicipio["abreviatura"].$rowPMI["zona"]."_".$rowPMI["calle"]."_".obtenerDireccion($ori_cam).$num_cam.$tipo;
            }
        }

        $camera = new camera($ns_cam, $ip_cam, $tipo, $num_cam, $ori_cam, $inc_cam, $nom_cam, $rec_server, $id_device, $firmware, $vms, $user_cam, $pass_cam, $fecha_inst, $id_pmi);
        $Connector->insert("camara", $camera->getSQL(),"");

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != ""){
            $Connector->insert("comentarios", "'camara','".$ns_cam."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showCamera.php?e=2");
        } else {
            mysqli_rollback($Connector->getCon());
            echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }

    }
    function obtenerDireccion($orientacion){
        $direccion="";
        if ($orientacion>=0 && $orientacion<22.5){
            $direccion="N";
        }
        else if($orientacion>=22.5 && $orientacion<67.5){
            $direccion="NE";
        }
        else if($orientacion>=67.5 && $orientacion<112.5){
            $direccion="E";
        }
        else if($orientacion>=112.5 && $orientacion<157.5){
            $direccion="SE";
        }
        else if($orientacion>=157.5 && $orientacion<202.5){
            $direccion="S";
        }
        else if($orientacion>=202.5 && $orientacion<247.5){
            $direccion="SO";
        }
        else if($orientacion>=247.5 && $orientacion<292.5){
            $direccion="O";
        }
        else if($orientacion>=292.5 && $orientacion<337.5){
            $direccion="NO";
        }
        else if($orientacion>=337.5 && $orientacion<=360){
            $direccion="N";
        }


        return $direccion;
    }

?>