<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1, 2]);
	}

	function index() {
		$data['isi'] = 'peminjaman/index';
		$data['js'] = 'peminjaman/index_js';

		$this->load->view('template/template', $data);
	}

	function tambah() {
		$data['isi'] = 'peminjaman/tambah';
		$data['js'] = 'peminjaman/tambah_js';

		$this->load->view('template/template', $data);
	}

	function ubah($id) {
		$data['isi'] = 'peminjaman/ubah';
		$data['js'] = 'peminjaman/ubah_js';
		$data['data']['peminjaman'] = $this->db->get_where('peminjaman', ['id' => $id])->row();

		$this->load->view('template/template', $data);
	}

	function aksi_tambah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {
				case 'tanggal':
					$date=date_create($value);
					$data[$key] = date_format($date,"Y-m-d");
					break;
				
				default:
					$data[$key] = $value;
					break;
			}
		}

		$this->db->insert('peminjaman', $data);

		redirect(base_url('peminjaman'));
	}

	function aksi_ubah() {
		foreach ($this->input->post('data') as $key => $value) {
			switch ($key) {
				case 'tanggal':
					$date=date_create($value);
					$data[$key] = date_format($date,"Y-m-d");
					break;
				
				default:
					$data[$key] = $value;
					break;
			}
		}

		foreach ($this->input->post('where') as $key => $value) {
			$where[$key] = $value;
		}

		$this->db->update('peminjaman', $data, $where);

		redirect(base_url('peminjaman'));
	}

	function aksi_hapus($id) {
		$this->db->delete('peminjaman', ['id' => $id]);

		redirect(base_url('peminjaman'));
	}

	function ajax_belum(){
	    $requestData = $_REQUEST;
	    $columns = ['nama', 'nip', 'nohp', 'noseri', 'jenis', 'tanggal', 'durasi'];

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM peminjaman
	        WHERE status = ?", [1])->row();

	        $totalData = $row->total_data;
	        $totalFiltered = $totalData; 

	    $data = [];

	    if( !empty($requestData['search']['value']) ) {
	      $search_value = "%" . $requestData['search']['value'] . "%";

		    $cari = [];

		    $cari[] = 1;

	  	    for ($i=1; $i <= 7; $i++) { 
		    	$cari[] = $search_value;
		    }

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM peminjaman
	        WHERE status = ?
	        AND (nama LIKE ?
	        		OR nip LIKE ?
	        		OR nohp LIKE ?
	        		OR noseri LIKE ?
	        		OR jenis LIKE ?
	        		OR tanggal LIKE ?
	        		OR durasi LIKE ?
	        		)", $cari)->row();

	        $totalFiltered = $row->total_data; 

	      $query = $this->db->query("SELECT *
	        FROM peminjaman
	        WHERE status = ?
	        AND (nama LIKE ?
	        		OR nip LIKE ?
	        		OR nohp LIKE ?
	        		OR noseri LIKE ?
	        		OR jenis LIKE ?
	        		OR tanggal LIKE ?
	        		OR durasi LIKE ?
	        		) ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length'], $cari);
	            
	    } else {  

	      $query = $this->db->query("SELECT *
	        FROM peminjaman
	        WHERE status = ?
	        ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length'], [1]);
	            
	    }

	    foreach ($query->result() as $row) { 
	      $nestedData=[]; 
	      $id = $row->id;
	      $nestedData[] = $row->nama;
	      $nestedData[] = $row->nip;
	      $nestedData[] = $row->nohp;
	      $nestedData[] = $row->noseri;
	      $nestedData[] = $row->jenis;
	      $nestedData[] = $this->pustaka->tanggal_indo($row->tanggal);
	      $nestedData[] = $row->durasi;
	      $deadline=date_create($row->tanggal);
          date_add($deadline,date_interval_create_from_date_string($row->durasi . " days"));
	      $nestedData[] = date_format($deadline,"d-m-Y");
	      $date1 = date("Y-m-d");
          $date2 = date_format($deadline,"Y-m-d");
          $days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);
	      $nestedData[] = $days;
	      $nestedData[] = '
	          <div class="btn-group">
	            <a class="btn btn-primary" href="' . base_url('peminjaman/ubah/' . $row->id) . '" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
	            <a class="btn btn-primary" href="#" onclick="hapus(' . "'$row->id'" . ')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
	          </div>';

	      $data[] = $nestedData;
	        
	    }

	    $json_data = [
	          "draw"            => intval( $requestData['draw'] ),    
	          "recordsTotal"    => intval( $totalData ), 
	          "recordsFiltered" => intval( $totalFiltered ), 
	          "data"            => $data   
	          ];

	    echo json_encode($json_data);  
	  }

	  function ajax_sudah(){
	    $requestData = $_REQUEST;
	    $columns = ['nama', 'nip', 'nohp', 'noseri', 'jenis', 'tanggal', 'durasi'];

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM peminjaman
	        WHERE status = ?", [0])->row();

	        $totalData = $row->total_data;
	        $totalFiltered = $totalData; 

	    $data = [];

	    if( !empty($requestData['search']['value']) ) {
	      $search_value = "%" . $requestData['search']['value'] . "%";

		    $cari = [];

		    $cari[] = 1;

	  	    for ($i=1; $i <= 7; $i++) { 
		    	$cari[] = $search_value;
		    }

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM peminjaman
	        WHERE status = ?
	        AND (nama LIKE ?
	        		OR nip LIKE ?
	        		OR nohp LIKE ?
	        		OR noseri LIKE ?
	        		OR jenis LIKE ?
	        		OR tanggal LIKE ?
	        		OR durasi LIKE ?
	        		)", $cari)->row();

	        $totalFiltered = $row->total_data; 

	      $query = $this->db->query("SELECT *
	        FROM peminjaman
	        WHERE status = ?
	        AND (nama LIKE ?
	        		OR nip LIKE ?
	        		OR nohp LIKE ?
	        		OR noseri LIKE ?
	        		OR jenis LIKE ?
	        		OR tanggal LIKE ?
	        		OR durasi LIKE ?
	        		) ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length'], $cari);
	            
	    } else {  

	      $query = $this->db->query("SELECT *
	        FROM peminjaman
	        WHERE status = ?
	        ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length'], [0]);
	            
	    }

	    foreach ($query->result() as $row) { 
	      $nestedData=[]; 
	      $id = $row->id;
	      $nestedData[] = $row->nama;
	      $nestedData[] = $row->nip;
	      $nestedData[] = $row->nohp;
	      $nestedData[] = $row->noseri;
	      $nestedData[] = $row->jenis;
	      $nestedData[] = $this->pustaka->tanggal_indo($row->tanggal);
	      $nestedData[] = $row->durasi;
	      $deadline=date_create($row->tanggal);
          date_add($deadline,date_interval_create_from_date_string($row->durasi . " days"));
	      $nestedData[] = date_format($deadline,"d-m-Y");
	      $date1 = date("Y-m-d");
          $date2 = date_format($deadline,"Y-m-d");
          $days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);
	      $nestedData[] = $days;
	      $nestedData[] = '
	          <div class="btn-group">
	            <a class="btn btn-primary" href="' . base_url('peminjaman/ubah/' . $row->id) . '" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
	            <a class="btn btn-primary" href="#" onclick="hapus(' . "'$row->id'" . ')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
	          </div>';

	      $data[] = $nestedData;
	        
	    }

	    $json_data = [
	          "draw"            => intval( $requestData['draw'] ),    
	          "recordsTotal"    => intval( $totalData ), 
	          "recordsFiltered" => intval( $totalFiltered ), 
	          "data"            => $data   
	          ];

	    echo json_encode($json_data);  
	  }

}