<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index() {
		if ($this->session->login != true) {
			$this->load->view("template/login");
		} else {
			$data['isi'] = "dashboard/index";
			$data['js'] = "dashboard/index_js";
			$data['data']['config'] = $this->db->get('config')->row();
			
			$this->load->view("template/template", $data);
		}
	}

}