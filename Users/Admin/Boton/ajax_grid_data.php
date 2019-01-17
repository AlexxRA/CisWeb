<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0=> 'id_pmi',
    1=> 'ext',
    2 => 'ip_bt',
    3 => 'mac_bt',
    4=> 'fecha_inst'
);

$sql = "SELECT boton.ext, boton.ip_bt, boton.mac_bt, boton.fecha_inst, boton.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM boton";
$sql.=" LEFT JOIN comentarios ON boton.ext = comentarios.identificador and comentarios.tabla = 'boton'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT boton.ext, boton.ip_bt, boton.mac_bt, boton.fecha_inst, boton.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM boton";
    $sql.=" LEFT JOIN comentarios ON boton.ext = comentarios.identificador and comentarios.tabla = 'boton'";
    $sql.=" WHERE ext LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ip_bt LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR mac_bt LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR id_pmi LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT boton.ext, boton.ip_bt, boton.mac_bt, boton.fecha_inst, boton.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM boton";
    $sql.=" LEFT JOIN comentarios ON boton.ext = comentarios.identificador and comentarios.tabla = 'boton'";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
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

    $nestedData=array();
    $nestedData[] = $row["ext"];//0
    $nestedData[] = $row["ip_bt"];//1
    $nestedData[] = $row["mac_bt"];//2
    $nestedData[] = $row["fecha_inst"];//3
    $nestedData[] = $row["id_pmi"];//4
    $nestedData[] = '<td><center>
                     <a href="updateBoton.php?id='.$row['ext'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showBoton.php?action=delete&id='.$row['ext'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger"> <i class="fa fa-fw fa-trash"></i> </a>
				    
				     </center></td>';//5
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