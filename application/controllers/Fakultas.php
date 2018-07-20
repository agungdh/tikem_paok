<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'fakultas/index';
		$data['js'] = 'fakultas/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'fakultas/tambah';
		$data['js'] = 'fakultas/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'fakultas/ubah';
		$data['js'] = 'fakultas/ubah_js';
		$data['data']['fakultas'] = $this->db->get_where('fakultas', ['id' => $id])->row();

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

		$this->db->insert('fakultas', $data);

		redirect(base_url('fakultas'));
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

		$this->db->update('fakultas', $data, $where);

		redirect(base_url('fakultas'));
	}

	function aksi_hapus($id) {
		$this->db->delete('fakultas', ['id' => $id]);

		redirect(base_url('fakultas'));
	}

}