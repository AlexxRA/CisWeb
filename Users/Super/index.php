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
  <?php
      if($_SESSION){
          if ($_SESSION["type"] != "super") {
              echo "<script type='text/javascript'>";
              echo "window.history.back(-1)";
              echo "</script>";
          }
      }
  ?>

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
            <a class="dropdown-item" href="Suscriptor/showSuscriptor.php">Suscriptores</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Busqueda/search.php">
            <i class="fas fa-fw fa-search"></i>
            <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Reportes/generarReporte.php">
              <i class="fas fa-fw fa-book"></i>
              <span>Reportes</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Maps/Mapa.php">
              <i class="fas fa-fw fa-map"></i>
              <span>Mapas</span></a>
        </li>

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Inicio</li>
          </ol>

          <!-- Area Chart Example-->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            Camaras</div>
                        <div class="card-body">
                            <canvas id="Camarachart" width="100%" ></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            Botones</div>
                        <div class="card-body">
                            <canvas id="Botonchart" width="100%" ></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            PMI</div>
                        <div class="card-body">
                            <canvas id="PMIchart" width="100%" ></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
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

      <script>
          window.onload = function() {

              var registrados = [];
              var faltantes = [];
              var labels = [];

              var chartPMI = document.getElementById("PMIchart").getContext("2d");

              var PMILineChart = new Chart(chartPMI, {
                  type: 'bar',
                  options: {
                      scales: {
                          xAxes: [{
                              gridLines: {
                                  display: false
                              }
                          }],
                          yAxes: [{
                              ticks: {
                                  min: 0,
                                  maxTicksLimit: 5
                              },
                              gridLines: {
                                  display: true
                              }
                          }],
                      },
                      legend: {
                          display: true
                      }
                  },
                  data: {
                      labels: labels,
                      datasets: [{
                          label: ["Registrados "],
                          backgroundColor: "rgba(39,174,96,1)",
                          borderColor: "rgba(39,174,96,1)",
                          data: registrados,
                      },
                      {
                          label: ["Faltantes "],
                          backgroundColor: "rgba(189,195,199,1)",
                          borderColor: "rgba(189,195,199,1)",
                          data: faltantes,
                      }
                      ],
                  },
              });

              function addDataPMI(data) {
                  registrados.push({
                      y: data[0].registrados
                  });
                  faltantes.push({
                      y: data[0].faltantes
                  });
                  labels.push(
                      data[0].nombre
                  );
                  PMILineChart.render();

              }
              $.getJSON("ChartPMI.php", addDataPMI);


              var registradosCam = [];
              var faltantesCam = [];
              var caidosCam = [];
              var labelsCam = [];

              var chartCamara = document.getElementById("Camarachart").getContext("2d");
              var CamaraLineChart = new Chart(chartCamara, {
                  type: 'bar',
                  options: {
                      scales: {
                          xAxes: [{
                              gridLines: {
                                  display: false
                              }
                          }],
                          yAxes: [{
                              ticks: {
                                  min: 0,
                                  maxTicksLimit: 5
                              },
                              gridLines: {
                                  display: true
                              }
                          }],
                      },
                      legend: {
                          display: true
                      }
                  },
                  data: {
                      labels: labelsCam,
                      datasets: [{
                              label: ["Registrados "],
                              backgroundColor: "rgba(39,174,96,1)",
                              borderColor: "rgba(39,174,96,1)",
                              data: registradosCam,
                          },
                          {
                              label: ["Caidos "],
                              backgroundColor: "rgba(231,76,60,1)",
                              borderColor: "rgba(231,76,60,1)",
                              data: caidosCam,
                          },
                          {
                              label: ["Faltantes "],
                              backgroundColor: "rgba(189,195,199,1)",
                              borderColor: "rgba(189,195,199,1)",
                              data: faltantesCam,
                          }
                      ],
                  },
              });

              function addDataCamara(data) {
                  registradosCam.push({
                      y: data[0].registrados
                  });
                  faltantesCam.push({
                      y: data[0].faltantes
                  });
                  caidosCam.push({
                      y: data[0].caidos
                  });
                  labelsCam.push(
                      data[0].nombre
                  );
                  CamaraLineChart.render();
                  CamaraLineChart.render();

              }
              $.getJSON("ChartCamara.php", addDataCamara);

              var registradosBtn = [];
              var faltantesBtn = [];
              var caidosBtn = [];
              var labelsBtn = [];

              var chartBoton = document.getElementById("Botonchart").getContext("2d");
              var BotonLineChart = new Chart(chartBoton, {
                  type: 'bar',
                  options: {
                      scales: {
                          xAxes: [{
                              gridLines: {
                                  display: false
                              }
                          }],
                          yAxes: [{
                              ticks: {
                                  min: 0,
                                  maxTicksLimit: 5
                              },
                              gridLines: {
                                  display: true
                              }
                          }],
                      },
                      legend: {
                          display: true
                      }
                  },
                  data: {
                      labels: labelsBtn,
                      datasets: [{
                          label: ["Registrados "],
                          backgroundColor: "rgba(39,174,96,1)",
                          borderColor: "rgba(39,174,96,1)",
                          data: registradosBtn,
                      },
                          {
                              label: ["Caidos "],
                              backgroundColor: "rgba(231,76,60,1)",
                              borderColor: "rgba(231,76,60,1)",
                              data: caidosBtn,
                          },
                          {
                              label: ["Faltantes "],
                              backgroundColor: "rgba(189,195,199,1)",
                              borderColor: "rgba(189,195,199,1)",
                              data: faltantesBtn,
                          }
                      ],
                  },
              });

              function addDataBoton(data) {
                  registradosBtn.push({
                      y: data[0].registrados
                  });
                  faltantesBtn.push({
                      y: data[0].faltantes
                  });
                  caidosBtn.push({
                      y: data[0].caidos
                  });
                  labelsBtn.push(
                      data[0].nombre
                  );
                  BotonLineChart.render();

              }
              $.getJSON("ChartBotones.php", addDataBoton)


              document.getElementById("sidebarToggle").click();

          }
      </script>

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
    <!--
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-bar-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>
    -->

  </body>

</html>
