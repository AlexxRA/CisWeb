<?php
    if(isset($_POST['input'])) {
        include("../../../SGBD/Connector.php");
        include("../../../class/Pmi.php");
        
        $Connector = new Connector();
        
        $id_Pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
        
        $Connector->select("pmi","id_pmi",$id_Pmi);
        $query = $Connector->getQuery();
		$nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el PMI ya existe</div>";	
		}
        else{
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
            if ($query) {
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>