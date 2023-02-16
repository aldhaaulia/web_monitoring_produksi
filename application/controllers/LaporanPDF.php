<?php 
class LaporanPDF extends MY_Controller
{
    function _construct(){
        parent::__construct();
        $this->load->library('fpdf');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('M_Laporan');
    }

    function index(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','8',16);
        $pdf->Cell(190,7,'Laporan Kegiatan Produksi',0,1.'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Times','B');
        $pdf->Cell(20,6,'NO',1,0);
        $pdf->Cell(20,6,'Customer Name',1,0);
        $pdf->Cell(20,6,'Project Id',1,0);
        $pdf->Cell(20,6,'Project Date',1,0);
        $pdf->Cell(20,6,'Deadline',1,0);
        $pdf->SetFont('Times','',10);
        
    }
}
?>