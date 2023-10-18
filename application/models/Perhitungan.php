<?php

use LDAP\Result;

class Perhitungan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Mahasiswa
	public function inputKriteria($data)
	{
		$this->db->insert('kriteria', $data);
	}

	public function getKriteria()
	{
		$query = $this->db->get('kriteria');
		return $query->result();
	}
	public function countKriteria()
	{
		$query = $this->db->count_all('kriteria');
		return $query;
	}
	public function countDataNilai()
	{
		$query = $this->db->count_all('data');
		return $query;
	}
	public function updateNilai($data, $NIM, $id)
	{

		// $array = array('NIM' => $NIM, 'ID_Kriteria' => $id)
		$this->db->where('NIM', $NIM,)->where('ID_Kriteria', $id);
		// $this->db->where($array);
		$this->db->update('data', $data);
	}

	public function inputNilai($data)
	{
		$this->db->insert('data', $data);
	}



	public function getJumlahPenerima()
	{
		$this->db->select('jumlah_diterima');
		$this->db->from('daftar_penerima_beasiswa');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getHasilMhs()
	{
		$this->db->select('hasil_penilaian.NIM,user.name');
		$this->db->from('hasil_penilaian');
		$this->db->join('user', 'hasil_penilaian.NIM = user.NIM');
		$this->db->order_by('hasil_penilaian.Nilai_Akhir', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	public function getHasilBeasiswaOrderBy()
	{
		$this->db->order_by('nilai', 'desc');
		// $this->db->limit($jmlh);
		$query = $this->db->get('daftar_penerima_beasiswa');
		return $query->result();
	}
	//ADMIN

	public function insertBerita($data)
	{
		$this->db->where('Id_Berita', 1);
		$this->db->update('berita', $data);
	}

	public function getBerita()
	{
		$query = $this->db->get('berita');
		return $query->result();
	}

	public function getUser()
	{

		$query = $this->db->get_where('user', array('role_id' => 2));
		return $query->result();
	}

	public function getAdmin()
	{

		$query = $this->db->get_where('user', array('role_id' => 1));
		return $query->result();
	}
	public function allUser()
	{

		// $query = $this->db->get_where('user');
		// return $query->result();
		$this->db->select('*,user_role.role');
		$this->db->from('user');
		$this->db->join('user_role', 'user.role_id = user_role.id');
		$query = $this->db->get();
		return $query->result();
	}



	public function editAdmin($kd, $data)
	{
		$this->db->where('NIM', $kd);
		$this->db->update('user', $data);
	}


	public function deleteuser($id)
	{
		$this->db->delete('user', array('NIM' => $id));
		$this->db->delete('data', array('NIM' => $id));
		$this->db->delete('hasil_penilaian', array('NIM' => $id));
	}
	public function getHasilAkhir()
	{
		$this->db->select('data.NIM,kriteria.Nama_Kriteria,data.Nilai');
		$this->db->from('data');
		$this->db->join('kriteria', 'data.ID_Kriteria = kriteria.ID_Kriteria');
		$query = $this->db->get();
		// dd($query->result());
		return $query->result();
	}

	public function inputBobotKriteria($data)
	{
		$this->db->insert('kriteria', $data);
	}

	public function reorderIdKriteria()
	{
		$SQL1 = 'SET @count = 0;';
		$SQL2 = 'UPDATE `kriteria` SET `kriteria`.`ID_Kriteria` = @count:= @count + 1;';
		$SQL3 = 'ALTER TABLE kriteria AUTO_INCREMENT = 1;';
		$this->db->query($SQL1);
		$this->db->query($SQL2);
		$this->db->query($SQL3);

		$SQL4 = 'SET @count = 0;';
		$SQL5 = 'UPDATE `data` SET `data`.`ID_Data` = @count:= @count + 1;';
		$SQL6 = 'ALTER TABLE kriteria AUTO_INCREMENT = 1;';
		$this->db->query($SQL4);
		$this->db->query($SQL5);
		$this->db->query($SQL6);
	}

	public function editBobotKriteria($id, $data)
	{
		$this->db->where('ID_Kriteria', $id);
		$this->db->update('kriteria', $data);
	}
	public function getDataKriteriaDetail($id)
	{
		$this->db->where('ID_Kriteria', $id);
		$query = $this->db->get('kriteria');
		// dd($query->row());
		return $query->result();
	}

	public function destroy($id)
	{

		$this->db->where('ID_Kriteria', $id);
		$query = $this->db->delete('kriteria');
	}

	public function insertDataFromExcel($data)
	{
		// $this->db->truncate('data');
		$this->db->insert('data', $data);
	}

	public function trunc()
	{
		$this->db->truncate('data');
		$this->db->where_not_in('role_id', 1);
		$this->db->delete('user');

		$this->db->truncate('hasil_penilaian');
	}

	//Perhitungan

	//menghitung normalisasi kriteria

	public function getNilaiBobot()
	{
		$this->db->select('Bobot_Kriteria,Nama_Kriteria');
		$query = $this->db->get('kriteria');
		return $query->result();
	}
	public function sumKriteria()
	{
		$this->db->select_sum('Bobot_Kriteria');
		$query = $this->db->get('kriteria');
		return $query->result();
	}
	public function inputNormalisasi($id, $data)
	{
		$this->db->where('ID_Kriteria', $id);
		$this->db->update('kriteria', $data);
	}

	//Menghitung nilai parameter

	public function getStatus()
	{
		$this->db->select('status');
		$query = $this->db->get('kriteria');
		return $query->result();
	}

	public function getNilaiKriteria()
	{
		$this->db->select('Nilai_Kriteria_1');
		$this->db->select('Nilai_Kriteria_2');
		$this->db->select('Nilai_Kriteria_3');
		$this->db->select('Nilai_Kriteria_4');
		$query = $this->db->get('kriteria');
		return $query->result();
	}

	public function getDataParameter()
	{
		$query = $this->db->query('SELECT * from data left join kriteria on data.ID_Kriteria = kriteria.ID_Kriteria');
		return $query->result();
	}

	public function inputParameter($id, $data)
	{
		$this->db->where('ID_Data', $id);
		$this->db->update('data', $data);
	}

	//menghitung Utility
	public function cMax($id)
	{
		$this->db->select_max('K');
		$this->db->where('ID_Kriteria', $id);
		$query = $this->db->get('data');
		return $query->row();
		// dd($query->result());
	}
	public function cMin($id)
	{
		$this->db->select_min('K');
		$this->db->where('ID_Kriteria', $id);
		$query = $this->db->get('data');
		return $query->row();
		// dd($query->result());
	}
	public function insertUtility($id, $data)
	{

		$this->db->where('ID_Data', $id);
		$this->db->update('data', $data);
	}

	//Menghitung Nilai Akhir Kriteria
	public function insertKriteriaAkhir($id, $data)
	{
		$this->db->where('ID_Data', $id);
		$this->db->update('data', $data);
	}
	//Menghitung nilai akhir
	public function getNim()
	{
		$role = 2;
		$this->db->select('NIM');
		$this->db->where('role_id', $role);
		$query = $this->db->get('user');
		return $query->result();
	}
	public function countMhs()
	{
		// $this->db->count_all_results('user');  // Produces an integer, like 25
		// $this->db->where('role_id', 2);
		// $this->db->from('user');
		// $query = $this->db->count_all_results();
		// return $query;

		$query = $this->db->query('SELECT DISTINCT NIM FROM data');
		return $query->result();
	}


	public function getNilaiAkhir($nim)
	{
		$this->db->select_sum('Nilai_Kriteria_Akhir');
		$this->db->where('NIM', $nim);
		$query = $this->db->get('data');
		return $query->row();
	}

	public function insertNilaiAkhir($nim, $data)
	{
		$this->db->where('NIM', $nim);
		$this->db->update('hasil_penilaian', $data);
	}

	public function insertNimNilaiAkhir($data)
	{
		$this->db->insert('hasil_penilaian', $data);
	}

	//Urutan pemenang
	// public function getHasilBeasiswa()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('data');
	// 	$this->db->from('data');
	// }
	public function getHasilBeasiswa()
	{
		// $this->db->select('NIM,name,Nilai_Akhir');
		// $this->db->order_by('Nilai_Akhir', 'DESC');
		// $query = $this->db->get_where('user', array('role_id' => 2));

		$this->db->select('hasil_penilaian.NIM,user.name,hasil_penilaian.Nilai_Akhir');
		$this->db->from('hasil_penilaian');
		$this->db->join('user', 'hasil_penilaian.NIM = user.NIM');
		$query = $this->db->get();

		return $query->result();
	}

	public function getHasilBeasiswa_fix()
	{
		// $this->db->select('NIM,name,Nilai_Akhir');
		// $this->db->order_by('Nilai_Akhir', 'DESC');
		// $query = $this->db->get_where('user', array('role_id' => 2));

		$this->db->select('hasil_penilaian.NIM,user.name,hasil_penilaian.Nilai_Akhir');
		$this->db->from('hasil_penilaian');
		$this->db->join('user', 'hasil_penilaian.NIM = user.NIM');
		$this->db->order_by('Nilai_Akhir', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}



	public function insertPublishData($data)
	{
		$this->db->insert('daftar_penerima_beasiswa', $data);
	}

	public function cekPeriode($tahun)
	{
		$query = $this->db->get_where('daftar_penerima_beasiswa', array('tahun' => $tahun))->row_array();
		return $query;
	}
	//mengolah data admin
	//Get Data Kriteria
	public function getDataKriteria()
	{
		$query = $this->db->get('kriteria');
		return $query->result();
	}

	//chart

	public function getDatachart($id)
	{
		$this->db->select('Nilai');
		$this->db->where('ID_Kriteria', $id);
		$query = $this->db->get('data');
		return $query->result();
	}
}
