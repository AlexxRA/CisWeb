<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - Postes</title>
</head>

<body id="page-top">
<?php include("../../../caducarSesion.php");
include ("../../../SGBD/Connector.php");
include("addPosteP.php");
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
                <a class="dropdown-item active" href="showPoste.php">Camaras</a>
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
                    <a href="showPoste.php">Postes</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo PMI-->
            <div class="card card-register mx-auto mb-5">
                <div class="card-header">Registrar nuevo poste</div>
                <div class="card-body">
                    <form action="addPoste.php" method="post" name="formCamera" id="formCamera">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_pmi" >ID PMI</label>
                                            </div>
                                            <?php

                                            $conn = new Connector();
                                            $sql = mysqli_query($conn->getCon(), "SELECT id_pmi FROM pmi");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showPMI.php");
                                            }else{
                                                $sqlp = mysqli_query($conn->getCon(), "SELECT id_pmi FROM poste");
                                                $data = array();
                                                while($rowp=mysqli_fetch_array($sqlp) ) {
                                                    $data[] = $rowp["id_pmi"];
                                                }
                                                $longitud = count($data);
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $flag=0;
                                                    for($i=0; $i<$longitud; $i++)
                                                    {
                                                        if($data[$i]==$row['id_pmi']){
                                                            $flag=1;
                                                        }
                                                    }
                                                    if($flag==0){
                                                        $option .= '<option value = "'.$row['id_pmi'].'">'.$row['id_pmi'].'</option>';
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
                                        <input type="text" id="ns_poste" name="ns_poste" class="form-control" placeholder="Numero de Serie" required onkeypress="return validarnum(event)">
                                        <label for="ns_poste">Numero de Serie</label>
                                        <div id="checkns" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="altura" name="altura" class="form-control" placeholder="Altura" required onkeypress="return validarnum(event)">
                                        <label for="altura">Altura</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="contratista" name="contratista" class="form-control" placeholder="Contratista" required >
                                        <label for="contratista">Contratista</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ns_ups" name="ns_ups" class="form-control" placeholder="NS UPS" required onkeypress="return validarnum(event)">
                                        <label for="ns_ups">NS UPS</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" id="ns_gabinete" name="ns_gabinete" class="form-control" placeholder="NS Gabinete" required onkeypress="return validarnum(event)">
                                        <label for="ns_gabinete">NS Gabinete</label>
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
                                                <label class="input-group-text" for="datepickerA">Fecha de Asignacion</label>
                                            </div>
                                            <input type="text" id="datepickerA" name="datepickerA" class="form-control pt-1" required/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepickerA').datepicker({
                                                    autoclose: true,
                                                    closeOnDateSelect: true
                                                }).datepicker("setDate",'now');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="datepickerB">Fecha de Base</label>
                                            </div>
                                            <input type="text" id="datepickerB" name="datepickerB" class="form-control pt-1" required/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepickerB').datepicker({
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
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="datepickerM">Fecha de Montaje</label>
                                            </div>
                                            <input type="text" id="datepickerM" name="datepickerM" class="form-control pt-1" required/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepickerM').datepicker({
                                                    autoclose: true,
                                                    closeOnDateSelect: true
                                                }).datepicker("setDate",'now');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="datepickerE">Fecha de Electrificado</label>
                                            </div>
                                            <input type="text" id="datepickerE" name="datepickerE" class="form-control pt-1" required/>
                                            <script>
                                                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
                                                $('#datepickerE').datepicker({
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
                                        <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Comentarios"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Agregar</button>
                                <a href="showPoste.php" class="btn btn-sm btn-danger">Cancelar</a>
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
<script src="validarPoste.js"></script>

<script>
    $(document).ready(function () {
        $("#ns_poste").keyup(checarNS);
    });


    $(document).ready(function () {
        $("#ns_poste").change(checarNS);
    });

    function checarNS() {

        var ns = document.getElementById('ns_poste').value;

        if (ns) {
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
                xhttp.send("ns_poste=" + ns + "");
            }
        else{
            document.getElementById("checkns").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }
</script>


</body>

</html>