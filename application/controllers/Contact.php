<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
	}

	public function submit ()
	{
		$name 		= $this->input->post('name');
		$email 		= $this->input->post('email');
		$content 	= $this->input->post('content');

		$data 		= array(

			'name'		=> $name,
			'email'		=> $email,
			'content'	=> $content

			);

		$this->load->model('email_model');
		if(!$this->email_model->contactus($data))
		{
			$this->session->set_flashdata('error', 'Sending Email Failed! Please Contact the Webmaster');
			redirect('main');
		}else
		{
			$this->session->set_flashdata('success', 'Sending Email Success! Please check your email for reply');
			redirect('main');
		}
	}

}

?>