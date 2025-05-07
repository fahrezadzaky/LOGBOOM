<?php
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('../function.php');
// Extend TCPDF with custom header and footer
class MYPDF extends TCPDF
{

    // Page header
    public function Header()
    {
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 10, 'Report Data Pelaporan Kegiatan IKO', 0, false, 'C', 0, '', 0, false, 'H', 'H');
        $this->Ln(10);
        // Add additional header if needed
        $this->Cell(0, 10, 'Additional Header Info', 0, false, 'C', 0, '', 0, false, 'H', 'H');
        $this->Ln(10);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Report Harian IKO');
$pdf->SetSubject('Report Harian IKO');
$pdf->SetKeywords('report harian IKO');

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Get year range from GET parameters
$year1 = isset($_GET['year1']) ? $_GET['year1'] : date('Y');
$year2 = isset($_GET['year2']) ? $_GET['year2'] : date('Y');

// Query data from the database based on year range
$data = query("SELECT * FROM pelaporaniko WHERE YEAR(tgl_kegiatan) BETWEEN '$year1' AND '$year2' ORDER BY tgl_kegiatan DESC");

// Add data to the PDF
$html = '<h1 align="center">Report Data Pelaporan Kegiatan IKO</h1>';
$html .= '<h3 align="center">Periode ' . $year1 . ' - ' . $year2 . '</h3>';
$html .= '<table border="1" cellpadding="5">';
$html .= '<tr align="center"><th>No.</th><th>Tanggal Kegiatan</th><th>Lokasi</th><th>Tim</th><th>Keterangan</th><th>Foto</th><th>Status</th><th>Catatan</th></tr>';
foreach ($data as $d) {
    $html .= '<tr>';
    $html .= '<td>' . $d['id'] . '</td>';
    $html .= '<td>' . $d['tgl_kegiatan'] . '</td>';
    $html .= '<td>' . $d['lokasi'] . '</td>';
    $html .= '<td>' . $d['t_lapor'] . '</td>';
    $html .= '<td>' . $d['ket'] . '</td>';
    $html .= '<td><img src="../' . $d['foto'] . '" alt="Foto Kegiatan" style="max-width: 100px;height: auto;"></td>';
    $html .= '<td>' . $d['status'] . '</td>';
    $html .= '<td>' . $d['ket_petugas'] . '</td>';
    $html .= '<td>' . $d['status'] . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, false, false, '');

// Close and output PDF document
$pdf->Output('report_tahunanIKO.pdf', 'D');

// Include footer
include "templates/footer.php";
