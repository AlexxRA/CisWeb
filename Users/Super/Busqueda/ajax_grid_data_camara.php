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
    3 => 'ip_cam',
    2 => 'tipo',
    1=> 'nom_cam',
    4=> 'firmware',
    5=> 'fecha_inst',
    0=> 'id_pmi'
);

$sql = "SELECT ns_cam, ip_cam, id_cam, tipo, num_cam, dir_cam, ori_cam, inc_cam, nom_cam, rec_server, id_device, firmware, import_file, user_cam, pass_cam, fecha_inst, id_pmi ";
$sql.=" FROM camara WHERE id_pmi LIKE '".$pmiForm."'";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data_camara.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


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

    switch ($row["import_file"]){
        case 1:
            $imp_f="Si";
            break;
        case 0:
            $imp_f="No";
            break;

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
                     <a data-toggle="tooltip" title="Detalles" class="btn btn-sm btn-outline-success"> <i class="fa fa-fw fa-plus"></i> </a>
				     </center></td>';

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