<?php
//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

$sql = "SELECT COUNT(*)";
$sql.= " FROM boton";

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$boton = mysqli_fetch_row($query);

$sql = "SELECT cantidad";
$sql.= " FROM metas";
$sql.= " WHERE id_meta=3";

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$metas = mysqli_fetch_row($query);

$data = array();

    $count = array(
        'nombre' => 'Botones',
        'registrados' => $boton[0],
        'caidos' =>  0,
        'faltantes' => $metas[0]-$boton[0]
    );

    $data[]=$count;
    //array_push($data['data'], $count);


echo json_encode($data,JSON_NUMERIC_CHECK);

?>