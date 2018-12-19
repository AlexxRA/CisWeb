<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Búsqueda</title>
</head>

<body id="page-top">
<?php session_start();
include("../../../SGBD/Connector.php"); ?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">Menú</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
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
                <a class="dropdown-item" href="../Sector/showSector.php">Sectores</a>
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
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.php">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Búsqueda</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class=" d-md-inline-block">
                        <div class="input-group input-group-lg">
                            <input type="text" id="pmiSearch" name="pmiSearch" class="form-control" placeholder="Buscar PMI" title="Buscar información de PMI">
                            <div class="input-group-append">
                                <button name="submit" id="submit" class="btn btn-sm btn-primary" type="button" title="Buscar"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 ml-2 mr-2">
            <!-- Tabla mostrar pmi-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        PMI
                    </div>
                    <div class="card-body">
                        <div >
                            <table class="table table-bordered display" id="pmi" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Calle</th>
                                    <th>Cruce</th>
                                    <th>Colonia</th>
                                    <th>Municipio</th>
                                    <th>Camaras</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla mostrar camaras-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        Camaras
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="camara" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>IP</th>
                                    <th>Firmware</th>
                                    <th>Fecha instalación
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla mostrar boton-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        Botón
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="boton" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Extensión</th>
                                    <th>IP</th>
                                    <th>Dirección MAC</th>
                                    <th>Fecha instalación</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        Switch
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="switch" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No. serie</th>
                                    <th>IP</th>
                                    <th>Tipo</th>
                                    <th>Conexión</th>
                                    <th>Fecha instalación
                                    <th>Dirección MAC</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        Poste
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="poste" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Numero de serie</th>
                                    <th>Altura</th>
                                    <th>Contratista</th>
                                    <th>Fecha asignación</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <?php
    include("../include/footer.php")
    ?>

</div>
<!-- /.content-wrapper -->
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<!-- Logout Modal-->
<!-- Scripts-->
<?php
include("../include/scroll.php");
include("../include/logoutModal.php");
include ("../include/scripts.php");
?>

<script>

    $(document).ready(function () {
        let dataTablePMI = "";
        let dataTableCamara="";
        let dataTableBoton="";
        let dataTableSwitch="";
        let dataTablePoste="";

        $("#submit").on('click', function () {
            // al hacer click en el boton obtengo las dos fechas del formulario
            var pmiForm = document.getElementById('pmiSearch').value;
            // luego "destruyo" la tabla anterior para inicializar nuevamente con la respuesta de los datos enviados
            $("#pmi").dataTable().fnDestroy();
            pmiTable(pmiForm); // luego llamo a la funcion
            $("#camara").dataTable().fnDestroy();
            camaraTable(pmiForm);
            $("#boton").dataTable().fnDestroy();
            botonTable(pmiForm);
            $("#switch").dataTable().fnDestroy();
            switchTable(pmiForm);
            $("#poste").dataTable().fnDestroy();
            posteTable(pmiForm);
            //console.log(pmi);
        });
        pmiDetalles();
        camaraDetalles();
        botonDetalles();
        switchDetalles();
        posteDetalles();

        function pmiTable(pmiForm) {
            dataTablePMI = $('#pmi').DataTable({

                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },

                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "ajax_grid_data_pmi.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function () {  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display", "none");

                    },
                    data: {
                        pmi: pmiForm
                    }
                },
                "columns": [
                    {"data": 0, 'orderable': false},
                    {"data": 1, 'orderable': false},
                    {"data": 2, 'orderable': false},
                    {"data": 3, 'orderable': false},
                    {"data": 8, 'orderable': false},
                    {"data": 9, 'orderable': false}

                ],
                "paging": false,
                "info": false
            });

        }

        function camaraTable(pmiForm){
            dataTableCamara = $('#camara').DataTable( {

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

                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"ajax_grid_data_camara.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display","none");

                    },
                    data: {
                        pmi: pmiForm
                    }
                },
                "columns" : [
                    {"data": 8, 'orderable' : false},
                    {"data": 3, 'orderable' : false},
                    {"data": 1, 'orderable' : false},
                    {"data": 11, 'orderable' : false},
                    {"data": 15, 'orderable' : false}
                ],
                "paging": false,
                "info": false
            } );
        }

        function botonTable(pmiForm){
            dataTableBoton = $('#boton').DataTable( {

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
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"ajax_grid_data_boton.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display","none");

                    },
                    data: {
                        pmi: pmiForm
                    }
                },
                "columns" : [
                    {"data": 0,'orderable' : false},
                    {"data": 1,'orderable' : false},
                    {"data": 2,'orderable' : false},
                    {"data": 3,'orderable' : false}
                ],
                "paging": false,
                "info": false
            } );
        }

        function switchTable(pmiForm){
            dataTableSwitch = $('#switch').DataTable( {

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
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"ajax_grid_data_switch.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display","none");

                    },
                    data: {
                        pmi: pmiForm
                    }
                },
                "columns" : [
                    {"data": 0,'orderable' : false},
                    {"data": 2,'orderable' : false},
                    {"data": 3,'orderable' : false},
                    {"data": 4,'orderable' : false},
                    {"data": 5,'orderable' : false},
                    {"data": 1,'orderable' : false}
                ],
                "paging": false,
                "info": false
            } );
        }

        function posteTable(pmiForm){
            dataTablePoste = $('#poste').DataTable( {

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
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"ajax_grid_data_poste.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".lookup-error").html("");
                        $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#lookup_processing").css("display","none");

                    },
                    data: {
                        pmi: pmiForm
                    }
                },
                "columns" : [
                    {"data": 0,'orderable' : false},
                    {"data": 1,'orderable' : false},
                    {"data": 5,'orderable' : false},
                    {"data": 6,'orderable' : false}
                ],
                "paging": false,
                "info": false
            } );
        }

        function pmiDetalles(){
            $('#pmi tbody').on('click', 'tr', function () {
                let filaDeLaTabla = $(this);
                let filaComplementaria = dataTablePMI.row(filaDeLaTabla);


                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();

                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();

                }
            });
            $('#pmi tbody').on('mouseover', 'tr', function () {
                let filaDeLaTabla = $(this);
                filaDeLaTabla.css("cursor","pointer");

            });

            function formatearSalidaDeDatosComplementarios(filaDelDataSet) {
                var cadenaDeRetorno = '';
                cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><h6>Coordenadas</h6></tr>';
                cadenaDeRetorno += '<tr><td>X: ' + filaDelDataSet[4]+'</td>';
                cadenaDeRetorno += '<td>Y: ' + filaDelDataSet[5]+'</td>';
                cadenaDeRetorno += '<td>Latitud: ' + filaDelDataSet[6]+'</td>';
                cadenaDeRetorno += '<td>Longitud: ' + filaDelDataSet[7]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';
                if(filaDelDataSet[10]){
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>' + filaDelDataSet[10]+'</td>';
                    cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[11]+'</td>';
                    cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[12]+'</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                else{
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                return cadenaDeRetorno;
            }
        }

        function camaraDetalles(){
            $('#camara tbody').on('click', 'tr', function () {
                let filaDeLaTabla = $(this);

                let filaComplementaria = dataTableCamara.row(filaDeLaTabla);


                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();

                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();


                }

            });
            $('#camara tbody').on('mouseover', 'tr', function () {
                let filaDeLaTabla = $(this);
                filaDeLaTabla.css("cursor","pointer");

            });

            function formatearSalidaDeDatosComplementarios (filaDelDataSet ) {
                var cadenaDeRetorno = '';
                cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><td>Dirección: ' + filaDelDataSet[5]+'</td>';
                cadenaDeRetorno += '<td>Orientación: ' + filaDelDataSet[6]+'</td>';
                cadenaDeRetorno += '<td>Inclinación: ' + filaDelDataSet[7]+'</td>';
                cadenaDeRetorno += '<td>Longitud: ' + filaDelDataSet[7]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';

                cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><td>Numero de serie: ' + filaDelDataSet[0]+'</td>';
                cadenaDeRetorno += '<td>ID: ' + filaDelDataSet[2]+'</td>';
                cadenaDeRetorno += '<td>ID Device: ' + filaDelDataSet[10]+'</td>';
                cadenaDeRetorno += '<td>Numero: ' + filaDelDataSet[4]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';

                cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><td>Recording server: ' + filaDelDataSet[9]+'</td>';
                cadenaDeRetorno += '<td>VMS: ' + filaDelDataSet[12]+'</td>';
                cadenaDeRetorno += '<td>Usuario: ' + filaDelDataSet[13]+'</td>';
                cadenaDeRetorno += '<td>Contraseña: ' + filaDelDataSet[14]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';

                if(filaDelDataSet[18]){
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>' + filaDelDataSet[18]+'</td>';
                    cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[19]+'</td>';
                    cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[20]+'</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                else{
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                return cadenaDeRetorno;
            }
        }

        function botonDetalles(){
            $('#boton tbody').on('click', 'tr', function () {
                let filaDeLaTabla = $(this);
                let filaComplementaria = dataTableBoton.row(filaDeLaTabla);


                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();

                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();

                }
            });
            $('#boton tbody').on('mouseover', 'tr', function () {
                let filaDeLaTabla = $(this);
                filaDeLaTabla.css("cursor","pointer");

            });

            function formatearSalidaDeDatosComplementarios(filaDelDataSet) {
                var cadenaDeRetorno = '';
                if(filaDelDataSet[5]){
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>' + filaDelDataSet[5]+'</td>';
                    cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[6]+'</td>';
                    cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[7]+'</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                else{
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                return cadenaDeRetorno;
            }
        }

        function switchDetalles(){
            $('#switch tbody').on('click', 'tr', function () {
                let filaDeLaTabla = $(this);
                let filaComplementaria = dataTableSwitch.row(filaDeLaTabla);


                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();

                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();

                }
            });
            $('#switch tbody').on('mouseover', 'tr', function () {
                let filaDeLaTabla = $(this);
                filaDeLaTabla.css("cursor","pointer");

            });

            function formatearSalidaDeDatosComplementarios(filaDelDataSet) {
                var cadenaDeRetorno = '';
                if(filaDelDataSet[7]){
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>' + filaDelDataSet[7]+'</td>';
                    cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[8]+'</td>';
                    cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[9]+'</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                else{
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                return cadenaDeRetorno;
            }
        }

        function posteDetalles(){
            $('#poste tbody').on('click', 'tr', function () {
                let filaDeLaTabla = $(this);
                let filaComplementaria = dataTablePoste.row(filaDeLaTabla);


                if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                    filaComplementaria.child.hide();

                } else { // La fila complementaria está cerrada y se abre.
                    filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();

                }
            });
            $('#poste tbody').on('mouseover', 'tr', function () {
                let filaDeLaTabla = $(this);
                filaDeLaTabla.css("cursor","pointer");

            });

            function formatearSalidaDeDatosComplementarios(filaDelDataSet) {
                var cadenaDeRetorno = '';
                cadenaDeRetorno += '<table class="table bg-light ">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><h6>Fechas</h6></tr>';
                cadenaDeRetorno +='<tr>';
                cadenaDeRetorno += '<td>Base colocada: ' + filaDelDataSet[4]+'</td>';
                cadenaDeRetorno += '<td>Montaje: ' + filaDelDataSet[2]+'</td>';
                cadenaDeRetorno += '<td>Electrificación: ' + filaDelDataSet[3]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';

                cadenaDeRetorno += '<table class="table bg-light ">';
                cadenaDeRetorno +='<tbody>';
                cadenaDeRetorno += '<tr><h6>Numero de serie dispositivos</h6></tr>';
                cadenaDeRetorno +='<tr>';
                cadenaDeRetorno += '<td>UPS: ' + filaDelDataSet[7]+'</td>';
                cadenaDeRetorno += '<td>Gabinete: ' + filaDelDataSet[8]+'</td></tr>';
                cadenaDeRetorno += '</tbody>';
                cadenaDeRetorno += '</table>';
                if(filaDelDataSet[10]){
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>' + filaDelDataSet[10]+'</td>';
                    cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[11]+'</td>';
                    cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[12]+'</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                else{
                    cadenaDeRetorno += '<table class="table bg-light">';
                    cadenaDeRetorno +='<tbody>';
                    cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
                    cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
                    cadenaDeRetorno += '</tr></tbody>';
                    cadenaDeRetorno += '</table>';
                }
                return cadenaDeRetorno;
            }
        }


    });
</script>

</body>

</html>
