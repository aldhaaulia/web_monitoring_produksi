<?PHP
date_default_timezone_set("Asia/Jakarta");


$pdf = new FPDF('L', 'pt', 'A4');
$pdf->SetTitle('Laporan Kegiatan Produksi');
$pdf->AliasNbPages();
$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->SetAutoPageBreak(true, 50);

$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(70);
$pdf->Image('assets/img/logo2.png', 40, 10, 100, 87);
// $pdf->Image('assets/img/logo2.png', 705, 10, 100, 87);
$pdf->Cell(680, 10, 'PT Kemala Cipta Selaras', 0, 0, 'C');
$pdf->Ln(14);
$pdf->Cell(70);
$pdf->SetFont('Times', 'I', 9);
$pdf->Cell(680, 10, 'Jl. Gedung Pinang PS14 No.159', 0, 0, 'C');
$pdf->Ln(14);
$pdf->Cell(70);
$pdf->Cell(680, 10, 'Pondok Pinang, Jakarta Selatan, Indonesia', 0, 0, 'C');
$pdf->Ln(14);
$pdf->Cell(70);
$pdf->Cell(680, 10, 'E-Mail : kemala@kemalainterior.com - Telp : (021) 765 2563', 0, 0, 'C');
// $pdf->Ln(14);
// $pdf->Cell(70);
// $pdf->Cell(680, 10, 'E-Mail : kemala@kemalainterior.com', 0, 0, 'C');
$pdf->SetLineWidth(1);
$pdf->Line(20, 100, 820, 100);
$pdf->SetLineWidth(1, 5);
$pdf->Line(20, 102, 820, 102);
$pdf->SetLineWidth(1, 5);
$pdf->Line(20, 102, 820, 102);
$pdf->SetY(110);
$pdf->SetFont('Times', 'BU', 16);
$pdf->Cell(0, 10, 'Laporan Kegiatan Produksi', 0, 0, 'C');
$pdf->Ln(25);

$pdf->SetFont('Times', '', 12);
$pdf->SetX(25);
$pdf->SetLineWidth(1);
$pdf->Cell(120, 10, "Tanggal Cetak", 0, "LR", "L");
$pdf->Cell(250, 10, ": " . $tanggal, 0, "L", "L");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(120, 30, "Operator", 0, "LR", "L");
$pdf->Cell(250, 30, ": " . $nama, 0, "L", "L");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(120, 10, "Periode", 0, "LR", "L");
$pdf->Cell(250, 10, ": " . $from_date . " s/d " . $to_date, 0, "L", "L");
$pdf->Ln(30);


$pdf->SetX(110);

$pdf->SetFont('Times', 'B', 10);
$pdf->SetLineWidth(1);
$pdf->SetFillColor(252, 255, 189);
$pdf->Cell(25, 25, "No", 1, "LR", "C", true);
$pdf->Cell(180, 25, "Nama Customer", 1, "LR", "C", true);
$pdf->Cell(100, 25, "Project Id", 1, "LR", "C", true);
$pdf->Cell(70, 25, "Project Date", 1, "LR", "C", true);
$pdf->Cell(70, 25, "Due Date", 1, "LR", "C", true);
$pdf->Cell(130, 25, "Jumlah", 1, "LR", "C", true);

$pdf->Ln();

if (!empty($transaksi)) {
    $no = 1;
    $nilaiY = $pdf->GetY();
    foreach ($transaksi as $row) {


        $pdf->SetX(110);
        $pdf->Cell(25, 22, $no, 1, "LR", "C");
        $pdf->Cell(180, 22, $row['nama_cust'], 1, "LR", "C");
        $pdf->Cell(100, 22, $row['kd_proj'], 1, "LR", "C");
        $pdf->Cell(70, 22, $row['tgl_create'], 1, "LR", "C");
        $pdf->Cell(70, 22, $row['date_project'], 1, "LR", "C");
        $pdf->Cell(130, 22, $row['jml_item'] . " Item", 1, "LR", "C");

        $pdf->Ln();
        $nilaiY = $pdf->GetY();
        $no++;
    }
}


$pdf->Output('Laporan-' . $tanggal . '.pdf', 'I');
