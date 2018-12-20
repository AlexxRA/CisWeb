<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Super usuario</title>
</head>

<body id="page-top">
<?php include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include ("updateUserP.php");
if (isset($_GET["e"])){
    $error=$_GET["e"];
    if($error==1){
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
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
                <a class="dropdown-item active" href="showUser.php">Usuarios</a>
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="showUser.php">Usuarios</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo usuario-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
            $sql = mysqli_query($conn->getCon(), "SELECT * FROM usuario WHERE id_usu='$id'");
            if(mysqli_num_rows($sql) == 0){
                header("Location:showSwitch.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            ?>

            <div class="card card-register mx-auto">
                <div class="card-header">Modificar nuevo usuario</div>
                <div class="card-body">
                    <form action="updateUser.php" method="post" name="formUser">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus="autofocus" value="<?php echo $row['usuario']; ?>">
                                        <label for="usuario">Usuario</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
                                        <label for="pass">Contraseña</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="tipo">Tipo de usuario</label>
                                            </div>
                                            <select class="custom-select" id="tipo" name="tipo">
                                                <option selected>Elegir...</option>
                                                <option value="super">Super usuario</option>
                                                <option value="admin">Administrador</option>
                                                <option value="it">IT</option>
                                                <option value="capturista">Capturista</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Modificar</button>
                                <a href="showUser.php" class="btn btn-sm btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </form>
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

</body>

</html>
