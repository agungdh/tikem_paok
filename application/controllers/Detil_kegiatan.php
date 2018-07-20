<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detil_kegiatan extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index($kegiatan_id) {
		$data['isi'] = 'detil_kegiatan/index';
		$data['js'] = 'detil_kegiatan/index_js';
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function tambah($kegiatan_id) {
		$data['isi'] = 'detil_kegiatan/tambah';
		$data['js'] = 'detil_kegiatan/tambah_js';
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'detil_kegiatan/ubah';
		$data['js'] = 'detil_kegiatan/ubah_js';
		$data['data']['detil_kegiatan'] = $this->db->get_where('individu', ['id' => $id])->row();
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $data['data']['detil_kegiatan']->kegiatan_id])->row();

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

		$this->db->insert('individu', $data);

		$insert_id = $this->db->insert_id();

		$foto_kegiatan = $_FILES['foto_kegiatan'];
		$foto_prestasi = $_FILES['foto_prestasi'];

		move_uploaded_file($foto_kegiatan['tmp_name'], 'uploads/kegiatan/' . $insert_id);
		move_uploaded_file($foto_prestasi['tmp_name'], 'uploads/prestasi/' . $insert_id);

		redirect(base_url('detil_kegiatan/index/' . $this->input->post('data')['kegiatan_id']));
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

		$this->db->update('individu', $data, $where);

		$foto_kegiatan = $_FILES['foto_kegiatan'];
		$foto_prestasi = $_FILES['foto_prestasi'];

		move_uploaded_file($foto_kegiatan['tmp_name'], 'uploads/kegiatan/' . $where['id']);
		move_uploaded_file($foto_prestasi['tmp_name'], 'uploads/prestasi/' . $where['id']);

		redirect(base_url('detil_kegiatan/index/' . $this->input->post('data')['kegiatan_id']));
	}

	function aksi_hapus($id) {
		$individu = $this->db->get_where('individu', ['id' => $id])->row();
		$kegiatan = $this->db->get_where('kegiatan', ['id' => $individu->kegiatan_id])->row();

		$this->db->delete('individu', ['id' => $id]);

		unlink('uploads/kegiatan/' . $individu->id);
		unlink('uploads/prestasi/' . $individu->id);

		redirect(base_url('detil_kegiatan/index/' . $kegiatan->id));
	}

}