<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

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

				$api_url = base_url() . 'LeadsRestApi';

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);
				curl_close($client);

				echo $response;
			}

		}
	}
	
}
