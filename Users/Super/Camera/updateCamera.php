<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Cámaras</title>
</head>

<body id="page-top">
<?php
include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include("updateCameraP.php");
    
    if (isset($_GET["e"])){
		$error=$_GET["e"];
		if($error==1){
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
        }
	}

    $conn = new Connector();
    $id = $_GET['id'];
    $sql = mysqli_query($conn->getCon(), "SELECT * FROM camara WHERE ns_cam='$id'");
    if(mysqli_num_rows($sql) == 0){
    header("Location:showCamera.php");
    }else{
    $row = mysqli_fetch_assoc($sql);
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
                <a class="dropdown-item active" href="showCamera.php">Cámaras</a>
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
                    <a href="showCamera.php">Camara</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Editar PMI-->
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
                                        <input type="text" id="ns_cam" name="ns_cam" class="form-control" placeholder="Numero de Serie" required  onkeypress="return soloLetrasNumeros(event)" value="<?php echo $row['ns_cam']; ?>">
                                        <label for="ns_cam">Numero de Serie</label>
                                        <input type="text" id="id" name="id" class="form-control" value="<?php echo $row['ns_cam']; ?>" hidden="hidden">
                                        <div id="checkns" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ip_cam" name="ip_cam" class="form-control" placeholder="IP" required value="<?php echo $row['ip_cam']; ?>">
                                        <label for="ip_cam">IP</label>
                                        <div id="checkip" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="mac_cam" name="mac_cam" class="form-control" placeholder="Dirección MAC" required  value="<?php echo $row['mac_cam']; ?>">
                                        <label for="mac_cam">Dirección MAC</label>
                                        <div id="checkmac" class=""></div>
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
                                        <input type="number" id="num_cam" name="num_cam" class="form-control" placeholder="Numero de Camara" required value="<?php echo $row['num_cam']; ?>">
                                        <label for="num_cam">Número de cámara</label>
                                        <div id="checkNumCam" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ori_cam" name="ori_cam" class="form-control" placeholder="Orientacion" required onkeypress="return soloNumeros(event)" value="<?php echo $row['ori_cam']; ?>">
                                        <label for="ori_cam">Orientación</label>
                                        <div id="obtenerDir" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        <input type="text" id="nom_cam" name="nom_cam" class="form-control" placeholder="Nombre" onkeypress="return soloLetrasNumeros(event)" required value="<?php echo $row['nom_cam']; ?>">
                                        <label for="nom_cam">Nombre</label>
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
                                                <label class="input-group-text" for="rec_serv" >Recording Server</label>
                                            </div>
                                            <?php
                                            $sql = mysqli_query($conn->getCon(), "SELECT * FROM servidorg");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showCamera.php");
                                            }else{
                                                while($rowr = mysqli_fetch_assoc($sql)){
                                                    if($row['id_servidorg']==$rowr['id_servidorg']){
                                                        $option .= '<option value = "'.$rowr['id_servidorg'].'" selected="selected">'.$rowr['nombre'].'</option>';
                                                    }
                                                    else{
                                                        $option .= '<option value = "'.$rowr['id_servidorg'].'">'.$rowr['nombre'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="rec_serv" name="rec_serv" autofocus="autofocus" required>
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
                                                <label class="input-group-text" for="import_file">VMS</label>
                                            </div>
                                            <select class="custom-select" id="vms" name="vms" required>
                                                <option selected>Elegir...</option>
                                                <?php
                                                    $if = $row['vms'];
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
                                                <label class="input-group-text" for="datepicker">Fecha instalación</label>
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
                                        <input type="text" id="user_cam" name="user_cam" class="form-control" placeholder="Usuario" required onkeypress="return soloLetras(event)" value="<?php echo $row['user_cam']; ?>">
                                        <label for="user_cam">Usuario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="pass_cam" name="pass_cam" class="form-control" placeholder="Password" required onkeypress="return soloLetras(event)" value="<?php echo $row['pass_cam']; ?>">
                                        <label for="pass_cam">Password</label>
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
                                        $sql = mysqli_query($conn->getCon(), "SELECT comentario, id_com FROM comentarios WHERE tabla='camara' and identificador='$id'");
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
                                        <input type="text" hidden="hidden" id="com" name="com" value="<?php echo $coment; ?>">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Comentarios"><?php echo $coment; ?></textarea>
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

<script>
    $(document).ready(function () {
        $("#ns_cam").keyup(checarNS);

    });

    $(document).ready(function () {
        $("#ns_cam").change(checarNS);
    });

    function checarNS() {
        var ns_cam = document.getElementById('ns_cam').value;
        if (ns_cam) {
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
            var params = "ns_cam=" + ns_cam + "&ns_act=<?php echo $row['ns_cam']; ?>";
            xhttp.send(params);
        }
        else{
            document.getElementById("checkns").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#ori_cam").keyup(direccion);
    });

    $(document).ready(function () {
        $("#ori_cam").change(direccion);
    });

    //<div class='alert alert-success mb-0'><i class='fa fa-check'></i>Valor no válido</div><input id='nschecker' type='hidden' value='1' name='nschecker'>

    function direccion() {
        var orientacion = document.getElementById('ori_cam').value;
        var divOrientacion = document.getElementById("obtenerDir");
        var submit = document.getElementById("input");

        if (orientacion) {
            if(orientacion<0 || orientacion >360){
                divOrientacion.innerHTML = "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Valor no válido</div>";
                submit.disabled = true;
            }
            else{
                divOrientacion.innerHTML = "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> "+obtenerDireccion(orientacion)+"</div>";
                submit.disabled = false;
            }
        }
        else{
            divOrientacion.innerHTML = "";
        }
    }

    function obtenerDireccion(orientacion){
        var direccion="";
        if (orientacion>=0 && orientacion<22.5){
            direccion="Norte";
        }
        else if(orientacion>=22.5 && orientacion<67.5){
            direccion="Noreste";
        }
        else if(orientacion>=67.5 && orientacion<112.5){
            direccion="Este";
        }
        else if(orientacion>=112.5 && orientacion<157.5){
            direccion="Sureste";
        }
        else if(orientacion>=157.5 && orientacion<202.5){
            direccion="Sur";
        }
        else if(orientacion>=202.5 && orientacion<247.5){
            direccion="Suroeste";
        }
        else if(orientacion>=247.5 && orientacion<292.5){
            direccion="Oeste";
        }
        else if(orientacion>=292.5 && orientacion<337.5){
            direccion="Noroeste";
        }
        else if(orientacion>=337.5 && orientacion<=360){
            direccion="Norte";
        }

        return direccion;

    }
</script>

<script>
    $(document).ready(function () {
        $("#mac_cam").keyup(checarMAC);
    });

    $(document).ready(function () {
        $("#mac_cam").change(checarMAC);
    });

    function checarMAC() {
        var mac = document.getElementById('mac_cam').value;
        var patron =/^((([a-fA-F0-9][a-fA-F0-9]+[-]){5}|([a-fA-F0-9][a-fA-F0-9]+[:]){5})([a-fA-F0-9][a-fA-F0-9])$)|(^([a-fA-F0-9][a-fA-F0-9][a-fA-F0-9][a-fA-F0-9]+[.]){2}([a-fA-F0-9][a-fA-F0-9][a-fA-F0-9][a-fA-F0-9]))$/g;
        if (mac) {
            if (mac.search(patron) == -1) {
                document.getElementById("checkmac").innerHTML = "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> MAC erronea</div><input id='macchecker' type='hidden' value='0' name='macchecker'>";
            } else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("checkmac").innerHTML = xhttp.responseText;
                        ipresponsed = document.getElementById('macchecker').value;

                        if (ipresponsed == "0") {
                            document.getElementById("input").disabled = true;
                        } else {
                            document.getElementById("input").disabled = false;
                        }
                    }
                };
                xhttp.open("POST", "checkMAC.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("mac_cam=" + mac + "");
            }
        }
        else{
            document.getElementById("checkmac").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#num_cam").keyup(checarNumCam);
    });

    $(document).ready(function () {
        $("#num_cam").change(checarNumCam);
    });

    function checarNumCam() {
        var num_cam = document.getElementById('num_cam').value;
        var pmi = document.getElementById('id_pmi').value;
        if (num_cam) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checkNumCam").innerHTML = xhttp.responseText;
                    ipresponsed = document.getElementById('numCamChecker').value;

                    if (ipresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            };
            xhttp.open("POST", "checkNumCam.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "num_cam=" + num_cam + "&id_pmi="+ pmi+"&num_act=<?php echo $row['num_cam']; ?>";
            xhttp.send(params);

        }
        else{
            document.getElementById("checkNumCam").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
