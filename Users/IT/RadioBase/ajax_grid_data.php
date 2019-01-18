<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_rb',
    1 => 'sector',
    2=> 'nom',
    3 => 'ip_rb',
    4 => 'dist_rb',
    5 => 'rss_rb'
);

$sql = "SELECT radiobase.id_rb, radiobase.dist_rb, radiobase.rss_rb, radiobase.ip_rb, radiobase.sector,  radiobase.id_sitio, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha";
$sql.=" FROM radiobase";
$sql.=" INNER JOIN sitio ON radiobase.id_sitio = sitio.id_sitio";
$sql.=" LEFT JOIN comentarios ON radiobase.id_rb = comentarios.identificador and comentarios.tabla= 'radiobase'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT radiobase.id_rb, radiobase.dist_rb, radiobase.rss_rb, radiobase.ip_rb, radiobase.sector,  radiobase.id_sitio, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha";
    $sql.=" FROM radiobase";
    $sql.=" INNER JOIN sitio ON radiobase.id_sitio = sitio.id_sitio";
    $sql.=" LEFT JOIN comentarios ON radiobase.id_rb = comentarios.identificador and comentarios.tabla= 'radiobase'";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR id_sector LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ip_rb LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT radiobase.id_rb, radiobase.dist_rb, radiobase.rss_rb, radiobase.ip_rb, radiobase.sector,  radiobase.id_sitio, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha";
    $sql.=" FROM radiobase";
    $sql.=" INNER JOIN sitio ON radiobase.id_sitio = sitio.id_sitio";
    $sql.=" LEFT JOIN comentarios ON radiobase.id_rb = comentarios.identificador and comentarios.tabla= 'radiobase'";
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
    $nestedData[] = $row["sector"];//0
    $nestedData[] = $row["id_sitio"];//1
    $nestedData[] = $row["ip_rb"];//2
    $nestedData[] = $row["dist_rb"];//3
    $nestedData[] = $row["rss_rb"];//4
    $nestedData[] = $row["id_rb"];//5
    $nestedData[] = $row["nom"];//6
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