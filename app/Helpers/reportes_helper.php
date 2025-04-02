<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!function_exists('exportar_historial_excel')) {
    function exportar_historial_excel($registros, $evento) {
        if (empty($registros)) {
            return false;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados de la hoja de cálculo
        $sheet->setCellValue('A1', 'Usuario');
        $sheet->setCellValue('B1', 'Empresa');
        $sheet->setCellValue('C1', 'Fecha');
        $sheet->setCellValue('D1', 'Hora');
        $sheet->setCellValue('E1', 'Tipo');
        $sheet->setCellValue('F1', 'Acceso');
        $sheet->setCellValue('G1', 'Evento');

        // Aplicar estilos opcionales
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // poniendo los datos
        $row = 2;
        foreach ($registros as $registro) {
            $sheet->setCellValue('A' . $row, $registro['nombreCompleto']);
            $sheet->setCellValue('B' . $row, $registro['empresa']);
            $sheet->setCellValue('C' . $row, "{$registro['day']}/{$registro['month']}/{$registro['year']}");
            $sheet->setCellValue('D' . $row, $registro['hour']);
            $sheet->setCellValue('E' . $row, $registro['type']);
            $sheet->setCellValue('F' . $row, $registro['userRegistration']);
            $sheet->setCellValue('G' . $row, $evento);
            $row++;
        }

        // Creación del archivo
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $excelData = ob_get_clean();

        return $excelData; // retorna el binario del Excel
    }
}