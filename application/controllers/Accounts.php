<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('accounts_model');
    }

	public function index()
	{

	}

    public function account_registration()
    {
        $data['page_header'] = 'Registrasi Akun Chemistry Fair 2016';
        
        $this->load->view('templates/header.php', $data);

        // If the user is already logged in an account, send an error and tells them to logout first
        if (isset($_SESSION['user_id']))
        {
            $this->load->view('error.php', array(
                'error_reason' => 'Silahkan log out terlebih dahulu untuk melakukan registrasi account baru',  
                'error_redirection' => ''));
        }

        // If the form is validated, add to the DB and show the success page, otherwise show the form again with errors
        else if ($this->form_validation->run() === TRUE)
        {
            // Register this new account to the DB
            $this->accounts_model->register(
                $this->input->post('email'),
                $this->input->post('password'),
                $this->input->post('fullname'),
                $this->input->post('phone_number'),
                $this->input->post('email_recovery'),
                $this->input->post('security_question'),
                $this->input->post('security_answer')
            );
            
            $data['success_header'] = 'Konfirmasi Akun Email Anda';
            $data['success_message'] = 'Kami telah mengirimkan email konfirmasi kepada anda. 
                                        Mohon membukanya dan klik link yang dicantumkan di dalam email anda';
            $this->load->view('registration/success.php', $data);

            // Send a verification email to the new user
            $this->send_verification_email($this->db->insert_id());
        }

        // Else, show the form
        else
        {
            $this->form_validation->set_rules(  
                'email', 'Email', 
                'required|valid_email|is_unique[accounts.email]', 
                array(
                    'valid_email'   => 'Email anda tidak valid.',
                    'is_unique'     => 'Email anda sudah terdaftar dalam data kami.'
                )
            );
            $this->form_validation->set_rules(  
                'emailconf', 'Konfirmasi Email', 
                'required|matches[email]', 
                array(
                    'matches'       => 'Mohon cek kembali email anda.'
                )
            );
            $this->form_validation->set_rules(  
                'password', 'Password', 
                'required|min_length[8]', 
                array(
                    'min_length'    => 'Password anda terlalu pendek. Minimal 8 karakter.'
                )
            );
            $this->form_validation->set_rules(  
                'passconf', 'Konfirmasi Password', 
                'required|matches[password]', 
                array(
                    'min_length'    => 'Password anda tidak sama dengan kolom password diatas.'
                )
            );
            $this->form_validation->set_rules(  
                'fullname', 'Nama Lengkap', 
                'required|max_length[128]|alpha', 
                array(
                    'alpha'         => 'Nama hanya dapat berisi karakter alphabet.'
                )
            );
            $this->form_validation->set_rules(  
                'phone_number', 'Nomor Telepon', 
                'required|max_length[24]|numeric', 
                array(
                    'numeric'       => 'Mohon masukkan hanya angka.'
                )
            );
            $this->form_validation->set_rules(  
                'email_recovery', 'Email Cadangan', 
                'required|max_length[128]|valid_email', 
                array(
                    'valid_email'   => 'Email anda tidak valid.',
                )
            );
            $this->form_validation->set_rules(  
                'security_question', 'Pertanyaan Keamanan', 
                'required|max_length[128]'
            );
            $this->form_validation->set_rules(  
                'security_answer', 'Jawaban Keamanan', 
                'required|max_length[128]'
            );
            $this->form_validation->set_rules('security_answer', 'Jawaban Keamanan', 'required');
            
            //$this->load->view('registrations/header.php', $data);
            //$this->load->view('registrations/account.php');
        }
        //$this->load->view('templates/footer.php');
    }

    public function participant_registration($type)
    {
        switch ($type) 
        {
            case 'account':
                
                break;

            case 'seminar':
                $this->form_validation->set_rules('type', 'Tipe Pendaftar', 'required');
                $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|max_length[128]|alpha');
		        $this->form_validation->set_rules('institution_name', 'Nama Institusi',  'required');
                break;

            default:
                # code...
                break;
        }
        $this->load->view('test/header.php', $data);
        $this->load->view('test/home.php');
        $this->load->view('test/footer.php');
    }

    // Splits the verification code and checks if it's correct
    public function email_validation($validation_code)
    {
        $separated_data = explode('_', $validation_code, 2);
        echo $this->accounts_model->verify_account($separated_data[0], $separated_data[1]) ? 'Verified' : 'Ayy no';
    }
}

?>