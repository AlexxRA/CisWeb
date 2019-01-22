<?php
    require '../../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    /*$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');*/

    $documento = new Spreadsheet();
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

    //$writer = new Xlsx($documento);

    # Le pasamos la ruta de guardado
    //$writer->save('nombre_del_documento.xlsx');
    $nombreDelDocumento = "Ejemplo.xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($documento, 'Xlsx');
    $writer->save('php://output');
    exit;
?>