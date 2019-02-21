<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();
    $ant = 0;

    $abreviatura = mysqli_real_escape_string($Connector->getCon(), $_POST["abreviatura"]);

    if(isset($_POST["abreviatura_act"])){
        $abreviatura_act = mysqli_real_escape_string($Connector->getCon(), $_POST["abreviatura_act"]);
        $ant = 1;
    }

    try{
        $Connector->select("municipios","abreviatura","'$abreviatura'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Abreviatura disponible</div><input id='abreviaturachecker' type='hidden' value='1' name='abreviaturachecker'>";
    }
    else{
        if($ant == 1){
            if($abreviatura==$abreviatura_act){
                echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Abreviatura disponible</div><input id='abreviaturachecker' type='hidden' value='1' name='abreviaturachecker'>";
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Abreviatura ya utilizada</div><input id='abreviaturachecker' type='hidden' value='0' name='abreviaturachecker'>";
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Abreviatura ya utilizada</div><input id='abreviaturachecker' type='hidden' value='0' name='abreviaturachecker'>";
        }
    }
}
?>