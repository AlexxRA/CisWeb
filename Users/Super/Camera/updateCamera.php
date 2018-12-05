<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DB Admin - Super usuario</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">

    <!-- DatePicker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css" />
    <script src="../../../js/jquery.js"></script>

    <script src="../../../js/datepicker.js"></script>

</head>

<body id="page-top">
<?php session_start(); include ("../../../SGBD/Connector.php"); include("updateCameraP.php");
    
    if (isset($_GET["e"])){
		$error=$_GET["e"];
		if($error==1){
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
        }
	}
    ?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">Menú</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>



    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <a class="dropdown-item" href="./PMI/showPMI.php">PMI</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="../Camera/showCamera.php">Camaras</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Switch/showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Boton/showBoton.php">Boton</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-search"></i>
                <span>Búsqueda</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
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
                    <a href="showCamera.php">Camara</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Editar PMI-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
			$sql = mysqli_query($conn->getCon(), "SELECT * FROM camara WHERE ns_cam='$id'");
			if(mysqli_num_rows($sql) == 0){
                header("Location:showCamera.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Editar Camara</div>
                <div class="card-body">
                    <form action="updateCamera.php" method="post" name="formCamera" id="formCamera">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_pmi" >ID PMI</label>
                                            </div>
                                            <?php
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_pmi FROM pmi");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showPMI.php");
                                            }else{
                                                while($rowp = mysqli_fetch_assoc($sql)){
                                                    if($row['id_pmi']==$rowp['id_pmi']){
                                                        $option .= '<option value = "'.$rowp['id_pmi'].'" selected="selected">'.$rowp['id_pmi'].'</option>';
                                                    }
                                                    else{
                                                        $option .= '<option value = "'.$rowp['id_pmi'].'">'.$rowp['id_pmi'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_pmi" name="id_pmi" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="ns_cam" name="ns_cam" class="form-control" placeholder="Numero de Serie" required  onkeypress="return validarnum(event)" readonly="readonly" value="<?php echo $row['ns_cam']; ?>">
                                        <label for="ns_cam">Numero de Serie</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="ip_cam" name="ip_cam" class="form-control" placeholder="IP" required value="<?php echo $row['ip_cam']; ?>">
                                        <label for="ip_cam">IP</label>
                                        <div id="checkip" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="id_cam" name="id_cam" class="form-control" placeholder="ID Camara" required value="<?php echo $row['id_cam']; ?>">
                                        <label for="id_cam">ID Camara</label>
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
                                                <label class="input-group-text" for="tipo">Tipo</label>
                                            </div>
                                            <select class="custom-select" id="tipo" name="tipo" required>
                                                <option selected>Elegir...</option>
                                                <?php
                                                $if = $row['tipo'];
                                                if($if=="A"){
                                                    ?>
                                                    <option value="P">PTZ</option>
                                                    <option value="F">Fija</option>
                                                    <option value="A" selected="selected">Analítica</option>
                                                    <?php
                                                }
                                                else if($if=="F"){
                                                    ?>
                                                    <option value="P">PTZ</option>
                                                    <option value="F" selected="selected">Fija</option>
                                                    <option value="A">Analítica</option>
                                                    <?php
                                                }
                                                else if($if=="P"){
                                                    ?>
                                                    <option value="P" selected="selected">PTZ</option>
                                                    <option value="F">Fija</option>
                                                    <option value="A">Analítica</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="num_cam" name="num_cam" class="form-control" placeholder="Numero de Camara" required value="<?php echo $row['num_cam']; ?>">
                                        <label for="num_cam">Número de cámara</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6" >
                                    <div class="form-label-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="tipo">Dirección</label>
                                            </div>
                                            <select class="custom-select" id="dir_cam" name="dir_cam" required>
                                                <option selected>Elegir...</option>
                                                <?php
                                                $if = $row['dir_cam'];
                                                if($if=="N"){
                                                    ?>
                                                    <option value="N" selected="selected">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="S"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S" selected="selected">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="E"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E" selected="selected">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="O"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O" selected="selected">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="NE"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE" selected="selected">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="NO"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO" selected="selected">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="SE"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE" selected="selected">Sureste</option>
                                                    <option value="SO">Suroeste</option>
                                                    <?php
                                                }
                                                else if($if=="SO"){
                                                    ?>
                                                    <option value="N">Norte</option>
                                                    <option value="S">Sur</option>
                                                    <option value="E">Este</option>
                                                    <option value="O">Oeste</option>
                                                    <option value="NE">Noreste</option>
                                                    <option value="NO">Noroeste</option>
                                                    <option value="SE">Sureste</option>
                                                    <option value="SO" selected="selected">Suroeste</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-label-group">
                                        <input type="text" id="ori_cam" name="ori_cam" class="form-control" placeholder="Orientacion" required onkeypress="return validarnum(event)" value="<?php echo $row['ori_cam']; ?>">
                                        <label for="ori_cam">Orientación</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-label-group">
                                        <input type="text" id="inc_cam" name="inc_cam" class="form-control" placeholder="Inclinacion" required onkeypress="return validarnum(event)" value="<?php echo $row['inc_cam']; ?>">
                                        <label for="inc_cam">Inclinación</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="nom_cam" name="nom_cam" class="form-control" placeholder="Nombre" required value="<?php echo $row['nom_cam']; ?>">
                                        <label for="nom_cam">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="rec_serv" name="rec_serv" class="form-control" placeholder="Recording Server" required value="<?php echo $row['rec_server']; ?>">
                                        <label for="rec_serv">Recording Server</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="id_device" name="id_device" class="form-control" placeholder="ID Device" required value="<?php echo $row['id_device']; ?>">
                                        <label for="id_device">ID Device</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="firmware" name="firmware" class="form-control" placeholder="Firmware" required value="<?php echo $row['firmware']; ?>">
                                        <label for="firmware">Firmware</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="import_file">Import File</label>
                                            </div>
                                            <select class="custom-select" id="import_file" name="import_file" required>
                                                <option selected>Elegir...</option>
                                                <?php
                                                    $if = $row['import_file'];
                                                    if($if==0){
                                                ?>
                                                        <option value="1">Si</option>
                                                        <option value="0" selected="selected">No</option>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <option value="1" selected="selected">Si</option>
                                                        <option value="0">No</option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="datepicker">Fecha</label>
                                            </div>
                                            <input type="text" id="datepicker" name="datepicker" class="form-control pt-1" required value="<?php echo $row['fecha_inst']; ?>"/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepicker').datepicker({
                                                    autoclose: true,
                                                    closeOnDateSelect: true
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="user_cam" name="user_cam" class="form-control" placeholder="Usuario" required onkeypress="return validarnum(event)" value="<?php echo $row['user_cam']; ?>">
                                        <label for="user_cam">Usuario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="pass_cam" name="pass_cam" class="form-control" placeholder="Password" required onkeypress="return validarnum(event)" value="<?php echo $row['pass_cam']; ?>">
                                        <label for="pass_cam">Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">
                                Modificar</button>
                                <a href="showCamera.php" class="btn btn-sm btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2018</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../cerrarSesion.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../../../vendor/chart.js/Chart.min.js"></script>
<script src="../../../vendor/datatables/jquery.dataTables.js"></script>
<script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="../../../js/demo/datatables-demo.js"></script>
<script src="../../../js/demo/chart-area-demo.js"></script>
    
<!-- Script validacion formulario -->
<script src="validarCamera.js"></script>

<script>
    $(document).ready(function () {
        $("#ip_cam").keyup(checarIP);
    });


    $(document).ready(function () {
        $("#ip_cam").change(checarIP);
    });



    function checarIP() {

        var ip = document.getElementById('ip_cam').value;
        var patron = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/g;
        if (ip) {
            if (ip.search(patron) == -1) {
                document.getElementById("checkip").innerHTML = "<div class='alert alert-danger'><i class='fa fa-times'></i> IP erronea</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
            } else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        /*var resp=xhttp.responseText;
                        console.log(resp);
                        if(resp){
                            document.getElementById("checkip").setAttribute("class","valid-feedback");
                            document.getElementById("checkip").innerHTML="Valido";
                            document.getElementById("ip_cam").setAttribute("class","is-valid");
                        }
                        else{
                            document.getElementById("checkip").setAttribute("class","invalid-feedback");
                            document.getElementById("checkip").innerHTML="Invalido";
                            document.getElementById("ip_cam").setAttribute("class","is-invalid");
                        }*/
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
                var params = "ip_cam=" + ip + "&ip_act=<?php echo $row['ip_cam']; ?>";
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