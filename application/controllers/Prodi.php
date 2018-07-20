<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index($fakultas_id) {
		$data['isi'] = 'prodi/index';
		$data['js'] = 'prodi/index_js';
		$data['data']['fakultas'] = $this->db->get_where('fakultas', ['id' => $fakultas_id])->row();

		$this->load->view('template/template', $data);
	}

	function tambah($fakultas_id) {
		$data['isi'] = 'prodi/tambah';
		$data['js'] = 'prodi/tambah_js';
		$data['data']['fakultas'] = $this->db->get_where('fakultas', ['id' => $fakultas_id])->row();

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'prodi/ubah';
		$data['js'] = 'prodi/ubah_js';
		$data['data']['prodi'] = $this->db->get_where('prodi', ['id' => $id])->row();
		$data['data']['fakultas'] = $this->db->get_where('fakultas', ['id' => $data['data']['prodi']->fakultas_id])->row();

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

		$this->db->insert('prodi', $data);

		redirect(base_url('prodi/index/' . $this->input->post('data')['fakultas_id']));
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

		$this->db->update('prodi', $data, $where);

		redirect(base_url('prodi/index/' . $this->input->post('data')['fakultas_id']));
	}

	function aksi_hapus($id) {
		$prodi = $this->db->get_where('prodi', ['id' => $id])->row();
		$fakultas = $this->db->get_where('fakultas', ['id' => $prodi->fakultas_id])->row();

		$this->db->delete('prodi', ['id' => $id]);

		redirect(base_url('prodi/index/' . $fakultas->id));
	}

}