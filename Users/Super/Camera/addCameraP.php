<?php
    if(isset($_POST['input'])) {
        include("../../../class/Camera.php");
        
        $Connector = new Connector();
        
        $ns_cam = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_cam"]);
        
        $Connector->select("camara","ns_cam",$ns_cam);
        $query = $Connector->getQuery();
		$nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, la Camara ya existe</div>";
		}
        else{
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

            $camera = new camera($ns_cam, $ip_cam, $id_cam, $tipo, $num_cam, $dir_cam, $ori_cam, $inc_cam, $nom_cam, $rec_server, $id_device, $firmware, $import_file, $user_cam, $pass_cam, $fecha_inst, $id_pmi);
            $Connector->insert("camara", $camera->getSQL(),"");


            $query = $Connector->getQuery();
            if ($query) {
                $PMI = new Connector();
                $PMI->select("pmi","id_pmi",$id_pmi);
                $query=$PMI->getQuery();
                $row=mysqli_fetch_array($query);
                $camaras=$row['num_cam'];
                $camaras++;
                $PMI->update("pmi","num_cam='$camaras'","id_pmi",$id_pmi);
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>