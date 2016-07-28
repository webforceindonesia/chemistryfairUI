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
        if (isset($_SERVER['user_id']))
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
                
                $_SESSION['user_id'] = $account_id;
                $_SESSION['user_email'] = $user_data->email;
                $_SESSION['user_fullname'] = $user_data->fullname;

                $this->load->view('templates/header.php', $data);
                
                $data['success_title'] = 'Selamat datang!';
                $data['success_message'] = $user_data->fullname . ', Anda telah berhasil login!';
                $data['success_button_label'] = 'Beranda';
                $data['success_button_link'] = site_url();
                $this->load->view('templates/success.php', $data);
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
    public function dashboard($action = 'index')
    {
        // If the user hasn't logon yet, show the login page
        if (isset($_SESSION['user_id']))
        {
            $this->login();
        }
        
        // Set the title and load the header
        $data['title'] = titlecase('Dashboard');
        $data['import_captcha'] = TRUE;
        $this->load->view('templates/header.php', $data);

        // Load the dashboard navigation template
        $this->load->view('accounts/dashboard_nav.php');

        $user_data = $this->accounts_model->get_details($_SESSION['user_id']);

        if ($action == 'index')
        {
            $data['user_fullname'] = $user_data->fullname;
            $data['user_email'] = $user_data->email;
            $data['user_verified'] = $user_data->is_verified;
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
}

?>