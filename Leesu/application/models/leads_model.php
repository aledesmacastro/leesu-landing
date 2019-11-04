<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

	public function get(){
		$sql = "SELECT * FROM leads";
		$res = $this->db->query($sql);
		return $res->result_array();
	}

}