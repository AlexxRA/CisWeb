<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$pmiForm="1";
if ($_POST["pmi"] != "") {
    $pmiForm = $_POST["pmi"];
} else {
    $pmiForm = "1";
}

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


$sql = "SELECT id_pmi, calle, cruce, colonia, coordX, coordY, latitud, longitud, municipio, num_cam ";
$sql.=" FROM pmi WHERE id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();

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
    $nestedData[] = '<td><center>
                     <a data-toggle="tooltip" title="Detalles" class="btn btn-sm btn-outline-success"> <i class="fa fa-fw fa-plus"></i> </a>
				     </center></td>';

    $data[] = $nestedData;
}

$json_data = array(
    //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    //"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>