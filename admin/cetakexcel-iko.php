<?php
require_once('../function.php');
require_once('../vendor/autoload.php'); // Load Composer's autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new PhpSpreadsheet object
$objPHPExcel = new Spreadsheet();

// Set document properties
$objPHPExcel->getProperties()->setCreator('Your Name')
    ->setLastModifiedBy('Your Name')
    ->setTitle('Laporan Kegiatan IKO')
    ->setSubject('Laporan')
    ->setDescription('Laporan kegiatan IKO yang diekspor ke Excel');

// Judul Sheet
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Laporan Kegiatan IKO')
    ->mergeCells('A1:H1');

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray([
    'font' => ['bold' => true],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
]);


// Header Kolom
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'No.')
    ->setCellValue('B2', 'Tanggal Kegiatan')
    ->setCellValue('C2', 'Lokasi')
    ->setCellValue('D2', 'Tim')
    ->setCellValue('E2', 'Keterangan')
    ->setCellValue('F2', 'Status')
    ->setCellValue('G2', 'Catatan')
    ->setCellValue('H2', 'Foto');

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray([
    'font' => ['bold' => true],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
]);

// Menentukan jenis filter dan ambil data
$data = [];
$nama_file = 'report_iko.xlsx';

if (isset($_GET['tgl1']) && isset($_GET['tgl2'])) {
    $tgl1 = $_GET['tgl1'];
    $tgl2 = $_GET['tgl2'];
    $data = query("SELECT * FROM pelaporaniko WHERE tgl_kegiatan BETWEEN '$tgl1' AND '$tgl2'");
    $nama_file = 'report_harianIKO.xlsx';
} elseif (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $startDate = "$year-$month-01";
    $endDate = date("Y-m-t", strtotime($startDate));
    $data = query("SELECT * FROM pelaporaniko WHERE tgl_kegiatan BETWEEN '$startDate' AND '$endDate'");
    $nama_file = 'report_bulananIKO.xlsx';
} elseif (isset($_GET['month1']) && isset($_GET['month2'])) {
    $month1 = $_GET['month1'];
    $month2 = $_GET['month2'];
    $data = query("SELECT * FROM pelaporaniko WHERE tgl_kegiatan BETWEEN '$month1' AND '$month2'");
    $nama_file = 'report_rentangBulanIKO.xlsx';
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
        ->setCellValue('H' . $row, $d['foto']);

    // Menambahkan gambar jika ada
    if (!empty($d['foto'])) {
        $file_extension = pathinfo($d['foto'], PATHINFO_EXTENSION);
        $imgPath = '../' . $d['foto'];

        if (file_exists($imgPath)) {
            $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
            $objDrawing->setName('Foto');
            $objDrawing->setDescription('Foto');

            if (strtolower($file_extension) === 'png') {
                $objDrawing->setImageResource(imagecreatefrompng($imgPath));
                $objDrawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_PNG);
                $objDrawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG);
            } elseif (in_array(strtolower($file_extension), ['jpg', 'jpeg'])) {
                $objDrawing->setImageResource(imagecreatefromjpeg($imgPath));
                $objDrawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_JPEG);
                $objDrawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
            }

            $objDrawing->setCoordinates('H' . $row);
            $objDrawing->setWidth(100);
            $objDrawing->setHeight(100);
            $objDrawing->setOffsetX(1);
            $objDrawing->setOffsetY(1);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        }
    }

    $row++;
}

// Tambahkan border ke seluruh data (A2 sampai baris terakhir)
$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];
$objPHPExcel->getActiveSheet()->getStyle("A2:H{$lastRow}")->applyFromArray($styleArray);

// Style, autosize, dan tinggi baris
$objPHPExcel->getActiveSheet()->getStyle("A3:H{$lastRow}")->getAlignment()
    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

foreach (range('A', 'H') as $col) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
}

for ($i = 1; $i <= $lastRow; $i++) {
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(100);
}

// Set judul sheet dan kirim ke browser
$objPHPExcel->getActiveSheet()->setTitle('Pelaporan Kegiatan IKO');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$nama_file\"");
header('Cache-Control: max-age=0');

$objWriter = new Xlsx($objPHPExcel);
$objWriter->save('php://output');
exit;
