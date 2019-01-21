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
            <div id="map" style="width:100%;height:500px;"></div>

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
    function initMap() {
        var map;
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 20.6777639, lng: -103.3822003},
            zoom: 15
        });

        var marker = new google.maps.Marker({
            position: {lat: 20.6777639, lng: -103.3822003},
            map: map,
            title: 'Hello World!'
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuBEidKGDuQo7Bzf1uRg47MPaRRlEesw0&callback=initMap">
</script>


</body>

</html>
