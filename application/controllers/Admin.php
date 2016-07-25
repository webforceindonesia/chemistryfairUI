<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $username;
	private $password;

	public function index()
	{
		if(isset($this->session->username) && $this->session->isLogged == True)
		{
			$page="admin/new_entry_news";	
		}else
		{
			$page = "login_admin";
		}

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
		if($unPassword = $this->login_model->getPassword($this->username))
		{
			if(password_verify($this->password, $unPassword))
			{
				$this->session->username = $this->username;
				$this->session->isLogged = True;

				redirect('/admin');
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
		$this->load->model('login_model');
		if($this->login_model->reset())
		{
			redirect('/admin?reset=1');
		}else
		{
			redirect('/forget?false=1');
		}
	}

	public function news_new_form()
	{
		$page = "admin/new_entry_news";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Admin - Chemistry Fair";
			
			$this->load->view('admin/templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('admin/templates/footer.php');
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

	public function sliderEdit ()
	{
				$config['upload_path']          = '/images/slider';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('slider'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
	}

	public function logout ()
	{
		session_destroy();
		redirect('/main');
	}

	public function successPage ()
	{
		$page = "admin/success";	
		if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}
			
			$data['title'] = "Admin - Chemistry Fair";
			
			$this->load->view('admin/templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('admin/templates/footer.php');
	}

	//Development Only
	public function new_admin()
	{
		if($_POST)
		{
			$this->load->model('login_model');
			$this->login_model->new_admin();

			redirect('/admin');
		}else
		{
			redirect('/admin');
		}
	}

	public function new_admin_form()
	{
		$event = mktime(0,0,0,8,1,2016);
		$remaining = $event - time();
		$data['countdown'] = floor($remaining / 86400);
		
		$page = "admin/new_entry_admin";	
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
}

?>