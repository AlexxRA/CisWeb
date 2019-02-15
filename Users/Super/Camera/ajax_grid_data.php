<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");
$conn->set_charset("utf8");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    3 => 'ip_cam',
    2 => 'tipo',
    1=> 'nom_cam',
    4=> 'firmware',
    5=> 'fecha_inst',
    0=> 'id_pmi'
);

$sql = "SELECT camara.ns_cam, camara.ip_cam, camara.id_cam, camara.tipo, camara.num_cam, camara.dir_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM camara";
$sql.=" LEFT JOIN comentarios ON camara.ns_cam = comentarios.identificador and comentarios.tabla = 'camara'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT camara.ns_cam, camara.ip_cam, camara.id_cam, camara.tipo, camara.num_cam, camara.dir_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM camara";
    $sql.=" LEFT JOIN comentarios ON camara.ns_cam = comentarios.identificador and comentarios.tabla = 'camara'";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ip_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nom_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ns_cam LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT camara.ns_cam, camara.ip_cam, camara.id_cam, camara.tipo, camara.num_cam, camara.dir_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM camara";
    $sql.=" LEFT JOIN comentarios ON camara.ns_cam = comentarios.identificador and comentarios.tabla = 'camara'";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    switch ($row["tipo"]){
        case "F":
            $tipo="Fija";
            break;
        case "P":
            $tipo="PTZ";
            break;
        case "A":
            $tipo="Analítica";
            break;
    }

    switch ($row["vms"]){
        case 1:
            $imp_f="Si";
            break;
        case 0:
            $imp_f="No";
            break;

    }
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
    $nestedData[] = $row["ns_cam"];//0
    $nestedData[] = $row["ip_cam"];
    $nestedData[] = $row["id_cam"];//2
    $nestedData[] = $tipo;
    $nestedData[] = $row["num_cam"];//4
    $nestedData[] = $row["dir_cam"];//5
    $nestedData[] = $row["ori_cam"];//6
    $nestedData[] = $row["inc_cam"];//7
    $nestedData[] = $row["nom_cam"];
    $nestedData[] = $row["rec_server"];//9
    $nestedData[] = $row["id_device"];//10
    $nestedData[] = $row["firmware"];
    $nestedData[] = $imp_f;
    $nestedData[] = $row["user_cam"];//13
    $nestedData[] = $row["pass_cam"];//14
    $nestedData[] = $row["fecha_inst"];
    $nestedData[] = $row["id_pmi"];
    $nestedData[] = '<td><center>
                     <a href="updateCamera.php?id='.$row['ns_cam'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showCamera.php?action=delete&id='.$row['ns_cam'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';
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