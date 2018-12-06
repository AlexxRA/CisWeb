<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
    0 => 'id_pmi',
    1 => 'id_sector',
    2=> 'id_rb',
    3 => 'ip_rb',
    4 => 'dist_rb',
    5 => 'rss_rb'

);

$sql = "SELECT id_rb, dist_rb, rss_rb, ip_rb, id_pmi, id_sector ";
$sql.=" FROM radiobase";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.




if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT id_rb, dist_rb, rss_rb, ip_rb, id_pmi, id_sector ";
    $sql.=" FROM radiobase";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR id_sector LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ip_rb LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {

    $sql = "SELECT id_rb, dist_rb, rss_rb, ip_rb, id_pmi, id_sector ";
    $sql.=" FROM radiobase";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array


    $nestedData=array();
    $nestedData[] = $row["id_pmi"];//0
    $nestedData[] = $row["id_sector"];//1
    $nestedData[] = $row["ip_rb"];//2
    $nestedData[] = $row["dist_rb"];//3
    $nestedData[] = $row["rss_rb"];//4
    $nestedData[] = $row["id_rb"];//5
    $nestedData[] = '<td><center>
                     <a href="updateRB.php?id='.$row['id_rb'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showRB.php?action=delete&id='.$row['id_rb'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';//6

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