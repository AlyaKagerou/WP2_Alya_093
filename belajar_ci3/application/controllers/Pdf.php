<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

// Load database
 public function __construct() {
 parent::__construct();
 //$this->load->model('admin/user_model');
 $this->load->model('Pdf_model', 'Pdf_model');
 }


public function export_excel_pdf(){
 $data = array( 'title' => 'Laporan PDF',
 'kasir' => $this->Excel_model->listing());
 $this->load->view('kasir/laporan_kasir_pdf',$data);
 }

}