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

$sql = "SELECT camara.ns_cam, camara.ip_cam, camara.mac_cam, camara.tipo, camara.num_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM camara";
$sql.=" LEFT JOIN comentarios ON camara.ns_cam = comentarios.identificador and comentarios.tabla = 'camara'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT camara.ns_cam, camara.ip_cam, camara.mac_cam, camara.tipo, camara.num_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM camara";
    $sql.=" LEFT JOIN comentarios ON camara.ns_cam = comentarios.identificador and comentarios.tabla = 'camara'";
    $sql.=" WHERE id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR ip_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nom_cam LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR ns_cam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR firmware LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR fecha_inst LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT camara.ns_cam, camara.ip_cam, camara.mac_cam, camara.tipo, camara.num_cam, camara.ori_cam, camara.inc_cam, camara.nom_cam, camara.rec_server, camara.id_device, camara.firmware, camara.vms, camara.user_cam, camara.pass_cam, camara.fecha_inst, camara.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
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
    $orientacion=$row["ori_cam"];

    if ($orientacion>=0 && $orientacion<22.5){
        $direccion="Norte";
    }
    else if($orientacion>=22.5 && $orientacion<67.5){
        $direccion="Noreste";
    }
    else if($orientacion>=67.5 && $orientacion<112.5){
        $direccion="Este";
    }
    else if($orientacion>=112.5 && $orientacion<157.5){
        $direccion="Sureste";
    }
    else if($orientacion>=157.5 && $orientacion<202.5){
        $direccion="Sur";
    }
    else if($orientacion>=202.5 && $orientacion<247.5){
        $direccion="Suroeste";
    }
    else if($orientacion>=247.5 && $orientacion<292.5){
        $direccion="Oeste";
    }
    else if($orientacion>=292.5 && $orientacion<337.5){
        $direccion="Noroeste";
    }
    else if($orientacion>=337.5 && $orientacion<=360){
        $direccion="Norte";
    }

    $nestedData=array();
    $nestedData[] = $row["ns_cam"];//0
    $nestedData[] = $row["ip_cam"];//1
    //$nestedData[] = $row["id_cam"];
    $nestedData[] = $tipo;//2
    $nestedData[] = $row["num_cam"];//3
    $nestedData[] = $direccion;//4
    $nestedData[] = $row["ori_cam"];//5
    $nestedData[] = $row["inc_cam"];//6
    $nestedData[] = $row["nom_cam"];//7
    $nestedData[] = $row["rec_server"];//8
    $nestedData[] = $row["id_device"];//9
    $nestedData[] = $row["firmware"];//10
    $nestedData[] = $imp_f;//11
    $nestedData[] = $row["user_cam"];//12
    $nestedData[] = $row["pass_cam"];//13
    $nestedData[] = $row["fecha_inst"];//14
    $nestedData[] = $row["id_pmi"];//15
    $nestedData[] = '<td><center>
                     <a href="updateCamera.php?id='.$row['ns_cam'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showCamera.php?action=delete&id='.$row['ns_cam'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirmarEliminar();"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';//16
    $nestedData[] = $com;//17
    $nestedData[] = $usu;//18
    $nestedData[] = $fecha;//19
    $nestedData[] = $row["mac_cam"];//20
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