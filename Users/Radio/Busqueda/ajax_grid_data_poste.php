<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "cis_db");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$pmiForm="1";
if ($_POST["pmi"] != "") {
    $pmiForm = $_POST["pmi"];
} else {
    $pmiForm = "1";
}
$columns = array(
// datatable column index  => database column name
    1 => 'ns_poste',
    2 => 'altura',
    3=> 'contratista',
    4=> 'fecha_asign',
);

$sql = "SELECT poste.ns_poste, poste.altura, poste.fecha_mont, poste.fecha_elect, poste.fecha_base, poste.contratista, poste.fecha_asign, poste.ns_ups, poste.ns_gabinete, poste.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM poste";
$sql.=" LEFT JOIN comentarios ON poste.ns_poste = comentarios.identificador and comentarios.tabla = 'poste'";
$sql.=" WHERE poste.id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data_poste.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


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

    if ($row["fecha_mont"]=="0000-00-00")
        $fecha_mont="No asignado";
    else
        $fecha_mont=$row["fecha_mont"];

    if ($row["fecha_elect"]=="0000-00-00")
        $fecha_elect="No asignado";
    else
        $fecha_elect=$row["fecha_elect"];

    if ($row["fecha_base"]=="0000-00-00")
        $fecha_base="No asignado";
    else
        $fecha_base=$row["fecha_base"];

    $nestedData=array();
    $nestedData[] = $row["ns_poste"];
    $nestedData[] = $row["altura"];
    $nestedData[] = $fecha_mont;//2
    $nestedData[] = $fecha_elect;//3
    $nestedData[] = $fecha_base;//4
    $nestedData[] = $row["contratista"];
    $nestedData[] = $row["fecha_asign"];
    $nestedData[] = $row["ns_ups"];//7
    $nestedData[] = $row["ns_gabinete"];//8
    $nestedData[] = $row["id_pmi"];
    $nestedData[] = $com;
    $nestedData[] = $usu;
    $nestedData[] = $fecha;

    $data[] = $nestedData;

}

$json_data = array(
    //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    //"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>