<?php
    if(isset($_POST['input'])) {
        include("../../../class/Boton.php");
        
        $Connector = new Connector();
        
        $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);

        $Connector->select("boton","ext","'$ext'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el boton ya existe</div>";
		}
        else {

            $ip_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_bt"]);
            $mac_bt = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_bt"]);
            $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
            $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

            $boton = new Boton($ext, $ip_bt, $mac_bt, $fecha_inst, $id_pmi);
            $Connector->insert("boton", $boton->getSQL(), "");


            $query = $Connector->getQuery();
            if ($query) {
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>