<?php
header("Content-Type: text/html;charset=utf-8");
//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");
$conn->set_charset("utf8");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_pmi',
    1 => 'calle',
    2 => 'cruce',
    3 => 'colonia',
    4=> 'municipio',
    5=> 'num_cam'
);

$sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.zona, pmi.id_municipio, COUNT(ns_cam) AS num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM pmi";
$sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";
$sql.=" LEFT JOIN camara";
$sql.=" ON pmi.id_pmi=camara.id_pmi";
$sql.=" GROUP BY pmi.id_pmi";

$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.zona, pmi.id_municipio, COUNT(ns_cam) AS num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM pmi";
    $sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";
    $sql.=" LEFT JOIN camara";
    $sql.=" ON pmi.id_pmi=camara.id_pmi";
    $sql.=" WHERE pmi.id_pmi LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR pmi.calle LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR pmi.cruce LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR pmi.municipio LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR pmi.colonia LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" GROUP BY pmi.id_pmi";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT pmi.id_pmi, pmi.calle, pmi.cruce, pmi.colonia, pmi.coordX, pmi.coordY, pmi.latitud, pmi.longitud, pmi.municipio, pmi.zona, pmi.id_municipio, COUNT(ns_cam) AS num_cam, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM pmi";
    $sql.=" LEFT JOIN comentarios ON pmi.id_pmi= comentarios.identificador and comentarios.tabla = 'pmi'";
    $sql.=" LEFT JOIN camara";
    $sql.=" ON pmi.id_pmi=camara.id_pmi";
    $sql.=" GROUP BY pmi.id_pmi";

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

    $nestedData[] = $row["id_pmi"];
    $nestedData[] = $row["calle"];
    $nestedData[] = $row["cruce"];
    $nestedData[] = $row["colonia"];
    $nestedData[] = $row["coordX"];
    $nestedData[] = $row["coordY"];
    $nestedData[] = $row["latitud"];
    $nestedData[] = $row["longitud"];
    $nestedData[] = $row["municipio"];
    $nestedData[] = $row["num_cam"];
    $nestedData[] = '<td><center>
                     <a href="updatePmi.php?id='.$row['id_pmi'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showPMI.php?action=delete&id='.$row['id_pmi'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirmarEliminar();"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';
    $nestedData[] = $com;
    $nestedData[] = $usu;
    $nestedData[] = $fecha;
    $nestedData[] = $row["zona"];

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