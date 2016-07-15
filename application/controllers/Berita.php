<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function index()
	{
			$event = mktime(0,0,0,8,1,2016);
			$remaining = $event - time();
			$data['countdown'] = floor($remaining / 86400);
			
			$page = "home";
			if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['page_title'] = "Chemistry Fair UI 2016";
			$this->load->view($page, $data);
	}
	
	public function form()
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		
		$page = "new_entry_news";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Form - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	public function news()
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		
		$this->load->model('cms_news_model');
		$content = $this->cms_news_model->pull_one();
		
		$data['news_title'] = $content['title'];
		$data['news_content'] = $content['content'];
		$data['news_created'] = $content['created'];
				
		$page = "news_entry";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Form - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	public function form_input()
	{
		$this->load->model('cms_news_model');
		
		$this->cms_news_model->write();
	}
}

?>