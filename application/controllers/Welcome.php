<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index() {
		$where = ' ';
		$where_i = ' ';
		$where_t = ' ';
		$where = ' ';
		$array_where = [];
		$data = [];
		$data['tabel'] = [];

		if ($this->input->post('tanggal_mulai') != null && $this->input->post('tanggal_mulai') != null) {
			$data['form']['tanggal_mulai'] = $this->input->post('tanggal_mulai');

			$where .= ' AND k.tanggal_mulai BETWEEN ? AND ? ' ;

			$tanggal = explode(' - ', $data['form']['tanggal_mulai']);
			
			$tanggal1 = explode('-', $tanggal[0]);
			$array_where[] = $tanggal1[2] . '-' . $tanggal1[1] . '-' . $tanggal1[0];

			$tanggal2 = explode('-', $tanggal[1]);
			$array_where[] = $tanggal2[2] . '-' . $tanggal2[1] . '-' . $tanggal2[0];
		}

		if ($this->input->post('kategori') != null && $this->input->post('kategori') != '0') {
			$data['form']['kategori'] = $this->input->post('kategori');

			$where .= ' AND k.kategori_id = ? ' ;

			$array_where[] = $data['form']['kategori'];
		}

		if ($this->input->post('tingkat') != null && $this->input->post('tingkat') != '0') {
			$data['form']['tingkat'] = $this->input->post('tingkat');

			$where .= ' AND k.tingkat = ? ' ;

			$array_where[] = $data['form']['tingkat'];
		}
		
		if ($this->input->post('keanggotaan') != null && $this->input->post('keanggotaan') != '0') {
			$data['form']['keanggotaan'] = $this->input->post('keanggotaan');

			$where .= ' AND k.keanggotaan = ? ' ;

			$array_where[] = $data['form']['keanggotaan'];
		}

		if ($this->input->post('prestasi') != null && $this->input->post('prestasi') != '0') {
			$data['form']['prestasi'] = $this->input->post('prestasi');

			$where_t = " AND t.prestasi != '' " ;
			$where_i = " AND i.prestasi != '' " ;

			// $array_where[] = $data['form']['prestasi'];
		}

		if ($this->input->post('fakultas') != null && $this->input->post('fakultas') != '0') {
			$data['form']['fakultas'] = $this->input->post('fakultas');

			$where .= ' AND f.id = ? ' ;

			$array_where[] = $data['form']['fakultas'];
		}

		if ($this->input->post('prodi') != null && $this->input->post('prodi') != '0') {
			$data['form']['prodi'] = $this->input->post('prodi');

			$where .= ' AND p.id = ? ' ;

			$array_where[] = $data['form']['prodi'];
		}

		$kegiatan_individu = $this->db->query("SELECT *, i.id individu_id, f.nama fakultas, p.nama prodi, m.nama mahasiswa
												FROM kegiatan k, individu i, mahasiswa m, prodi p, fakultas f
												WHERE i.kegiatan_id = k.id
												AND i.mahasiswa_id = m.id
												AND m.prodi_id = p.id
												AND p.fakultas_id = f.id"
												. $where . $where_i .
												"ORDER BY k.id", $array_where)->result();
// echo $this->db->last_query() . "<br>";
		$data_item = [];
		$kegiatanId = null;
		foreach ($kegiatan_individu as $item) {
		 	if ($kegiatanId != null) {
		 		if ($kegiatanId != $item->kegiatan_id) {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
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
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = 'Individu';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		} else {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
		 			$data_item['kegiatan'] = null;
			 		$data_item['tanggal_mulai'] = null;
				 	$data_item['lokasi'] = null;
				 	$data_item['kategori'] = null;
				 	$data_item['tahun_ajar'] = null;
				 	$data_item['semester'] = null;
				 	$data_item['tingkat'] = null;
				 	$data_item['pembina'] = null;
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = null;
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		}
	 			$data['tabel'][] = $data_item;
		 	} else {
		 		$kegiatanId = $item->kegiatan_id;
		 		$data_item['kegiatan_id'] = $kegiatanId;
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
		 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
		 		$data_item['keanggotaan'] = 'Individu';
		 		$data_item['nim'] = $item->nim;
		 		$data_item['nama'] = $item->mahasiswa;
		 		$data_item['prodi'] = $item->prodi;
		 		$data_item['fakultas'] = $item->fakultas;

		 		$data['tabel'][] = $data_item;
		 	}
		}

		$kegiatan_tim = $this->db->query("SELECT *, dt.id detil_tim_id, m.nama mahasiswa, p.nama prodi, f.nama fakultas
										FROM kegiatan k, tim t, detil_tim dt, mahasiswa m, prodi p, fakultas f
										WHERE dt.tim_id = t.id
										AND t.kegiatan_id = k.id
										AND dt.mahasiswa_id = m.id
										AND m.prodi_id = p.id
										AND p.fakultas_id = f.id"
										. $where . $where_t .
										"ORDER BY k.id, t.id", $array_where)->result();
		// echo $this->db->last_query() . "<br>";
		$data_item = [];
		$kegiatanId = null;
		foreach ($kegiatan_tim as $item) {
		 	if ($kegiatanId != null) {
		 		if ($kegiatanId != $item->kegiatan_id) {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
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
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		} else {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
		 			$data_item['kegiatan'] = null;
			 		$data_item['tanggal_mulai'] = null;
				 	$data_item['lokasi'] = null;
				 	$data_item['kategori'] = null;
				 	$data_item['tahun_ajar'] = null;
				 	$data_item['semester'] = null;
				 	$data_item['tingkat'] = null;
				 	$data_item['pembina'] = null;
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = $data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		}
	 			$data['tabel'][] = $data_item;
		 	} else {
	 			$kegiatanId = $item->kegiatan_id;
	 			$data_item['kegiatan_id'] = $kegiatanId;
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
		 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
		 		$data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
		 		$data_item['nim'] = $item->nim;
		 		$data_item['nama'] = $item->mahasiswa;
		 		$data_item['prodi'] = $item->prodi;
		 		$data_item['fakultas'] = $item->fakultas;

		 		$data['tabel'][] = $data_item;
		 	}
		}

// die;
		$this->load->view("main", $data);
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

	function ajax_prodi($prodi_id = null) {
		if ($this->input->post('fakultas_id') == 0) {
			?>
			<option value="0">Semua</option>
			<?php
		} else {
			?>
			<option value="0">Semua</option>
			<?php
			foreach ($this->db->get_where('prodi', ['fakultas_id' => $this->input->post('fakultas_id')])->result() as $item) {
				?>
				<option <?php echo $prodi_id != null && $prodi_id != 0 && $prodi_id == $item->id ? 'selected' : null;  ?> value="<?php echo $item->id; ?>"><?php echo $item->nama; ?></option>
				<?php
			}			
		}
	}

	function export_pdf() {
		$where = ' ';
		$where_i = ' ';
		$where_t = ' ';
		$where = ' ';
		$array_where = [];
		$data = [];
		$data['tabel'] = [];

		if ($this->input->get('tanggal_mulai') != null && $this->input->get('tanggal_mulai') != '') {
			$data['form']['tanggal_mulai'] = $this->input->get('tanggal_mulai');

			$where .= ' AND k.tanggal_mulai BETWEEN ? AND ? ' ;

			$tanggal = explode(' - ', $data['form']['tanggal_mulai']);
			
			$tanggal1 = explode('-', $tanggal[0]);
			$array_where[] = $tanggal1[2] . '-' . $tanggal1[1] . '-' . $tanggal1[0];

			$tanggal2 = explode('-', $tanggal[1]);
			$array_where[] = $tanggal2[2] . '-' . $tanggal2[1] . '-' . $tanggal2[0];
		}

		if ($this->input->get('kategori') != null && $this->input->get('kategori') != '0') {
			$data['form']['kategori'] = $this->input->get('kategori');

			$where .= ' AND k.kategori_id = ? ' ;
			
			$array_where[] = $data['form']['kategori'];
			
			$data['form']['kategori'] = $this->db->get_where('kategori', ['id' => $this->input->get('kategori')])->row()->kategori;

		}

		if ($this->input->get('tingkat') != null && $this->input->get('tingkat') != '0') {
			$data['form']['tingkat'] = $this->input->get('tingkat');

			$where .= ' AND k.tingkat = ? ' ;

			$array_where[] = $data['form']['tingkat'];

			if ($this->input->get('tingkat') == 'l') {
              $data['form']['tingkat'] = "Lokal";
            } elseif ($this->input->get('tingkat') == 'n') {
              $data['form']['tingkat'] = "Nasional";
            } else {
              $data['form']['tingkat'] = "Internasional";
            }

		}
		
		if ($this->input->get('keanggotaan') != null && $this->input->get('keanggotaan') != '0') {
			$data['form']['keanggotaan'] = $this->input->get('keanggotaan');

			$where .= ' AND k.keanggotaan = ? ' ;

			$array_where[] = $data['form']['keanggotaan'];

			if ($this->input->get('keanggotaan') == 'i') {
              $data['form']['keanggotaan'] = "Individu";
              $url_keanggotaan = 'detil_kegiatan_individu';
            } else {
              $data['form']['keanggotaan'] = "Tim";
              $url_keanggotaan = 'detil_kegiatan_tim';
            }

		}

		if ($this->input->get('prestasi') != null && $this->input->get('prestasi') != '0') {
			$data['form']['prestasi'] = 'Hanya Berprestasi';

			$where_t = " AND t.prestasi != '' " ;
			$where_i = " AND i.prestasi != '' " ;

			// $array_where[] = $data['form']['prestasi'];
		}

		if ($this->input->get('fakultas') != null && $this->input->get('fakultas') != '0') {
			$data['form']['fakultas'] = $this->input->get('fakultas');

			$where .= ' AND f.id = ? ' ;

			$array_where[] = $data['form']['fakultas'];

			// $data['form']['fakultas'] = $this->db->get_where('fakultas', ['id' => $this->input->get('fakultas')])->row()->nama;
		}

		if ($this->input->get('prodi') != null && $this->input->get('prodi') != '0') {
			$data['form']['prodi'] = $this->input->get('prodi');

			$where .= ' AND p.id = ? ' ;

			$array_where[] = $data['form']['prodi'];

			// $data['form']['prodi'] = $this->db->get_where('prodi', ['id' => $this->input->get('prodi')])->row()->nama;

		}

		$kegiatan_individu = $this->db->query("SELECT *, i.id individu_id, f.nama fakultas, p.nama prodi, m.nama mahasiswa
												FROM kegiatan k, individu i, mahasiswa m, prodi p, fakultas f
												WHERE i.kegiatan_id = k.id
												AND i.mahasiswa_id = m.id
												AND m.prodi_id = p.id
												AND p.fakultas_id = f.id"
												. $where . $where_i .
												"ORDER BY k.id", $array_where)->result();
// echo $this->db->last_query() . "<br>";
		$data_item = [];
		$kegiatanId = null;
		foreach ($kegiatan_individu as $item) {
		 	if ($kegiatanId != null) {
		 		if ($kegiatanId != $item->kegiatan_id) {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
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
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = 'Individu';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		} else {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
		 			$data_item['kegiatan'] = null;
			 		$data_item['tanggal_mulai'] = null;
				 	$data_item['lokasi'] = null;
				 	$data_item['kategori'] = null;
				 	$data_item['tahun_ajar'] = null;
				 	$data_item['semester'] = null;
				 	$data_item['tingkat'] = null;
				 	$data_item['pembina'] = null;
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = null;
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		}
	 			$data['tabel'][] = $data_item;
		 	} else {
		 		$kegiatanId = $item->kegiatan_id;
		 		$data_item['kegiatan_id'] = $kegiatanId;
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
		 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
		 		$data_item['keanggotaan'] = 'Individu';
		 		$data_item['nim'] = $item->nim;
		 		$data_item['nama'] = $item->mahasiswa;
		 		$data_item['prodi'] = $item->prodi;
		 		$data_item['fakultas'] = $item->fakultas;

		 		$data['tabel'][] = $data_item;
		 	}
		}

		$kegiatan_tim = $this->db->query("SELECT *, dt.id detil_tim_id, m.nama mahasiswa, p.nama prodi, f.nama fakultas
										FROM kegiatan k, tim t, detil_tim dt, mahasiswa m, prodi p, fakultas f
										WHERE dt.tim_id = t.id
										AND t.kegiatan_id = k.id
										AND dt.mahasiswa_id = m.id
										AND m.prodi_id = p.id
										AND p.fakultas_id = f.id"
										. $where . $where_t .
										"ORDER BY k.id, t.id", $array_where)->result();
		// echo $this->db->last_query() . "<br>";
		$data_item = [];
		$kegiatanId = null;
		foreach ($kegiatan_tim as $item) {
		 	if ($kegiatanId != null) {
		 		if ($kegiatanId != $item->kegiatan_id) {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
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
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		} else {
		 			$kegiatanId = $item->kegiatan_id;
		 			$data_item['kegiatan_id'] = $kegiatanId;
		 			$data_item['kegiatan'] = null;
			 		$data_item['tanggal_mulai'] = null;
				 	$data_item['lokasi'] = null;
				 	$data_item['kategori'] = null;
				 	$data_item['tahun_ajar'] = null;
				 	$data_item['semester'] = null;
				 	$data_item['tingkat'] = null;
				 	$data_item['pembina'] = null;
			 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
			 		$data_item['keanggotaan'] = $data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
			 		$data_item['nim'] = $item->nim;
			 		$data_item['nama'] = $item->mahasiswa;
			 		$data_item['prodi'] = $item->prodi;
			 		$data_item['fakultas'] = $item->fakultas;
		 		}
	 			$data['tabel'][] = $data_item;
		 	} else {
	 			$kegiatanId = $item->kegiatan_id;
	 			$data_item['kegiatan_id'] = $kegiatanId;
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
		 		$data_item['prestasi'] = $data_item['prestasi'] = $item->prestasi == null ? '-' : $item->prestasi;
		 		$data_item['keanggotaan'] = 'Tim (' . $item->tim . ')';
		 		$data_item['nim'] = $item->nim;
		 		$data_item['nama'] = $item->mahasiswa;
		 		$data_item['prodi'] = $item->prodi;
		 		$data_item['fakultas'] = $item->fakultas;

		 		$data['tabel'][] = $data_item;
		 	}
		}

		if (isset($data['form']['fakultas'])) {
			$data['form']['fakultas'] = $this->db->get_where('fakultas', ['id' => $data['form']['fakultas']])->row()->nama;
		}

		if (isset($data['form']['prodi'])) {
			$data['form']['prodi'] = $this->db->get_where('prodi', ['id' => $data['form']['prodi']])->row()->nama;
		}

		// var_dump($data['tabel']); die;
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($this->load->view('dompdf', $data, true));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A3', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('Data Kegiatan dan Prestasi Mahasiswa Universitas Budi Luhur.pdf');
	}

}