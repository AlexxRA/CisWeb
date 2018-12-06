<?php
    if(isset($_POST['input'])) {
        include("../../../class/Pole.php");
        
        $Connector = new Connector();
        
        $ns_poste = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_poste"]);
        
        $Connector->select("poste","ns_poste","'$ns_poste'");
        $query = $Connector->getQuery();
		$nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el poste ya existe</div>";
		}
        else{
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
            if ($query) {
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>