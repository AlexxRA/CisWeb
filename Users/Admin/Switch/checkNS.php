<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();

    $ns_sw = mysqli_real_escape_string($Connector->getCon(), $_POST["ns_sw"]);
    try{
        $Connector->select("switch","ns_sw","'$ns_sw'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Numero de serie disponible</div><input id='nschecker' type='hidden' value='1' name='nschecker'>";
    }
    else{
        echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Numero de serie ya agregado</div><input id='nschecker' type='hidden' value='0' name='nschecker'>";
    }
}
?>