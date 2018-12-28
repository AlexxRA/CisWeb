<?php
if (isset($_POST)){
    include("../../../class/Camera.php");
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();

    $id_sitio = mysqli_real_escape_string($Connector->getCon(), $_POST["id_sitio"]);
    try{
        $Connector->select("sitio","id_sitio","'$id_sitio'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> ID disponible</div><input id='nschecker' type='hidden' value='1' name='nschecker'>";
    }
    else{
        echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> ID ya agregado</div><input id='nschecker' type='hidden' value='0' name='nschecker'>";
    }
}
?>