<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
    0=>'id_pmi',
    1 => 'ns_poste',
    2 => 'altura',
    3=> 'contratista',
    4=> 'fecha_asign',
);


$sql = "SELECT ns_poste, altura, fecha_mont, fecha_elect, fecha_base, contratista, fecha_asign, ns_ups, ns_gabinete, id_pmi ";
$sql.=" FROM poste";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT ns_poste, altura, fecha_mont, fecha_elect, fecha_base, contratista, fecha_asign, ns_ups, ns_gabinete, id_pmi ";
    $sql.=" FROM poste";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ns_poste LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR fecha_asign LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {

    $sql = "SELECT ns_poste, altura, fecha_mont, fecha_elect, fecha_base, contratista, fecha_asign, ns_ups, ns_gabinete, id_pmi ";
    $sql.=" FROM poste";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

    $nestedData=array();
    $nestedData[] = $row["ns_poste"];
    $nestedData[] = $row["altura"];
    $nestedData[] = $row["fecha_mont"];//2
    $nestedData[] = $row["fecha_elect"];//3
    $nestedData[] = $row["fecha_base"];//4
    $nestedData[] = $row["contratista"];
    $nestedData[] = $row["fecha_asign"];
    $nestedData[] = $row["ns_ups"];//7
    $nestedData[] = $row["ns_gabinete"];//8
    $nestedData[] = $row["id_pmi"];
    $nestedData[] = '<td><center>
                     <a href="updatePoste.php?id='.$row['ns_poste'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showPoste.php?action=delete&id='.$row['ns_poste'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger"> <i class="fa fa-fw fa-trash"></i> </a>
                     <a data-toggle="tooltip" title="Detalles" class="btn btn-sm btn-outline-success"> <i class="fa fa-fw fa-plus"></i> </a>
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