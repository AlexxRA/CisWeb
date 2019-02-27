<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();
    $ant = 0;

    $id_vlan = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan"]);

    if(isset($_POST["id_vlan_act"])){
        $id_vlan_act = mysqli_real_escape_string($Connector->getCon(), $_POST["id_vlan_act"]);
        $ant = 1;
    }

    try{
        $Connector->select("vlan","id_vlan","'$id_vlan'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> VLAN disponible</div><input id='vlanachecker' type='hidden' value='1' name='vlanachecker'>";
    }
    else{
        if($ant == 1){
            if($id_vlan==$id_vlan_act){
                echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> VLAN disponible</div><input id='vlanachecker' type='hidden' value='1' name='vlanachecker'>";
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> VLAN ya utilizada</div><input id='vlanachecker' type='hidden' value='0' name='vlanachecker'>";
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> VLAN ya utilizada</div><input id='vlanachecker' type='hidden' value='0' name='vlanachecker'>";
        }
    }
}
?>