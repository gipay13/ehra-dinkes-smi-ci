<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Responden extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('RespondenModel');
		if (!$this->session->userdata('username'))
			redirect('auth');
	}

	public function index()
	{
		$data = array(
			"regencies"		=> $this->RespondenModel->regencies(),
			"supervisor" 	=> $this->RespondenModel->supevisor(),
			"koordinator" 	=> $this->RespondenModel->koordinator(),
		);

		$this->load->view('layouts/survey_layouts/head');
		$this->load->view('layouts/survey_layouts/nav');
		$this->load->view('survey_pages/responden-page', $data);
		$this->load->view('layouts/survey_layouts/footer');
	}

	public function fetch_district()
	{
		if ($this->input->post('id')) {
			echo $this->RespondenModel->district($this->input->post('id'));
		}
	}

	public function fetch_village()
	{
		if ($this->input->post('id')) {
			echo $this->RespondenModel->village($this->input->post('id'));
		}
	}

	public function fetch_koordinator()
	{
		if ($this->input->post('id')) {
			echo $this->RespondenModel->koordinator($this->input->post('id'));
		}
	}

	public function get_last_no_survey()
	{
		$tahun = date("y");
		$bulan = date("m");
		$survey_last_id = $this->RespondenModel->get_last_no_survey($bulan, date("Y"));

		if ($survey_last_id->num_rows()) {
			$row_last_id   = $survey_last_id->row_array();
			$last_id       = substr($row_last_id['id'], 4) + 1;
			$id_survey = $tahun . $bulan . sprintf("%05d", $last_id);
		} else {
			$id_survey = $tahun . $bulan . sprintf("%05d", 1);
		}

		return $id_survey;
	}

	public function store()
	{
		$no_survey = $this->get_last_no_survey();

		$responden = array(
			'nokk'					=> $this->input->post('nokk'),
			'nik'					=> $this->input->post('nik'),
			'nama_kepala'			=> $this->input->post('namakepala'),
			'jml_keluarga'			=> $this->input->post('jumlahkeluarga'),
			'jml_laki'				=> $this->input->post('jumlahlaki'),
			'jml_pr'				=> $this->input->post('jumlahpr'),
			'nama_responden'		=> $this->input->post('responden'),
			'hubungan_responden'	=> $this->input->post('hubungan'),
			'id_kecamatan'			=> $this->input->post('kecamatan'),
			'alamat'				=> $this->input->post('alamat'),
			'rt'					=> $this->input->post('rt'),
			'rw'					=> $this->input->post('rw'),
			'no_rmh'				=> $this->input->post('normh'),
		);

		$this->db->insert('responden', $responden);

		$survey = array(
			'id'					=> $no_survey,
			'nik'					=> $this->input->post('nik'),
			'tgl_survey'			=> $this->input->post('tanggalSurvey'),
			'jam_survey'			=> $this->input->post('waktu'),
			'id_pewawancara'		=> $this->input->post('pewawancara'),
			'id_supervisor'			=> $this->input->post('supervisor'),
			'id_koordinator'		=> $this->input->post('koordinator'),
		);

		$this->db->insert('survey', $survey);

		redirect('pertanyaan/p/b/' . $no_survey);
		// $wilayah_survey = array(
		// 	'id_provinsi'		=> $this->input->post('provinsi'),
		// 	'id_kabupaten'		=> $this->input->post('kabupaten'),
		// 	'id_kecamatan' 		=> $this->input->post('kecamatan'),
		// 	'id_kelurahan' 		=> $this->input->post('kelurahan'),
		// 	'strata' 			=> $this->input->post('strata'),
		// );

		// $this->db->insert('wilayah_survey', $wilayah_survey);
		// $get_id = $this->db->insert_id();



		// $surfey = array(
		// 	'tgl_survey' 			=> $this->input->post('tanggalSurvey'),
		// 	'jam_survey' 			=> $this->input->post('waktu'),
		// 	'id_pewawancara' 		=> $this->input->post('pewawancara'),
		// 	'id_supervisor' 		=> $this->input->post('supervisor'),
		// 	'id_koordinator' 		=> $this->input->post('koordinator'),
		// );

		// $this->db->insert('surfey', $surfey);

		// $responden = array(
		// 	'id_survey'				=> $get_id,
		// 	'nik'					=> $this->input->post('nikKepalaRumah'),
		// 	'nama_kepala'			=> $this->input->post('namaKepalaRumah'),
		// 	'jml_keluarga'			=> $this->input->post('jumlahKeluarga'),
		// 	'jml_laki'				=> $this->input->post('jumlahJiwaLaki'),
		// 	'jml_pr'				=> $this->input->post('jumlahJiwaPr'),
		// 	'nama_responden'		=> $this->input->post('responden'),
		// 	'hubungan_responden'	=> $this->input->post('hubungan'),
		// 	'alamat'				=> $this->input->post('alamat'),
		// );

		// $this->db->insert('responden', $responden);

		// redirect('pertanyaan/p/b/' . $get_id);
	}
}
