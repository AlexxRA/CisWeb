<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");
$conn->set_charset("utf8");
// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_usu',
    1 => 'nombre',
    2 => 'apellidos',
    3 => 'usuario',
    4 => 'tipo'
);

$sql = "SELECT *";
$sql.="FROM usuario";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT *";
    $sql.="FROM usuario";
    $sql.=" WHERE id_usu LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR usuario LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tipo LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT *";
    $sql.="FROM usuario";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();

    $nestedData[] = $row["id_usu"];
    $nestedData[] = $row["nombre"];
    $nestedData[] = $row["apellidos"];
    $nestedData[] = $row["usuario"];
    $nestedData[] = $row["tipo"];
    $nestedData[] = '<td><center>
                     <a href="updateUser.php?id='.$row['id_usu'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showUser.php?action=delete&id='.$row['id_usu'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger" onclick="return confirm(\'Estas seguro de elimar el usuario?\');"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';

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