<?php
    if(isset($_POST['input'])) {
        include("../../../class/Sector.php");
        
        $Connector = new Connector();
        $e=0;
        
        $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
        
        $Connector->select("sector","id_sector","'$id_sector'");
        $query = $Connector->getQuery();
		$nr=mysqli_num_rows($query);
		if($nr>=1){
			echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, el sector ya existe</div>";
		}
        else{
            $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
            $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

            $sector = new sector($id_sector, $nombre, $id_sitio);
            $Connector->insert("sector", $sector->getSQL(),"");

            $query = $Connector->getQuery();
            if (!$query) {
                $e=1;
            }

            $comentario = mysqli_real_escape_string($Connector->getCon(), $_POST["comentario"]);
            if($comentario != ""){
                $Connector->insert("comentarios", "'sector','".$id_sector."','".$comentario."','".$_SESSION["name"]."','".date("Y-n-j")."'","(tabla, identificador, comentario, usuario, fecha)");
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