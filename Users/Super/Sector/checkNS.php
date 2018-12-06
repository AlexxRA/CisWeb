<?php
if (isset($_POST)){
    include("../../../class/Sector.php");
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();

    $id_sector = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sector"]);
    try{
        $Connector->select("sector","id_sector","'$id_sector'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        //echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar, la Camara ya existe</div>";
        echo "<div class='alert alert-success '><i class='fa fa-check'></i> ID disponible</div><input id='nschecker' type='hidden' value='1' name='nschecker'>";
    }
    else{
        echo "<div class='alert alert-danger'><i class='fa fa-times'></i> ID ya agregado</div><input id='nschecker' type='hidden' value='0' name='nschecker'>";
    }




}
?>