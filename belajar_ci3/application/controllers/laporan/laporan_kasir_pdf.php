<?php
Class Laporan_kasir_pdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'Laporan Data Kasir Toko Serba Ada',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Nama-nama Kasir',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'Kode Kasir',1,0);
        $pdf->Cell(85,6,'Nama Kasir',1,0);
        $pdf->Cell(27,6,'User Name',1,0);
        $pdf->Cell(25,6,'Password',1,1);
        $pdf->SetFont('Arial','',10);
        $kasir = $this->db->get('kasir')->result();
        foreach ($kasir as $row){
            $pdf->Cell(20,6,$row->kode_kasir,1,0);
            $pdf->Cell(85,6,$row->nama_kasir,1,0);
            $pdf->Cell(27,6,$row->username_kasir,1,0);
            $pdf->Cell(25,6,$row->password_kasir,1,1); 
        }
        $pdf->Output();
    }
}