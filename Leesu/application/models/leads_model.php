<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

	public function addLead($data){
		$sql = "INSERT INTO leads (nombresLeads, apellidosLeads, emailLeads, telefonoLeads, ciudadLeads, comentariosLeads, autorizaDatosLeads, ipLeads, fechaRegistroLeads)
			VALUES (UPPER(". $this->db->escape($data["first_name"]) ."),UPPER(". $this->db->escape($data["last_name"]) ."),UPPER(". $this->db->escape($data["email"]) ."),UPPER(". $this->db->escape($data["phone"]) ."),UPPER(". $this->db->escape($data["city"]) ."),UPPER(". $this->db->escape($data["comments"]) ."),'Y','12',NOW())";
		
		if ($this->db->simple_query($sql)) {
			$array = array(
				'success'	=> true
			);
		}else{
			$array = array(
				'success'	=> false
			);	
		}

		return $array;

	}

	public function get(){
		$sql = "SELECT * FROM leads";
		$res = $this->db->query($sql);
		return $res->result_array();
	}

}