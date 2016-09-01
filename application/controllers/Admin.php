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

			$this->load->model('admin_model');

			$accounts = $this->admin_model->getAllAccounts();

			foreach ($accounts as $key => $value)
			{
				$participantions = $this->admin_model->getParticipations($value['id']);
				$accounts[$key]['participations'] = $participantions;
			}

			$data['accounts'] = $accounts;

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

					}break;

					case 'cfk' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cfk', $param2);
						$page 				  = "admin/lomba/participants_cfk";


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


					}break;

					case 'cip' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cip', $param2);

						//Get Participants Emails
						$counter = 0;
						foreach($data['participants'] as $participant)
						{
							$emails[$counter] = $this->admin_model->getAccountInfo($participant->account_id)->email;
							$counter++;
						}

						$data['emails']		  = $emails;

						//Page Link
						$page 				  = "admin/lomba/participants_cip";


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

					}break;

					case 'cmp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cmp', $param2);
						$page 				  = "admin/lomba/participants_cmp";


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

					}break;

					case 'cp' :
					{
						$data['participants'] = $this->admin_model->getParticipants('cp', $param2);
						$page 				  = "admin/lomba/participants_cp";


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

	public function konfirmasi($type='', $lomba = '', $account_id = '', $gagal ='')
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		if($type == "pembayaran" && $gagal == '')
		{
			$this->db->set('is_paid', '1');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Konfirmasi Pembayaran');
			redirect('/admin/lomba/' . $lomba);
		}else if($type == "pembayaran" && $gagal == 'invalid')
		{
			$this->db->set('is_paid', '2');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Menolak Konfirmasi Pembayaran');
			redirect('/admin/lomba/' . $lomba);
		}else if($type == "abstrak" && $gagal == '')
		{
			$this->db->set('abstract_passed', '1');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Approval');
			redirect('/admin/lomba/' . $lomba);
		}else if($type == "abstrak" && $gagal == "gagal")
		{
			$this->db->set('abstract_passed', '2');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Rejection');
			redirect('/admin/lomba/' . $lomba);
		}else if($type == "makalah" && $gagal == '')
		{
			$this->db->set('makalah_approved', '1');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Approval');
			redirect('/admin/lomba/' . $lomba);
		}else if($type == "makalah" && $gagal == "gagal")
		{
			$this->db->set('makalah_approved', '2');
			$this->db->where('account_id', $account_id);
			$this->db->update($lomba . '_participants');
			$this->session->set_flashdata('success', 'Success in Rejection');
			redirect('/admin/lomba/' . $lomba);
		}
	}

	public function winner ($lomba, $account_id, $final = '')
	{
		if(!isset($this->session->username) && $this->session->isLogged == False)
		{
			$this->session->sess_destroy();
			redirect('/main');
		}

		switch($lomba)
		{
			case 'cp':
			{
				$this->db->set('is_paid', '4');
				$this->db->where('account_id', $account_id);
				$this->db->update($lomba . '_participants');
				$this->session->set_flashdata('success', 'Success in Winner Selection');

				//Make Everyone Else A Loser!
				foreach($this->db->get_where($lomba . '_participants', array('is_paid' => '1'))->result() as $row)
				{
					$this->db->set('is_paid', '3');
					$this->db->where('id', $row->id);
					$this->db->update($lomba . '_participants');
				}
				redirect('/admin/lomba/' . $lomba);
			}break;

			case 'cmp':
			{
				$this->db->set('is_paid', '4');
				$this->db->where('account_id', $account_id);
				$this->db->update($lomba . '_participants');
				$this->session->set_flashdata('success', 'Success in Winner Selection');

				//Make Everyone Else A Loser!
				foreach($this->db->get_where($lomba . '_participants', array('is_paid' => '1'))->result() as $row)
				{
					$this->db->set('is_paid', '3');
					$this->db->where('id', $row->id);
					$this->db->update($lomba . '_participants');
				}

				redirect('/admin/lomba/' . $lomba);
			}break;

			case 'cip':
			{
				$this->db->set('is_paid', '4');
				$this->db->where('account_id', $account_id);
				$this->db->update($lomba . '_participants');
				$this->session->set_flashdata('success', 'Success in Winner Selection');

				//Make Everyone Else A Loser!
				foreach($this->db->get_where($lomba . '_participants', array('is_paid' => '1'))->result() as $row)
				{
					$this->db->set('is_paid', '3');
					$this->db->where('id', $row->id);
					$this->db->update($lomba . '_participants');
				}

				redirect('/admin/lomba/' . $lomba);
			}break;

			
		}
	}
}

?>