<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sitio.php");
        
        $Connector = new Connector();
        
        $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
        
        $Connector->select("sitio","id_sitio","'$id_sitio'");
        $query = $Connector->getQuery();
		$nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el sitio ya existe</div>";
		}
        else{
            $nom_prop = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_prop"]);
            $nom_real = mysqli_real_escape_string($Connector->getCon(), $_POST["nom_real"]);
            $vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["vlan"]);

            $sitio = new Sitio($id_sitio, $nom_prop, $nom_real, $vlan);
            $Connector->insert("sitio", $sitio->getSQL(),"");

            $query = $Connector->getQuery();
            if ($query) {
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
            }
        }

        
    }
?>