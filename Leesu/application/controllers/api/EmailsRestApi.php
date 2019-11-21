<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class EmailsRestApi extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("emails_model");
		
	}

	public function index_get(){
		$datos = $this->emails_model->get($this->input->get('idEmail'));
		$this->response($datos, REST_Controller::HTTP_OK);
	}

	public function index_post(){
		$this->response('Metodo en implementacion', REST_Controller::HTTP_OK);
	}

	public function index_put(){
		$this->response('Metodo en implementacion', REST_Controller::HTTP_OK);
	}

	public function index_delete(){
		$this->response('Metodo en implementacion', REST_Controller::HTTP_OK);
	}	
	
}
