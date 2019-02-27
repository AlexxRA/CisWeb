<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Super usuario</title>
</head>

<body id="page-top">
<?php
include("../../../caducarSesion.php");;
include("addVlanP.php");
include("../include/navbar.php");
include("../../../SGBD/Connector.php");

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
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="../Municipio/showMunicipio.php">Municipios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="showVlan.php">VLANs</a>
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
                    <a href="showVlan.php">VLAN</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo usuario-->
            <div class="card card-register mx-auto">
                <div class="card-header">Registrar nueva VLAN</div>
                <div class="card-body">
                    <form action="addVlan.php" method="post" name="formUser">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="id_vlan" name="id_vlan" class="form-control" placeholder="VLAN" required onkeypress="return soloNumeros(event)" autofocus="autofocus">
                                        <label for="id_vlan">VLAN</label>
                                        <div id="checkvlan" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_sitio" >SITIO</label>
                                            </div>

                                            <?php

                                            $conn = new Connector();
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_sitio, nom FROM sitio");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location:showRB.php");
                                            }else{
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $option .= '<option value = "'.$row['id_sitio'].'">'.$row['nom'].'</option>';
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_sitio" name="id_sitio" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Agregar</button>
                                <a href="showVlan.php" class="btn btn-sm btn-danger">Cancelar</a>
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
        $("#id_vlan").keyup(checarVlan);
    });

    $(document).ready(function () {
        $("#id_vlan").change(checarVlan);
    });

    function checarVlan() {
        var vlan = document.getElementById('id_vlan').value;

        if (vlan) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checkvlan").innerHTML = xhttp.responseText;
                    nsresponsed = document.getElementById('vlanchecker').value;

                    if (nsresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            };
            xhttp.open("POST", "checkVlan.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id_vlan=" + vlan + "");
        }
        else{
            document.getElementById("checkvlan").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
