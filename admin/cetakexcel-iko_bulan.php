<?php
require_once('../function.php');
require_once('../vendor/autoload.php'); // Load Composer's autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

$objPHPExcel = new Spreadsheet();

// Set judul
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Laporan Kegiatan IKO')
    ->mergeCells('A1:H1');

// Gaya judul + border
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// Header kolom
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'No.')
    ->setCellValue('B2', 'Tanggal Kegiatan')
    ->setCellValue('C2', 'Lokasi')
    ->setCellValue('D2', 'Tim')
    ->setCellValue('E2', 'Keterangan')
    ->setCellValue('F2', 'Status')
    ->setCellValue('G2', 'Catatan')
    ->setCellValue('H2', 'Foto');

// Gaya header + border
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray([
    'font' => ['bold' => true],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// Filter berdasarkan bulan & tahun
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $startDate = $year . '-' . $month . '-01';
    $endDate = date("Y-m-t", strtotime($startDate));
    $data = query("SELECT * FROM pelaporaniko WHERE tgl_kegiatan BETWEEN '$startDate' AND '$endDate'");
}

$row = 3;
foreach ($data as $d) {
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $row, $d['id'])
        ->setCellValue('B' . $row, $d['tgl_kegiatan'])
        ->setCellValue('C' . $row, $d['lokasi'])
        ->setCellValue('D' . $row, $d['t_lapor'])
        ->setCellValue('E' . $row, $d['ket'])
        ->setCellValue('F' . $row, $d['status'])
        ->setCellValue('G' . $row, $d['ket_petugas'])
        ->setCellValue('H' . $row, ''); // kosongkan teks, gambar akan masuk di sini

    if (!empty($d['foto'])) {
        $ext = strtolower(pathinfo($d['foto'], PATHINFO_EXTENSION));
        $path = '../' . $d['foto'];

        $drawing = new MemoryDrawing();
        $drawing->setName('Foto');
        $drawing->setDescription('Foto');

        if ($ext === 'png') {
            $drawing->setImageResource(imagecreatefrompng($path));
            $drawing->setRenderingFunction(MemoryDrawing::RENDERING_PNG);
            $drawing->setMimeType(MemoryDrawing::MIMETYPE_PNG);
        } elseif (in_array($ext, ['jpg', 'jpeg'])) {
            $drawing->setImageResource(imagecreatefromjpeg($path));
            $drawing->setRenderingFunction(MemoryDrawing::RENDERING_JPEG);
            $drawing->setMimeType(MemoryDrawing::MIMETYPE_DEFAULT);
        }

        $drawing->setCoordinates('H' . $row);
        $drawing->setWidth(100);
        $drawing->setHeight(100);
        $drawing->setOffsetX(1);
        $drawing->setOffsetY(1);
        $drawing->setWorksheet($objPHPExcel->getActiveSheet());
    }

    // Terapkan border untuk baris data
    $objPHPExcel->getActiveSheet()->getStyle("A$row:H$row")->applyFromArray([
        'borders' => [
            'allBorders' => ['borderStyle' => Border::BORDER_THIN]
        ]
    ]);

    $row++;
}

// Perataan isi seluruh data
$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
$objPHPExcel->getActiveSheet()->getStyle("A3:H$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A3:H$lastRow")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

// Auto size kolom
foreach (range('A', 'H') as $col) {
    if ($col != 'H') {
        $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
    }

$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
}

// Tinggi semua baris
for ($i = 1; $i <= $lastRow; $i++) {
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(100);
}

// Judul sheet
$objPHPExcel->getActiveSheet()->setTitle('Pelaporan Kegiatan IKO');
$objPHPExcel->setActiveSheetIndex(0);

// Output Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report_bulananIKO.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($objPHPExcel);
$writer->save('php://output');
exit;

include "templates/footer.php";
