<?php
//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

$sql = "SELECT COUNT(*)";
$sql.= " FROM pmi";

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$fila = mysqli_fetch_row($query);

$data = array();

    $count = array(
        'nombre' => 'PMI',
        'registrados' => $fila[0],
        'caidos' =>  2,
        'faltantes' => 1
    );

    $data[]=$count;
    //array_push($data['data'], $count);


echo json_encode($data,JSON_NUMERIC_CHECK);

?>