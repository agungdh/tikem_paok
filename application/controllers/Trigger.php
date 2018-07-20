<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trigger extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index() {
		$config = $this->db->get('config')->row();
		
		$phone = [];
		$deadline_phone = [];
		foreach ($this->db->get_where('peminjaman', ['status' => 1])->result() as $item) {
                $deadline=date_create($item->tanggal);
                date_add($deadline,date_interval_create_from_date_string($item->durasi . " days"));
                $date1 = date("Y-m-d");
                $date2 = date_format($deadline,"Y-m-d");
                $days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);
                if ($days <= 1) {
                	$phone[] = $item->nohp;
                	$deadline_phone[] = $days;
                }
		}

		foreach ($phone as $item) {
			$zenziva = simplexml_load_string(file_get_contents('https://reguler.zenziva.net/apps/smsapi.php?userkey='.$config->zenziva_userkey.'&passkey='.$config->zenziva_passkey.'&nohp='.$item.'&pesan='.urlencode($config->zenziva_sms)));

			var_dump($zenziva);

			$this->db->insert('log',
			[
				'tag' => 'Zenziva Kirim SMS',
				'base_url' => 'trigger',
				'time' => date('Y-m-d H:i:s'),
				'value' => json_encode($zenziva)
			]);
		}
	}
}