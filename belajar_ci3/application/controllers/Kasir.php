<?php 
use Dompdf\Dompdf;

class Kasir extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin')
        redirect();

        $this->data['aktif'] = 'kasir';
        $this->load->model('M_kasir', 'm_kasir');
    }
    public function index(){
        $this->data['title'] = 'Data Kasir';
        $this->data['all_kasir'] = $this->m_kasir->lihat();
        $this->data['no'] = 1;

        $this->load->view('kasir/lihat', $this->data);
    }

    //Tambah Data Kasir
    public function tambah(){
        if($this->session->login['role'] == 'kasir'){
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('kasir');
        }
        $this->data['title'] = 'Tambah Kasir';
        $this->load->view('kasir/tambah', $this->data);
    }
    public function proses_tambah(){
        if($this->session->login['role'] = 'kasir'){
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('kasir');
        }
        $data = [
            'kode_kasir' => $this->input->post('kode_kasir'),
            'nama_kasir' => $this->input->post('nama_kasir'),
            'username_kasir' => $this->input->post('username_kasir'),
            'password_kasir' => $this->input->post('password_kasir'),
        ];
        if($this->m_kasir->tambah($data)){
            $this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
            redirect('kasir');
        }else{
            $this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
            redirect('kasir');
        }
    }
    //Ubah Data Kasir
    public function ubah($id){
        if($this->session->login['role'] == 'kasir'){
            $this->session->set_flashdata('error', 'Ubah Data hanya untuk admin!');
            redirect('kasir');
        }
        $this->data['title'] = 'Ubah Kasir';
        $this->data['kasir'] = $this->m_kasir->lihat_id($id);
        $this->load->view('kasir/ubah',$this->data);
    }
    public function proses_ubah($id){
        if($this->session->login['role'] = 'kasir'){
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('kasir');
        }
        $data = [
            'kode_kasir' => $this->input->post('kode_kasir'),
            'nama_kasir' => $this->input->post('nama_kasir'),
            'username_kasir' => $this->input->post('username_kasir'),
            'password_kasir' => $this->input->post('password_kasir'),
        ];
        if($this->m_kasir->ubah($data, $id)){
            $this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Di Ubah!');
            redirect('kasir');
        }else{
            $this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Di Ubah!');
            redirect('kasir');
        }
    }
    //Hapus Data Kasir
    public function hapus($id){
        if($this->session->login['role'] == 'kasir'){
            $this->session->set_flashdata('error', 'Ubah Data hanya untuk admin!');
            redirect('kasir');
        }
        if($this->m_kasir->hapus($id)){
            $this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Di hapus!');
            redirect('kasir');
        }else{
            $this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Di hapus!');
            redirect('kasir');
        }
    }
    public function export(){
        $dompdf = new Dompdf();
        // $this->data['perusahaan'] = $this->m_usaha->lihat();
        $this->data['all_kasir'] = $this->m_kasir->lihat();
        $this->data['title'] = 'Laporan Data Kasir';
        $this->data['no'] = 1;

        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('kasir/report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Kasir Tanggal' .date('d F Y'), array("Attachment" => false));
    }
}
?>