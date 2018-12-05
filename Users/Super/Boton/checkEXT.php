<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();

    $ext = mysqli_real_escape_string($Connector->getCon(), $_POST["extension"]);
    try{
        $Connector->select("boton","ext","'$ext'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        //echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, la Camara ya existe</div>";
        echo "<div class='alert alert-success '><i class='fa fa-check'></i> Extension disponible</div><input id='extchecker' type='hidden' value='1' name='extchecker'>";
    }
    else{
        echo "<div class='alert alert-danger'><i class='fa fa-times'></i> Extension ya agregada</div><input id='extchecker' type='hidden' value='0' name='extchecker'>";
    }




}
?>