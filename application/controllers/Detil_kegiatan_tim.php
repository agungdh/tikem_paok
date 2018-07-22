<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detil_kegiatan_tim extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index($kegiatan_id) {
		$data['isi'] = 'detil_kegiatan_tim/index';
		$data['js'] = 'detil_kegiatan_tim/index_js';
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function tambah($kegiatan_id) {
		$data['isi'] = 'detil_kegiatan_tim/tambah';
		$data['js'] = 'detil_kegiatan_tim/tambah_js';
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'detil_kegiatan_tim/ubah';
		$data['js'] = 'detil_kegiatan_tim/ubah_js';
		$data['data']['detil_kegiatan_tim'] = $this->db->get_where('tim', ['id' => $id])->row();
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $data['data']['detil_kegiatan_tim']->kegiatan_id])->row();

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

		$this->db->insert('tim', $data);

		$insert_id = $this->db->insert_id();

		$foto_kegiatan = $_FILES['foto_kegiatan'];
		$foto_prestasi = $_FILES['foto_prestasi'];

		move_uploaded_file($foto_kegiatan['tmp_name'], 'uploads/kegiatan/tim/' . $insert_id);
		move_uploaded_file($foto_prestasi['tmp_name'], 'uploads/prestasi/tim/' . $insert_id);

		redirect(base_url('detil_kegiatan_tim/index/' . $this->input->post('data')['kegiatan_id']));
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

		$this->db->update('tim', $data, $where);

		$foto_kegiatan = $_FILES['foto_kegiatan'];
		$foto_prestasi = $_FILES['foto_prestasi'];

		move_uploaded_file($foto_kegiatan['tmp_name'], 'uploads/kegiatan/tim/' . $where['id']);
		move_uploaded_file($foto_prestasi['tmp_name'], 'uploads/prestasi/tim/' . $where['id']);

		redirect(base_url('detil_kegiatan_tim/index/' . $this->input->post('data')['kegiatan_id']));
	}

	function aksi_hapus($id) {
		$tim = $this->db->get_where('tim', ['id' => $id])->row();
		$kegiatan = $this->db->get_where('kegiatan', ['id' => $tim->kegiatan_id])->row();

		$this->db->delete('tim', ['id' => $id]);

		unlink('uploads/kegiatan/tim/' . $tim->id);
		unlink('uploads/prestasi/tim/' . $tim->id);

		redirect(base_url('detil_kegiatan_tim/index/' . $kegiatan->id));
	}

}