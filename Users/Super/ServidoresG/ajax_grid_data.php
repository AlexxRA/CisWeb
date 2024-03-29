<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");
$conn->set_charset("utf8");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_servidorg',
    1 => 'nombre',
    2 => 'num_cam'
);

$sql = "SELECT servidorg.nombre, servidorg.id_servidorg, servidorg.ubicacion, servidorg.ip_servidorg, servidorg.id_vlan, COUNT(ns_cam) as num_cam";
$sql.=" FROM servidorG";
$sql.=" LEFT JOIN camara on servidorg.id_servidorg=camara.id_servidorg";
$sql.=" GROUP BY servidorg.id_servidorg";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT servidorg.nombre, servidorg.id_servidorg, servidorg.ubicacion, servidorg.ip_servidorg, servidorg.id_vlan, COUNT(ns_cam) as num_cam";
    $sql.=" FROM servidorG";
    $sql.=" LEFT JOIN camara on servidorg.id_servidorg=camara.id_servidorg";
    $sql.=" WHERE servidorg.id_servidorg LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR servidorg.nombre LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR servidorg.ubicacion LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR servidorg.ip_servidorg LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" GROUP BY servidorg.id_servidorg";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT servidorg.nombre, servidorg.id_servidorg, servidorg.ubicacion, servidorg.ip_servidorg, servidorg.id_vlan, COUNT(ns_cam) as num_cam";
    $sql.=" FROM servidorG";
    $sql.=" LEFT JOIN camara on servidorg.id_servidorg=camara.id_servidorg";
    $sql.=" GROUP BY servidorg.id_servidorg";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();

    $nestedData[] = $row["id_servidorg"];
    $nestedData[] = $row["nombre"];
    $nestedData[] = $row["num_cam"];
    $nestedData[] = '<td><center>
                     <a href="updateServidorG.php?id='.$row['id_servidorg'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showServidorG.ph?action=delete&id='.$row['id_servidorg'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger" onclick="return confirm(\'Estas seguro de elimar el servidor?\');"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';
    $nestedData[] = $row["ubicacion"];
    $nestedData[] = $row["ip_servidorg"];
    $nestedData[] = $row["id_vlan"];

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
