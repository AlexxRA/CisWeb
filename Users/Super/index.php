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
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">
  <?php include("../../caducarSesion.php"); ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Menú</a>

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
            <a class="dropdown-item" href="User/showUser.php">Usuarios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="PMI/showPMI.php">PMI</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Camera/showCamera.php">Cámaras</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Switch/showSwitch.php">Switch</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Boton/showBoton.php">Botones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Poste/showPoste.php">Postes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="RadioBase/showRB.php">Radiobases</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Sitio/showSitio.php">Sitios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Sector/showSector.php">Sectores</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Suscriptor/showSuscriptor.php">Suscriptores</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Busqueda/search.php">
            <i class="fas fa-fw fa-search"></i>
            <span>Búsqueda</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Inicio</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26 New Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myBarChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer-->
      <?php
        include ("include/footer.php");
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
            <a class="btn btn-primary" href="cerrarSesion.php">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="../../js/demo/chart-area-demo.js"></script>
  <script src="../../js/demo/chart-bar-demo.js"></script>
  <script src="../../js/demo/chart-pie-demo.js"></script>

  </body>

</html>
