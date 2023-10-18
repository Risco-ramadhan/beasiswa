<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
	}


	public function index()
	{
		$datax = $this->session->userdata('role_id');
		// dd($datax);
		if ($datax == 1) {
			redirect('admin');
		}
		if ($datax == 2) {
			redirect('user');
		}


		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim|min_length[3]',
			[
				'min_length' => 'password too short!',
			]
		);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('template/header', $data);
			$this->load->view('auth/login');
			$this->load->view('template/footer');
		} else {
			$this->_login();
		}
	}

	public function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->Auth_model->cekUser($email);
		if ($user) {
			//usernya ada
			if ($user['is_active'] == 1) {
				//usernya aktif
				if (password_verify($password, $user['password'])) {
					//password sesuai
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('Admin');
					} elseif ($user['role_id'] == 2) {
						redirect('User');
					}
				} else {
					$this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Your password is wrong ! </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">This Email has not activated ! </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Email is not Registered! </div>');
			redirect('auth');
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
			$this->load->view('template/header', $data);
			$this->load->view('auth/register');
			$this->load->view('template/footer');
		} else {
			$data = array(
				'NIM' => $this->input->post('NIM'),
				'name' => $this->input->post('Name'),
				'email' => $this->input->post('Email'),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('Password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			);
			$this->Auth_model->Register($data);

			$this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Congratulation! Your Account Has been Created. Please Login </div>');
			redirect('auth');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">You have been logged out </div>');
		redirect('auth');
	}


	public function updateDataUser()
	{
		$this->load->model('Perhitungan');
		$email = $this->input->post('Email');
		$name = $this->input->post('name');
		$kd = $this->input->post('NIM');
		// dd($kd);
		$oldNIm = $this->input->post('NIM');

		$data = array(
			'name' => $name,
			'NIM' => $kd,
			'email' => $email
		);

		// dd($data);

		$this->Perhitungan->editAdmin($oldNIm, $data);
		redirect('auth/profile');
	}


	public function profile()
	{
		$data['user'] = $this->Auth_model->getDatauser();
		// dd($data['user']);
		$data['title'] = 'Halaman User';
		$this->load->view('template/admin_header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('template/admin_footer', $data);
	}



	// public function dashboard()
	// {
	// 	$this->load->view('template/header');
	// 	$this->load->view('auth/dashboard');
	// 	$this->load->view('template/footer');
	// }
}
