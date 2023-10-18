<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'Excel'));
        $this->load->model('Auth_model');
        $this->load->model('Perhitungan');
        $data = $this->session->userdata('role_id');
        if ($data != 1) {
            redirect('auth');
        }
    }


    public function index()
    {
        // $data = $this->session->userdata();
        // dd($data);

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $data['totalKrirteria'] = count($this->Perhitungan->getKriteria());
        $data['totalUser'] = count($this->Perhitungan->getUser());
        $data['totalData'] = count($this->Perhitungan->countMhs());
        $berita = $this->Perhitungan->getBerita();
        // dd($berita[0]->Berita);
        $berita = $berita[0]->Berita;
        $data['berita'] = nl2br($berita, false);

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function DataBeasiswa()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $jmlh = $this->Perhitungan->getJumlahPenerima();
        if (!$jmlh) {
            $jmlh['jumlah_diterima'] = 0;
        }

        $data['hasil'] = $this->Perhitungan->getHasilBeasiswaOrderBy();
        // dd($data['hasil']);

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/hasil', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function inputBerita()
    {

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $data['totalKrirteria'] = count($this->Perhitungan->getKriteria());

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/inputberita', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function inputBeritaDb()
    {
        $konten = $this->input->post('content');
        $data = array(
            'Berita' => $konten
        );
        $this->Perhitungan->insertBerita($data);
        redirect('admin');
    }

    public function analisis()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Analisis';
        $data['datakriteria'] = $this->Perhitungan->getKriteria();
        $data['NIM'] = $this->Perhitungan->countMhs();
        // dd($data['datakriteria']);
        // dd($data['NIM']);
        for ($i = 1; $i <= count($data['datakriteria']); $i++) {
            $dataChart = $this->Perhitungan->getDatachart($i);
            $data['chart'][] = $dataChart;
        }


        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/analisis', $data);
        $this->load->view('template/admin_footer', $data);
        $this->load->view('template/chart', $data);
    }

    public function kelolaUser()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        // $data['datauser'] = $this->Perhitungan->getUser();
        // $data['datauser'] = $this->Perhitungan->getAdmin();
        $data['datauser'] = $this->Perhitungan->allUser();
        // dd($data['datauser']);
        $data['title'] = 'Kelola User';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function tambahUser()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Tambah User';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/tambahuser', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function edituser($NIM)
    {

        $this->form_validation->set_rules('Email', 'Email', 'required');
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->Auth_model->getDatauser();
            $data['datauser'] = $this->Perhitungan->getUser();
            $data['title'] = 'Kelola User';
            $this->load->view('template/admin_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('template/admin_footer', $data);
        } else {

            $email = $this->input->post('Email');
            $name = $this->input->post('name');
            $kd = $this->input->post('NIM');
            $oldNIm = $this->input->post('oldNIM');

            $data = array(
                'name' => $name,
                'NIM' => $kd,
                'email' => $email
            );

            $this->Perhitungan->editAdmin($oldNIm, $data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Berhasil Diubah </div>');
            redirect('admin/kelolauser');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('Name', 'Name', 'required|trim');
        $this->form_validation->set_rules('NIM', 'NIM', 'required|trim|is_unique[user.NIM]');
        $this->form_validation->set_rules('Email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules(
            'Password1',
            'Password',
            'required|trim|min_length[3]|matches[Password2]',
            [
                'matches' => 'password dont match!',
                'min_length' => 'password too short!',

            ]
        );
        $this->form_validation->set_rules('Password2', 'Password', 'required|trim|matches[Password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register';
            $data['user'] = $this->Auth_model->getDatauser();
            $this->load->view('template/admin_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/tambahuser', $data);
            $this->load->view('template/admin_footer', $data);
        } else {
            $data = array(
                'NIM' => $this->input->post('NIM'),
                'name' => $this->input->post('Name'),
                'email' => $this->input->post('Email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('Password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            );
            $this->Auth_model->Register($data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Berhasil Ditambahkan </div>');
            redirect('admin/kelolauser');
        }
    }

    public function deleteuser($id)
    {
        $this->Perhitungan->deleteuser($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data Berhasil Dihapus </div>');
        redirect('admin/kelolauser');
    }

    public function deletDataNilai($id)
    {
        $this->Perhitungan->deleteuser($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data Berhasil Dihapus </div>');
        redirect('admin/hasilAkhir');
    }




    public function importexcel()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/import', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function import_excel()
    {
        $id = 1;
        $jmlhKriteria = $this->Perhitungan->countKriteria();
        if (isset($_FILES["fileExcel"]["name"])) {
            $this->Perhitungan->trunc();
            $path = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $NIM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    for ($i = 1; $i <= $jmlhKriteria; $i++) {
                        $kriteria = $worksheet->getCellByColumnAndRow($i + 2, $row)->getValue();
                        $temp_data = array(

                            'NIM'    => $NIM,
                            'ID_Kriteria' => $i,
                            'Nilai' => $kriteria
                        );

                        $this->Perhitungan->insertDataFromExcel($temp_data);
                    }
                    $dataUser = array(
                        'name' => $nama,
                        'NIM' => $NIM,
                        'email' => $NIM . '@gmail.com',
                        'image' => 'default.jpg',
                        'password' => password_hash('admin', PASSWORD_DEFAULT),
                        'role_id' => 2,
                        'is_active' => 1,
                        'date_created' => time()
                    );
                    $dataNilaiAkhir = array('NIM' => $NIM);
                    $this->Auth_model->Register($dataUser);
                    $this->Perhitungan->insertNimNilaiAkhir($dataNilaiAkhir);
                }

                // $temp_data adalah data nilai mahasiswa yang telah diubah format excel menjadi penulisan database
                // data akan dimasukan kedalam table data

                //dataUser adalah data akun yang diinputkan secara otomatis terdaftar akunya
                //data akan dimasukan kedalam table user
                $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">File berhasil di upload!!!</div>');

                redirect('admin/hasilAkhir');
            }
        } else {
            $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">File kosong!!!</div>');
            redirect('admin/hasilAkhir');
        }
    }

    public function exportExcel()
    {
        $alphas = range('A', 'Z');
        $jmlh = $this->Perhitungan->getJumlahPenerima();
        $kriteria = $this->Perhitungan->getKriteria();
        $hasil = $this->Perhitungan->getHasilBeasiswaOrderBy($jmlh['jumlah_diterima']);
        if (!$hasil) {
            $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">File kosong!!!</div>');
            redirect('admin/databeasiswa');
        }
        $jmlhData = $jmlh['jumlah_diterima'] * count($kriteria);
        $fileName = 'data-' . time() . '.csv';
        // $listInfo = $this->export->exportList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Kode');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Tahun');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Nilai');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Rank');

        for ($i = 0; $i < count($hasil); $i++) {
            $row = $i + 2;
            $arr = $i;
            $rank = $i + 1;
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $hasil[$arr]->NIM);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $hasil[$arr]->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $hasil[$arr]->nilai);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $hasil[$arr]->tahun);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $rank);
        }
        $filename = "Hasil" . date("Y-m-d-H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    public function exportDataBeasiswa()
    {
        $this->load->library('Pdf');
        $jmlh = $this->Perhitungan->getJumlahPenerima();
        $hasil = $this->Perhitungan->getHasilBeasiswaOrderBy($jmlh['jumlah_diterima']);

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DAFTAR PENERIMA BEASISWA', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(Lebar, Tinggi, 'Judul', 1 = garis, 0 =pembuka 1= penutup, 'C');
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Kode', 1, 0, 'C');
        $pdf->Cell(70, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Tahun', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Nilai', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Rank', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        for ($i = 0; $i < count($hasil); $i++) {
            $pdf->Cell(10, 6, $i + 1, 1, 0, 'L');
            $pdf->Cell(40, 6, $hasil[$i]->NIM, 1, 0, 'L');
            $pdf->Cell(70, 6, $hasil[$i]->name, 1, 0, 'L');
            $pdf->Cell(25, 6, $hasil[$i]->tahun, 1, 0, 'C');
            $pdf->Cell(25, 6, $hasil[$i]->nilai, 1, 0, 'C');
            $pdf->Cell(25, 6, $i + 1, 1, 1, 'C');
        }

        $pdf->Output();
    }



    public function detailData()
    {
        // $data = $this->session->userdata();
        // dd($data);

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Detail Data';
        $data['dataKriteria'] = $this->Perhitungan->getDataKriteria();
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('template/admin_footer', $data);
    }
    public function editKriteria($id)
    {
        // $data = $this->session->userdata();
        // dd($data);

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Detail Data';
        $data['datakriteria'] = $this->Perhitungan->getDataKriteriaDetail($id);
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/editdata', $data);
        $this->load->view('template/admin_footer', $data);
    }
    public function editData()
    {

        $data = array(
            'ID_Kriteria' => $_POST['id'],
            'Nama_Kriteria' => $_POST['kriteria'],
            'Bobot_Kriteria' => $_POST['bobot'],
            'Status' => $_POST['status'],
            'Nilai_Kriteria_1' => $_POST['nilaikriteria1'],
            'Nilai_Kriteria_2' => $_POST['nilaikriteria2'],
            'Nilai_Kriteria_3' => $_POST['nilaikriteria3'],
            'Nilai_Kriteria_4' => $_POST['nilaikriteria4']
        );
        $id = $data['ID_Kriteria'];
        $this->Perhitungan->editBobotKriteria($id, $data);
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Berhasil Di Edit </div>');
        redirect('admin/detaildata');
    }

    public function editNilai()
    {
        $NIM = $this->input->post('NIM');
        $data['user'] = $this->Auth_model->getDatauser();

        // $this->form_validation->set_rules('NIM', 'NIM', 'required|is_unique[data.NIM]');


        $query  = $this->Perhitungan->getKriteria();
        // dd($_SESSION['Nim']);
        $jumlah_data  = $this->Perhitungan->countKriteria();
        //dd($query[1]->Nama_Kriteria);

        // dd($_POST[$da]);

        for ($i = 0; $i < $jumlah_data; $i++) {
            $da = $query[$i]->Nama_Kriteria;
            $datainput[$i] = $_POST[$da];
            $id = $query[$i]->ID_Kriteria;
            //
            $data = array(
                'NIM' => $NIM,
                'ID_Kriteria' => $query[$i]->ID_Kriteria,
                'Nilai' => $datainput[$i]
            );

            $this->Perhitungan->updateNilai($data, $NIM, $id);
        }
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Anda Berhasil Dimasukan !</div>');
        redirect('admin/hasilAkhir');
    }
    public function inputdataNilai()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $NIM = $this->input->post('NIM');
        $nama = $this->input->post('nama');

        $this->form_validation->set_rules('NIM', 'NIM', 'required|is_unique[data.NIM]');

        if ($this->form_validation->run() == true) {
            //register

            $dataUser = array(
                'name' => $nama,
                'NIM' => $NIM,
                'email' => $NIM . '@gmail.com',
                'image' => 'default.jpg',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            );
            // dd($dataUser);
            $dataNilaiAkhir = array('NIM' => $NIM);
            $this->Auth_model->Register($dataUser);
            $this->Perhitungan->insertNimNilaiAkhir($dataNilaiAkhir);
            //mantap


            $query  = $this->Perhitungan->getKriteria();
            $jumlah_data  = $this->Perhitungan->countKriteria();
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
            redirect('admin/hasilAkhir');
        }
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Kode beasiswa Salah !</div>');
        // dd($this->sesion);
        redirect('admin/hasilAkhir');
    }


    public function HasilAkhir()
    {
        $data['query']  = $this->Perhitungan->getKriteria();
        $data['user'] = $this->Auth_model->getDatauser();
        $data['datauser'] = $this->Perhitungan->getUser();
        $data['title'] = 'Penilaian';
        $data['datakriteria'] = $this->Perhitungan->getKriteria();
        $kriteria = $this->Perhitungan->getKriteria();
        // dd($kriteria);
        $hasildata = $this->Perhitungan->getHasilAkhir();
        $hasildata2 = $this->Perhitungan->getHasilBeasiswa();
        // dd($hasildata);
        // $jmlhMhs = $this->Perhitungan->countMhs();
        $jmlhMhs = $this->Perhitungan->countMhs();
        $jmlhKriteria = $this->Perhitungan->countKriteria();
        $jmlhDataNilai = $this->Perhitungan->countDataNilai();
        $nim = $this->Perhitungan->getNim();
        // dd($nim[0]->NIM);
        //jumlah mahasiswa
        $akhir = null;
        for ($i = 0; $i < count($jmlhMhs); $i++) {
            //jumlah data
            for ($j = 0; $j < $jmlhDataNilai; $j++) {
                if ($nim[$i]->NIM == $hasildata[$j]->NIM) {
                    // $akhir[$i] = array(
                    //     'NIM' => $nim[$i]->NIM,
                    // );
                    //jumlah kriteria
                    for ($k = 0; $k < $jmlhKriteria; $k++) {
                        if ($kriteria[$k]->Nama_Kriteria == $hasildata[$j]->Nama_Kriteria) {
                            $akhir[$i] = array(
                                'NIM' => $nim[$i]->NIM,
                            );
                        }
                    }
                }
            }
        }
        for ($i = 0; $i < count($jmlhMhs); $i++) {
            //jumlah data
            for ($j = 0; $j < $jmlhDataNilai; $j++) {
                if ($nim[$i]->NIM == $hasildata[$j]->NIM) {
                    // $akhir[$i] = array(
                    //     'NIM' => $nim[$i]->NIM,
                    // );
                    //jumlah kriteria
                    for ($k = 0; $k < $jmlhKriteria; $k++) {
                        if ($kriteria[$k]->Nama_Kriteria == $hasildata[$j]->Nama_Kriteria) {
                            $akhir[$i] += array(
                                $kriteria[$k]->Nama_Kriteria => $hasildata[$j]->Nilai,
                            );
                        }
                    }
                }
            }
        }

        for ($i = 0; $i < count($jmlhMhs); $i++) {
            for ($j = 0; $j < count($jmlhMhs); $j++) {
                if ($akhir[$i]['NIM'] == $hasildata2[$j]->NIM) {
                    $akhir[$i] += array(
                        'NilaiAkhir' => $hasildata2[$j]->Nilai_Akhir
                    );
                }
            }
        }
        if (!$akhir) {
            $akhir = [];
        }
        // dd($akhir);
        usort($akhir, function ($a, $b) { //Sort the array using a user defined function
            return $a['NilaiAkhir'] > $b['NilaiAkhir'] ? -1 : 1; //Compare the scores
        });


        $data['nilai'] = $akhir;
        // dd($data['nilai']);
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/coba', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function datakriteria()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['dataKriteria'] = $this->Perhitungan->getDataKriteria();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/datakriteria', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function input()
    {

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/input', $data);
        $this->load->view('template/admin_footer', $data);
    }
    public function delete($id)
    {
        $this->Perhitungan->destroy($id);
        $this->Perhitungan->reorderIdKriteria();
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data Berhasil Dihapus !</div>');
        redirect('admin/detaildata');
    }



    public function inputdata()
    {



        $data = array(
            'Nama_Kriteria' => $_POST['kriteria'],
            'Bobot_Kriteria' => $_POST['bobot'],
            'Status' => $_POST['status'],
            'Nilai_Kriteria_1' => $_POST['nilaikriteria1'],
            'Nilai_Kriteria_2' => $_POST['nilaikriteria2'],
            'Nilai_Kriteria_3' => $_POST['nilaikriteria3'],
            'Nilai_Kriteria_4' => $_POST['nilaikriteria4']
        );
        $this->Perhitungan->inputBobotKriteria($data);
        redirect('admin');
    }

    public function normalisasiKriteria()
    {
        //mengurutkan id Data Kriteria
        $this->Perhitungan->reorderIdKriteria();

        $jumlah_data = $this->Perhitungan->countKriteria(); //manggil berapa banyak data kriteria
        $nilai_bobot = $this->Perhitungan->getNilaiBobot(); //manggil semua data nilai bobot kriteria
        $jumlah_nilia_bobot = $this->Perhitungan->sumKriteria(); //manggil jumlah total nilai bobot kriteria

        //rumus normalisasi, nilai bobot / jumlah seluruh nilai bobot

        // dd($nilai_bobot[0]->Bobot_Kriteria);
        for ($i = 0; $i < $jumlah_data; $i++) {
            $j = $nilai_bobot[$i]->Bobot_Kriteria;
            $hasil = $j / $jumlah_nilia_bobot[0]->Bobot_Kriteria;
            $data = array(
                'Normalisasi_Kriteria' => $hasil
            );
            $id = $i + 1;
            $this->Perhitungan->inputNormalisasi($id, $data);
        }
        redirect('admin/parameter');
    }

    public function parameter()
    {
        $jumlah_kriteria = $this->Perhitungan->countKriteria(); //memanggil berapa banyak data kriteria
        $status = $this->Perhitungan->getStatus(); //memanggil status dari semua data
        $datapembanding = $this->Perhitungan->getDataParameter();
        $jumlah_data = count($datapembanding);
        // dd($datapembanding[0]->Nilai);
        // dd($datapembanding[0]->Nilai_kriteria_2);
        for ($i = 0; $i < $jumlah_kriteria; $i++) {

            // Jika nilai yang paling tinggi yang di inginkan
            if ($status[$i]->status == 1) {
                for ($x = 0; $x < $jumlah_data; $x++) {
                    if ($datapembanding[$x]->Status != 1) {
                        #skip
                    } else if ($datapembanding[$x]->Nilai >= $datapembanding[$x]->Nilai_Kriteria_1) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => $datapembanding[$x]->Nilai
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai >= $datapembanding[$x]->Nilai_Kriteria_2) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => $datapembanding[$x]->Nilai
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai >= $datapembanding[$x]->Nilai_Kriteria_3) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => $datapembanding[$x]->Nilai
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai < $datapembanding[$x]->Nilai_Kriteria_3) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => $datapembanding[$x]->Nilai
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai < $datapembanding[$x]->Nilai_Kriteria_4) {
                    }
                }
            }
            // jika nilai yang paling rendah yang di inginkan
            elseif ($status[$i]->status == 2) {
                for ($x = 0; $x < $jumlah_data; $x++) {
                    if ($datapembanding[$x]->Status != 2) {
                        #skip
                    } else if ($datapembanding[$x]->Nilai <= $datapembanding[$x]->Nilai_Kriteria_1) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => 4
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai <= $datapembanding[$x]->Nilai_Kriteria_2) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => 3
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai <= $datapembanding[$x]->Nilai_Kriteria_3) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => 2
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    } else if ($datapembanding[$x]->Nilai > $datapembanding[$x]->Nilai_Kriteria_3) {
                        $id = $datapembanding[$x]->ID_Data;
                        $K = array(
                            'K' => 1
                        );
                        $this->Perhitungan->inputParameter($id, $K);
                    }
                    // else if ($datapembanding[$x]->Nilai < $datapembanding[$x]->Nilai_Kriteria_4) {
                    // }
                }
            }
        }
        // dd('mantap');
        redirect('admin/utility');
    }
    public function utility()
    {
        $datapembanding = $this->Perhitungan->getDataParameter();
        $jumlah_data = count($datapembanding);
        //mencari Cmax dan Cmin, Cmax adalah nilai tertinggi dari K
        for ($i = 0; $i < $jumlah_data; $i++) {
            $id = $datapembanding[$i]->ID_Kriteria;
            $Cmax = $this->Perhitungan->cMax($id);
            $Cmin = $this->Perhitungan->cMin($id);

            $a = $datapembanding[$i]->K - $Cmin->K;
            $b = $Cmax->K - $Cmin->K;
            if ($b == 0) {
                $data = array(
                    'U' => 1
                );
            } else {

                $u = ($a / $b);
                $data = array(
                    'U' => $u
                );
            }
            // if (is_nan($u)) {
            //     $u = 1;
            // }
            // $data = array(
            //     'U' => $u
            // );
            echo $u;
            $id_data = $datapembanding[$i]->ID_Data;
            $this->Perhitungan->insertUtility($id_data, $data);
        }

        redirect('admin/NilaiKriteriaAkhir');
    }

    public function NilaiKriteriaAkhir()
    {
        $datapembanding = $this->Perhitungan->getDataParameter();
        $jumlah_data = count($datapembanding);
        // dd($jumlah_data);
        // dd($datapembanding[0]->Normalisasi_Kriteria);
        // dd($datapembanding[0]->U);

        for ($i = 0; $i < $jumlah_data; $i++) {
            $nilaiKriteriaAkhir = ($datapembanding[$i]->Normalisasi_Kriteria * $datapembanding[$i]->U);
            $data = array(
                'Nilai_Kriteria_Akhir' => $nilaiKriteriaAkhir
            );
            $id_data = $datapembanding[$i]->ID_Data;
            $this->Perhitungan->insertKriteriaAkhir($id_data, $data);
        }
        redirect('admin/NilaiAkhir');
    }

    public function NilaiAkhir()
    {
        // $nim = 1900018189;
        $jmlhMhs = $this->Perhitungan->countMhs();
        $nim_awal = $this->Perhitungan->getNim();
        // dd(count($jmlhMhs));
        for ($i = 0; $i < count($jmlhMhs); $i++) {

            $nim = $nim_awal[$i]->NIM;
            $nilai = $this->Perhitungan->getNilaiAkhir($nim);

            $data = array(
                'Nilai_Akhir' => $nilai->Nilai_Kriteria_Akhir
            );

            $this->Perhitungan->insertNilaiAkhir($nim, $data);
        }
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data berhasil di hitung!!!</div>');

        redirect('admin/hasilakhir');
    }


    public function publishHasil()
    {
        $jmlhMhs = $this->Perhitungan->countMhs();
        $jmlh = $this->input->post('jmlh');
        $hasilNilai = $this->Perhitungan->getHasilBeasiswa_fix();
        $tahun = date('Y');
        $row = $this->Perhitungan->cekPeriode($tahun);
        if ($row > 0) {
            $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data tahun ' . $tahun . ' Sudah Dipublish</div>');
            redirect('admin/hasilAkhir');
        }
        // dd($hasilNilai);
        for ($i = 0; $i < $jmlh; $i++) {
            $data = array(
                'NIM' => $hasilNilai[$i]->NIM,
                'name' => $hasilNilai[$i]->name,
                'nilai' => $hasilNilai[$i]->Nilai_Akhir,
                'tahun' => $tahun,
                'jumlah_diterima' => $jmlh
            );
            $this->Perhitungan->insertPublishData($data);
        }
        $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data berhasil Di Publish</div>');
        redirect('admin/hasilAkhir');
    }
}
