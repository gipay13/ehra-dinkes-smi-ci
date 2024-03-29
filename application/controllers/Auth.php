<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('id')) {
			redirect('dashboard', 'refresh');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == false) {
				$this->load->view('auth_pages/login-page');
			} else {
				// Validasi Success
				$this->_login();
			}
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'puskesmas' => $user['puskesmas_id'],
					'name' 		=> $user['name'],
					'level'		=> $user['level_id'],
					'id'		=> $user['user_id']
				];
				$this->session->set_userdata($data);
				redirect('dashboard', 'refresh');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<span>Username atau Password salah</span>
					</div>'
				);
				redirect('', 'refresh');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<span>Username atau Password salah</span>
				</div>'
			);
			redirect('', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('', 'refresh');
	}
}
