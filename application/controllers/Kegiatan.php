<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'kegiatan/index';
		$data['js'] = 'kegiatan/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'kegiatan/tambah';
		$data['js'] = 'kegiatan/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'kegiatan/ubah';
		$data['js'] = 'kegiatan/ubah_js';
		$data['data']['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $id])->row();

		$this->load->view('template/template', $data);
	}

	function aksi_tambah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {				
				case 'tanggal_mulai':
				case 'tanggal_selesai':
					$tanggal = explode('-', $value);
					$data[$key] = $tanggal[2] . '-' . $tanggal[1] . '-' . $tanggal[0];
					break;

				case 'tahun_ajar_awal':
					$tahun_ajar_awal = $value;
					break;

				case 'tahun_ajar_akhir':
					$tahun_ajar_akhir = $value;
					break;

				default:
					$data[$key] = $value;
					break;
			}
		}

		$data['tahun_ajar'] = $tahun_ajar_awal . $tahun_ajar_akhir;

		$this->db->insert('kegiatan', $data);

		redirect(base_url('kegiatan'));
	}

	function aksi_ubah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {				
				case 'tanggal_mulai':
				case 'tanggal_selesai':
					$tanggal = explode('-', $value);
					$data[$key] = $tanggal[2] . '-' . $tanggal[1] . '-' . $tanggal[0];
					break;

				case 'tahun_ajar_awal':
					$tahun_ajar_awal = $value;
					break;

				case 'tahun_ajar_akhir':
					$tahun_ajar_akhir = $value;
					break;

				default:
					$data[$key] = $value;
					break;
			}
		}

		$data['tahun_ajar'] = $tahun_ajar_awal . $tahun_ajar_akhir;

		foreach ($this->input->post('where') as $key => $value) {
			$where[$key] = $value;
		}

		$this->db->update('kegiatan', $data, $where);

		redirect(base_url('kegiatan'));
	}

	function aksi_hapus($id) {
		$this->db->delete('kegiatan', ['id' => $id]);

		redirect(base_url('kegiatan'));
	}

}