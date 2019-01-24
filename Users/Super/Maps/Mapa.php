<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - PMI</title>
</head>

<body id="page-top">
<?php
include("../../../caducarSesion.php");
include("../../../SGBD/Connector.php");
include("../include/navbar.php");
?>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Información</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="../User/showUser.php">Usuarios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="../PMI/showPMI.php">PMI</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Camera/showCamera.php">Cámaras</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Switch/showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Boton/showBoton.php">Botones</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Poste/showPoste.php">Postes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../RadioBase/showRB.php">Radiobases</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Sitio/showSitio.php">Sitios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Suscriptor/showSuscriptor.php">Suscriptores</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Busqueda/search.php">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
    </ul>

    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active">PMI</li>
            </ol>

            <!-- Tabla mostrar usuarios-->
            <div id="map" style="width:100%;height:70vh; position: relative;"></div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <?php
    include("../include/footer.php")
    ?>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<!-- Logout Modal-->
<!-- Scripts-->
<?php
include("../include/scroll.php");
include("../include/logoutModal.php");
include("../include/scripts.php");
?>

<script>
    var map;
    let locationsInfo;


    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 20.6777639, lng: -103.3822003},
            zoom: 10
        });

        var script = document.createElement('script');
        script.src = 'GeoJson.php';
        document.getElementsByTagName('head')[0].appendChild(script);

    }

    window.eqfeed_callback = function(results) {
        var infowindow;
        for (var i = 0; i < results.features.length; i++) {
            var coords = results.features[i].geometry.coordinates;
            var latLng = new google.maps.LatLng(coords[1],coords[0]);
            var nombre = results.features[i].properties.nombre;
            var numcam = results.features[i].properties.num_cam;
            var camaras = results.features[i].properties.camaras;;

            var marker = new google.maps.Marker({
                position: latLng,
                title: String(nombre),
                numcam: numcam,
                camaras: camaras,
                map: map,
            });

            google.maps.event.addListener(marker, 'click', function() {
                if (infowindow) {
                    infowindow.close();
                };
                makecontent(this);
            });
            google.maps.event.addListener(map, 'click', function() {
                if (infowindow) {
                    infowindow.close();
                };
            });
        }

        var contentString;
        function makecontent(marker) {

            contentString =
                '<h6>' + marker.title + '</h6>';
            for (j=0;j<marker.numcam;j++){
                contentString += '<b>' + marker.camaras[j] + '</b><br>';
            }
            contentString += '<a href="../Busqueda/search.php?id_pmi='+String(marker.title)+'" class="" > Mas detalles </a>';

            infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 150
            });
            infowindow.open(map, marker);
        }

    }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl6mfoS8AE5woNLZSUdmVN5ZrSjM1WVn4&callback=initMap">
</script>



</body>

</html>
