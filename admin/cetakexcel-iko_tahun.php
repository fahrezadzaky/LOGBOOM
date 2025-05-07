<?php
require_once('../function.php');
require_once('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$objPHPExcel = new Spreadsheet();
$objPHPExcel->getProperties()->setTitle('Laporan Kegiatan IKO');

$sheet = $objPHPExcel->getActiveSheet();
$sheet->setTitle('Pelaporan IKO');

// Judul
$sheet->setCellValue('A1', 'Laporan Kegiatan IKO');
$sheet->mergeCells('A1:H1');
$sheet->getStyle('A1:H1')->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// Header kolom
$headers = ['No.', 'Tanggal Kegiatan', 'Lokasi', 'Tim', 'Keterangan', 'Status', 'Catatan', 'Foto'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '2', $header);
    $sheet->getStyle($col . '2')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ],
        'borders' => [
            'allBorders' => ['borderStyle' => Border::BORDER_THIN]
        ]
    ]);
    $col++;
}

// Ambil data dari database
$year1 = $_GET['year1'] ?? '';
$year2 = $_GET['year2'] ?? '';
$data = [];

if (!empty($year1) && !empty($year2)) {
    $startDate = $year1 . '-01-01';
    $endDate = $year2 . '-12-31';
    $data = query("SELECT * FROM pelaporaniko WHERE tgl_kegiatan BETWEEN '$startDate' AND '$endDate'");
}

// Tulis data ke sheet
$row = 3;
$no = 1;
foreach ($data as $d) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $d['tgl_kegiatan']);
    $sheet->setCellValue('C' . $row, $d['lokasi']);
    $sheet->setCellValue('D' . $row, $d['t_lapor']);
    $sheet->setCellValue('E' . $row, $d['ket']);
    $sheet->setCellValue('F' . $row, $d['status']);
    $sheet->setCellValue('G' . $row, $d['ket_petugas']);

    // Border untuk baris ini
    foreach (range('A', 'H') as $col) {
        $sheet->getStyle($col . $row)->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ]);
    }

    // Tambah gambar jika ada
    $imagePath = '../' . $d['foto'];
    if (!empty($d['foto']) && file_exists($imagePath)) {
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $imageCreate = null;

        if (in_array(strtolower($extension), ['jpg', 'jpeg'])) {
            $imageCreate = imagecreatefromjpeg($imagePath);
        } elseif (strtolower($extension) === 'png') {
            $imageCreate = imagecreatefrompng($imagePath);
        }

        if ($imageCreate) {
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
            $drawing->setImageResource($imageCreate);
            $drawing->setCoordinates('H' . $row);
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $drawing->setHeight(80);
            $drawing->setRenderingFunction(
                strtolower($extension) === 'png'
                    ? \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_PNG
                    : \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_JPEG
            );
            $drawing->setMimeType(
                strtolower($extension) === 'png'
                    ? \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG
                    : \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT
            );
            $drawing->setWorksheet($sheet);
        }
    }

    $row++;
}

// Atur kolom lebar otomatis
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Atur tinggi baris
for ($i = 3; $i < $row; $i++) {
    $sheet->getRowDimension($i)->setRowHeight(90);
}

// Output ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_ICO_' . $year1 . '-' . $year2 . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($objPHPExcel);
$writer->save('php://output');
exit;
