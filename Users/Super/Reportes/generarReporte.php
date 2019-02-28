<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Reportes</title>
</head>

<body id="page-top">
<?php include("../../../caducarSesion.php");
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
                <a class="dropdown-item" href="../PMI/showPMI.php">PMI</a>
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
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Municipio/showMunicipio.php">Municipios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Vlan/showVlan.php">VLANs</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../ServidoresG/showServidorG.php">Servidores</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Busqueda/search.php">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Reportes/generarReporte.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Reportes</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Maps/Mapa.php">
                <i class="fas fa-fw fa-map"></i>
                <span>Mapas</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active">Generar reporte</li>
            </ol>

            <!-- Generar reporte a Excel-->
            <div class="card mx-auto mb-5">
                <div class="card-header">Generar reporte</div>
                <div class="card-body">
                    <form action="generarReporteP.php" method="post" name="formReporte" id="formReporte">
                        <div class="form-group ">
                            <h3>Nombre del archivo</h3>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-label-group">
                                        <input type="text" id="nombreArchivo" name="nombreArchivo" class="form-control"
                                               placeholder="Nombre del archivo" required>
                                        <label for="nombreArchivo">Nombre del archivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>PMI</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="id_pmi" name="pmi[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="calle" name="pmi[]">
                                <label class="form-check-label" for="calle">Calle</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="cruce" name="pmi[]">
                                <label class="form-check-label" for="cruce">Cruce</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="colonia" name="pmi[]">
                                <label class="form-check-label" for="colonia">Colonia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="coordX" name="pmi[]">
                                <label class="form-check-label" for="coordX">X</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="coordY" name="pmi[]">
                                <label class="form-check-label" for="coordY">Y</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="latitud" name="pmi[]">
                                <label class="form-check-label" for="latitud">Latitud</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"  value="longitud" name="pmi[]">
                                <label class="form-check-label" for="longitud">Longitud</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="municipio" name="pmi[]">
                                <label class="form-check-label" for="municipio">Municipio</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="num_cam" name="pmi[]">
                                <label class="form-check-label" for="num_cam">No. Camaras</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Camaras</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_pmi" value="id_pmi" name="camaras[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_cam" value="ns_cam" name="camaras[]">
                                <label class="form-check-label" for="ns_cam">No. Serie</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ip_cam" value="ip_cam" name="camaras[]">
                                <label class="form-check-label" for="ip_cam">IP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_cam" value="id_cam" name="camaras[]">
                                <label class="form-check-label" for="id_cam">ID</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tipo" value="tipo" name="camaras[]">
                                <label class="form-check-label" for="tipo">Tipo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="num_cam">No. Camara</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="dir_cam" value="dir_cam" name="camaras[]">
                                <label class="form-check-label" for="dir_cam">Direccion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ori_cam" value="ori_cam" name="camaras[]">
                                <label class="form-check-label" for="ori_cam">Orientacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inc_cam" value="inc_cam" name="camaras[]">
                                <label class="form-check-label" for="inc_cam">Inclinacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="nom_cam" value="nom_cam" name="camaras[]">
                                <label class="form-check-label" for="nom_cam">Nombre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="rec_server" value="rec_server" name="camaras[]">
                                <label class="form-check-label" for="rec_server">Rec. Server</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_device" value="id_device" name="camaras[]">
                                <label class="form-check-label" for="id_device">ID Device</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="firmware" value="firmware" name="camaras[]">
                                <label class="form-check-label" for="firmware">Firmware</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="vms" value="vms" name="camaras[]">
                                <label class="form-check-label" for="vms">VMS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="user_cam" value="user_cam" name="camaras[]">
                                <label class="form-check-label" for="user_cam">User</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="pass_cam" value="pass_cam" name="camaras[]">
                                <label class="form-check-label" for="pass_cam">Password</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_inst" value="fecha_inst" name="camaras[]">
                                <label class="form-check-label" for="fecha_inst">Fecha instalacion</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Postes</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_pmi" value="id_pmi" name="postes[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="altura" value="altura" name="postes[]">
                                <label class="form-check-label" for="altura">Altura</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_mont" value="fecha_mont" name="postes[]">
                                <label class="form-check-label" for="fecha_mont">Fecha montaje</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_base" value="fecha_base" name="postes[]">
                                <label class="form-check-label" for="fecha_base">Fecha base</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_elect" value="fecha_elect" name="postes[]">
                                <label class="form-check-label" for="fecha_elect">Fecha electrificacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_asign" value="fecha_asign" name="postes[]">
                                <label class="form-check-label" for="fecha_asign">Fecha asignacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contratista" value="contratista" name="postes[]">
                                <label class="form-check-label" for="contratista">Contratista</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_ups" value="ns_ups" name="postes[]">
                                <label class="form-check-label" for="ns_ups">No. serie UPS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_gabinete" value="ns_gabinete" name="postes[]">
                                <label class="form-check-label" for="ns_gabinete">No. serie gabinete</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Switches</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_pmi" value="id_pmi" name="switches[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_sw" value="ns_sw" name="switches[]">
                                <label class="form-check-label" for="ns_sw">No. serie</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="mac_sw" value="mac_sw" name="switches[]">
                                <label class="form-check-label" for="mac_sw">Direccion MAC</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ip_sw" value="ip_sw" name="switches[]">
                                <label class="form-check-label" for="ip_sw">IP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tipo" value="tipo" name="switches[]">
                                <label class="form-check-label" for="tipo">Tipo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="conexion" value="conexion" name="switches[]">
                                <label class="form-check-label" for="conexion">Conexion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_inst" value="fecha_inst" name="switches[]">
                                <label class="form-check-label" for="fecha_inst">Fecha instalacion</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Botones</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_pmi" value="id_pmi" name="botones[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ext" value="ext" name="botones[]">
                                <label class="form-check-label" for="ext">Extension</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="mac_bt" value="mac_bt" name="botones[]">
                                <label class="form-check-label" for="mac_bt">Direccion MAC</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ip_bt" value="ip_bt" name="botones[]">
                                <label class="form-check-label" for="ip_bt">IP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="fecha_inst" value="fecha_inst" name="botones[]">
                                <label class="form-check-label" for="fecha_inst">Fecha instalacion</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Suscriptores</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_pmi" value="id_pmi" name="suscriptores[]">
                                <label class="form-check-label" for="id_pmi">ID PMI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_sus" value="ns_sus" name="suscriptores[]">
                                <label class="form-check-label" for="ns_sus">No. serie</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="mac_sus" value="mac_sus" name="suscriptores[]">
                                <label class="form-check-label" for="mac_sus">Direccion MAC</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ip_sus" value="ip_sus" name="suscriptores[]">
                                <label class="form-check-label" for="ip_sus">IP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="azimuth" value="azimuth" name="suscriptores[]">
                                <label class="form-check-label" for="azimuth">Azimuth</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="rss_sus" value="rss_sus" name="suscriptores[]">
                                <label class="form-check-label" for="rss_sus">RSS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_rb" value="id_rb" name="suscriptores[]">
                                <label class="form-check-label" for="id_rb">ID Radiobase</label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <h3>Radiobases</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_rb" value="id_rb" name="radiobases[]">
                                <label class="form-check-label" for="id_rb">ID Radiobase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="dist_rb" value="dist_rb" name="radiobases[]">
                                <label class="form-check-label" for="dist_rb">Dist</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="rss_rb" value="rss_rb" name="radiobases[]">
                                <label class="form-check-label" for="rss_rb">RSS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ip_rb" value="ip_rb" name="radiobases[]">
                                <label class="form-check-label" for="ip_rb">IP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="sector" value="sector" name="radiobases[]">
                                <label class="form-check-label" for="sector">Sector</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_sitio" value="id_sitio" name="radiobases[]">
                                <label class="form-check-label" for="id_sitio">ID Sitio</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <h3>Sitios</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="id_sitio" value="id_sitio" name="sitios[]">
                                <label class="form-check-label" for="id_sitio">ID Sitio</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="nom" value="nom" name="sitios[]">
                                <label class="form-check-label" for="nom">Nombre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="vlan" value="vlan" name="sitios[]">
                                <label class="form-check-label" for="vlan">VLAN</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="calle" value="calle" name="sitios[]">
                                <label class="form-check-label" for="calle">Calle</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="cruce" value="cruce" name="sitios[]">
                                <label class="form-check-label" for="cruce">Cruce</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="colonia" value="colonia" name="sitios[]">
                                <label class="form-check-label" for="colonia">Colonia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="municipio" value="municipio" name="sitios[]">
                                <label class="form-check-label" for="municipio">Municipio</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="latitud" value="latitud" name="sitios[]">
                                <label class="form-check-label" for="latitud">Latitud</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="longitud" value="longitud" name="sitios[]">
                                <label class="form-check-label" for="longitud">Longitud</label>
                            </div>
                        </div>




                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Generar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Footer-->
<?php
include ("../include/footer.php");
?>


<!-- Scroll to Top Button-->
<!-- Logout Modal-->
<!-- Scripts-->
<?php
include("../include/scroll.php");
include("../include/logoutModal.php");
include ("../include/scripts.php");
?>

</body>

</html>
