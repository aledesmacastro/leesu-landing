<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

	public function index()
	{
		$datos["titulo"] = " .: Formulario de Registro :.";
		$this->load->view("landing/index", $datos);
	}

	public function action(){

		if ($this->input->get('data_action')) {
			$data_action = $this->input->get('data_action');

			if ($data_action == 'create') {

				$first_name	= $this->input->get('first_name');
				$last_name	= $this->input->get('last_name');
				$email	= $this->input->get('email');
				$phone	= $this->input->get('phone');
				$city	= $this->input->get('city');
				$comments	= $this->input->get('comments');

				$api_url = base_url() . 'LeadsRestApi/addLead?first_name=' . $first_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&city=' . $city . '&comments=' . $comments;

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);
				curl_close($client);

				echo $response;
			}

		}
	}
	
}
