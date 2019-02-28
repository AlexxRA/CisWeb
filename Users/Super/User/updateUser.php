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
include ("updateUserP.php");

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
                header("Location:showUser.php");
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
                                        <input type="text" id="id" name="id" value="<?php echo $row['id_usu']; ?>" hidden="hidden">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required autofocus="autofocus" value="<?php echo $row['nombre']; ?>">
                                        <label for="nombre">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" required value="<?php echo $row['apellidos']; ?>">
                                        <label for="apellidos">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required value="<?php echo $row['usuario']; ?>">
                                        <label for="usuario">Usuario</label>
                                        <div id="checkuser" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required >
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
                                            <?php
                                            $option = '';
                                            $data= array("super","admin","obra_civil","radio","it","instalaciones","administrativo");
                                            $name= array("Super Usuario","Administrador","Obra Civil","Radio","IT","Instalaciones","Administrativo");
                                            switch($row['tipo']) {
                                                case "super":
                                                    $option .= '<option value = "super" selected="selected">Super Usuario</option>';
                                                    break;
                                                case "admin":
                                                    $option .= '<option value = "admin" selected="selected">Administrador</option>';
                                                    break;
                                                case "obra_civil":
                                                    $option .= '<option value = "obra_civil" selected="selected">Obra Civil</option>';
                                                    break;
                                                case "radio":
                                                    $option .= '<option value = "radio" selected="selected">Radio</option>';
                                                    break;
                                                case "it":
                                                    $option .= '<option value = "it" selected="selected">IT</option>';
                                                    break;
                                                case "instalaciones":
                                                    $option .= '<option value = "instalaciones" selected="selected">Instalaciones</option>';
                                                    break;
                                                case "administrativo":
                                                    $option .= '<option value = "administrativo" selected="selected">Administrativo</option>';
                                                    break;
                                            }
                                            $longitud = count($data);
                                            for($i=0; $i<$longitud; $i++)
                                            {
                                                if($row['tipo']!=$data[$i]){
                                                    $option .= '<option value = "'.$data[$i].'">'.$name[$i].'</option>';
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="tipo" name="tipo">
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

<script>
    $(document).ready(function () {
        $("#usuario").keyup(checarUser);
    });

    $(document).ready(function () {
        $("#usuario").change(checarUser);
    });

    function checarUser() {
        var usuario = document.getElementById('usuario').value;

        if (usuario) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checkuser").innerHTML = xhttp.responseText;
                    nsresponsed = document.getElementById('userchecker').value;

                    if (nsresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            };
            xhttp.open("POST", "checkUser.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "user=" + usuario + "&user_act=<?php echo $row['usuario']; ?>";
            xhttp.send(params);
        }
        else{
            document.getElementById("checkuser").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
