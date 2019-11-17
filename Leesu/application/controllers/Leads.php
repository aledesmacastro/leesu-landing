<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->api_key = KEY_API_REST;
		$this->user_name = USER_API_REST;
		$this->password = PASS_API_REST;
		
	}

	public function index()
	{
		$datos["titulo"] = " .: Formulario de Registro :.";
		$this->load->view("landing/index", $datos);

	}

	public function action(){
		if ($this->input->post('data_action')) {

			$data_action = $this->input->post('data_action');
			
			if ($data_action == 'create') {

				$form_data = array(
					'first_name'	=>	$this->input->post('first_name'),
					'last_name'		=>	$this->input->post('last_name'),
					'email'			=>	$this->input->post('email'),
					'phone'			=>	$this->input->post('phone'),
					'city'			=>	$this->input->post('city'),
					'comments'		=>	$this->input->post('comments')
				);

				$api_url = base_url() . 'api/LeadsRestApi';

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $this->api_key));
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($client, CURLOPT_USERPWD, $this->user_name . ':' . $this->password);

				$response = curl_exec($client);
				curl_close($client);

				echo $response;
			}

		}
	}
	
}
