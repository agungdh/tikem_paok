<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index() {
		if ($this->input->post('filter') == null) {
			$data = [];

			$kegiatan_individu = $this->db->query("SELECT *, i.id individu_id, f.nama fakultas, p.nama prodi, m.nama mahasiswa
													FROM kegiatan k, individu i, mahasiswa m, prodi p, fakultas f
													WHERE i.kegiatan_id = k.id
													AND i.mahasiswa_id = m.id
													AND m.prodi_id = p.id
													AND p.fakultas_id = f.id
													ORDER BY k.id")->result();

				$data_item = [];
			foreach ($kegiatan_individu as $item) {
			 	if (array_key_exists('kegiatan', $data_item)) {
			 		if ($data_item['kegiatan'] != $item->kegiatan) {
			 			$data_item['kegiatan'] = $item->kegiatan;
				 		$data_item['tanggal_mulai'] = $this->pustaka->tanggal_indo_string($item->tanggal_mulai);
					 	$data_item['lokasi'] = $item->lokasi;
					 	$data_item['kategori'] = $this->db->get_where('kategori', ['id' => $item->kategori_id])->row()->kategori;
					 	$data_item['tahun_ajar'] = substr($item->tahun_ajar, 0, 4) . '/' . substr($item->tahun_ajar, 4, 4);
					 	$data_item['semester'] = $item->semester == 'e' ? 'Genap' : 'Gasal';
					 	if ($item->tingkat == 'l') {
					 		$data_item['tingkat'] = 'Lokal';
					 	} elseif ($item->tingkat == 'n') {
					 		$data_item['tingkat'] = 'Nasional';
					 	} else {
							$data_item['tingkat'] = 'Internasional';
					 	}
					 	$pembina = $this->db->get_where('pembina', ['id' => $item->pembina_id])->row();
					 	$data_item['pembina'] = $pembina->nip . ' ' .$pembina->nama;
				 		$data_item['keanggotaan'] = 'Individu';
				 		$data_item['nim'] = $item->nim;
				 		$data_item['nama'] = $item->mahasiswa;
				 		$data_item['prodi'] = $item->prodi;
				 		$data_item['fakultas'] = $item->fakultas;
			 		} else {
			 			$data_item['kegiatan'] = null;
				 		$data_item['tanggal_mulai'] = null;
					 	$data_item['lokasi'] = null;
					 	$data_item['kategori'] = null;
					 	$data_item['tahun_ajar'] = null;
					 	$data_item['semester'] = null;
					 	$data_item['tingkat'] = null;
					 	$data_item['pembina'] = null;
				 		$data_item['keanggotaan'] = null;
				 		$data_item['nim'] = $item->nim;
				 		$data_item['nama'] = $item->mahasiswa;
				 		$data_item['prodi'] = $item->prodi;
				 		$data_item['fakultas'] = $item->fakultas;
			 		}
		 			$data['tabel'][] = $data_item;
			 	} else {
			 		$data_item['kegiatan'] = $item->kegiatan;
			 		$data_item['tanggal_mulai'] = $this->pustaka->tanggal_indo_string($item->tanggal_mulai);
				 	$data_item['lokasi'] = $item->lokasi;
				 	$data_item['kategori'] = $this->db->get_where('kategori', ['id' => $item->kategori_id])->row()->kategori;
				 	$data_item['tahun_ajar'] = substr($item->tahun_ajar, 0, 4) . '/' . substr($item->tahun_ajar, 4, 4);
				 	$data_item['semester'] = $item->semester == 'e' ? 'Genap' : 'Gasal';
				 	if ($item->tingkat == 'l') {
				 		$data_item['tingkat'] = 'Lokal';
				 	} elseif ($item->tingkat == 'n') {
				 		$data_item['tingkat'] = 'Nasional';
				 	} else {
						$data_item['tingkat'] = 'Internasional';
				 	}
				 	$pembina = $this->db->get_where('pembina', ['id' => $item->pembina_id])->row();
				 	$data_item['pembina'] = $pembina->nip . ' ' .$pembina->nama;
			 		$data_item['keanggotaan'] = 'Individu';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;

			 		$data['tabel'][] = $data_item;
			 	}
			}

			$kegiatan_tim = $this->db->query("SELECT *, t.id tim_id
													FROM kegiatan k, tim t
													WHERE t.kegiatan_id = k.id
													ORDER BY k.id")->result();

			 // {
			 // 	$data_item = [];

			 // 	$data_item['kegiatan'] = $item->kegiatan;
			 // 	$data_item['tanggal_mulai'] = $this->pustaka->tanggal_indo_string($item->tanggal_mulai);
			 // 	$data_item['lokasi'] = $item->lokasi;
			 // 	$data_item['kategori'] = $this->db->get_where('kategori', ['id' => $item->kategori_id])->row()->kategori;
			 // 	$data_item['tahun_ajar'] = substr($item->tahun_ajar, 0, 4) . '/' . substr($item->tahun_ajar, 4, 4);
			 // 	$data_item['semester'] = $item->semester == 'e' ? 'Genap' : 'Gasal';
			 // 	if ($item->tingkat == 'l') {
			 // 		$data_item['tingkat'] = 'Lokal';
			 // 	} elseif ($item->tingkat == 'n') {
			 // 		$data_item['tingkat'] = 'Nasional';
			 // 	} else {
				// 	$data_item['tingkat'] = 'Internasional';
			 // 	}
			 // 	$pembina = $this->db->get_where('pembina', ['id' => $item->pembina_id])->row();
			 // 	$data_item['pembina'] = $pembina->nip . ' ' .$pembina->nama;
			 // 	if ($item->keanggotaan == 'i') {
			 // 		$data_item['keanggotaan'] = 'Individu';
			 // 	} else {
			 // 		$data_item['keanggotaan'] = 'Tim';
			 // 	}

			 // 	$data['tabel'][] = $data_item;
			 // }

			$this->load->view("main", $data);
		} else {
			$this->load->view("main", $data);
		}
	}

	function login() {
		$data_user = $this->db->get_where('user', ['username' => $this->input->post('username'), 'password' => hash("sha512", $this->input->post('password'))])->row();

		if ($data_user != null) {			
			$array_data_user = array(
				'id'  => $data_user->id,
				'nama'  => $data_user->nama,
				'username'  => $data_user->username,
				'level'  => $data_user->level,
				'login'  => true
			);

			$this->session->set_userdata($array_data_user);

			echo json_encode(['login' => true]);
		} else {
			$data['header'] = "ERROR !!!";
			$data['pesan'] = "Password Salah !!!";
			$data['status'] = "error";

			$data['login'] = false;

			echo json_encode($data);
		}
	}

}