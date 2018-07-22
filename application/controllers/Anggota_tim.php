<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota_tim extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index($tim_id) {
		$data['isi'] = 'anggota_tim/index';
		$data['js'] = 'anggota_tim/index_js';
		$data['data']['detil_kegiatan'] = $this->db->get_where('tim', ['id' => $tim_id])->row();
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $data['data']['detil_kegiatan']->kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function tambah($tim_id) {
		$data['isi'] = 'anggota_tim/tambah';
		$data['js'] = 'anggota_tim/tambah_js';
		$data['data']['detil_kegiatan'] = $this->db->get_where('tim', ['id' => $tim_id])->row();
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $data['data']['detil_kegiatan']->kegiatan_id])->row();

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'anggota_tim/ubah';
		$data['js'] = 'anggota_tim/ubah_js';
		$data['data']['anggota_tim'] = $this->db->get_where('detil_tim', ['id' => $id])->row();
		$data['data']['detil_kegiatan'] = $this->db->get_where('tim', ['id' => $data['data']['anggota_tim']->tim_id])->row();
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

		$this->db->insert('detil_tim', $data);

		redirect(base_url('anggota_tim/index/' . $this->input->post('data')['tim_id']));
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

		$this->db->update('detil_tim', $data, $where);

		redirect(base_url('anggota_tim/index/' . $this->input->post('data')['tim_id']));
	}

	function aksi_hapus($id) {
		$anggota_tim = $this->db->get_where('detil_tim', ['id' => $id])->row();
		$tim = $this->db->get_where('tim', ['id' => $anggota_tim->tim_id])->row();

		$this->db->delete('detil_tim', ['id' => $id]);

		redirect(base_url('anggota_tim/index/' . $tim->id));
	}

}