<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function index()
	{
			$event = mktime(0,0,0,8,1,2016);
			$remaining = $event - time();
			$data['countdown'] = floor($remaining / 86400);
			
			$page = "berita";
			if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['page_title'] = "Berita - Chemistry Fair UI 2016";
			$this->load->view($page, $data);
	}
	
	public function view($id = '')
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		$news_id = $id;

		$this->load->model('cms_news_model');
		$content = $this->cms_news_model->pull_one($news_id);
		
		$data['news_title'] = $content->title;
		$data['news_content'] = $content->content;
		$data['news_created'] = $content->created;
				
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
	
}

?>