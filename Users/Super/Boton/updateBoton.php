<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Botones</title>
</head>

<body id="page-top">
<?php include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include("updateBotonP.php");
    
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
                <a class="dropdown-item" href="../User/showUser.php">Usuarios</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../PMI/showPMI.php">PMI</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Camera/showCamera.php">Camaras</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="showSwitch.php">Switch</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="showBoton.php">Boton</a>
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
                    <a href="showBoton.php">Botones</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Editar PMI-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
			$sql = mysqli_query($conn->getCon(), "SELECT * FROM boton WHERE ext='$id'");
			if(mysqli_num_rows($sql) == 0){
                header("Location:showBoton.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Editar Boton</div>
                <div class="card-body">
                    <form action="updateBoton.php" method="post" name="formBoton" id="formBoton">
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
                                        <input type="text" id="extension" name="extension" class="form-control" placeholder="Extension" required  onkeypress="return validarnum(event)" value="<?php echo $row['ext']; ?>" readonly="readonly"">
                                        <label for="extension">Extension</label>
                                        <div id="checkext" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ip_bt" name="ip_bt" class="form-control" placeholder="IP" required  onkeypress="return validarnum(event)" value="<?php echo $row['ip_bt']; ?>">
                                        <label for="ip_bt">IP</label>
                                        <div id="checkip" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="mac_bt" name="mac_bt" class="form-control" placeholder="Dirección MAC" required value="<?php echo $row['mac_bt']; ?>">
                                        <label for="mac_bt">Dirección MAC</label>
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
                                                <label class="input-group-text" for="datepicker">Fecha</label>
                                            </div>
                                            <input type="text" id="datepicker" name="datepicker" class="form-control pt-1" required value="<?php echo $row['fecha_inst']; ?>"/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepicker').datepicker({
                                                    autoclose: true,
                                                    closeOnDateSelect: true
                                                }).datepicker("setDate",'now');
                                            </script>
                                        </div>
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
                                        $sql = mysqli_query($conn->getCon(), "SELECT comentario, id_com FROM comentarios WHERE tabla='boton' and identificador='$id'");
                                        if(mysqli_num_rows($sql) == 0){
                                            $id_coment="";
                                            $coment="";
                                        }else{
                                            $rowc = mysqli_fetch_assoc($sql);
                                            $id_coment = $rowc['id_com'];
                                            $coment = $rowc['comentario'];
                                        }
                                        ?>
                                        <input type="text" hidden="hidden" id="id_com" name="id_com" value="<?php echo $id_coment; ?>">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Comentarios"><?php echo $coment; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">
                                Modificar</button>
                                <a href="showBoton.php" class="btn btn-sm btn-danger">Cancelar</a>
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
    
<!-- Script validacion formulario -->
<script src="validarBoton.js"></script>

<script>
    $(document).ready(function () {
        $("#ip_sw").keyup(checarIP);
    });


    $(document).ready(function () {
        $("#ip_sw").change(checarIP);
    });



    function checarIP() {

        var ip = document.getElementById('ip_sw').value;
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
                xhttp.send("ip_sw=" + ip + "");
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