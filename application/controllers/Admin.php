<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $username;
	private $password;

	public function index()
	{
		$page = "login_admin";
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
		{
			//Homepage does not exist
			show_404();
		}
			
		$data['page_title'] = "Admin - Chemistry Fair UI 2016";
		$this->load->view($page, $data);
	}

	public function login()
	{
		$this->username = $this->input->post('username');
		$this->password = $this->input->post('password');

		$this->load->model('login_model');
		if($this->login_model->getUsername($this->username, $this->password))
		{
			if(password_verify($this->password, $unPassword))
			{
				$this->session->username = $this->username;
				$this->session->isLogged = True;
			}else
			{
				redirect('/admin', 'refresh');
			}
		}else
		{
			redirect('/admin', 'refresh');
		}
	}

	public function forget()
	{
		$page = "forget_password";
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
		{
			//Homepage does not exist
			show_404();
		}
			
		$data['page_title'] = "Admin - Chemistry Fair UI 2016";
		$this->load->view($page, $data);
	}

	public function reset()
	{
		$email = $this->input->post('email');
	}

	public function news_new_form()
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
			
			$data['title'] = "Admin - Chemistry Fair";
			
			$this->load->view('templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('templates/footer.php');
	}
	
	public function new_news()
	{
		if(!$_POST)
		{
			redirect('/main');
		}else
		{
			$this->load->model('cms_news_model');
			$this->cms_news_model->write();

			redirect('/main');
		}
	}

	//Development Only
	public function new_admin()
	{

	}
}

?>