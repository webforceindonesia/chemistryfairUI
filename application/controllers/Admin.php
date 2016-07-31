<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $username;
	private $password;

	public function index()
	{
			
		$data['page_title'] = "Admin - Chemistry Fair UI 2016";
		
		if(isset($this->session->username) && $this->session->isLogged == True)
		{
			$page="admin/dashboard";

			if (!file_exists (APPPATH.'views/'.$page.'.php'))
			{
				//Homepage does not exist
				show_404();
			}

			$this->load->view('admin/templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('admin/templates/footer.php');	
		}else
		{
			$this->session->sess_destroy();
			redirect('/main');
		}
	}

	// /* Login Methods */ Depreceated - Moved to account controller
	// public function login()
	// {
	// 	$this->username = $this->input->post('username');
	// 	$this->password = $this->input->post('password');

	// 	$this->load->model('login_model');
	// 	if($unPassword = $this->login_model->getPassword($this->username))
	// 	{
	// 		if(password_verify($this->password, $unPassword))
	// 		{
	// 			$this->session->username = $this->username;
	// 			$this->session->isLogged = True;

	// 			redirect('/admin');
	// 		}else
	// 		{
	// 			$this->session->set_flashdata('failed', 'Login Error, Wrong Username or Password');
	// 			redirect('/admin', 'refresh');
	// 		}
	// 	}else
	// 	{
	// 			$this->session->set_flashdata('failed', 'Login Error, Wrong Username or Password');
	// 		redirect('/admin', 'refresh');
	// 	}
	// }

	// public function forget()
	// {
	// 	$page = "admin/forget_password";
	// 	if (!file_exists (APPPATH.'views/'.$page.'.php'))
	// 	{
	// 		//Homepage does not exist
	// 		show_404();
	// 	}
			
	// 	$data['page_title'] = "Admin - Chemistry Fair UI 2016";
	// 	$this->load->view($page, $data);
	// }

	// public function reset()
	// {
	// 	$this->load->model('login_model');
	// 	if($this->login_model->reset())
	// 	{
	// 		$this->session->set_flashdata('failed', 'Success');
	// 		redirect('/admin');
	// 	}else
	// 	{
	// 		$this->session->set_flashdata('failed', 'Reset Failed');
	// 		redirect('/forget');
	// 	}
	// }

	public function logout ()
	{
		session_destroy();
		redirect('/main');
	}

	/* Admin Functionality */
	public function news ($param1 = '', $param2 = '')
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}
		
		$page 						= "admin/news/news";
		$data['page_title']			= "Berita | Admin - Chemistry Fair UI";

		if($param1 == 'delete')
		{
		
			$this->db->where('id', $param2);
			$this->db->delete('cms_news');
			$this->session->set_flashdata('delete', 'Menghapus Berita Sukses');
			redirect('/admin/news');
		
		}else if($param1 == 'edit')
		{
			$this->db->where('id', $param2);
			$article = $this->db->get('cms_news')->row();

			$page 					= "admin/news/new_entry_news";
			$data['article']		= $article;
			$data['page_title'] 	= "Ubah Berita | Admin - Chemistry Fair";

		}else if($param1 == 'new')
		{

			$page 					= "admin/news/new_entry_news";
			$data['page_title'] 	= "Buat Baru | Admin - Chemistry Fair";
			$data['article']		= '';

		}else
		{
			$this->load->model('admin_model');
			if($param1 == '')
			{
				$data['news']			= $this->admin_model->getNews();
			}else
			{
				$data['news']			= $this->admin_model->getNews($param1);
			}
			$totalNews 					= $this->admin_model->totalNews();

			//Load Pagination Helper
			$this->load->library('pagination');

			$config['base_url'] 		= base_url() . 'admin/news/';
			$config['total_rows'] 		= $totalNews;
			$config['per_page'] 		= 10;
			$config['full_tag_open'] 	= '<ul class="pagination">';
			$config['full_tag_close'] 	= '</ul>';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';


			$this->pagination->initialize($config);

			$data['pagination'] 		= $this->pagination->create_links();
		}

		//Load The Page
		$this->load->view('admin/templates/header.php', $data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer.php');
	}
	
	public function new_news()
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		if(!$_POST)
		{
			redirect('/admin/news');
		}else
		{
			$this->load->model('cms_news_model');
			$this->cms_news_model->write();

			$this->session->set_flashdata('news', 'Membuat Berita Baru Sukses');

			redirect('/admin/news');
		}
	}

	public function edit_news($id)
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		if(!$_POST)
		{
			redirect('/admin/news');
		}else
		{
			$this->load->model('cms_news_model');
			$this->cms_news_model->edit($id);

			$this->session->set_flashdata('news', 'Merubah Berita Sukses');

			redirect('/admin/news');
		}
	}

	public function slider ()
	{
			if(isset($this->session->username) && $this->session->isLogged == True)
			{
				$page="admin/slider_upload";	
			}else
			{
				$this->session->sess_destroy();
				redirect('/main');
			}

			$data['page_title'] = "New News | Admin - Chemistry Fair";
			
			$this->load->view('admin/templates/header.php', $data);
			$this->load->view($page, $data);
			$this->load->view('admin/templates/footer.php');
	}

	public function slider_upload ($param1 = '')
	{
				if(!isset($this->session->username) && $this->session->isLogged == False)
				{
					$this->session->sess_destroy();
					redirect('/main');
				}

				if($param1 == 'tran')
				{
					$this->db->set('value', $this->input->post('tran'));
					$this->db->where('name', 'slidejs');
					$this->db->update('config');
					$this->session->set_flashdata('success', 'Mengganti Animasi Slider Sukses!');
					redirect('/admin');
				}
				$config['upload_path']          = 'images/slider';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 5000;
                $config['overwrite']			= True;
                // $config['max_width']            = 1920;
                // $config['max_height']           = 1080;

                $this->load->library('upload', $config);
                $i=1;

                foreach ($_FILES as $key => $value) {

				    if (!empty($value['tmp_name']) && $value['size'] > 0) {

				    	$config['file_name'] = "Slide-" . $i;
				    	$this->upload->initialize($config);

				        if (!$this->upload->do_upload($key)) {

				            $errors = $this->upload->display_errors();
				            $this->session->set_flashdata('errors', $errors);
				            redirect('/admin');
				        } else {

				            $data = array('upload_data' => $this->upload->data());
				            $this->session->set_flashdata('success', 'Upload Success!');
				        }

				        $i++;
				    }
				}

				redirect('/admin');
	}

	public function lomba ($param1 = NULL, $param2 = NULL)
	{
		$this->load->model('admin_model');
		$data['page_title'] 	= "Peserta Lomba - Admin Chemistry Fair";

		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		if($param1 != NULL)
			{
				$totalNews			  = $this->admin_model->totalParticipants($param1);
				
				switch ($param1)
				{
					case 'cc' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cc', $param2);
						$page 				  = "admin/lomba/participants_cc";

						//Load Pagination Helper
						$this->load->library('pagination');

						$config['base_url'] 		= base_url() . 'admin/news/';
						$config['total_rows'] 		= $totalNews;
						$config['per_page'] 		= 10;
						$config['full_tag_open'] 	= '<ul class="pagination">';
						$config['full_tag_close'] 	= '</ul>';
						$config['first_link'] = '&laquo; First';
						$config['first_tag_open'] = '<li class="prev page">';
						$config['first_tag_close'] = '</li>';
						$config['last_link'] = 'Last &raquo;';
						$config['last_tag_open'] = '<li class="next page">';
						$config['last_tag_close'] = '</li>';
						$config['next_link'] = 'Next &rarr;';
						$config['next_tag_open'] = '<li class="next page">';
						$config['next_tag_close'] = '</li>';
						$config['prev_link'] = '&larr; Previous';
						$config['prev_tag_open'] = '<li class="prev page">';
						$config['prev_tag_close'] = '</li>';
						$config['cur_tag_open'] = '<li class="active"><a href="">';
						$config['cur_tag_close'] = '</a></li>';
						$config['num_tag_open'] = '<li class="page">';
						$config['num_tag_close'] = '</li>';


						$this->pagination->initialize($config);

						$data['pagination'] 		= $this->pagination->create_links();

					}break;

					case 'cfk' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cfk', $param2);
						$page 				  = "admin/lomba/participants_cfk";

						//Load Pagination Helper
						$this->load->library('pagination');

						$config['base_url'] 		= base_url() . 'admin/news/';
						$config['total_rows'] 		= $totalNews;
						$config['per_page'] 		= 10;
						$config['full_tag_open'] 	= '<ul class="pagination">';
						$config['full_tag_close'] 	= '</ul>';
						$config['first_link'] = '&laquo; First';
						$config['first_tag_open'] = '<li class="prev page">';
						$config['first_tag_close'] = '</li>';
						$config['last_link'] = 'Last &raquo;';
						$config['last_tag_open'] = '<li class="next page">';
						$config['last_tag_close'] = '</li>';
						$config['next_link'] = 'Next &rarr;';
						$config['next_tag_open'] = '<li class="next page">';
						$config['next_tag_close'] = '</li>';
						$config['prev_link'] = '&larr; Previous';
						$config['prev_tag_open'] = '<li class="prev page">';
						$config['prev_tag_close'] = '</li>';
						$config['cur_tag_open'] = '<li class="active"><a href="">';
						$config['cur_tag_close'] = '</a></li>';
						$config['num_tag_open'] = '<li class="page">';
						$config['num_tag_close'] = '</li>';


						$this->pagination->initialize($config);

						$data['pagination'] 		= $this->pagination->create_links();
					}break;

					case 'cip' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cip', $param2);
						$page 				  = "admin/lomba/participants_cip";

						//Load Pagination Helper
						$this->load->library('pagination');

						$config['base_url'] 		= base_url() . 'admin/news/';
						$config['total_rows'] 		= $totalNews;
						$config['per_page'] 		= 10;
						$config['full_tag_open'] 	= '<ul class="pagination">';
						$config['full_tag_close'] 	= '</ul>';
						$config['first_link'] = '&laquo; First';
						$config['first_tag_open'] = '<li class="prev page">';
						$config['first_tag_close'] = '</li>';
						$config['last_link'] = 'Last &raquo;';
						$config['last_tag_open'] = '<li class="next page">';
						$config['last_tag_close'] = '</li>';
						$config['next_link'] = 'Next &rarr;';
						$config['next_tag_open'] = '<li class="next page">';
						$config['next_tag_close'] = '</li>';
						$config['prev_link'] = '&larr; Previous';
						$config['prev_tag_open'] = '<li class="prev page">';
						$config['prev_tag_close'] = '</li>';
						$config['cur_tag_open'] = '<li class="active"><a href="">';
						$config['cur_tag_close'] = '</a></li>';
						$config['num_tag_open'] = '<li class="page">';
						$config['num_tag_close'] = '</li>';


						$this->pagination->initialize($config);

						$data['pagination'] 		= $this->pagination->create_links();
					}break;

					case 'cmp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cmp', $param2);
						$page 				  = "admin/lomba/participants_cmp";

						//Load Pagination Helper
						$this->load->library('pagination');

						$config['base_url'] 		= base_url() . 'admin/news/';
						$config['total_rows'] 		= $totalNews;
						$config['per_page'] 		= 10;
						$config['full_tag_open'] 	= '<ul class="pagination">';
						$config['full_tag_close'] 	= '</ul>';
						$config['first_link'] = '&laquo; First';
						$config['first_tag_open'] = '<li class="prev page">';
						$config['first_tag_close'] = '</li>';
						$config['last_link'] = 'Last &raquo;';
						$config['last_tag_open'] = '<li class="next page">';
						$config['last_tag_close'] = '</li>';
						$config['next_link'] = 'Next &rarr;';
						$config['next_tag_open'] = '<li class="next page">';
						$config['next_tag_close'] = '</li>';
						$config['prev_link'] = '&larr; Previous';
						$config['prev_tag_open'] = '<li class="prev page">';
						$config['prev_tag_close'] = '</li>';
						$config['cur_tag_open'] = '<li class="active"><a href="">';
						$config['cur_tag_close'] = '</a></li>';
						$config['num_tag_open'] = '<li class="page">';
						$config['num_tag_close'] = '</li>';


						$this->pagination->initialize($config);

						$data['pagination'] 		= $this->pagination->create_links();
					}break;

					case 'cp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cp', $param2);
						$page 				  = "admin/lomba/participants_cp";

						//Load Pagination Helper
						$this->load->library('pagination');

						$config['base_url'] 		= base_url() . 'admin/news/';
						$config['total_rows'] 		= $totalNews;
						$config['per_page'] 		= 10;
						$config['full_tag_open'] 	= '<ul class="pagination">';
						$config['full_tag_close'] 	= '</ul>';
						$config['first_link'] = '&laquo; First';
						$config['first_tag_open'] = '<li class="prev page">';
						$config['first_tag_close'] = '</li>';
						$config['last_link'] = 'Last &raquo;';
						$config['last_tag_open'] = '<li class="next page">';
						$config['last_tag_close'] = '</li>';
						$config['next_link'] = 'Next &rarr;';
						$config['next_tag_open'] = '<li class="next page">';
						$config['next_tag_close'] = '</li>';
						$config['prev_link'] = '&larr; Previous';
						$config['prev_tag_open'] = '<li class="prev page">';
						$config['prev_tag_close'] = '</li>';
						$config['cur_tag_open'] = '<li class="active"><a href="">';
						$config['cur_tag_close'] = '</a></li>';
						$config['num_tag_open'] = '<li class="page">';
						$config['num_tag_close'] = '</li>';


						$this->pagination->initialize($config);

						$data['pagination'] 		= $this->pagination->create_links();
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

	public function konfirmasi($type='', $lomba = '', $account_id = '')
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		if($type == "pembayaran")
		{
			$this->db->set('is_paid', '1');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Konfirmasi Pembayaran');
			redirect('/admin/lomba');
		}else if($type == "abstrak")
		{
			$this->db->set('abstract_passed', '1');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Abstract Approval');
			redirect('/admin/lomba');
		}
	}

	// //Development Only - Depreceated Merged with accounts controller
	// public function new_admin()
	// {
	// 	if($_POST)
	// 	{
	// 		$this->load->model('login_model');
	// 		$this->login_model->new_admin();

	// 		redirect('/admin');
	// 	}else
	// 	{
	// 		redirect('/admin');
	// 	}
	// }

	// public function new_admin_form()
	// {
	// 	$event = mktime(0,0,0,8,1,2016);
	// 	$remaining = $event - time();
	// 	$data['countdown'] = floor($remaining / 86400);
		
	// 	$page = "admin/new_entry_admin";	
	// 	if (!file_exists (APPPATH.'views/'.$page.'.php'))
	// 		{
	// 			//Homepage does not exist
	// 			show_404();
	// 		}
			
	// 		$data['title'] = "Admin - Chemistry Fair";
			
	// 		$this->load->view('templates/header.php', $data);
	// 		$this->load->view($page, $data);
	// 		$this->load->view('templates/footer.php');
	// }
}

?>