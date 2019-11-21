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
				$datos = json_decode($response);
				curl_close($client);
				
				if ($datos->success) {
					$this->send_email($this->input->post('email'), $this->input->post('first_name'));
				}

				echo $response;
			}

		}
	}

	public function send_email($destinatario, $nombre){

		$idEmail = 1;
		$api_url = base_url() . 'api/EmailsRestApi/index?idEmail=' . $idEmail;

		$client = curl_init($api_url);

		curl_setopt($client, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $this->api_key));
		curl_setopt($client, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_USERPWD, $this->user_name . ':' . $this->password);

		$response = curl_exec($client);
		$datos = json_decode($response);
		curl_close($client);
		
		if ($datos) {
			// Load PHPMailer library
	        $this->load->library('phpmailer_lib');
	        
	        // PHPMailer object
	        $mail = $this->phpmailer_lib->load();
	        
	        // SMTP configuration
	        $mail->isSMTP();
	        $mail->Host     	= $datos->hostEmail;
	        $mail->SMTPAuth 	= $datos->authSMTP;
	        $mail->Username 	= $datos->userEmail;
	        $mail->Password 	= $datos->passEmail;
	        $mail->SMTPSecure 	= $datos->secureSMTP;
	        $mail->Port     	= $datos->portEmail;
	        
	        $mail->setFrom($datos->userEmail, 'Leesu');
	        //$mail->addReplyTo('info@example.com', 'CodexWorld');
	        
	        // Add a recipient
	        $mail->addAddress($destinatario);
	        
	        // Add cc or bcc 
	        //$mail->addCC('cc@example.com');
	        //$mail->addBCC('bcc@example.com');
	        
	        // Email subject
	        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
	        
	        // Set email format to HTML
	        $mail->isHTML(true);
	        
	        // Email body content
	        $mailContent = $this->load->view("email_templates/register_landing","",true);
	        $mail->Body = $mailContent;
	        
	        // Send email
	        $mail->send();	
		}

		

	}
	
}
