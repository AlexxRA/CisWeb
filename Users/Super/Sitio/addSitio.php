<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Sitios</title>
</head>

<body id="page-top">
<?php
include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include("addSitioP.php");
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
                <a class="dropdown-item" href="../PMI/showPMI.php">PMI</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Camera/showCamera.php">Cámaras</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="../Switch/showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="../Boton/showBoton.php">Botones</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="../Poste/showPoste.php">Postes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item " href="../RadioBase/showRB.php">Radiobases</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="showSitio.php">Sitios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Suscriptor/showSuscriptor.php">Suscriptores</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Municipio/showMunicipio.php">Municipios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Vlan/showVlan.php">VLANs</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../ServidoresG/showServidorG.php">Servidores</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Busqueda/search.php">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Reportes/generarReporte.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Reportes</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Maps/Mapa.php">
                <i class="fas fa-fw fa-map"></i>
                <span>Mapas</span></a>
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
                    <a href="showSitio.php">Sitios</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo PMI-->
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Registrar nuevo Sitio</div>
                <div class="card-body">
                    <form action="addSitio.php" method="post" name="formCamera" id="formCamera">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nombre" onkeypress="return soloLetrasNumeros(event)" required >
                                        <label for="nom">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="calle" name="calle" class="form-control"
                                               placeholder="Calle" onkeypress="return soloLetrasNumeros(event)" required>
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
                                               placeholder="Cruce" onkeypress="return soloLetrasNumeros(event)" required>
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
                                               placeholder="Colonia" onkeypress="return soloLetrasNumeros(event)" required>
                                        <label for="colonia">Colonia</label>
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
                                                <label class="input-group-text" for="id_municipio" >Municipio</label>
                                            </div>
                                            <?php
                                            $conn = new Connector();
                                            $sql = mysqli_query($conn->getCon(), "SELECT * FROM municipios");
                                            $option = '<option value = "">Selecciona una opcion</option>';
                                            while($row = mysqli_fetch_assoc($sql)){
                                                $option .= '<option value = "'.$row['id_municipio'].'">'.$row['nombre'].'</option>';
                                            }
                                            ?>
                                            <select class="custom-select" id="id_municipio" name="id_municipio" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="latitud" name="latitud" class="form-control"
                                               placeholder="Latitud" required onkeypress="return validarnum(event)">
                                        <label for="latitud">Latitud</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="longitud" name="longitud" class="form-control"
                                               placeholder="Longitud" required onkeypress="return validarnum(event)">
                                        <label for="longitud">Longitud</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Comentarios"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Agregar</button>
                                <a href="showSitio.php" class="btn btn-sm btn-danger">Cancelar</a>
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

<script>
    $(document).ready(function () {
        $("#id_sitio").keyup(checarNS);
    });

    $(document).ready(function () {
        $("#id_sitio").change(checarNS);
    });

    function checarNS() {
        var ns = document.getElementById('id_sitio').value;

        if (ns) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("checkns").innerHTML = xhttp.responseText;
                        nsresponsed = document.getElementById('nschecker').value;

                        if (nsresponsed == "0") {
                            document.getElementById("input").disabled = true;
                        } else {
                            document.getElementById("input").disabled = false;
                        }
                    }
                };
                xhttp.open("POST", "checkNS.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id_sitio=" + ns + "");
            }
        else{
            document.getElementById("checkns").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
