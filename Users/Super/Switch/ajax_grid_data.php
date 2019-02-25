<?php
    session_start();
//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0=> 'id_pmi',
    1=> 'ip_sw',
    2 => 'tipo',
    3 => 'conexion',
    4=> 'fecha_inst'
);

$sql = "SELECT switch.ns_sw, switch.mac_sw, switch.ip_sw, switch.tipo, switch.conexion, switch.fecha_inst, switch.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM switch";
$sql.=" LEFT JOIN comentarios ON switch.ns_sw= comentarios.identificador and comentarios.tabla = 'switch'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT switch.ns_sw, switch.mac_sw, switch.ip_sw, switch.tipo, switch.conexion, switch.fecha_inst, switch.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM switch";
    $sql.=" LEFT JOIN comentarios ON switch.ns_sw= comentarios.identificador and comentarios.tabla = 'switch'";
    $sql.=" WHERE ip_sw LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR tipo LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR id_pmi LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR mac_sw LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ns_sw LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR conexion LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT switch.ns_sw, switch.mac_sw, switch.ip_sw, switch.tipo, switch.conexion, switch.fecha_inst, switch.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM switch";
    $sql.=" LEFT JOIN comentarios ON switch.ns_sw= comentarios.identificador and comentarios.tabla = 'switch'";
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
    $nestedData[] = $row["ns_sw"];//0
    $nestedData[] = $row["mac_sw"];//1
    $nestedData[] = $row["ip_sw"];
    $nestedData[] = $row["tipo"];
    $nestedData[] = $row["conexion"];
    $nestedData[] = $row["fecha_inst"];
    $nestedData[] = $row["id_pmi"];
    if($_SESSION["type"]=="super"){
        $nestedData[] = '<td><center>
                     <a href="updateSwitch.php?id='.$row['ns_sw'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showSwitch.php?action=delete&id='.$row['ns_sw'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirmarEliminar();"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';
    }
    else{
        $nestedData[] = '<td><center>
                     <a href="updateSwitch.php?id='.$row['ns_sw'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
				     </center></td>';
    }

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