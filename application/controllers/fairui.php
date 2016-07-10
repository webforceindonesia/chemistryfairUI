<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fairui extends CI_Controller {

	public function index()
	{
			$event = mktime(0,0,0,8,1,2016);
			$remaining = $event - time();
			$data['countdown'] = floor($remaining / 86400);
			
			$page = "landing_page";
			if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['page_title'] = "Chemistry Fair UI 2016";
			$this->load->view($page, $data);
	}
	
	public function aboutUs()
	{
		$page = "aboutUs";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "About Us - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	public function acara()
	{
		$page = "aboutUs";	
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