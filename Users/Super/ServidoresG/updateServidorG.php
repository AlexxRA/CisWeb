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
include("updateServidorGP.php");

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
                <a class="dropdown-item" href="../Municipio/showMunicipio.php">Municipios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Vlan/showVlan.php">VLANs</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="showServidorG.php">Servidores</a>
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
                    <a href="showServidorG.php">Recording Server</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Registrar nuevo usuario-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
            $sql = mysqli_query($conn->getCon(), "SELECT * FROM servidorg WHERE id_servidorg='$id'");
            if(mysqli_num_rows($sql) == 0){
                header("Location:showServidorG.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card card-register mx-auto">
                <div class="card-header">Modificar servidor</div>
                <div class="card-body">
                    <form action="updateServidorG.php" method="post" name="formUser">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="id" name="id" value="<?php echo $row['id_servidorg']; ?>" hidden="hidden">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required autofocus="autofocus" value="<?php echo $row['nombre']; ?>">
                                        <label for="nombre">Nombre</label>
                                        <div id="checknombre" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ubicacion" required value="<?php echo $row['ubicacion']; ?>" autofocus="autofocus">
                                        <label for="ubicacion">Ubicacion</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ip_servidorg" name="ip_servidorg" class="form-control" placeholder="IP" required value="<?php echo $row['ip_servidorg']; ?>" onkeypress="return validarnum(event)">
                                        <label for="ip_servidorg">IP</label>
                                        <div id="checkip" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_vlan" >VLAN</label>
                                            </div>
                                            <?php
                                            $conn = new Connector();
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_vlan FROM vlan");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showRB.php");
                                            }else{
                                                while($rows = mysqli_fetch_assoc($sql)){
                                                    if($row['id_vlan']==$rows['id_vlan']){
                                                        $option .= '<option value = "'.$rows['id_vlan'].'" selected="selected">'.$rows['id_vlan'].'</option>';
                                                    }
                                                    else{
                                                        $option .= '<option value = "'.$rows['id_vlan'].'">'.$rows['id_vlan'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_vlan" name="id_vlan" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Modificar</button>
                                <a href="showServidorG.php" class="btn btn-sm btn-danger">Cancelar</a>
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
            xhttp.open("POST", "checkServidorG.php", true);
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

<script>
    $(document).ready(function () {
        $("#ip_servidorg").keyup(checarIP);
    });

    $(document).ready(function () {
        $("#ip_servidorg").change(checarIP);
    });

    function checarIP() {
        var ip = document.getElementById('ip_servidorg').value;
        var patron = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/g;
        if (ip) {
            if (ip.search(patron) == -1) {
                document.getElementById("checkip").innerHTML = "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> IP erronea</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
            } else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("checkip").innerHTML = xhttp.responseText;
                        ipresponsed = document.getElementById('ipchecker').value;

                        if (ipresponsed == "0") {
                            document.getElementById("input").disabled = true;
                        } else {
                            document.getElementById("input").disabled = false;
                        }
                    }
                };
                xhttp.open("POST", "checkIP.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = "ip_servidorg=" + ip + "&ip_act=<?php echo $row['ip_servidorg']; ?>";
                xhttp.send(params);
            }
        }
        else{
            document.getElementById("checkip").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
