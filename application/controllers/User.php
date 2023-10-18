<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Perhitungan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman User';
        $berita = $this->Perhitungan->getBerita();
        $berita = $berita[0]->Berita;
        $data['berita'] = nl2br($berita, false);
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function profile()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman User';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function input()
    {
        $query  = $this->Perhitungan->getKriteria();
        $data = array('querykriteria' => $query);
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman User';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/input', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function inputdata()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $NIM = $data['user']['NIM'];

        $this->form_validation->set_rules('NIM', 'NIM', 'required|is_unique[data.NIM]');

        if ($this->form_validation->run() == true) {
            // dd($this->session->userdata());
            $query  = $this->Perhitungan->getKriteria();
            // dd($_SESSION['Nim']);
            $jumlah_data  = $this->Perhitungan->countKriteria();
            //dd($query[1]->Nama_Kriteria);

            // dd($_POST[$da]);

            for ($i = 0; $i < $jumlah_data; $i++) {
                $da = $query[$i]->Nama_Kriteria;
                $datainput[$i] = $_POST[$da];
                //
                $data = array(
                    'NIM' => $NIM,
                    'ID_Kriteria' => $query[$i]->ID_Kriteria,
                    'Nilai' => $datainput[$i]
                );
                $this->Perhitungan->inputNilai($data);
            }
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Anda Berhasil Dimasukan !</div>');
            redirect('user');
        }
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Anda Sudah Pernah Menginputkan Data !</div>');
        // dd($this->sesion);
        redirect('user');
    }

    public function hasilAkhir()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Hasil Akhir';
        $jmlh = $this->Perhitungan->getJumlahPenerima();
        if (!$jmlh) {
            $jmlh['jumlah_diterima'] = 0;
            $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Hasil beasiswa belum diterbitkan !!!</div>');
        }

        $data['hasil'] = $this->Perhitungan->getHasilBeasiswaOrderBy($jmlh['jumlah_diterima']);

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/hasil', $data);
        $this->load->view('template/admin_footer', $data);
    }
}
