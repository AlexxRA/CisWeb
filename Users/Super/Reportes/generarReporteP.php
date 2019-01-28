<?php

    require '../../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Border;

    $conn = mysqli_connect("localhost", "root", "", "cis_db");

    $sqlPMI = $sqlCamaras = $sqlPostes = $sqlSwitches = $sqlBotones = $sqlSus = $sqlRB = $sqlSitios = "SELECT ";
    $nombreDocumento;

    $indexSheet=0;

    $spreadsheet = new Spreadsheet();

    if(isset($_POST["nombreArchivo"])){
        $nombreDocumento = $_POST["nombreArchivo"];
    }

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
        $sheetPMI = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'PMI');
        $spreadsheet->addSheet($sheetPMI, $indexSheet++);


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
        $spreadsheet->addSheet($sheetCamaras, $indexSheet++);



        $sqlCamaras .= " FROM camara";//SELECT id_pmi, calle, cruce, colonia FROM pmi
        $queryCamaras=mysqli_query($conn, $sqlCamaras);

        guardarValorCelda($queryCamaras, $cantParametros, $sheetCamaras);
        guardarTituloColumna($parametros,$cantParametros, $sheetCamaras);
    }

    if (isset($_POST["postes"])) {
        $primero=false;
        $parametros=$_POST["postes"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlPostes .= ", ";
                }
                $sqlPostes .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetPostes = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Postes');
        $spreadsheet->addSheet($sheetPostes, $indexSheet++);



        $sqlPostes .= " FROM poste";
        $queryPostes=mysqli_query($conn, $sqlPostes);

        guardarValorCelda($queryPostes, $cantParametros, $sheetPostes);
        guardarTituloColumna($parametros,$cantParametros, $sheetPostes);
    }

    if (isset($_POST["switches"])) {
        $primero=false;
        $parametros=$_POST["switches"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlSwitches .= ", ";
                }
                $sqlSwitches .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetSwitches = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Switches');
        $spreadsheet->addSheet($sheetSwitches, $indexSheet++);



        $sqlSwitches .= " FROM switch";
        $querySwitches=mysqli_query($conn, $sqlSwitches);

        guardarValorCelda($querySwitches, $cantParametros, $sheetSwitches);
        guardarTituloColumna($parametros,$cantParametros, $sheetSwitches);
    }

    if (isset($_POST["botones"])) {
        $primero=false;
        $parametros=$_POST["botones"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlBotones .= ", ";
                }
                $sqlBotones .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetBotones = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Botones');
        $spreadsheet->addSheet($sheetBotones, $indexSheet++);



        $sqlBotones .= " FROM boton";
        $queryBotones=mysqli_query($conn, $sqlBotones);

        guardarValorCelda($queryBotones, $cantParametros, $sheetBotones);
        guardarTituloColumna($parametros,$cantParametros, $sheetBotones);
    }

    if (isset($_POST["suscriptores"])) {
        $primero=false;
        $parametros=$_POST["suscriptores"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlSus .= ", ";
                }
                $sqlSus .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetSus = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Suscriptores');
        $spreadsheet->addSheet($sheetSus, $indexSheet++);



        $sqlSus .= " FROM suscriptor";
        $querySus=mysqli_query($conn, $sqlSus);

        guardarValorCelda($querySus, $cantParametros, $sheetSus);
        guardarTituloColumna($parametros,$cantParametros, $sheetSus);
    }

    if (isset($_POST["radiobases"])) {
        $primero=false;
        $parametros=$_POST["radiobases"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlRB .= ", ";
                }
                $sqlRB .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetRB = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Radiobases');
        $spreadsheet->addSheet($sheetRB, $indexSheet++);



        $sqlRB .= " FROM radiobase";
        $queryRB=mysqli_query($conn, $sqlRB);

        guardarValorCelda($queryRB, $cantParametros, $sheetRB);
        guardarTituloColumna($parametros,$cantParametros, $sheetRB);
    }

    if (isset($_POST["sitios"])) {
        $primero=false;
        $parametros=$_POST["sitios"];
        $cantParametros = count($parametros);
        for ($i = 0; $i < $cantParametros; $i++) {
            if ($parametros[$i]) {
                if ($primero) {
                    $sqlSitios .= ", ";
                }
                $sqlSitios .= $parametros[$i];
                $primero = true;
            }
        }

        $sheetSitios = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Sitios');
        $spreadsheet->addSheet($sheetSitios, $indexSheet++);



        $sqlSitios .= " FROM sitio";
        $querySitios=mysqli_query($conn, $sqlSitios);

        guardarValorCelda($querySitios, $cantParametros, $sheetSitios);
        guardarTituloColumna($parametros,$cantParametros, $sheetSitios);
    }



    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nombreDocumento.'.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

    function guardarValorCelda($query, $cantParametros, $sheet){
        $numCelda=1;
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '0000'],
                ],
            ],
        ];
        while ($row = mysqli_fetch_array($query)){
            $columna= "A";
            for ($j=0; $j<$cantParametros; $j++){
                $sheet->setCellValue($columna.($numCelda+1),$row[$j]);
                $sheet->getColumnDimension($columna)->setAutoSize(true);
                $sheet->getStyle($columna.($numCelda+1))->applyFromArray($styleArray);
                $cel=ord($columna)+1;
                $columna=chr($cel);
            }
            $numCelda++;
        }
    }

    function guardarTituloColumna($parametros, $cantParametros, $sheet){
        $numCelda=1;
        $columna= "A";
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '0000'],
                ],
            ],
        ];

        //$worksheet->getStyle('B2:G8')->applyFromArray($styleArray);
        for ($j=0; $j<$cantParametros; $j++){
            $sheet->setCellValue($columna.($numCelda),$parametros[$j]);
            $sheet->getStyle($columna.($numCelda))->applyFromArray($styleArray);
            $sheet->getStyle($columna.($numCelda))->getFont()->setName('Arial')->setBold(true);
            $sheet->getStyle($columna.($numCelda))->getFont()->setSize(12);
            $sheet->getColumnDimension($columna)->setAutoSize(true);

            $cel=ord($columna)+1;
            $columna=chr($cel);
        }
    }

    function estiloHoja($parametros, $cantParametros, $sheet){

    }
?>