<?PHP
date_default_timezone_set("Asia/Jakarta");


$pdf = new FPDF('L', 'pt', 'A4');
$pdf->SetTitle('Laporan Pemesanan Barang');
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
$pdf->Cell(0, 10, 'Surat Jalan', 0, 0, 'C');
$pdf->Ln(25);

$pdf->SetFont('Times', '', 12);
$pdf->SetX(25);
$pdf->SetLineWidth(1);
$pdf->Cell(120, 10, "Project Id", 0, "LR", "L");
$pdf->Cell(250, 10, ": " . $project['kd_proj'], 0, "L", "L");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(120, 30, "Project Due Date", 0, "LR", "L");
$pdf->Cell(250, 30, ": " . date("d-m-Y", strtotime($project['date_project'])), 0, "L", "L");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(120, 10, "Nama Customer", 0, "LR", "L");
$pdf->Cell(250, 10, ": " . $project['nama_cust'], 0, "L", "L");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(120, 30, "Kode Customer", 0, "LR", "L");
$pdf->Cell(250, 30, ": " .  $project['kd_cust'], 0, "L", "L");
$pdf->Ln(30);


$pdf->SetX(70);

$pdf->SetFont('Times', 'B', 10);
$pdf->SetLineWidth(1);
$pdf->SetFillColor(252, 255, 189);
$pdf->Cell(25, 25, "No", 1, "LR", "C", true);
$pdf->Cell(100, 25, "Jenis Barang", 1, "LR", "C", true);
$pdf->Cell(130, 25, "Nama Barang", 1, "LR", "C", true);
$pdf->Cell(130, 25, "Ukuran", 1, "LR", "C", true);
$pdf->Cell(70, 25, "Warna", 1, "LR", "C", true);
$pdf->Cell(230, 25, "Keterangan", 1, "LR", "C", true);

$pdf->Ln();

if (!empty($detail)) {
    $no = 1;
    $nilaiY = $pdf->GetY();
    $min_width = 230;
    $def_width = 100;

    foreach ($detail as $row) {
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $pdf->SetX(70);
        $pdf->SetFont('Times', 'B', 10);
        $StringWidth = $pdf->GetStringWidth($row['keterangan']);

        if ($StringWidth > 230) {

            $pdf->Sety($nilaiY);
            $pdf->SetX(525);
            $pdf->MultiCell(230, 22, $row['keterangan'], 1, "LR", false);
            $current_y = $pdf->GetY();

            $height = $current_y - $nilaiY;

            $pdf->Sety($nilaiY);
            $pdf->SetX(70);
            $pdf->MultiCell(25, $height, $no, 1, "C", false);
            $pdf->Sety($nilaiY);
            $pdf->SetX(95);
            $pdf->MultiCell(100, $height, $row['jenis_barang'], 1, "C", false);
            $pdf->Sety($nilaiY);
            $pdf->SetX(195);
            $pdf->MultiCell(130, $height, $row['nama_barang'], 1, "C", false);
            $pdf->Sety($nilaiY);
            $pdf->SetX(325);
            $pdf->MultiCell(130, $height, $row['ukuran'], 1, "C", false);
            $pdf->Sety($nilaiY);
            $pdf->SetX(455);
            $pdf->MultiCell(70, $height, $row['warna'], 1, "C", false);
            $nilaiY = $height;
        } else {
            $pdf->Cell(25, 100, $no, 1, "LR", "C");
            $pdf->Cell(100, 100, $row['jenis_barang'], 1, "LR", "C");
            $pdf->Cell(130, 100, $row['nama_barang'], 1, "LR", "C");
            $pdf->Cell(130, 100, $row['ukuran'], 1, "LR", "C");
            $pdf->Cell(70, 100, $row['warna'], 1, "LR", "C");

            $pdf->Cell(230, 100, $row['keterangan'], 1, "LR", "");
            $nilaiY = $pdf->GetY();
        }


        $pdf->Ln();
        // $nilaiY = $pdf->GetY();
        // $nilaiY = $height;
        $no++;
    }
}
$pdf->Ln(20);

$pdf->SetX(25);

$pdf->SetFont('Times', 'B', 10);
$pdf->SetLineWidth(1);
$pdf->SetFillColor(252, 255, 189);
$pdf->Cell(100, 25, "Manager", 1, "LR", "C", true);
$pdf->Cell(100, 25, "Pengirim", 1, "LR", "C", true);
$pdf->Cell(100, 25, "Penerima", 1, "LR", "C", true);

$pdf->Ln();

$pdf->SetX(25);
$pdf->SetFont('Times', 'B', 10);
$pdf->SetLineWidth(1);
$pdf->SetFillColor(252, 255, 189);
$pdf->Cell(100, 60, "", 1, "LR", "C");
$pdf->Cell(100, 60, "", 1, "LR", "C");
$pdf->Cell(100, 60, "", 1, "LR", "C");
$pdf->Ln();

// $pdf->SetX(25);
// $pdf->SetFont('Times', 'B', 10);
// $pdf->SetLineWidth(1);
// $pdf->SetFillColor(252, 255, 189);
// $pdf->Cell(130, 22, "Nama:", 1, "LR", "l");
// $pdf->Cell(130, 22, "Nama:", 1, "LR", "l");
// $pdf->Cell(130, 22, "Nama:", 1, "LR", "l");
// $pdf->Ln();


$pdf->Output('PO-' . $project['kd_proj'] . '.pdf', 'I');
