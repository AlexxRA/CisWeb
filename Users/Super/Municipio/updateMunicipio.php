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
include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include("updateMunicipioP.php");

if (isset($_GET["e"])){
    $error=$_GET["e"];
    if($error==1){
        echo "<div class='alert alert-danger alert-dismissable  mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
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
                <a class="dropdown-item active" href="showMunicipio.php">Municipios</a>
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
                    <a href="showMunicipio.php">Municipio</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Registrar nuevo usuario-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
            $sql = mysqli_query($conn->getCon(), "SELECT * FROM municipios WHERE id_municipio='$id'");
            if(mysqli_num_rows($sql) == 0){
                header("Location:showMunicipio.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card card-register mx-auto">
                <div class="card-header">Modificar municipio</div>
                <div class="card-body">
                    <form action="updateMunicipio.php" method="post" name="formUser">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="form-label-group">
                                        <input type="text" id="id" name="id" value="<?php echo $row['id_municipio']; ?>" hidden="hidden">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required onkeypress="return soloLetras(event)" autofocus="autofocus" value="<?php echo $row['nombre']; ?>">
                                        <label for="nombre">Nombre</label>
                                        <div id="checknombre" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input type="text" id="abreviatura" name="abreviatura" class="form-control" placeholder="Abreviatura" onkeypress="return soloLetras(event)" required value="<?php echo $row['abreviatura']; ?>">
                                        <label for="abreviatura">Abreviatura</label>
                                        <div id="checkabreviatura" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Modificar</button>
                                <a href="showMunicipio.php" class="btn btn-sm btn-danger">Cancelar</a>
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
        $("#abreviatura").keyup(checarAbreviatura);
    });

    $(document).ready(function () {
        $("#abreviatura").change(checarAbreviatura);
    });

    function checarAbreviatura() {
        var abreviatura = document.getElementById('abreviatura').value;

        if (abreviatura) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checkabreviatura").innerHTML = xhttp.responseText;
                    nsresponsed = document.getElementById('abreviaturachecker').value;

                    if (nsresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            }
            xhttp.open("POST", "checkAbreviatura.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "abreviatura=" + abreviatura + "&abreviatura_act=<?php echo $row['abreviatura']; ?>";
            xhttp.send(params);
        }
        else{
            document.getElementById("checkabreviatura").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#nombre").keyup(checarNombre);
    });

    $(document).ready(function () {
        $("#nombre").change(checarNombre);
    });

    function checarNombre() {
        var nombre = document.getElementById('nombre').value;

        if (nombre) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checknombre").innerHTML = xhttp.responseText;
                    nsresponsed = document.getElementById('nombrechecker').value;

                    if (nsresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            };
            xhttp.open("POST", "checkMunicipio.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "nombre=" + nombre + "&nombre_act=<?php echo $row['nombre']; ?>";
            xhttp.send(params);
        }
        else{
            document.getElementById("checknombre").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
