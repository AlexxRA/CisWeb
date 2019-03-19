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
    1=> 'ip_sw',
    2 => 'tipo',
    3 => 'conexion',
    4=> 'fecha_inst'
);

/*$sql = "SELECT switch.ns_sw, switch.mac_sw, switch.ip_sw, switch.tipo, switch.conexion, switch.fecha_inst, switch.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM switch";
$sql.=" LEFT JOIN comentarios ON switch.ns_sw= comentarios.identificador and comentarios.tabla = 'switch'";*/
$sql = "SELECT switch.ns_sw, switch.mac_sw, switch.id_vlan, switch.ip_sw, switch.tipo, switch.conexion, switch.fecha_inst, switch.id_pmi, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM switch";
$sql.=" LEFT JOIN comentarios ON switch.ns_sw= comentarios.identificador and comentarios.tabla = 'switch'";
$sql.=" WHERE switch.id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data_switch.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

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

    $nestedData[] = $com;
    $nestedData[] = $usu;
    $nestedData[] = $fecha;
    $nestedData[] = $row["id_vlan"];

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