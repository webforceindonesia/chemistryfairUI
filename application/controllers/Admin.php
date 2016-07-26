<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $username;
	private $password;

	public function index()
	{
		if(isset($this->session->username) && $this->session->isLogged == True)
		{
			$page="admin/dashboard";	
		}else
		{
			$page = "admin/login_admin";
		}

		if (!file_exists (APPPATH.'views/'.$page.'.php'))
		{
			//Homepage does not exist
			show_404();
		}
			
		$data['page_title'] = "Admin - Chemistry Fair UI 2016";
		$this->load->view('admin/templates/header.php', $data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer.php');
	}

	/* Login Methods */
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
				$this->session->set_flashdata('failed', 'Login Error, Wrong Username or Password');
				redirect('/admin', 'refresh');
			}
		}else
		{
				$this->session->set_flashdata('failed', 'Login Error, Wrong Username or Password');
			redirect('/admin', 'refresh');
		}
	}

	public function forget()
	{
		$page = "admin/forget_password";
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
			$this->session->set_flashdata('failed', 'Success');
			redirect('/admin');
		}else
		{
			$this->session->set_flashdata('failed', 'Reset Failed');
			redirect('/forget');
		}
	}

	public function logout ()
	{
		session_destroy();
		redirect('/main');
	}

	/* Admin Functionality */
	public function news_new_form()
	{
			if(isset($this->session->username) && $this->session->isLogged == True)
			{
				$page="admin/news/new_entry_news";	
			}else
			{
				$page = "admin/login_admin";
			}

			$data['page_title'] = "New News | Admin - Chemistry Fair";
			
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

	public function lomba ($param1 = NULL, $param2 = NULL)
	{
		$this->load->model('admin_model');
		$data['page_title'] 	= "Peserta Lomba - Admin Chemistry Fair";

		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			redirect('main');
		}
		

		if($param1 != NULL)
			{
				switch ($param1)
				{
					case 'cc' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cc', $param2);
						$page 				  = "admin/lomba/participants_cc";
					}break;

					case 'cfk' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cfk', $param2);
						$page 				  = "admin/lomba/participants_cfk";
					}break;

					case 'cip' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cip', $param2);
						$page 				  = "admin/lomba/participants_cip";
					}break;

					case 'cmp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cmp', $param2);
						$page 				  = "admin/lomba/participants_cmp";
					}break;

					case 'cp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cp', $param2);
						$page 				  = "admin/lomba/participants_cp";
					}break;

					default :
					{
						redirect ('/admin');
					}
				}
			}
			else{
				$page = "admin/lomba/lomba_home";
			}

		$this->load->view('admin/templates/header.php', $data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer.php');
	}

	public function konfirmasi_pembayaran($lomba = '', $account_id = '')
	{
		$this->db->set('is_paid', '1');
		$this->db->where('account_id', $account_id);
		$this->db->update($lomba . '_participants');
		$this->session->set_flashdata('success', 'Success in Konfirmasi Pembayaran');
		redirect('/admin/lomba');
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