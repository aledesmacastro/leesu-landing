<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
use Restserver\Libraries\REST_Controller_Definitions;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/REST_Controller_Definitions.php';

class Leads extends CI_Controller {

	use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
	}

	public function test_get(){
		$array = array('Hola',"Mundo","Codeigniter");
		$this->response($array);
	}

	public function leads_get(){
		//echo $this->get("id");
		$this->load->model("Leads_model");
		$datos = $this->Leads_model->get();
		$this->response($datos);
	}
	
}
