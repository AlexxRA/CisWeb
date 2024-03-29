<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_pmi',
    1 => 'calle',
    2 => 'cruce',
    3 => 'colonia',
    4=> 'coordX',
    5=> 'coordY',
    6=> 'latitud',
    7=> 'longitud',
    8=> 'municipio',
    9=> 'num_cam'
);

/*
SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario
FROM pmi
LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador
UNION
SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario
FROM pmi
RIGHT JOIN comentarios ON pmi.id_pmi= comentarios.identificador

$sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario ";
$sql.=" FROM pmi";
$sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador";
$sql.=" UNION";
$sql = " SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario ";
$sql.=" FROM pmi";
$sql.=" RIGHT JOIN comentarios ON pmi.id_pmi= comentarios.identificador";
 */
$sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM pmi";
$sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM pmi";
    $sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";

    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR calle LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR municipio LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR colonia LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR num_cam LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM pmi";
    $sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();
    if($row["comentario"]){
        $com=$row["comentario"];
        $usu=$row["usuario"];
        $fecha=$row["fecha"];
    }
    else{
        $com="";
        $usu="";
        $fecha="";
    }

    $nestedData[] = $row["id_pmi"];
    $nestedData[] = $row["calle"];
    $nestedData[] = $row["cruce"];
    $nestedData[] = $row["colonia"];
    $nestedData[] = $row["coordX"];
    $nestedData[] = $row["coordY"];
    $nestedData[] = $row["latitud"];
    $nestedData[] = $row["longitud"];
    $nestedData[] = $row["municipio"];
    $nestedData[] = $row["num_cam"];
    $nestedData[] = $com;
    $nestedData[] = $usu;
    $nestedData[] = $fecha;

    $data[] = $nestedData;

}

$json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>