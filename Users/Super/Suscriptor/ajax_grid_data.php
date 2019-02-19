<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_pmi',
    1 => 'id_rb',
    2=> 'ns_sus',
    3=> 'ip_sus',
    4=> 'mac_sus',
    5=> 'azimuth',
    6=> 'rss_sus'
);

$sql = "SELECT suscriptor.ns_sus, suscriptor.ip_sus, suscriptor.mac_sus, suscriptor.azimuth, suscriptor.rss_sus, suscriptor.id_pmi, suscriptor.id_rb, radiobase.sector, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM suscriptor";
$sql.=" INNER JOIN radiobase ON suscriptor.id_rb = radiobase.id_rb";
$sql.=" INNER JOIN sitio ON sitio.id_sitio = radiobase.id_sitio";
$sql.=" LEFT JOIN comentarios ON suscriptor.ns_sus = comentarios.identificador and comentarios.tabla= 'suscriptor'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT suscriptor.ns_sus, suscriptor.ip_sus, suscriptor.mac_sus, suscriptor.azimuth, suscriptor.rss_sus, suscriptor.id_pmi, suscriptor.id_rb, radiobase.sector, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM suscriptor";
    $sql.=" INNER JOIN radiobase ON suscriptor.id_rb = radiobase.id_rb";
    $sql.=" INNER JOIN sitio ON sitio.id_sitio = radiobase.id_sitio";
    $sql.=" LEFT JOIN comentarios ON suscriptor.ns_sus = comentarios.identificador and comentarios.tabla= 'suscriptor'";
    $sql.=" WHERE ns_sus LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ip_sus LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR id_pmi LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT suscriptor.ns_sus, suscriptor.ip_sus, suscriptor.mac_sus, suscriptor.azimuth, suscriptor.rss_sus, suscriptor.id_pmi, suscriptor.id_rb, radiobase.sector, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM suscriptor";
    $sql.=" INNER JOIN radiobase ON suscriptor.id_rb = radiobase.id_rb";
    $sql.=" INNER JOIN sitio ON sitio.id_sitio = radiobase.id_sitio";
    $sql.=" LEFT JOIN comentarios ON suscriptor.ns_sus = comentarios.identificador and comentarios.tabla= 'suscriptor'";
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
    $nestedData[] = $row["ns_sus"];//0
    $nestedData[] = $row["ip_sus"];//1
    $nestedData[] = $row["mac_sus"];//2
    $nestedData[] = $row["azimuth"];//3
    $nestedData[] = $row["rss_sus"];//4
    $nestedData[] = $row["id_pmi"];//5
    $nestedData[] = $row["id_rb"];//6
    $nestedData[] = '<td><center>
                     <a href="updateSuscriptor.php?id='.$row['ns_sus'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showSuscriptor.php?action=delete&id='.$row['ns_sus'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirmarEliminar();"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';//7
    $nestedData[] = $row["sector"];//8
    $nestedData[] = $row["nom"];//9
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