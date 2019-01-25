<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DB Admin - Super usuario</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<?php include("../../../caducarSesion.php"); ?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">Menú</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->


    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
                <i><?php echo $_SESSION["name"] ?></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
            </div>
        </li>
    </ul>

</nav>

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
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Busqueda/search.php">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="generarReporte.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Reportes</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Inicio</li>
            </ol>

            <!-- Generar reporte a Excel-->
            <div class="card mx-auto mb-5">
                <div class="card-header">Generar reporte</div>
                <div class="card-body">
                    <form action="generarReporteP.php" method="post" name="formReporte" id="formReporte">
                        <div class="form-group">
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
                                <input class="form-check-input" type="checkbox" id="longitud" value="longitud" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Orientacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="municipio" value="municipio" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Inclinacion</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Nombre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Rec. Server</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">ID Device</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Firmware</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">VMS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">User</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Password</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="num_cam" value="num_cam" name="camaras[]">
                                <label class="form-check-label" for="inlineCheckbox3">Fecha instalacion</label>
                            </div>
                        </div>

                        <div class="form-group">
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
                                <input class="form-check-input" type="checkbox" id="ns_ups" value="ns_ups" name="postes[]">
                                <label class="form-check-label" for="ns_ups">No. serie UPS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ns_gabinete" value="ns_gabinete" name="postes[]">
                                <label class="form-check-label" for="ns_gabinete">No. serie gabinete</label>
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
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecciona "Cerrar sesión" si estás listo para salir</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="../cerrarSesion.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../../../vendor/chart.js/Chart.min.js"></script>
<script src="../../../vendor/datatables/jquery.dataTables.js"></script>
<script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="../../../js/demo/datatables-demo.js"></script>
<script src="../../../js/demo/chart-area-demo.js"></script>
<script src="../../../js/demo/chart-bar-demo.js"></script>
<script src="../../../js/demo/chart-pie-demo.js"></script>

</body>

</html>