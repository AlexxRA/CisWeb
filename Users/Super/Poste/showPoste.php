<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Postes</title>
</head>

<body id="page-top">
<?php include("../../../caducarSesion.php");
include("../../../SGBD/Connector.php");
if(isset($_GET['action']) == 'delete'){
    $id_delete = $_GET['id'];
    $c= new Connector();
    $conn=$c->getCon();
    $query = mysqli_query($conn, "SELECT * FROM poste WHERE ns_poste='$id_delete'");
    $queryCom = mysqli_query($conn, "SELECT * FROM comentarios WHERE identificador='$id_delete' and tabla='poste'");

    if(mysqli_num_rows($query) == 0 || mysqli_num_rows($queryCom) == 0){
        echo '<div class="alert alert-success alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
    }else{
        mysqli_autocommit($conn, false);
        $delete = mysqli_query($conn, "DELETE FROM poste WHERE ns_poste='$id_delete'");

        if($delete){
            $deleteCom = mysqli_query($conn, "DELETE FROM comentarios WHERE identificador='$id_delete'");
            if($deleteCom){
                mysqli_commit($conn);
                header("Location: showPoste.php?e=1");
            }
            else{
                mysqli_rollback($conn);
                header("Location: showPoste.php?e=0");
            }
        }else{
            mysqli_rollback($conn);
            header("Location: showPoste.php?e=0");
        }

    }
}
if (isset($_GET["e"])){
    $error=$_GET["e"];
    if($error==1){
        echo '<div class="alert alert-primary alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, los datos han sido eliminados correctamente.</div>';
    }else{
        echo '<div class="alert alert-danger alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
    }
}
include("../include/navbar.php");?>

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
                <a class="dropdown-item " href="../Switch/showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="../Boton/showBoton.php">Botones</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="showPoste.php">Postes</a>
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active">Postes</li>
            </ol>


            <!-- Tabla mostrar usuarios-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-2"></i>
                    Postes
                    <a href="addPoste.php"><button type="button" class="btn btn-outline-secondary ml-auto mr-0 my-2 my-md-0 float-right" title="Agregar nuevo">Agregar nuevo poste</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="lookup" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>PMI</th>
                                <th>Numero de serie</th>
                                <th>Altura</th>
                                <th>Contratista</th>
                                <th>Fecha asignación</th>
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
include ("../include/scripts.php");
?>

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
                {"data": 9},
                {"data": 0},
                {"data": 1},
                {"data": 5},
                {"data": 6},
                {"data": 10, 'orderable' : false}
            ]
        } );

        $('#lookup tbody').on('click', 'tr', function () {
            let filaDeLaTabla = $(this);
            let filaComplementaria = dataTable.row(filaDeLaTabla);


            if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                filaComplementaria.child.hide();

            } else { // La fila complementaria está cerrada y se abre.
                filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();

            }
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

        });
        $('#lookup tbody').on('mouseover', 'tr', function () {
            let filaDeLaTabla = $(this);
            filaDeLaTabla.css("cursor","pointer");

        });

    function formatearSalidaDeDatosComplementarios (filaDelDataSet ) {
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

        if(filaDelDataSet[11]){
            cadenaDeRetorno += '<table class="table bg-light">';
            cadenaDeRetorno +='<tbody>';
            cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
            cadenaDeRetorno += '<tr><td>' + filaDelDataSet[11]+'</td>';
            cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[12]+'</td>';
            cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[13]+'</td>';
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
    } );
</script>

</body>

</html>
