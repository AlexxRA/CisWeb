<?php
if (isset($_POST)){
    include("../../../class/Pmi.php");
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();

    $id_pmi = mysqli_real_escape_string($Connector->getCon(), $_POST["id_pmi"]);
    try{
        $Connector->select("pmi","id_pmi","'$id_pmi'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> PMI valido</div><input id='pmichecker' type='hidden' value='1' name='pmichecker'>";
    }
    else{
        echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> PMI en uso</div><input id='pmichecker' type='hidden' value='0' name='pmichecker'>";
    }
}
?>