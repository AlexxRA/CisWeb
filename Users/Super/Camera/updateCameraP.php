<?php
    if(isset($_POST['input'])) {
        include("../../../class/Camera.php");
        
        $Connector = new Connector();

        mysqli_autocommit($Connector->getCon(), false);
        $e=0;

        $id = mysqli_real_escape_string($Connector->getCon(), $_POST["id"]);
        $ns_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_cam"]);
        $ip_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_cam"]);
        $mac_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_cam"]);
        //$id_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["id_cam"]);
        $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);
        $num_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["num_cam"]);
        $ori_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ori_cam"]);
        $inc_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["inc_cam"]);
        $nom_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_cam"]);
        //$rec_server = mysqli_real_escape_string($Connector->getCon(), $_POST["rec_serv"]);
        $id_server = mysqli_real_escape_string($Connector->getCon(), $_POST["rec_serv"]);
        $id_device = mysqli_real_escape_string($Connector->getCon(), $_POST["id_device"]);
        $firmware = mysqli_real_escape_string($Connector->getCon(), $_POST["firmware"]);
        $vms = mysqli_real_escape_string($Connector->getCon(), $_POST["vms"]);
        $user_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["user_cam"]);
        $pass_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["pass_cam"]);
        $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
        $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);

        //Prueba temporal
        $sqlr = mysqli_query($Connector->getCon(), "SELECT nombre FROM servidorg WHERE id_servidorg='$id_server'");
        $rowr = mysqli_fetch_assoc($sqlr);
        $rec_server = $rowr['nombre'];

        $camara = new Camera($ns_cam, $ip_cam, $mac_cam, $tipo, $num_cam, $ori_cam, $inc_cam, $nom_cam, $rec_server, $id_server, $id_device, $firmware, $vms, $user_cam, $pass_cam, $fecha_inst, $id_pmi, $id_vlan);

        $Connector->update("camara", $camara->UpdateSQL(),"ns_cam","'$id'");

        $id_com = mysqli_real_escape_string($Connector->getCon(), $_POST["id_com"]);
        $com = mysqli_real_escape_string($Connector->getCon(), $_POST["com"]);
        $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
        if($comentario != "") {
            if ($id_com == "") {
                $Connector->insert("comentarios", "'camara','".$ns_cam."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            } else {
                if ($com != $comentario) {
                    $Connector->update("comentarios", "identificador='$ns_cam', comentario='$comentario', fecha='" . date("Y-n-j") . "', usuario='" . $_SESSION["name"] . "'", "id_com", $id_com);
                }
            }
        }

        $query = $Connector->getQuery();
        if ($query) {
            mysqli_commit($Connector->getCon());
            header("Location: showCamera.php?e=3");
        } else {
            mysqli_rollback($Connector->getCon());
            header("Location:updateCamera.php?id=".$id."&e=1");
        }
    }
?>
