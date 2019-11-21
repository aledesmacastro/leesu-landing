<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

	public function get($id){
		$sql = "SELECT * FROM emails ";

		if (!empty($id)) {
			$sql .= "WHERE idEmail = " . $this->db->escape($id);
		}
		
		$res = $this->db->query($sql);
		return $res->result_array();
	}

}