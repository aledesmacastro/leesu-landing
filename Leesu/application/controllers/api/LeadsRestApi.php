<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class LeadsRestApi extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model("Leads_model");
		
	}

	public function index_get(){
		
		$this->load->model("Leads_model");
		$datos = $this->Leads_model->get();
		$this->response($datos, REST_Controller::HTTP_OK);
		
	}

	public function index_post(){
		
		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','Last Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('phone','Phone','required');
		$this->form_validation->set_rules('city','City','required');

		if ($this->form_validation->run()) {
			$data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
				'email'			=> $this->input->post('email'),
				'phone'			=> $this->input->post('phone'),
				'city'			=> $this->input->post('city'),
				'comments'		=> $this->input->post('comments'),
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

		$this->response($array, REST_Controller::HTTP_OK);
	}

	public function index_put(){
		$this->response('Metodo en implementacion', REST_Controller::HTTP_OK);
	}

	public function index_delete(){
		$this->response('Metodo en implementacion', REST_Controller::HTTP_OK);
	}	
	
}
