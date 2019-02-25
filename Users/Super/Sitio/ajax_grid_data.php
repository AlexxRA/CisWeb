<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_sitio',
    1 => 'nom',
    2=> 'vlan',
    3=> 'colonia',
    4=> 'municipio'
);

$sql = "SELECT sitio.id_sitio, sitio.nom, sitio.vlan, sitio.calle, sitio.cruce, sitio.colonia, sitio.municipio, sitio.latitud, sitio.longitud, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM sitio";
$sql.=" LEFT JOIN comentarios ON sitio.id_sitio = comentarios.identificador and comentarios.tabla= 'sitio'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT sitio.id_sitio, sitio.nom, sitio.vlan, sitio.calle, sitio.cruce, sitio.colonia, sitio.municipio, sitio.latitud, sitio.longitud, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM sitio";
    $sql.=" LEFT JOIN comentarios ON sitio.id_sitio = comentarios.identificador and comentarios.tabla= 'sitio'";
    $sql.=" WHERE id_sitio LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR nom LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR vlan LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR calle LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR cruce LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR colonia LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR municipio LIKE '%".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT sitio.id_sitio, sitio.nom, sitio.vlan, sitio.calle, sitio.cruce, sitio.colonia, sitio.municipio, sitio.latitud, sitio.longitud, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
    $sql.=" FROM sitio";
    $sql.=" LEFT JOIN comentarios ON sitio.id_sitio = comentarios.identificador and comentarios.tabla= 'sitio'";
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
    $nestedData[] = $row["id_sitio"];//0
    $nestedData[] = $row["nom"];//1
    $nestedData[] = $row["vlan"];//2
    $nestedData[] = $row["calle"];//3
    $nestedData[] = $row["cruce"];//4
    $nestedData[] = $row["colonia"];//5
    $nestedData[] = $row["municipio"];//6
    $nestedData[] = $row["latitud"];//7
    $nestedData[] = $row["longitud"];//8
    $nestedData[] = '<td><center>
                     <a href="updateSitio.php?id='.$row['id_sitio'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-outline-info"> <i class="fa fa-fw fa-pencil-alt"></i> </a>
                     <a href="showSitio.php?action=delete&id='.$row['id_sitio'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirmarEliminar();"> <i class="fa fa-fw fa-trash"></i> </a>
				     </center></td>';//9
    $nestedData[] = $com;//10
    $nestedData[] = $usu;//11
    $nestedData[] = $fecha;//12

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