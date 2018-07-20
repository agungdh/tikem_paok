<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembina extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'pembina/index';
		$data['js'] = 'pembina/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'pembina/tambah';
		$data['js'] = 'pembina/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'pembina/ubah';
		$data['js'] = 'pembina/ubah_js';
		$data['data']['pembina'] = $this->db->get_where('pembina', ['id' => $id])->row();

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

		$this->db->insert('pembina', $data);

		redirect(base_url('pembina'));
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

		$this->db->update('pembina', $data, $where);

		redirect(base_url('pembina'));
	}

	function aksi_hapus($id) {
		$this->db->delete('pembina', ['id' => $id]);

		redirect(base_url('pembina'));
	}

}