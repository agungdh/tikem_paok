<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->pustaka->auth($this->session->level, [1]);
	}

	function index() {
		$data['isi'] = 'log/index';
		$data['js'] = 'log/index_js';

		$this->load->view('template/template', $data);
	}

	function ajax(){
	    $requestData = $_REQUEST;
	    $columns = ['time', 'tag', 'base_url', 'value'];

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM log")->row();

	        $totalData = $row->total_data;
	        $totalFiltered = $totalData; 

	    $data = [];

	    if( !empty($requestData['search']['value']) ) {
	      $search_value = "%" . $requestData['search']['value'] . "%";

		    $cari = [];
	  	    for ($i=1; $i <= 4; $i++) { 
		    	$cari[] = $search_value;
		    }

	      $row = $this->db->query("SELECT count(*) total_data 
	        FROM log
	        WHERE (tag LIKE ?
	    			OR base_url LIKE ?
	    			OR time LIKE ?
	    			OR value LIKE ?
	    		)", $cari)->row();

	        $totalFiltered = $row->total_data; 

	      $query = $this->db->query("SELECT *
	        FROM log
	        WHERE (tag LIKE ?
	    			OR base_url LIKE ?
	    			OR time LIKE ?
	    			OR value LIKE ?
	    		)
	        ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length'], $cari);
	            
	    } else {  

	      $query = $this->db->query("SELECT *
	        FROM log
	        ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']);
	            
	    }

	    foreach ($query->result() as $row) { 
	      $nestedData=[]; 
	      $id = $row->id;
	      $nestedData[] = $this->pustaka->tanggal_waktu_indo($row->time);
	      $nestedData[] = $row->tag;
	      $nestedData[] = base_url($row->base_url);
	      $nestedData[] = $row->value;

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