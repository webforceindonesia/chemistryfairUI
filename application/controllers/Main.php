<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	
	public function aboutus()
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		
		$page = "about_us";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Tentang Kami - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	public function home()
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		
		$i=0;
		$page = "home";
		
		$this->load->model('cms_news_model');
		$content = $this->cms_news_model->pull_last();
		
		foreach ($content as $row)
		{
			$data['news_id'][$i] = $row['id'];
			$data['news_title'][$i] = $row['title'];
			$data['news_created'][$i] = $row['created'];
			$data['news_content'][$i] = $row['content'];
			$i++;
		}
		
		$data['news_counter'] = $i;
			
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Beranda - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
}

?>