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
<?php session_start();
include("../../../SGBD/Connector.php");?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">Menú</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

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
                <a class="dropdown-item" href="../Camera/showCamera.php">Camaras</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Switch/showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Boton/showBoton.php">Boton</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="search.php">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active">Búsqueda</li>
            </ol>

            <div class="card card-register mx-auto mb-3">
                <div class="card-body">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-10">
                                    <div class="form-label-group">
                                        <input type="text" id="pmiSearch" name="pmiSearch" class="form-control" placeholder="Buscar PMI" required>
                                        <label for="pmiSearch">Buscar PMI</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="control-group mt-2">
                                        <div class="controls">
                                            <button  name="submit" id="submit" class="btn btn-sm btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>


            <!-- Tabla mostrar usuarios-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table "></i>
                    PMI
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pmi" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Calle</th>
                                <th>Cruce</th>
                                <th>Colonia</th>
                                <th>Municipio</th>
                                <th>Camaras</th>
                                <th class="text-center"> Detalles </th>
                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2018</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../cerrarSesion.php">Logout</a>
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

<script>

    $(document).ready(function() {


        $("#submit").on('click',  function() {
            // al hacer click en el boton obtengo las dos fechas del formulario
            var pmiForm = document.getElementById('pmiSearch').value;
            // luego "destruyo" la tabla anterior para inicializar nuevamente con la respuesta de los datos enviados
            $("#pmi").dataTable().fnDestroy();
            table(pmiForm); // luego llamo a la funcion
            //console.log(pmi);
        });

        function table(pmiForm){
            let dataTable = $('#pmi').DataTable( {

                "language":	{
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },

                "bFilter":false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"ajax_grid_data.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display","none");

                    },
                    data:{
                        pmi:pmiForm
                    }
                },
                "columns" : [
                    {"data": 0,'orderable' : false},
                    {"data": 1, 'orderable' : false},
                    {"data": 2, 'orderable' : false},
                    {"data": 3, 'orderable' : false},
                    {"data": 8, 'orderable' : false},
                    {"data": 9, 'orderable' : false},
                    {"data": 10, 'orderable' : false}
                ],
                "paging":false,
                "info":false
            } );

            $('#pmi tbody').on('click', 'a.btn.btn-sm.btn-outline-success', function () {

                let filaDeLaTabla = $(this).closest('tr');
                let filaComplementaria = dataTable.row(filaDeLaTabla);
                console.log($(this).closest('tr'));
                let celdaDeIcono = $(this).closest('a.btn.btn-sm.btn-outline-success');

                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();
                    celdaDeIcono.html('<i class="fa fa-fw fa-plus"></i>');
                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();
                    celdaDeIcono.html('<i class="fa fa-fw fa-minus"></i>');
                }
            });

            function formatearSalidaDeDatosComplementarios (filaDelDataSet ) {
                var cadenaDeRetorno = '';
                cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto">';
                cadenaDeRetorno +='<tbody><tr>';
                cadenaDeRetorno += '<td>Coordenadas en X: ' + filaDelDataSet[4]+'</td>';
                cadenaDeRetorno += '<td>Coordenadas en Y: ' + filaDelDataSet[5]+'</td></tr>';
                cadenaDeRetorno += '<tr><td>Latitud: ' + filaDelDataSet[6]+'</td>';
                cadenaDeRetorno += '<td>Longitud: ' + filaDelDataSet[7]+'</td>';
                cadenaDeRetorno += '</tr></tbody>';
                cadenaDeRetorno += '</table>';
                return cadenaDeRetorno;
            }
        }


    } );
</script>

</body>

</html>
