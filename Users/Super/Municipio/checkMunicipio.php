<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();
    $ant = 0;

    $nombre = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre"]);

    if(isset($_POST["nombre_act"])){
        $nombre_act = mysqli_real_escape_string($Connector->getCon(), $_POST["nombre_act"]);
        $ant = 1;
    }

    try{
        $Connector->select("municipios","nombre","'$nombre'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Municipio disponible</div><input id='abreviaturachecker' type='hidden' value='1' name='abreviaturachecker'>";
    }
    else{
        if($ant == 1){
            if($nombre==$nombre_act){
                echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Municipio disponible</div><input id='abreviaturachecker' type='hidden' value='1' name='abreviaturachecker'>";
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Municipio ya registrado</div><input id='abreviaturachecker' type='hidden' value='0' name='abreviaturachecker'>";
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Municipio ya registrado</div><input id='abreviaturachecker' type='hidden' value='0' name='abreviaturachecker'>";
        }
    }
}
?>