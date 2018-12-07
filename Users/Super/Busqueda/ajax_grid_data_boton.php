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
    0=> 'id_pmi',
    1=> 'ext',
    2 => 'ip_bt',
    3 => 'mac_bt',
    4=> 'fecha_inst'
);

$sql = "SELECT ext, ip_bt, mac_bt, fecha_inst, id_pmi ";
$sql.=" FROM boton WHERE id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data_boton.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

    $nestedData=array();
    $nestedData[] = $row["ext"];//0
    $nestedData[] = $row["ip_bt"];//1
    $nestedData[] = $row["mac_bt"];//2
    $nestedData[] = $row["fecha_inst"];//3
    $nestedData[] = $row["id_pmi"];//4

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