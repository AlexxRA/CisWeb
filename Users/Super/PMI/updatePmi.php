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
include("updatePmiP.php");

if (isset($_GET["e"])) {
    $error = $_GET["e"];
    if ($error == 1) {
        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
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
                <li class="breadcrumb-item">
                    <a href="showPMI.php">PMI</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Editar PMI-->
            <?php
            $conn = new Connector();
            $id = intval($_GET['id']);
            $sql = mysqli_query($conn->getCon(), "SELECT * FROM pmi WHERE id_pmi='$id'");
            if (mysqli_num_rows($sql) == 0) {
                header("Location:showPMI.php");
            } else {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Editar PMI</div>
                <div class="card-body">
                    <form action="updatePmi.php" method="post" name="formPmi" id="formPmi">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="id_pmi" name="id_pmi" class="form-control"
                                               placeholder="id_PMI" required autofocus="autofocus"
                                               onkeypress="return validarnum(event)"
                                               value="<?php echo $row['id_pmi']; ?>" readonly="readonly">
                                        <label for="id_pmi">id_PMI</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="calle" name="calle" class="form-control"
                                               placeholder="Calle" required value="<?php echo $row['calle']; ?>">
                                        <label for="calle">Calle</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="cruce" name="cruce" class="form-control"
                                               placeholder="Cruce" required value="<?php echo $row['cruce']; ?>">
                                        <label for="cruce">Cruce</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="colonia" name="colonia" class="form-control"
                                               placeholder="Colonia" required value="<?php echo $row['colonia']; ?>">
                                        <label for="colonia">Colonia</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="municipio" name="municipio" class="form-control"
                                               placeholder="Municipio" required
                                               value="<?php echo $row['municipio']; ?>">
                                        <label for="municipio">Municipio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="coordenadax" name="coordenadax" class="form-control"
                                               placeholder="Coordenada X" required onkeypress="return validarnum(event)"
                                               value="<?php echo $row['coordX']; ?>">
                                        <label for="coordenadax">Coordenada X</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="coordenaday" name="coordenaday" class="form-control"
                                               placeholder="Coordenada Y" required onkeypress="return validarnum(event)"
                                               value="<?php echo $row['coordY']; ?>">
                                        <label for="coordenaday">Coordenada Y</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="latitud" name="latitud" class="form-control"
                                               placeholder="Latitud" required onkeypress="return validarnum(event)"
                                               value="<?php echo $row['latitud']; ?>">
                                        <label for="latitud">Latitud</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="longitud" name="longitud" class="form-control"
                                               placeholder="Longitud" required onkeypress="return validarnum(event)"
                                               value="<?php echo $row['longitud']; ?>">
                                        <label for="longitud">Longitud</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <?php
                                        $conn = new Connector();
                                        $sql = mysqli_query($conn->getCon(), "SELECT comentario, id_com FROM comentarios WHERE tabla='pmi' and identificador='$id'");
                                        if (mysqli_num_rows($sql) == 0) {
                                            $id_coment = "";
                                            $coment = "";
                                        } else {
                                            $rowc = mysqli_fetch_assoc($sql);
                                            $id_coment = $rowc['id_com'];
                                            $coment = $rowc['comentario'];
                                        }
                                        ?>
                                        <input type="text" hidden="hidden" id="id_com" name="id_com" value="<?php echo $id_coment; ?>">
                                        <input type="text" hidden="hidden" id="com" name="com" value="<?php echo $coment; ?>">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Comentarios"><?php echo $coment; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">
                                    Modificar
                                </button>
                                <a href="showPMI.php" class="btn btn-sm btn-danger">Cancelar</a>
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
include("../include/scripts.php");
?>

</body>

</html>