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

if(isset($_GET['action']) == 'delete'){
    $id_delete = $_GET['id'];
    $c= new Connector();
    $conn=$c->getCon();
    $query = mysqli_query($conn, "SELECT * FROM pmi WHERE id_pmi='$id_delete'");
    $queryCom = mysqli_query($conn, "SELECT * FROM comentarios WHERE identificador='$id_delete' and tabla='pmi'");

    if(mysqli_num_rows($query) == 0 ){
        echo '<div class="alert alert-success alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
    }else{
        mysqli_autocommit($conn, false);
        $delete = mysqli_query($conn, "DELETE FROM pmi WHERE id_pmi='$id_delete'");

        if($delete){
            $deleteCom = mysqli_query($conn, "DELETE FROM comentarios WHERE identificador='$id_delete' and tabla='pmi'");
            if($deleteCom){
                mysqli_commit($conn);
                header("Location: showPMI.php?e=1");
            }
            else{
                mysqli_rollback($conn);
                header("Location: showPMI.php?e=0");
            }
        }else{
            $error = mysqli_errno($conn);
            mysqli_rollback($conn);
            if($error==1451){
                header("Location: showPMI.php?e=4");
            }
            else{
                header("Location: showPMI.php?e=0");
            }
        }
    }
}

if (isset($_GET["e"])){
    $error=$_GET["e"];
    if($error==1){
        echo '<div class="alert alert-success alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, los datos han sido eliminados correctamente.</div>';
        ?>
        <script type="text/javascript">
            history.pushState(null, "", "showPMI.php");
        </script>
    <?php
    }
    elseif($error==2){
    echo "<div class='alert alert-success alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>";
    ?>
        <script type="text/javascript">
            history.pushState(null, "", "showPMI.php");
        </script>
    <?php
    }
    elseif($error==3){
    echo "<div class='alert alert-success alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Bien hecho, los datos han sido modificados correctamente.</div>";
    ?>
        <script type="text/javascript">
            history.pushState(null, "", "showPMI.php");
        </script>
    <?php
    }
    elseif($error==4){
    echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error, no se puede eliminar porque el PMI tiene algún dispositivo asociado</div>";
    ?>
        <script type="text/javascript">
            history.pushState(null, "", "showPMI.php");
        </script>
    <?php
    }
    else{
    echo '<div class="alert alert-danger alert-dismissable mb-0"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
    ?>
        <script type="text/javascript">
            history.pushState(null, "", "showPMI.php");
        </script>
        <?php
    }
}

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
                <a class="dropdown-item active" href="showPMI.php">PMI</a>
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
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-2"></i>
                    PMI
                    <a href="addPmi.php"><button  type="button" class="btn btn-outline-secondary ml-auto mr-0 my-2 my-md-0 float-right" title="Agregar nuevo">Agregar nuevo PMI</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="lookup" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Calle</th>
                                <th>Cruce</th>
                                <th>Colonia</th>
                                <th>Municipio</th>
                                <th>Camaras</th>
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

<script src="dataTablePMI.js"></script>

</body>

</html>
