<?php
session_start();
if ($_SESSION["autentificado"] != "SI") {
    echo "<script>window.location='http://localhost/CisWeb/index.php';</script>";
}
else {
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

    if($tiempo_transcurrido >= 3000) {
        session_destroy();
        echo "<script>window.location='http://localhost/CisWeb/index.php';</script>";
    }
    else{
        $_SESSION["ultimoAcceso"] = $ahora;
    }
}
?>