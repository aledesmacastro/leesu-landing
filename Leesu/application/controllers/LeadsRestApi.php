<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*use Restserver\Libraries\REST_Controller;
use Restserver\Libraries\REST_Controller_Definitions;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/REST_Controller_Definitions.php';*/

class LeadsRestApi extends CI_Controller {

	/*use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
	}*/

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model("Leads_model");
	}

	public function getLeads_get(){
		$this->load->model("Leads_model");
		$datos = $this->Leads_model->get();
		$this->response($datos);
	}

	public function addLead(){
		$this->form_validation->set_data($this->input->get());

		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','Last Name','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('phone','Phone','required');
		$this->form_validation->set_rules('city','City','required');

		if ($this->form_validation->run()) {
			$data = array(
				'first_name'	=> $this->input->get('first_name'),
				'last_name'		=> $this->input->get('last_name'),
				'email'			=> $this->input->get('email'),
				'phone'			=> $this->input->get('phone'),
				'city'			=> $this->input->get('city'),
				'comments'		=> $this->input->get('comments'),
				'ip_address'	=> $this->input->ip_address()
			);

			$array = $this->Leads_model->addLead($data);
		}else{
			$array = array(
				'error' 			=> true,
				'first_name_error'	=> form_error('first_name'),
				'last_name_error'	=> form_error('last_name'),
				'email_error'		=> form_error('email'),
				'phone_error'		=> form_error('phone'),
				'city_error'		=> form_error('city')
			);
		}

		echo json_encode($array);
	}
	
}
