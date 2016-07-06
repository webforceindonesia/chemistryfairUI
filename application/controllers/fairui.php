<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fairui extends CI_Controller {

	public function index()
	{
			$page = 'home';
			if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Home - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	
}

?>