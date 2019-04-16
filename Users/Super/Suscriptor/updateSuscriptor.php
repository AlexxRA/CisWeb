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
include("updateSuscriptorP.php");
    
    if (isset($_GET["e"])){
		$error=$_GET["e"];
		if($error==1){
            echo "<div class='alert alert-danger alert-dismissable mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
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
                <a class="dropdown-item active" href="showSuscriptor.php">Suscriptores</a>
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
                    <a href="showSuscriptor.php">Suscriptores</a>
                </li>
                <li class="breadcrumb-item active">Modificar</li>
            </ol>

            <!-- Editar PMI-->
            <?php
            $conn = new Connector();
            $id = $_GET['id'];
			$sql = mysqli_query($conn->getCon(), "SELECT * FROM suscriptor WHERE ns_sus='$id'");
			if(mysqli_num_rows($sql) == 0){
                header("Location:showSuscriptor.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Editar suscriptor</div>
                <div class="card-body">
                    <form action="updateSuscriptor.php" method="post" name="formCamera" id="formCamera">
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
                                                header("Location:showSuscriptor.php");
                                            }else{
                                                $sqlp = mysqli_query($conn->getCon(), "SELECT id_pmi FROM suscriptor");
                                                $data = array();
                                                while($rowv=mysqli_fetch_array($sqlp) ) {
                                                    $data[] = $rowv["id_pmi"];
                                                }
                                                $longitud = count($data);
                                                while($rowp = mysqli_fetch_assoc($sql)){
                                                    $flag=0;
                                                    for($i=0; $i<$longitud; $i++)
                                                    {
                                                        if($data[$i]==$rowp['id_pmi'] && $row['id_pmi']!=$rowp['id_pmi']){
                                                            $flag=1;
                                                        }
                                                    }
                                                    if($flag==0){
                                                        if($row['id_pmi']==$rowp['id_pmi']){
                                                            $option .= '<option value = "'.$rowp['id_pmi'].'" selected="selected">'.$rowp['id_pmi'].'</option>';
                                                        }
                                                        else{
                                                            $option .= '<option value = "'.$rowp['id_pmi'].'">'.$rowp['id_pmi'].'</option>';
                                                        }
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
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_rb" >Sector</label>
                                            </div>
                                            <?php
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_rb, sector FROM radiobase");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location:showSuscriptor.php");
                                            }else{
                                                while($rowr = mysqli_fetch_assoc($sql)){
                                                    if($rowr['id_rb']==$row['id_rb']){
                                                        $option .= '<option value = "'.$rowr['id_rb'].'" selected="selected">'.$rowr['sector'].'</option>';
                                                    }
                                                    else{
                                                        $option .= '<option value = "'.$rowr['id_rb'].'">'.$rowr['sector'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_rb" name="id_rb" autofocus="autofocus" required>
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
                                        <input type="text" id="ns_sus" name="ns_sus" class="form-control" placeholder="Numero de Serie" onkeypress="return soloLetrasNumeros(event)" required value="<?php echo $row['ns_sus']; ?>">
                                        <label for="ns_sus">Numero de Serie</label>
                                        <input type="text" id="id" name="id" class="form-control" value="<?php echo $row['ns_sus']; ?>" hidden="hidden">
                                        <div id="checkns" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ip_sus" name="ip_sus" class="form-control" placeholder="IP" required  onkeypress="return validarnum(event)" value="<?php echo $row['ip_sus']; ?>">
                                        <label for="ip_sus">IP</label>
                                        <div id="checkip" class=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="mac_sus" name="mac_sus" class="form-control" placeholder="MAC" required value="<?php echo $row['mac_sus']; ?>">
                                        <label for="mac_sus">MAC</label>
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
                                                <label class="input-group-text" for="id_pmi" >VLAN</label>
                                            </div>

                                            <?php
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_vlan FROM vlan");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location:showSuscriptor.php");
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
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="azimuth" name="azimuth" class="form-control" placeholder="Azimuth" required onkeypress="return validarnum(event)" value="<?php echo $row['azimuth']; ?>">
                                        <label for="azimuth">Azimuth</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="rss_sus" name="rss_sus" class="form-control" placeholder="RSS" required onkeypress="return validarnum(event)" value="<?php echo $row['rss_sus']; ?>">
                                        <label for="rss_sus">RSS</label>
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
                                        $sql = mysqli_query($conn->getCon(), "SELECT comentario, id_com FROM comentarios WHERE tabla='suscriptor' and identificador='$id'");
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
                                <a href="showSuscriptor.php" class="btn btn-sm btn-danger">Cancelar</a>
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
        $("#ip_sus").keyup(checarIP);
    });

    $(document).ready(function () {
        $("#ip_sus").change(checarIP);
    });

    function checarIP() {
        var ip = document.getElementById('ip_sus').value;
        var patron = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/g;
        if (ip) {
            if (ip.search(patron) == -1) {
                document.getElementById("checkip").innerHTML = "<div class='alert alert-danger'><i class='fa fa-times'></i> IP erronea</div><input id='ipchecker' type='hidden' value='0' name='ipchecker'>";
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
                var params = "ip_sus=" + ip + "&ip_act=<?php echo $row['ip_sus']; ?>";
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
        $("#ns_sus").keyup(checarNS);
    });

    $(document).ready(function () {
        $("#ns_sus").change(checarNS);
    });

    function checarNS() {

        var ns = document.getElementById('ns_sus').value;

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
            var params = "ns_sus=" + ns + "&ns_act=<?php echo $row['ns_sus']; ?>";
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
        console.log("funcion");
        $("#mac_sus").keyup(checarMAC);
    });

    $(document).ready(function () {
        console.log("funcion");
        $("#mac_sus").change(checarMAC);
    });

    function checarMAC() {
        var mac = document.getElementById('mac_sus').value;
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
                var params = "mac_sus=" + mac + + "&mac_act=<?php echo $row['mac_sus']; ?>";
                xhttp.send(params);
            }
        }
        else{
            document.getElementById("checkmac").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>

</body>

</html>
