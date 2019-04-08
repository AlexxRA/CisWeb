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
    0 => 'id_pmi',
    1 => 'id_rb',
    2=> 'ns_sus',
    3=> 'ip_sus',
    4=> 'mac_sus',
    5=> 'azimuth',
    6=> 'rss_sus'
);


$sql = "SELECT suscriptor.ns_sus, suscriptor.ip_sus,  suscriptor.id_vlan, suscriptor.mac_sus, suscriptor.azimuth, suscriptor.rss_sus, suscriptor.id_pmi, suscriptor.id_rb, radiobase.sector, sitio.nom, comentarios.comentario, comentarios.usuario, comentarios.fecha ";
$sql.=" FROM suscriptor";
$sql.=" INNER JOIN radiobase ON suscriptor.id_rb = radiobase.id_rb";
$sql.=" INNER JOIN sitio ON sitio.id_sitio = radiobase.id_sitio";
$sql.=" LEFT JOIN comentarios ON suscriptor.ns_sus = comentarios.identificador and comentarios.tabla= 'suscriptor'";
$sql.=" WHERE suscriptor.id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data_sus.php: get InventoryItems");
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
    $nestedData=array();
    $nestedData[] = $row["ns_sus"];//0
    $nestedData[] = $row["ip_sus"];//1
    $nestedData[] = $row["mac_sus"];//2
    $nestedData[] = $row["azimuth"];//3
    $nestedData[] = $row["rss_sus"];//4
    $nestedData[] = $row["id_pmi"];//5
    $nestedData[] = $row["id_rb"];//6
    $nestedData[] = $row["sector"];//7
    $nestedData[] = $row["nom"];//8
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