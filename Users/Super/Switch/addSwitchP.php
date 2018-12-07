<?php
    if(isset($_POST['input'])) {
        include("../../../class/Switches.php");
        
        $Connector = new Connector();
        $e=0;
        
        $ns_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_sw"]);

        $Connector->select("switch","ns_sw","'$ns_sw'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el switch ya existe</div>";
		}
        else {

            $ip_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["ip_sw"]);
            $mac_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["mac_sw"]);
            $tipo = mysqli_real_escape_string($Connector->getCon(), $_POST["tipo"]);
            $conexion = mysqli_real_escape_string($Connector->getCon(), $_POST["conexion"]);
            $fecha_inst = mysqli_real_escape_string($Connector->getCon(), $_POST["datepicker"]);
            $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);

            $sw = new Switches($ns_sw, $ip_sw, $mac_sw, $tipo, $conexion, $fecha_inst, $id_pmi);
            $Connector->insert("switch", $sw->getSQL(), "");

            $query = $Connector->getQuery();
            if (!$query) {
                $e=1;
            }

            $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
            if($comentario != ""){
                $Connector->insert("comentarios", "'switch','".$ns_sw."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
            }

            $query = $Connector->getQuery();
            if ($query) {
                if($e!=1){
                    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
                }
                else{
                    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>