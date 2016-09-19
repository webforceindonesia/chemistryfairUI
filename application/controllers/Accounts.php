<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('titlecase');
        $this->load->model('accounts_model');
    }

	public function index()
	{
        if (isset($_SESSION['user_id']))
        {
            $this->dashboard();
        }
        else
        {
            $this->login();
        }
	}

    public function register()
    {
        $data['title'] = titlecase('Registrasi Akun Chemistry Fair 2016');
        $data['disable_user_bar'] = TRUE;
        $data['import_captcha'] = TRUE;
        
        $this->load->view('templates/header.php', $data);

        // Prepare the rules of the form
        $this->form_validation->set_rules(  
            'email', 'Email', 
            'required|valid_email|is_unique[accounts.email]', 
            array(
                'required'      => 'Form ini harus diisi!',
                'valid_email'   => 'Email anda tidak valid.',
                'is_unique'     => 'Email anda sudah terdaftar dalam data kami. Apakah anda ingin <a href="'
                                    . site_url() . '/akun/login">Login</a>?'
            )
        );
        $this->form_validation->set_rules(  
            'emailconf', 'Konfirmasi Email', 
            'required|matches[email]', 
            array(
                'required'      => 'Form ini harus diisi!',
                'matches'       => 'Mohon cek kembali email anda.'
            )
        );
        $this->form_validation->set_rules(  
            'password', 'Password', 
            'required|min_length[8]', 
            array(
                'required'      => 'Form ini harus diisi!',
                'min_length'    => 'Password anda terlalu pendek. Minimal 8 karakter.'
            )
        );
        $this->form_validation->set_rules(  
            'passconf', 'Konfirmasi Password', 
            'required|matches[password]', 
            array(
                'required'      => 'Form ini harus diisi!',
                'min_length'    => 'Password anda tidak sama dengan kolom password diatas.'
            )
        );
        $this->form_validation->set_rules(  
            'fullname', 'Nama Lengkap', 
            'required|max_length[128]|callback_is_name_valid', 
            array(
                'required'      => 'Form ini harus diisi!',
                'callback_is_name_valid'    => 'Nama hanya dapat berisi karakter alphabet atau spasi.'
            )
        );
        $this->form_validation->set_rules(  
            'phone_number', 'Nomor Telepon', 
            'required|max_length[24]|numeric', 
            array(
                'required'      => 'Form ini harus diisi!',
                'numeric'       => 'Mohon masukkan hanya angka.'
            )
        );
        $this->form_validation->set_rules(  
            'email_recovery', 'Email Cadangan', 
            'required|max_length[128]|valid_email', 
            array(
                'required'      => 'Form ini harus diisi!',
                'valid_email'   => 'Email anda tidak valid.',
            )
        );

        /*
        $this->form_validation->set_rules(  
            'security_question', 'Pertanyaan Keamanan', 
            'required|max_length[128]', 
            array(
                'required'      => 'Form ini harus diisi!',
            )
        );
        $this->form_validation->set_rules(  
            'security_answer', 'Jawaban Keamanan', 
            'required|max_length[128]', 
            array(
                'required'      => 'Form ini harus diisi!',
            )
        );
        */

        // Get the captcha results
        $show_captcha_error = isset($_POST['submit']) ? !$this->is_captcha_valid($this->input->post('g-recaptcha-response')) : false;

        // If the user is already logged in an account, send an error and tells them to logout first
        if (isset($_SESSION['user_id']))
        {
            $this->load->view('error.php', array(
                'error_reason' => 'Silahkan log out terlebih dahulu untuk melakukan registrasi account baru',  
                'error_redirection' => ''));
        }

        // If the form is validated, add to the DB and show the success page, otherwise show the form again with errors
        else if ($this->form_validation->run() === TRUE && !$show_captcha_error)
        {
            // Register this new account to the DB
            $this->accounts_model->register(
                $this->input->post('email'),
                $this->input->post('password'),
                $this->input->post('fullname'),
                $this->input->post('phone_number'),
                $this->input->post('email_recovery'),
                '',
                ''
            );
            
            $data['success_title'] = 'Registrasi Hampir Selesai';
            $data['success_message'] = 'Kami telah mengirimkan email konfirmasi kepada anda. 
                                        Mohon membukanya dan klik link yang dicantumkan di dalam email anda.';
            $data['success_button_label'] = 'Kembali ke Beranda';
            $data['success_button_link'] = site_url();
            $this->load->view('templates/success.php', $data);

            // Send a verification email to the new user
            $this->accounts_model->send_verification_email($this->db->insert_id());
        }

        // Else, show the form
        else
        { 
            $this->load->view('accounts/register.php', array('show_captcha_error' => $show_captcha_error));
        }
        $this->load->view('templates/footer.php');
    }

    public function login()
    {
        $data['title'] = titlecase('Login');

        // Prepare the rules of the form
        $this->form_validation->set_rules(  
            'email', 'Email', 
            'required|valid_email', 
            array(
                'required'      => 'Form ini harus diisi!',
                'valid_email'   => 'Email anda tidak valid.',
            )
        );
        $this->form_validation->set_rules(  
            'password', 'Password', 
            'required', 
            array(
                'required'      => 'Form ini harus diisi!',
            )
        );

        // If the user is already logged in an account, send an error and tells them to logout first
        if (isset($_SESSION['user_id']))
        {
            $this->dashboard();
        }

        // If the form is validated, set the session ID
        else if ($this->form_validation->run() === TRUE)
        {
            $account_id = $this->accounts_model->login($this->input->post('email'), $this->input->post('password'));
            if ($account_id !== 0)
            {
                $user_data = $this->accounts_model->get_details($account_id);

                if ($user_data->is_admin != 1)
                {
                    $this->session->set_userdata('user_id', $account_id);
                    $this->session->set_userdata('user_email', $user_data->email);
                    $this->session->set_userdata('user_fullname', $user_data->fullname);
                    $this->session->set_userdata('user_participations', $this->accounts_model->get_account_participation($this->session->user_id));

                    $this->load->view('templates/header.php', $data);
                    
                    $data['success_title'] = 'Selamat datang!';
                    $data['success_message'] = $user_data->fullname . ', Anda telah berhasil login!';
                    $data['success_button_label'] = 'Beranda';
                    $data['success_button_link'] = site_url();
                    $this->load->view('templates/success.php', $data);
            	}

                else
            	{
            		$this->session->username = $account_id;
            		$this->session->isLogged = True;
            		redirect('/admin');
            	}
            }

            else 
            {
                $this->load->view('templates/header.php', $data);
                $this->load->view('accounts/login.php', array('show_invalid_credentials_error' => TRUE));
            }
        }

        // Else, show the form
        else
        { 
            $this->load->view('templates/header.php', $data);
            $this->load->view('accounts/login.php', array('show_invalid_credentials_error' => FALSE));
        }
        $this->load->view('templates/footer.php');
    }

    /**
     *  Deletes the current user session
     *  @return void
     *  @author FURIBAITO
     */
    public function logout()
    {
        if (isset($_SESSION['user_id']))
        {
            unset($_SESSION['user_id']);
        }
        redirect('', 'location');
    }

    /**
     *  Open the form to send a password reset confirmation email
     *  @param string $secret_code The code to confirmation the email
     *  @return void
     *  @author FURIBAITO
     */
    public function change_password($secret_code = '')
    {
        $data['title'] = titlecase('Ganti Password');
        $data['import_captcha'] = TRUE;

        $this->load->view('templates/header.php', $data);

        // If the code is submitted, check it if it's correct
        if (!empty($secret_code))
        {
            $splitted_code = explode('_', $secret_code);
            if($this->accounts_model->check_password_change_code($splitted_code[0], $splitted_code[1]))
            {
                // Prepare the form validation rules
                $this->form_validation->set_rules(  
                    'password', 'Password Baru', 
                    'required|min_length[8]', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                        'min_length'    => 'Password anda terlalu pendek. Minimal 8 karakter.'
                    )
                );

                $this->form_validation->set_rules(  
                    'passconf', 'Konfirmasi Password Baru', 
                    'required|matches[password]', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                        'min_length'    => 'Password anda tidak sama dengan kolom password diatas.',
                        'matches'       => 'Password anda tidak sama dengan kolom password diatas.'
                    )
                );

                // If the form validated, change the DB otherwise show the form
                if ($this->form_validation->run() === TRUE)
                {
                    $this->accounts_model->confirm_password_change($splitted_code[0], $this->input->post('password'));

                    $data['success_title'] = 'Password anda berhasil diganti!';
                    $data['success_message'] = 'Silahkan login dengan password baru anda.';
                    $data['success_button_label'] = 'Beranda';
                    $data['success_button_link'] = site_url();
                    $this->load->view('templates/success.php', $data);
                }
                else 
                {
                    $this->load->view('accounts/change_password.php', array('secret_code' => $secret_code));
                }
            }

            else 
            {
                $data['error_title'] = 'Proses Ubah Password Gagal';
                $data['error_message'] = 'Kami tidak dapat memproses kode reset password yang anda berikan. Link reset password yang anda 
                                            akses mungkin sudah tidak berlaku lagi.';
                $data['error_button_label'] = 'Beranda';
                $data['error_button_link'] = site_url();
                $this->load->view('templates/error.php', $data);
            }
        }

        // If the user is already logged in an account, just send the email imidiately
        else if (isset($_SESSION['user_id']))
        {
            $this->accounts_model->send_password_change_email($this->accounts_model->get_details($_SESSION['user_id'])->email);

            $data['success_title'] = 'Link password reset telah dikirimkan!';
            $data['success_message'] = 'Email berisi link untuk mengganti password anda telah dikirimkan ke ' . $this->accounts_model->get_details($_SESSION['user_id'])->email;
            $data['success_button_label'] = 'Beranda';
            $data['success_button_link'] = site_url();
            $this->load->view('templates/success.php', $data);
        }

        else 
        {
            // Prepare the rules of the form
            $this->form_validation->set_rules(  
                'email', 'Email Anda', 
                'required|valid_email', 
                array(
                    'required'      => 'Form ini harus diisi!',
                    'valid_email'   => 'Email anda tidak valid.'
                )
            );

            // Get the captcha results
            $show_captcha_error = isset($_POST['submit']) ? !$this->is_captcha_valid($this->input->post('g-recaptcha-response')) : false;
            
            // If the form is validated, try to send the reset password email
            if ($this->form_validation->run() === TRUE && $show_captcha_error === FALSE)
            {
                $this->accounts_model->send_password_change_email($this->input->post('email'));
                $data['success_title'] = 'Link password akan segera dikirimkan.';
                $data['success_message'] = 'Jika email yang anda berikan ditemukan dalam database kami, kami akan mengirimkan email berisi
                                            link untuk mengganti password anda ke alamat email yang anda gunakan untuk mendaftar di Chemistry Fair 2016. 
                                            Kami juga akan mengirimkan email ini ke email cadangan anda yang anda masukkan saat mendaftar. Terima kasih!';
                $data['success_button_label'] = 'Beranda';
                $data['success_button_link'] = site_url();
                $this->load->view('templates/success.php', $data);
            }

            // Else, show the form
            else
            { 
                $this->load->view('accounts/change_password_emailto.php', array('show_captcha_error' => $show_captcha_error));
            }
        }
        $this->load->view('templates/footer.php');
    }

    /**
     *  Shows the user dashboard
     *  @param string $show Page to load (empty for index)
     *  @return bool TRUE on success, FALSE otherwise
     *  @author FURIBAITO
     */
    public function dashboard($action = 'index', $param = '')
    {
        // If the user hasn't logon yet, show the login page
        if (!isset($_SESSION['user_id']))
        {
            $this->login();
            exit();
        }
        
        // Set the title and load the header
        $data['title'] = titlecase('Dashboard');
        $data['import_captcha'] = TRUE;
        $this->load->view('templates/header.php', $data);

        // Load the dashboard navigation template
        $this->load->view('accounts/dashboard_nav.php');

        $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

        $data['user_verified'] = $user_data->is_verified;

        if ($action == 'index' || $user_data->is_verified == FALSE)
        {
            $data['user_fullname'] = $user_data->fullname;
            $data['user_email'] = $user_data->email;
            $data['user_phone_number'] = $user_data->phone_number;
            $data['user_email_recovery'] = $user_data->email_recovery;
            $data['show_captcha_error'] = FALSE;

            if ($data['user_verified'] == FALSE)
            {
                if (isset($_POST['submit']))
                {
                    $show_captcha_error = !$this->is_captcha_valid($this->input->post('g-recaptcha-response'));
                    $data['show_captcha_error'] = $show_captcha_error;
                    if (!$show_captcha_error)
                    {
                        // Send a verification email to the requesting user
                        $this->accounts_model->send_verification_email($_SESSION['user_id']);
                    }
                }
            }

            $this->load->view('accounts/dashboard_profile.php', $data);
        }

        else if ($action == 'edit_account')
        {
            $this->form_validation->set_rules(  
            'fullname', 'Nama Lengkap', 
            'required|max_length[128]|callback_is_name_valid', 
            array(
                'required'      => 'Form ini harus diisi!',
                'callback_is_name_valid'    => 'Nama hanya dapat berisi karakter alphabet atau spasi.'
                )
            );
            $this->form_validation->set_rules(  
                'phone_number', 'Nomor Telepon', 
                'required|max_length[24]|numeric', 
                array(
                    'required'      => 'Form ini harus diisi!',
                    'numeric'       => 'Mohon masukkan hanya angka.'
                )
            );
            $this->form_validation->set_rules(  
                'email_recovery', 'Email Cadangan', 
                'required|max_length[128]|valid_email', 
                array(
                    'required'      => 'Form ini harus diisi!',
                    'valid_email'   => 'Email anda tidak valid.',
                )
            );

            // If the form is validated, update DB otherwise show the form again with errors
            if ($this->form_validation->run() === TRUE)
            {
                // Change the account details in the DB
                $this->accounts_model->change_details($_SESSION['user_id'], 'fullname', $this->input->post('fullname'));
                $this->accounts_model->change_details($_SESSION['user_id'], 'phone_number', $this->input->post('phone_number'));
                $this->accounts_model->change_details($_SESSION['user_id'], 'email_recovery', $this->input->post('email_recovery'));

                // Redirect to the dashboard index
                redirect('akun/dashboard', 'location');
            }

            // Else, show the form
            else
            {
                $data['user_fullname'] = $user_data->fullname;
                $data['user_phone_number'] = $user_data->phone_number;
                $data['user_email_recovery'] = $user_data->email_recovery;
                
                $this->load->view('accounts/edit_account.php', $data);
            }
        }
        else if ($action == 'cip')
        {
            if (array_key_exists('cip', $this->session->userdata('user_participations')))
            {
                $this->load->model('cip_participants_model');
                $user_participant_data = $this->cip_participants_model->get_details($this->session->userdata('user_id'));
                $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

        		$data['user_is_participant']			= TRUE;
  	        	$data['user_submitted_abstract'] 		= $user_participant_data->abstract_link != NULL ? TRUE : FALSE;
	        	$data['user_passed_abstract']			= $user_participant_data->abstract_passed;
                $data['user_submitted_makalah']         = $user_participant_data->makalah_link != NULL ? TRUE : FALSE;
                $data['user_passed_makalah']            = $user_participant_data->makalah_approved;
	        	$data['user_submitted_payment_proof']	= $user_participant_data->payment_proof_link != NULL ? TRUE : FALSE;
	        	$data['user_payment_verified']			= $user_participant_data->is_paid;
                $data['user_email']                     = $this->session->userdata('user_email');
                
                $cip_data = $this->cip_participants_model->get_details($this->session->userdata('user_id'));
                $data['user_category']              = $cip_data->type;
                $data['user_institution_name']      = $cip_data->institution_name;
                $data['user_fullname_member1']      = $cip_data->fullname_member1;
                $data['user_id_number_member1']     = $cip_data->id_number_member1;
                $data['user_identity_member1_link'] = $cip_data->identity_member1_link;
                $data['user_passphoto_link1']       = $cip_data->passphoto_link1;
                $data['user_fullname_member2']      = $cip_data->fullname_member2;
                $data['user_id_number_member2']     = $cip_data->id_number_member2;
                $data['user_identity_member2_link'] = $cip_data->identity_member2_link;
                $data['user_passphoto_link2']       = $cip_data->passphoto_link2;
                $data['user_fullname_member3']      = $cip_data->fullname_member3;
                $data['user_id_number_member3']     = $cip_data->id_number_member3;
                $data['user_identity_member3_link'] = $cip_data->identity_member3_link;
                $data['user_passphoto_link3']       = $cip_data->passphoto_link3;
                $data['user_province_id']          = $cip_data->province_id;
                $data['user_lodging_days']          = $cip_data->lodging_days;
                $data['user_need_transport']        = $cip_data->need_transport;
                $data['user_teacher_name']          = $cip_data->teacher_name;
                $data['user_teacher_phone']         = $cip_data->teacher_phone;
                $data['user_teacher_email']         = $cip_data->teacher_email;

	        	if (empty($data['user_identity_member1_link'])
                || empty($data['user_identity_member2_link'])
                || empty($data['user_identity_member3_link'])
                || empty($data['user_passphoto_link1'])
                || empty($data['user_passphoto_link2'])
                || empty($data['user_passphoto_link3']))
	        	{
	        		$data['user_details_complete'] = FALSE;
	        	}
                
                else
	        	{
	        		$data['user_details_complete'] = TRUE;
	        	}
        	}
            
            else
        	{
        		$data['user_is_participant'] = FALSE;
        	}

            $this->load->view('accounts/dashboard_cip.php', $data);
            
            if ($param == 'upload')
            {
            	$config['upload_path']          = 'uploads/cip/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cip/" . $this->session->user_id;

                if (!file_exists ($link))
				{
					if(!mkdir($link, 0777, TRUE))
					{
						$this->session->set_flashdata('make_failed', 'Error Membuat Folder');
					}
				}

                //Check File Berkas Upload
                if(isset($_FILES['file_berkas']))
                {
                	$config['allowed_types']        = 'zip';
                	$config['file_name']			= 'berkas.zip';
				    $this->upload->initialize($config);

	                if ( ! $this->upload->do_upload('file_berkas'))
	                {
	                        $error = array('error' => $this->upload->display_errors());
	                        $error_data = $error['error'];
	                        $this->session->set_flashdata('upload_failed', $error_data);

	                        redirect('akun/dashboard/cip');
	                }
	                else
	                {
	                		//Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
	                		$this->db->select('cip_participants');
	                		$data = array('abstract_link' => $link . "/berkas.zip");
	                		$this->db->update('cip_participants', $data);
	                        $this->session->set_flashdata('upload', 'Upload File Berkas Sukses!');
	                        redirect('akun/dashboard/cip');
	                }
	            }

	            //Check File Bukti Trf Upload
				if(isset($_FILES['file_bukti']))
                {
                	$config['allowed_types']        = 'jpg';
                	$config['file_name']			= 'bukti_trf.jpg';
                	$config['overwrite']			= TRUE;
				    $this->upload->initialize($config);

	                if ( ! $this->upload->do_upload('file_bukti') )
	                {
	                        $error = array('error' => $this->upload->display_errors());

	                        $this->session->set_flashdata('upload_failed', $error);

	                        redirect('akun/dashboard/cip');
	                }
	                else
	                {

	                		//Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
	                		$this->db->select('cip_participants');
	                		$data = array('payment_proof_link' => $link . "/bukti_trf.JPG");
	                		$this->db->update('cip_participants', $data);
	                        $this->session->set_flashdata('upload', 'Upload Bukti Transfer Sukses!');
	                        redirect('akun/dashboard/cip');
	                }
	            }
            }

            if ($param == 'makalah')
            {
                $config['upload_path']          = 'uploads/cip/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cip/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Berkas Upload
                if(isset($_FILES['file_berkas']))
                {
                    $config['allowed_types']        = 'zip';
                    $config['file_name']            = 'berkas_makalah.zip';
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file_berkas'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $error_data = $error['error'];
                            $this->session->set_flashdata('upload_failed', $error_data);

                            redirect('akun/dashboard/cip');
                    }
                    else
                    {
                            //Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $this->db->select('cip_participants');
                            $data = array('makalah_link' => $link . "/berkas_makalah.zip");
                            $this->db->update('cip_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload File Berkas Sukses!');
                            redirect('akun/dashboard/cip');
                    }
                }
            }else if($param == 'email_penginapan')
            {
                if($this->input->post())
                {
                   //Send Email
                   $this->load->model('email_model');
                   $this->email_model->email_transportasi();

                   //Change
                   $this->db->where('account_id', $this->session->userdata('user_id'));
                   $this->db->select('cip_participants');
                   $this->db->update('cip_participants', array('abstract_passed' => 3));
                   redirect('akun/dashboard/cip');
                }else
                {
                   redirect('akun/dashboard/cip');
                }
            }

        }else if($action == 'cp')
        {
            if (array_key_exists('cp', $this->session->userdata('user_participations')))
            {
                $this->load->model('cp_participants_model');
                $user_participant_data = $this->cp_participants_model->get_details($this->session->userdata('user_id'));
                $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

                $data['user_is_participant']            = TRUE;
                $data['user_submitted_payment_proof']   = $user_participant_data->payment_proof_link != NULL ? TRUE : FALSE;
                $data['user_payment_verified']          = $user_participant_data->is_paid;
                $data['user_email']                     = $this->session->userdata('user_email');
                
                $cp_data = $this->cp_participants_model->get_details($this->session->userdata('user_id'));
                $data['mode']                       = 'edit';
                $data['user_institution_name']      = $cp_data->institution_name;
                $data['user_fullname']              = $cp_data->fullname;
                $data['user_id_number']             = $cp_data->id_number;
                $data['user_identity_link']         = $cp_data->identity_link;
                $data['user_province_id']           = $cp_data->province_id;
                $data['user_instagram_link']        = $cp_data->instagram_photo_link;
                $data['address']                    = $cp_data->address;
                $data['email']                      = $cp_data->email;
                $data['phone']                      = $cp_data->phone;

                if (empty($data['user_identity_link']))
                {
                    $data['user_details_complete'] = FALSE;
                }
                
                else
                {
                    $data['user_details_complete'] = TRUE;
                }
            }
            
            else
            {
                $data['user_is_participant'] = FALSE;
            }

            $this->load->view('accounts/dashboard_cp.php', $data);
            
            if ($param == 'upload')
            {
                $config['upload_path']          = 'uploads/cp/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cp/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES['file_bukti']))
                {
                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'bukti_trf.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file_bukti') )
                    {
                            $error = array('error' => $this->upload->display_errors());

                            $this->session->set_flashdata('upload_failed', $error);

                            redirect('akun/dashboard/cp');
                    }
                    else
                    {
                            //Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $this->db->select('cp_participants');
                            $data = array('payment_proof_link' => $link . "/bukti_trf.jpg");
                            $this->db->update('cp_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload Bukti Transfer Sukses!');
                            redirect('akun/dashboard/cp');
                    }
                }
            }else if($param == 'insta')
            {
                $config['upload_path']          = 'uploads/cp/karya/' . $this->session->user_id;
                $config['max_size']             = 30000;

                $this->load->library('upload', $config);

                $link = "uploads/cp/karya/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES))
                {
                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'hasil_karya.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('insta_file') )
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('upload_failed', $error);
                        redirect('akun/dashboard/cp');
                    }
                    else
                    {
                        $photo = $link . '/' . $config['file_name'];
                    }

                    $config['allowed_types']        = 'pdf';
                    $config['file_name']            = 'description.pdf';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('des') )
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('upload_failed', $error);
                        redirect('akun/dashboard/cp');
                    }
                    else
                    {
                        //Update DB   
                        $this->db->where('account_id', $this->session->userdata('user_id'));
                        $this->db->update('cp_participants', array('photo_description' => $link . '/' . $config['file_name']));
                        $this->session->set_flashdata('upload', 'Upload Karya Sukses & Deskripsi Karya Sukses Di Simpan');
                        $desc = $link . '/' . $config['file_name'];

                        //Update DB   
                        $this->db->where('account_id', $this->session->userdata('user_id'));
                        $this->db->update('cp_participants', array('instagram_photo_link' => $photo));

                        $data = array (

                            'photo' => $photo,
                            'desc'  => $desc

                            );

                        //Email To The Ticketing
                        // $this->load->model('email_model');
                        // $this->email_model->cp_email($data);

                        redirect('akun/dashboard/cp');
                    }

                }
            }
        }else if($action == 'cmp')
        {
            if (array_key_exists('cmp', $this->session->userdata('user_participations')))
            {
                $this->load->model('cmp_participants_model');
                $user_participant_data = $this->cmp_participants_model->get_details($this->session->userdata('user_id'));
                $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

                $data['user_is_participant']            = TRUE;
                $data['user_submitted_payment_proof']   = $user_participant_data->payment_proof_link != NULL ? TRUE : FALSE;
                $data['user_payment_verified']          = $user_participant_data->is_paid;
                $data['user_email']                     = $this->session->userdata('user_email');
                
                $cp_data = $this->cmp_participants_model->get_details($this->session->userdata('user_id'));
                $data['mode']                       = 'edit';
                $data['user_institution_name']      = $cp_data->institution_name;
                $data['user_fullname']              = $cp_data->fullname;
                $data['user_id_number']             = $cp_data->id_number;
                $data['anggotas']                   = explode('#', $cp_data->anggota);
                $data['user_identity_link']         = $cp_data->identity_link;
                $data['user_province_id']           = $cp_data->province_id;
                $data['user_youtube_link']          = $cp_data->youtube_video_link;
                $data['berkas']                     = $cp_data->makalah_approved;
                $data['user_poster_link']           = $cp_data->poster_link;
                $data['user_synopsys_link']         = $cp_data->synopsys_link;
                $data['address']                    = $cp_data->address;
                $data['email']                      = $cp_data->email;
                $data['phone']                      = $cp_data->phone;

                if (empty($data['user_identity_link']))
                {
                    $data['user_details_complete'] = FALSE;
                }
                
                else
                {
                    $data['user_details_complete'] = TRUE;
                }
            }
            
            else
            {
                $data['user_is_participant'] = FALSE;
            }

            $this->load->view('accounts/dashboard_cmp.php', $data);
            
            if ($param == 'upload')
            {
                $config['upload_path']          = 'uploads/cmp/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cmp/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES['file_bukti']))
                {
                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'bukti_trf.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file_bukti') )
                    {
                            $error = array('error' => $this->upload->display_errors());

                            $this->session->set_flashdata('upload_failed', $error);

                            redirect('akun/dashboard/cmp');
                    }
                    else
                    {
                            //Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $this->db->select('cmp_participants');
                            $data = array('payment_proof_link' => $link . "/bukti_trf.jpg");
                            $this->db->update('cmp_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload Bukti Transfer Sukses!');
                            redirect('akun/dashboard/cmp');
                    }
                }
            }else if($param == 'youtube')
            {
                if($this->input->post('youtube'))
                {
                    $this->db->where('account_id', $this->session->userdata('user_id'));
                    $this->db->update('cmp_participants', array('youtube_video_link' => $this->input->post('youtube')));
                            $this->session->set_flashdata('upload', 'Link Youtube Sukses Di Simpan');
                            redirect('akun/dashboard/cmp');
                }else
                {
                    $this->session->set_flashdata('upload_failed', 'Link Tidak Valid');

                    redirect('akun/dashboard/cmp');
                }
            }else if($param == 'berkas')
            {
                $config['upload_path']          = 'uploads/cmp/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cmp/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES))
                {
                    $config['allowed_types']        = 'pdf';
                    $config['file_name']            = 'synopsys.pdf';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('synopsys') )
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('upload_failed', $error);
                            redirect('akun/dashboard/cmp');
                    }
                    else
                    {
                            //Write to db
                            $synopsys = $link . "/bukti_trf.jpg";
                    }

                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'poster.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('poster') )
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('upload_failed', $error);
                            redirect('akun/dashboard/cmp');
                    }
                    else
                    {
                            //Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $this->db->select('cmp_participants');
                            $data = array(
                                'poster_link'      => $link . "/bukti_trf.jpg",
                                'synopsys_link'    => $synopsys
                                );
                            $this->db->update('cmp_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload Berkas Sukses!');
                            redirect('akun/dashboard/cmp');
                    }
                }
            }
        }else if($action == 'cc')
        {
            if (array_key_exists('cc', $this->session->userdata('user_participations')))
            {
                $this->load->model('cc_participants_model');
                $user_participant_data = $this->cc_participants_model->get_details($this->session->userdata('user_id'));
                $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

                $data['user_is_participant']            = TRUE;
                $data['user_submitted_payment_proof']   = $user_participant_data->payment_proof_link != NULL ? TRUE : FALSE;
                $data['user_payment_verified']          = $user_participant_data->is_paid;
                $data['user_passed']                    = $user_participant_data->abstract_passed;
                $data['user_email']                     = $this->session->userdata('user_email');
                
                $cmp_data = $this->cc_participants_model->get_details($this->session->userdata('user_id'));
                $data['mode']                       = 'edit';
                $data['institution_name']           = $cmp_data->institution_name;
                $data['user_fullname_ketua']        = $cmp_data->fullname_member1;
                $data['user_fullname_anggota']      = $cmp_data->fullname_member2;
                $data['user1_identity_link']        = $cmp_data->identity_member1_link;
                $data['user2_identity_link']        = $cmp_data->identity_member2_link;
                $data['user_province_id']           = $cmp_data->province_id;
                $data['address']                    = $cmp_data->address;
                $data['phone']                      = $cmp_data->phone;
                $data['email']                      = $cmp_data->email;
                $data['teacher_name']               = $cmp_data->teacher_name;
                $data['teacher_phone']              = $cmp_data->teacher_phone_number;
                $data['teacher_email']              = $cmp_data->teacher_email;

                if (empty($data['user1_identity_link']) && empty($data['user2_identity_link']))
                {
                    $data['user_details_complete'] = FALSE;
                }
                
                else
                {
                    $data['user_details_complete'] = TRUE;
                }
            }
            
            else
            {
                $data['user_is_participant'] = FALSE;
            }

            $this->load->view('accounts/dashboard_cc.php', $data);
            
            if ($param == 'upload')
            {
                $config['upload_path']          = 'uploads/cc/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cc/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES['file_bukti']))
                {
                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'bukti_trf.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file_bukti') )
                    {
                            $error = array('error' => $this->upload->display_errors());

                            $this->session->set_flashdata('upload_failed', $error);

                            redirect('akun/dashboard/cc');
                    }
                    else
                    {
                            //Write to db
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $this->db->select('cc_participants');
                            $data = array('payment_proof_link' => $link . "/bukti_trf.jpg");
                            $this->db->update('cc_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload Bukti Transfer Sukses!');
                            redirect('akun/dashboard/cc');
                    }
                }

            }else if($param == 'email_penginapan')
            {
                if($this->input->post())
                {
                   //Send Email
                   $this->load->model('email_model');
                   $this->email_model->email_transportasi();

                   //Change
                   $this->db->where('account_id', $this->session->userdata('user_id'));
                   $this->db->select('cc_participants');
                   $this->db->update('cc_participants', array('abstract_passed' => 3));
                   redirect('akun/dashboard/cc');
                }else
                {
                   redirect('akun/dashboard/cc');
                }
            }
        }else if ($action == 'cfk')
        {
            if (array_key_exists('cfk', $this->session->userdata('user_participations')))
            {
                $this->load->model('cfk_participants_model');
                $user_participant_data = $this->cfk_participants_model->get_details($this->session->userdata('user_id'));
                $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

                $data['user_is_participant']            = TRUE;
                $data['user_submitted_payment_proof']   = $user_participant_data->payment_proof_link != NULL ? TRUE : FALSE;
                $data['user_payment_verified']            = $user_participant_data->is_paid;
                $data['user_email']                     = $this->session->userdata('user_email');
                
                $cfk_data = $this->cfk_participants_model->get_details($this->session->userdata('user_id'));
                $data['user_institution_name']      = $cfk_data->institution_name;
                $data['user_fullname']              = $cfk_data->fullname;
                $data['user_fullname_parent']       = $cfk_data->fullname_parent;
                $data['user_age']                   = $cfk_data->age;
                $data['user_phone']                 = $cfk_data->phone;
                $data['user_competition']           = $cfk_data->competition;
                $data['user_is_tk']                 = ($cfk_data->is_tk == 1)? 'TK' : 'SD';
            }
            
            else
            {
                $data['user_is_participant'] = FALSE;
            }

            $this->load->view('accounts/dashboard_cfk.php', $data);
            
            if ($param == 'upload')
            {
                $config['upload_path']          = 'uploads/cfk/' . $this->session->user_id;
                $config['max_size']             = 5000;

                $this->load->library('upload', $config);

                $link = "uploads/cfk/" . $this->session->user_id;

                if (!file_exists ($link))
                {
                    if(!mkdir($link, 0777, TRUE))
                    {
                        $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                    }
                }

                //Check File Bukti Trf Upload
                if(isset($_FILES['file_bukti']))
                {
                    $config['allowed_types']        = 'jpg';
                    $config['file_name']            = 'bukti_trf.jpg';
                    $config['overwrite']            = TRUE;
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file_bukti') )
                    {
                            $error = array('error' => $this->upload->display_errors());

                            $this->session->set_flashdata('upload_failed', $error);

                            redirect('akun/dashboard/cfk');
                    }
                    else
                    {
                            //Write to db
                            $this->db->select('cfk_participants');
                            $this->db->where('account_id', $this->session->userdata('user_id'));
                            $data = array('payment_proof_link' => $link . "/bukti_trf.jpg");
                            $this->db->update('cfk_participants', $data);
                            $this->session->set_flashdata('upload', 'Upload Bukti Transfer Sukses!');
                            redirect('akun/dashboard/cfk');
                    }
                }
            }
        }
        
        $this->load->view('templates/footer.php');
    }

    // Splits the verification code and checks if it's correct
    public function email_validation($validation_code)
    {
        $data['title'] = titlecase('Validasi Email');
        
        $separated_data = explode('_', $validation_code, 2);
        if ($this->accounts_model->verify_account($separated_data[0], $separated_data[1]))
        {
            $data['title'] = titlecase('Akun Terverifikasi');
            $data['disable_user_bar'] = TRUE;
            $this->load->view('templates/header.php', $data);

            $data['success_title'] = 'Akun Anda Terverifikasi!';
            $data['success_message'] = 'Selamat! Anda sudah bisa login dengan email dan password yang anda 
                                        tulis saat mendaftar. <br/>Setelah login, anda bisa mengunjungi dashboard 
                                        peserta untuk berpartisipasi dalam berbagai acara dan lomba menarik
                                        dalam Chemistry Fair 2016!';
            $data['success_button_label'] = 'Login Sekarang';
            $data['success_button_link'] = site_url() . 'akun/login';
            $this->load->view('templates/success.php', $data);
            $this->load->view('templates/footer.php');
        }
        else
        {
            $data['title'] = titlecase('Error');
            $this->load->view('templates/header.php', $data);

            $data['error_title'] = 'Kode Validasi Tidak Diketahui';
            $data['error_message'] = 'Kami tidak dapat memproses kode validasi yang anda masukkan.<br>
                                            Mungkin akun anda sudah tervalidasi. Jika demikian, silahkan <a href="' . site_url() . 'akun/login">login</a>.<br>
                                            Pastikan email yang anda terima adalah dari kami.';
            $data['error_button_label'] = 'Beranda';
            $data['error_button_link'] = site_url();
            $this->load->view('templates/error.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    // Check if the inputted name is correct (Alphabet or spaces only)
    function is_name_valid($input)
    {
        return (preg_match("/^([-a-z_ ])+$/i", $input)) ? TRUE : FALSE;
    } 

    /**
     *  Checks if the captcha response successful
     *  @param string $response
     *  @return bool TRUE on success, FALSE otherwise
     *  @author FURIBAITO
     */
    function is_captcha_valid($response)
    {
        if (empty($response))
        {
            return false;
        }

        $passed_data = array(
            'secret'    =>  '6Lcr_SUTAAAAAFJ7UFpI-wP25i4NMDrBEFxvXU5S',
            'response'  =>  $response,
            'remoteip'  =>  $_SERVER['REMOTE_ADDR']
        );

        $stream_options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($passed_data) 
            )
        );

        return json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create($stream_options)))->success;
    }

    //Pendaftaran
    public function daftar_lomba ($param1 = '')
    {
        switch ($param1)
        {
            case 'cip':
            {
                $page = 'accounts/form_cip.php';
            }break;

            default :
            {
                redirect('/main');
            }
        }

        $this->load->view('templates/header.php');
        $this->load->view($page);
        $this->load->view('templates/footer.php');
    }

    //Daftar Lomba
    public function register_lomba($param1 = '', $param2 = '')
    {

        switch ($param1)
        {
            case 'cip' :
            {
                $flag = 0;

                //File Handling
                if($_FILES['identity_member1_link'] && $_FILES['identity_member2_link'] && $_FILES['identity_member3_link'] && $_FILES['passphoto_link1'] && $_FILES['passphoto_link2'] && $_FILES['passphoto_link3'])
                {
                    $config['upload_path']          = 'uploads/cip/' . $this->session->user_id;
                    $config['max_size']             = 5000;
                    $config['overwrite']            = TRUE;

                    $this->load->library('upload', $config);

                    $link = "uploads/cip/" . $this->session->user_id;

                    if (!file_exists ($link))
                    {
                        if(!mkdir($link, 0777, TRUE))
                        {
                            $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                        }
                    }

                    if($_FILES['identity_member1_link'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'identity_member1_link.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('identity_member1_link') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('identity_member1_link' => $link . "/identity_member1_link");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($_FILES['identity_member2_link'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'identity_member2_link.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('identity_member2_link') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('identity_member2_link' => $link . "/identity_member2_link");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($_FILES['identity_member3_link'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'identity_member3_link.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('identity_member3_link') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('identity_member3_link' => $link . "/identity_member3_link");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($_FILES['passphoto_link1'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'passphoto_link1.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('passphoto_link1') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('passphoto_link1' => $link . "/passphoto_link1");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($_FILES['passphoto_link2'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'passphoto_link2.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('passphoto_link1') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('passphoto_link2' => $link . "/passphoto_link2");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($_FILES['passphoto_link3'])
                    {
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = 'passphoto_link3.jpg';
                        $config['overwrite']            = TRUE;
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('passphoto_link1') )
                        {
                                $error = array('error' => $this->upload->display_errors());

                                $this->session->set_flashdata('upload_failed', $error);

                                redirect('akun/dashboard/cip');
                        }
                        else
                        {
                                //Write to db
                                $this->db->where('account_id', $this->session->userdata('user_id'));
                                $this->db->select('cip_participants');
                                $data = array('passphoto_link3' => $link . "/passphoto_link3");
                                $this->db->update('cip_participants', $data);
                                $flag++;
                        }
                    }

                    if($flag != '6')
                    {
                        $this->session->set_flashdata('error', 'Tolong unggah semua data');
                        redirect('/akun/dashboard');
                    }

                }else
                {
                    $this->session->set_flashdata('error', 'Tolong unggah semua data');
                    redirect('/akun/dashboard');
                }

                //Put Into Array
                if($this->input->post('type') == 'univeristy')
                {
                    $data_pendaftar = array (

                        'type'                       => $this->input->post('type'),
                        'account_id'                 => $this->session->userdata('user_id'),
                        'fullname_member1'           => $this->input->post('fullname_member1'),
                        'fullname_member2'           => $this->input->post('fullname_member2'),
                        'fullname_member3'           => $this->input->post('fullname_member3'),
                        'identity_member1'           => $this->input->post('identity_member1'),
                        'identity_member2'           => $this->input->post('identity_member2'),
                        'identity_member3'           => $this->input->post('identity_member3'),
                        // 'identity_member1_link'      => $identity_link1,
                        // 'identity_member2_link'      => $identity_link2,
                        // 'identity_member3_link'      => $identity_link3,
                        // 'passphoto_link1'            => $photo_link3,
                        // 'passphoto_link2'            => $photo_link2,
                        // 'passphoto_link3'            => $photo_link3,
                        'institution_name'           => $this->input->post('institution_name'),
                        'province_id'                => $this->input->post('provice_id'),
                        'logging_days'               => $this->input->post('logging_days'),
                        'need_transport'             => $this->input->post('need_transport')

                        );
                }else
                {
                    $data_pendaftar = array (
                        'type'                       => $this->input->post('type'),
                        'account_id'                 => $this->session->userdata('user_id'),
                        'fullname_member1'           => $this->input->post('fullname_member1'),
                        'fullname_member2'           => $this->input->post('fullname_member2'),
                        'fullname_member3'           => $this->input->post('fullname_member3'),
                        'identity_member1'           => $this->input->post('identity_member1'),
                        'identity_member2'           => $this->input->post('identity_member2'),
                        'identity_member3'           => $this->input->post('identity_member3'),
                        // 'identity_member1_link'      => $identity_link1,
                        // 'identity_member2_link'      => $identity_link2,
                        // 'identity_member3_link'      => $identity_link3,
                        // 'passphoto_link1'            => $photo_link3,
                        // 'passphoto_link2'            => $photo_link2,
                        // 'passphoto_link3'            => $photo_link3,
                        'institution_name'           => $this->input->post('institution_name'),
                        'province_id'                => $this->input->post('provice_id'),
                        'logging_days'               => $this->input->post('logging_days'),
                        'need_transport'             => $this->input->post('need_transport'),
                        'teacher_name'               => $this->input->post('teacher_name'),
                        'teacher_phone'              => $this->input->post('teacher_phone'),
                        'teacher_email'              => $this->input->post('teacher_email')
                        );
                }

                $this->db->where('account_id', $this->session->userdata('user_id'));
                $this->db->insert('cip_participants' , $data);

                //Email ticketingcf2016@gmail.com
                $this->load->model('admin_model');
                $pendaftar = $this->admin_model->getUser($this->session->userdata('user_id'));
                $this->admin_model->email_new_register('ticketingcf2016@gmail.com', 'Chemistry Innovation Project', $pendaftar);

            }break;

            case 'cfk' :
            {
                //Put Into Array
                $data_pendaftar = array (

                    'account_id'                 => $this->session->userdata('user_id'),
                    'fullname'                   => $this->input->post('fullname'),
                    'institution_name'           => $this->input->post('institution_name'),
                    'fullname_parent'                   => $this->input->post('fullname_parent'),
                    'age'                   => $this->input->post('age'),
                    'competitions'                   => $this->input->post('competitions'),
                    'is_tk'                   => $this->input->post('is_tk'),
                    'phone'                   => $this->input->post('phone'),
                );

                $this->db->where('account_id', $this->session->userdata('user_id'));
                $this->db->insert('cfk_participants' , $data);

                //Email ticketingcf2016@gmail.com
                $this->load->model('admin_model');
                $pendaftar = $this->admin_model->getUser($this->session->userdata('user_id'));
                $this->admin_model->email_new_register('ticketingcf2016@gmail.com', 'Chemistry Fair Kids', $pendaftar);

            }break;


            default:
            {
                redirect('/main');
            }
        }
    }
    
}

?>