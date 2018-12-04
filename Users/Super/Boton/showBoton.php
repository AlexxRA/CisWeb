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
include("addBotonP.php");
include("../../../SGBD/Connector.php");?>

<script>
    window.onreset = function () {
        return 'Are you sure you want to leave?';
    }
</script>

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
                <a class="dropdown-item  active" href="showBoton.php">Switch</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
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
                <li class="breadcrumb-item active">Switch</li>
            </ol>


            <!-- Tabla mostrar usuarios-->

            <?php
            if(isset($_GET['action']) == 'delete'){
                $id_delete = intval($_GET['id']);
                $c= new Connector();
                $conn=$c->getCon();
                $query = mysqli_query($conn, "SELECT * FROM switch WHERE ns_sw='$id_delete'");
                if(mysqli_num_rows($query) == 0){
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                }else{
                    $delete = mysqli_query($conn, "DELETE FROM switch WHERE ns_sw='$id_delete'");
                    if($delete){
                        header("Location: showSwitch.php?e=1");
                    }else{
                        header("Location: showSwitch.php?e=0");
                    }

                }
            }
            if (isset($_GET["e"])){
                $error=$_GET["e"];
                if($error==1){
                    echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, los datos han sido eliminados correctamente.</div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
                }
            }
            ?>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table "></i>
                    Switch
                    <a href="addBoton.php"><button type="button" class="btn btn-outline-secondary ml-auto mr-0 mr-md-3 my-2 my-md-0" title="Agregar nuevo">Agregar nuevo switch</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="lookup" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>PMI</th>
                                <th>IP</th>
                                <th>Tipo</th>
                                <th>Conexión</th>
                                <th>Fecha instalación
                                <th class="text-center"> Acciones </th>
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

</div>
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
        let dataTable = $('#lookup').DataTable( {

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

            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_grid_data.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".lookup-error").html("");
                    $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#lookup_processing").css("display","none");

                }
            },
            "columns" : [
                {"data": 6},
                {"data": 2},
                {"data": 3},
                {"data": 4},
                {"data": 5},
                {"data": 7, 'orderable' : false}
            ]
        } );


    $('#lookup tbody').on('click', 'a.btn.btn-sm.btn-outline-success', function () {
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
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno +='<tr>';
        cadenaDeRetorno += '<td>Numero de serie: ' + filaDelDataSet[0]+'</td>';
        cadenaDeRetorno += '<td>Dirección MAC: ' + filaDelDataSet[1]+'</td></tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';
        return cadenaDeRetorno;
    }
    } );
</script>

</body>

</html>
