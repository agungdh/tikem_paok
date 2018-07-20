<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'kategori/index';
		$data['js'] = 'kategori/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'kategori/tambah';
		$data['js'] = 'kategori/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'kategori/ubah';
		$data['js'] = 'kategori/ubah_js';
		$data['data']['kategori'] = $this->db->get_where('kategori', ['id' => $id])->row();

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

		$this->db->insert('kategori', $data);

		redirect(base_url('kategori'));
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

		$this->db->update('kategori', $data, $where);

		redirect(base_url('kategori'));
	}

	function aksi_hapus($id) {
		$this->db->delete('kategori', ['id' => $id]);

		redirect(base_url('kategori'));
	}

}