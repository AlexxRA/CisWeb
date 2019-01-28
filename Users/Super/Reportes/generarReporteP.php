<?php

    require '../../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Border;

    $conn = mysqli_connect("localhost", "root", "", "cis_db");

    $sqlPMI = "SELECT ";
    $sqlCamaras = "SELECT ";
    $sqlPostes = "SELECT ";

    $spreadsheet = new Spreadsheet();

    if (isset($_POST["pmi"])) {
        $primero=false;
        $parametros=$_POST["pmi"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlPMI .= ", ";
                }
                $sqlPMI .= $parametros[$i];
                $primero = true;
            }
        }
        $sheetPMI = $spreadsheet->getActiveSheet();
        $sheetPMI->setTitle('PMI');


        $sqlPMI .= " FROM pmi";//SELECT id_pmi, calle, cruce, colonia FROM pmi
        $queryPMI=mysqli_query($conn, $sqlPMI);

        guardarValorCelda($queryPMI, $cantParametros, $sheetPMI);
        guardarTituloColumna($parametros,$cantParametros, $sheetPMI);

    }

    if (isset($_POST["camaras"])) {
        $primero=false;
        $parametros=$_POST["camaras"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlCamaras .= ", ";
                }
                $sqlCamaras .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetCamaras = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Camaras');
        $spreadsheet->addSheet($sheetCamaras, 1);



        $sqlCamaras .= " FROM camara";//SELECT id_pmi, calle, cruce, colonia FROM pmi
        $queryCamaras=mysqli_query($conn, $sqlCamaras);

        guardarValorCelda($queryCamaras, $cantParametros, $sheetCamaras);
        guardarTituloColumna($parametros,$cantParametros, $sheetCamaras);
    }
    //echo $sqlCamaras;

    $writer = new Xlsx($spreadsheet);
    $writer->save('ejemplo.xlsx');
    exit;

    function guardarValorCelda($query, $cantParametros, $sheet){
        $numCelda=1;
        while ($row = mysqli_fetch_array($query)){
            $columna= "A";
            for ($j=0; $j<$cantParametros; $j++){

                $sheet->setCellValue($columna.($numCelda+1),$row[$j]);
                $cel=ord($columna)+1;
                $columna=chr($cel);

            }
            $numCelda++;
        }
    }

    function guardarTituloColumna($parametros, $cantParametros, $sheet){
        $numCelda=1;
        $columna= "A";
        for ($j=0; $j<$cantParametros; $j++){
            $sheet->setCellValue($columna.($numCelda),$parametros[$j]);
            $cel=ord($columna)+1;
            $columna=chr($cel);
        }
    }
?>