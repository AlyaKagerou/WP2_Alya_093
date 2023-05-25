<?php
Class Laporan_customer_pdf extends CI_Controller{
    
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
        $pdf->Cell(190,7,'Laporan Data Customer Toko Serba Ada',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Nama-nama Kasir',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'Kode Customer',1,0);
        $pdf->Cell(85,6,'Nama Customer',1,0);
        $pdf->Cell(27,6,'Alamat',1,0);
        $pdf->Cell(25,6,'Email',1,1);
        $pdf->Cell(25,6,'No. Telp',1,1);
        $pdf->SetFont('Arial','',10);
        $kasir = $this->db->get('customer')->result();
        foreach ($kasir as $row){
            $pdf->Cell(20,6,$row->kd_cust,1,0);
            $pdf->Cell(85,6,$row->nm_cust,1,0);
            $pdf->Cell(27,6,$row->alamat,1,0);
            $pdf->Cell(25,6,$row->email,1,1); 
            $pdf->Cell(25,6,$row->hp,1,1); 
        }
        $pdf->Output();
    }
}