<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
    0 => 'id_sector',
    1 => 'nombre',
    2=> 'id_sitio'
);


$sql = "SELECT sector.id_sector, sector.nombre, sector.id_sitio, sitio.nom_real";
$sql.=" FROM sector";
$sql.=" INNER JOIN sitio ON sector.id_sitio = sitio.id_sitio";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT sector.id_sector, sector.nombre, sector.id_sitio, sitio.nom_real";
    $sql.=" FROM sector";
    $sql.=" INNER JOIN sitio ON sector.id_sitio = sitio.id_sitio";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ip_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nom_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ns_cam LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {

    $sql = "SELECT sector.id_sector, sector.nombre, sector.id_sitio, sitio.nom_real";
    $sql.=" FROM sector";
    $sql.=" INNER JOIN sitio ON sector.id_sitio = sitio.id_sitio";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

    $nestedData=array();
    $nestedData[] = $row["id_sector"];//0
    $nestedData[] = $row["nombre"];//1
    $nestedData[] = $row["id_sitio"];//2
    $nestedData[] = $row["nom_real"];//3
    $nestedData[] = '<td><center>
                     <a href="updateSector.php?id='.$row['id_sector'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showSector.php?action=delete&id='.$row['id_sector'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';//4

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