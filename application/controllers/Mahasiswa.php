<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'mahasiswa/index';
		$data['js'] = 'mahasiswa/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'mahasiswa/tambah';
		$data['js'] = 'mahasiswa/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'mahasiswa/ubah';
		$data['js'] = 'mahasiswa/ubah_js';
		$data['data']['mahasiswa'] = $this->db->get_where('mahasiswa', ['id' => $id])->row();

		$this->load->view('template/template', $data);
	}

	function aksi_tambah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {				
				default:
					$data[$key] = $value;
					break;
			}
		}

		$this->db->insert('mahasiswa', $data);

		redirect(base_url('mahasiswa'));
	}

	function aksi_ubah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {				
				default:
					$data[$key] = $value;
					break;
			}
		}

		foreach ($this->input->post('where') as $key => $value) {
			$where[$key] = $value;
		}

		$this->db->update('mahasiswa', $data, $where);

		redirect(base_url('mahasiswa'));
	}

	function aksi_hapus($id) {
		$this->db->delete('mahasiswa', ['id' => $id]);

		redirect(base_url('mahasiswa'));
	}

}