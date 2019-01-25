<?php

    require '../../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Border;

    $conn = mysqli_connect("localhost", "root", "", "cis_db");
    $sqlPMI = "SELECT ";
    $primero=false;

    if (isset($_POST["pmi"])){
        $length = count($_POST["pmi"]);
        for($i=0;$i<$length;$i++) {
            if($_POST["pmi"][$i]){
                if ($primero){
                    $sqlPMI.=", ";
                }
                $sqlPMI.= $_POST["pmi"][$i];
                $primero=true;
            }
        }
        $sqlPMI.=" FROM pmi";
    }
    if (isset($_POST["camaras"])){
        $length = count($_POST["pmi"]);
        for($i=0;$i<$length;$i++) {
            if($_POST["pmi"][$i]){
                if ($primero){
                    $sqlPMI.=", ";
                }
                $sqlPMI.= $_POST["pmi"][$i];
                $primero=true;
            }
        }
        $sqlPMI.=" FROM pmi";
    }
    echo  $sqlPMI;


    /*$query=mysqli_query($conn, $sql);
    $i = 3;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Camaras');
    $sheet->mergeCells("A1:D1");



    $sheet->setCellValue('A1', 'REPORTE DE CAMARAS');
    $sheet->setCellValue('A2', 'NUMERO DE SERIE');
    $sheet->setCellValue('B2', 'NOMBRE');
    $sheet->setCellValue('C2', 'IP');
    $sheet->setCellValue('D2', 'DIRECCION');
    $boldArray = array('font' => array('bold' => true));
    $sheet->getStyle("A1:D2")->applyFromArray($boldArray)->getAlignment()->setHorizontal('center');

    $sheet->getColumnDimension("A")->setWidth(20);
    $sheet->getColumnDimension("B")->setWidth(45);
    $sheet->getColumnDimension("C")->setWidth(30);
    $sheet->getColumnDimension("D")->setWidth(15);

    while ($row = mysqli_fetch_array($query)) {
        $sheet->setCellValue('A'.$i, $row['ns_cam']);
        $sheet->setCellValue('B'.$i, $row['nom_cam']);
        $sheet->setCellValue('C'.$i, $row['ip_cam']);
        $sheet->setCellValue('D'.$i, $row['dir_cam']);
        $i++;
    }*/

    /*$rango="A1:D".$i;
    $styleArray = array('font' => array( 'name' => 'Century Gothic','size' => 12),
        'borders'=>array('allborders'=>array('style'=> Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
    );
    $sheet->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle("true");*/

//    $writer = new Xlsx($spreadsheet);
//
//    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//    header('Content-Disposition: attachment;filename="camarasEjemplo.xlsx"');
//    header('Cache-Control: max-age=0');
//    $writer->save('php://output');
//    exit;

    /*$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');

    /*$documento = new Spreadsheet();
    $documento
        ->getProperties()
        ->setCreator("Aquí va el creador, como cadena")
        ->setLastModifiedBy('Parzibyte') // última vez modificado por
        ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        ->setSubject('El asunto')
        ->setDescription('Este documento fue generado para parzibyte.me')
        ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categoría');

    $hoja = $documento->getActiveSheet();
    $hoja->setTitle("El título de la hoja");
    $hoja->setCellValueByColumnAndRow(1, 1, "Un valor en 1, 1");
    $hoja->setCellValue("B2", "Este va en B2");
    $hoja->setCellValue("A3", "Parzibyte");

    $writer = new Xlsx($documento);

    # Le pasamos la ruta de guardado
    //$writer->save('nombre_del_documento.xlsx');
    $nombreDelDocumento = "Ejemplo.xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    header('Cache-Control: max-age=0');

    //$writer = IOFactory::createWriter($documento, 'Xlsx');
    $writer->save('php://output');
    exit;*/
?>