<?php
//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");
$conn->set_charset("utf8");

$sql = "SELECT *";
$sql.= " FROM pmi";

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $sql.=" WHERE id_pmi=".$id;
}

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");

$data = array( 'type' => 'FeatureCollection', 'features' => array());
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

    /*$nestedData[] = $row["id_pmi"];
    $nestedData[] = $row["calle"];
    $nestedData[] = $row["cruce"];
    $nestedData[] = $row["colonia"];
    $nestedData[] = $row["coordX"];
    $nestedData[] = $row["coordY"];
    $nestedData[] = $row["latitud"];
    $nestedData[] = $row["longitud"];
    $nestedData[] = $row["municipio"];
    $nestedData[] = $row["num_cam"];*/

    $sqlc = "SELECT *";
    $sqlc.=" FROM camara";
    $sqlc.=" WHERE id_pmi=".$row["id_pmi"];
    $queryc=mysqli_query($conn, $sqlc);
    $numCams=0;

    $camaras=array();
    while( $rowc=mysqli_fetch_array($queryc) ) {
        $camaras[]=$rowc["nom_cam"];
        $numCams++;

    }

    $marker = array(
        'type' => 'Feature',
        'features' => array(
            'type' => 'Feature',
            'properties' => array(
                'nombre' => "".$row["id_pmi"]."",
                'marker-color' => '#f00',
                'marker-size' => 'small',
                'num_cam' => $numCams,
                'camaras' => $camaras
                //'url' =>
            ),
            "geometry" => array(
                'type' => 'Point',
                'coordinates' => array(
                    $row["longitud"],
                    $row["latitud"]
                )
            )
        )
    );
    array_push($data['features'], $marker['features']);

}

echo ("eqfeed_callback(");
echo json_encode($data,JSON_NUMERIC_CHECK);
echo (");");

?>