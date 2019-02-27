<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();
    $ant = 0;

    $sector = mysqli_real_escape_string($Connector->getCon(), $_POST["sector"]);

    if(isset($_POST["sector_act"])){
        $sector_act = mysqli_real_escape_string($Connector->getCon(), $_POST["sector_act"]);
        $ant = 1;
    }

    try{
        $Connector->select("radiobase","sector","'$sector'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Sector disponible</div><input id='sectorchecker' type='hidden' value='1' name='sectorchecker'>";
    }
    else{
        if($ant == 1){
            if($sector==$sector_act){
                echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Sector disponible</div><input id='sectorchecker' type='hidden' value='1' name='sectorchecker'>";
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Sector ya utilizado</div><input id='sectorchecker' type='hidden' value='0' name='sectorchecker'>";
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Sector ya utilizado</div><input id='sectorchecker' type='hidden' value='0' name='sectorchecker'>";
        }
    }
}
?>
