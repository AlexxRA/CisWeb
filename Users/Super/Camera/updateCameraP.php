<?php
    if(isset($_POST['input'])) {
        include("../../../class/Camera.php");
        
        $Connector = new Connector();
        $e=0;

        $ns_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_cam"]);
        $ip_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_cam"]);
        $id_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["id_cam"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);
        $num_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["num_cam"]);
        $dir_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["dir_cam"]);
        $ori_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ori_cam"]);
        $inc_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["inc_cam"]);
        $nom_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_cam"]);
        $rec_server = mysqli_real_escape_string($Connector->getCon(), $_POST["rec_serv"]);
        $id_device = mysqli_real_escape_string($Connector->getCon(), $_POST["id_device"]);
        $firmware = mysqli_real_escape_string($Connector->getCon(), $_POST["firmware"]);
        $import_file = mysqli_real_escape_string($Connector->getCon(), $_POST["import_file"]);
        $user_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["user_cam"]);
        $pass_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["pass_cam"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

        $camara = new Camera($ns_cam, $ip_cam, $id_cam, $tipo, $num_cam, $dir_cam, $ori_cam, $inc_cam, $nom_cam, $rec_server, $id_device, $firmware, $import_file, $user_cam, $pass_cam, $fecha_inst, $id_pmi);

        $Connector->select("camara","ns_cam",$ns_cam);
        $query = $Connector->getQuery();
        $row = mysqli_fetch_assoc($query);
        $id_ant=$row["id_pmi"];

        $Connector->update("camara", $camara->UpdateSQL(),"ns_cam",$ns_cam);

        $query = $Connector->getQuery();
        if (!$query) {
            $e=1;
        }

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($id_com == ""){
            $Connector->insert("comentarios", "'camara','".$ns_cam."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
        }
        else{
            $Connector->update("comentarios", "comentario='$comentario', fecha='".date("Y-n-j")."', usuario='".$_SESSION["name"]."'","id_com", $id_com);
        }

        $query = $Connector->getQuery();
        if ($query) {
            if($id_ant!=$id_pmi){
                $Connector->select("pmi","id_pmi",$id_ant);
                $queryp=$Connector->getQuery();
                $rowp=mysqli_fetch_array($queryp);
                $camaras=$rowp['num_cam'];
                $camaras--;
                echo $camaras;
                $Connector->update("pmi","num_cam='$camaras'","id_pmi",$id_ant);
                $Connector->select("pmi","id_pmi",$id_pmi);
                $queryp=$Connector->getQuery();
                $rowp=mysqli_fetch_array($queryp);
                $camaras=$rowp['num_cam'];
                $camaras++;
                echo $camaras;
                $Connector->update("pmi","num_cam='$camaras'","id_pmi",$id_pmi);
            }
            if($e!=1){
                header("Location:showCamera.php");
            }
            else{
                header("Location:updateCamera.php?id=".$ns_cam."&e=1");
            }
        } else {
            header("Location:updateCamera.php?id=".$ns_cam."&e=1");
        }
    }
?>