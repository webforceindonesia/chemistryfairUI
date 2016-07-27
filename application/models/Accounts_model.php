<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Accounts_model.php
// Interface to manage the account from the database

/* 'accounts' table structure

    id              	int(10) unsigned	
    email               varchar(255)				
    password	        varchar(255)				
    fullname	        varchar(128)				
    phone_number	    varchar(16)				
    email_recovery	    varchar(128)				
    security_question	varchar(128)				
    security_answer	    varchar(128)				
    is_admin	        tinyint(1)	
    verification_code	varchar(64)			
    is_verified	        tinyint(1)			
    time_created	    datetime				
*/

class Accounts_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *  Get the account details data
     *  @param integer $account_id 
     *  @return object Contains data
     *  @author FURIBAITO
     */
    public function get_details($account_id)
    {
        $this->db->select('email, fullname, phone_number, email_recovery, security_question, is_admin, is_verified, time_created');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        return $this->db->get('accounts')->row();
    }

    /**
     *  Get account id from email
     *  @param string $email 
     *  @return integer Account ID on exists, 0 otherwise
     *  @author FURIBAITO
     */
    public function get_id_from_email($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $this->db->limit(1);
        if ($this->db->count_all_results('accounts') === 0)
        {
            return 0;
        }
        $this->db->select('id');
        $this->db->where('email', $email);
        return $this->db->get('accounts')->row()->id;
    }

    /**
     *  Get all competition that this account participate in 
     *  Returns an associative array with competition keys and their respective team id in the values
     *  NULL value is given if the account isn't participating in a competition
     *  'cc'        = Chemistry Competition
     *  'cip'       = Chemistry Innovation Project
     *  'cac'       = Chemistry Art Competition
     *  'seminar'   = National Seminar
     *  'cfk'       = Chemistry Fair Kids
     *  @param integer $account_id 
     *  @return array Associative array
     *  @author FURIBAITO
     */
    public function get_account_participation($account_id)
    {
        $this->db->start_cache();
        $this->db->select('id');
        $this->db->where('account_id', $account_id);
        $this->db->limit(1);
        $this->db->stop_cache();

        $return_data = array();

        // Check from Seminar table
        $query_row = $this->db->get('seminar_participant')->row();
        if (!empty($query_row))
        {
            $return_data['seminar'] = $query_row->id;
        }

        // Check from CFK table
        $query_row = $this->db->get('cfk_participants')->row();
        if (!empty($query_row))
        {
            $return_data['cfk'] = $query_row->id;
        }

        // Check from CC table
        $query_row = $this->db->get('cc_participants')->row();
        if (!empty($query_row))
        {
            $return_data['cc'] = $query_row->id;
        }

        // Check from CIP table
        $query_row = $this->db->get('cip_participants')->row();
        if (!empty($query_row))
        {
            $return_data['cip'] = $query_row->id;
        }

        // Check from CAC table
        $query_row = $this->db->get('cac_participants')->row();
        if (!empty($query_row))
        {
            $return_data['cac'] = $query_row->id;
        }

        $this->db->flush_cache();
        
        return $return_data;
    }
    
    /**
     *  Register a new account to the database (Not validated yet)
     *  @param string $email
     *  @param string $password 
     *  @param string $fullname
     *  @param string $phone_number 
     *  @param integer $institution_type 
     *  @param string $institution_name 
     *  @param string $email_recovery 
     *  @param string $security_question 
     *  @param string $security_answer
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function register($email, $password, $fullname, $phone_number, $email_recovery, $security_question, $security_answer)
    {
        // Check if the email is not taken yet
        if ($this->get_id_from_email($email) !== 0)
        {
            return false;
        }

        // Create the query builder 
        $this->db->insert('accounts', array(
            'email'             =>  $email,
            'password'          =>  password_hash($password, PASSWORD_DEFAULT),
            'fullname'          =>  $fullname,
            'phone_number'      =>  $phone_number,
            'email_recovery'    =>  $email_recovery,
            'security_question' =>  $security_question,
            'security_answer'   =>  $security_answer,
            'is_admin'          =>  false,
            'is_verified'       =>  false,
            'time_created'      =>  date('Y-m-d H:i:s')
        ));
    }

    /**
     *  Attempt to login with the specified email and password
     *  @param string $email 
     *  @param string $password 
     *  @return integer Account ID on success, 0 otherwise
     *  @author FURIBAITO
     */
    public function login($email, $password)
    {
        $account_id = $this->get_id_from_email($email);
        if ($account_id !== 0)
        {
            $this->db->select('password');
            $this->db->from('accounts');
            $this->db->where('email', $email);
            $this->db->limit(1);
            $query = $this->db->get();
            if (password_verify($password, $query->row()->password))
            {
                return $account_id;
            }
        }
        return 0;
    }

    /**
     *  Send a verification email containing a link to activate the account
     *  Fails when the email doesn't exist or the account is already activated
     *  @param integer $account_id 
     *  @return bool TRUE on success, FALSE otherwise
     *  @author FURIBAITO
     */
    public function send_verification_email($account_id)
    {
        $this->load->helper('url');
        
        // Create a 64 byte random string as a key to activate the account
        $this->db->select('email');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $account_email = $this->db->get('accounts')->row()->email;

        $verification_code = bin2hex(openssl_random_pseudo_bytes(32));
        $activation_url = site_url() . 'accounts/email_validation/' . $account_id . '_' . $verification_code;
        
        // Store the validation code in the DB
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $this->db->update('accounts', array('verification_code' => $verification_code));

        // Send the email containing the link

        $subject = 'Chemistry Fair UI 2016 | Verifikasi alamat email';

        $message = '<span style="font-family: Verdana">Kami mendeteksi alamat email anda melakukan proses pendaftaran akun di website kami.';
        $message .= 'Silahkan meng-klik link ini untuk mengaktifkan akun anda. </span>';

        $message .= '<a href=' . "'" . $activation_url . "'" . '>Aktifkan akun Chemistry Fair anda</a>';

        $header = "From:furibaito.test@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        return mail($account_email, $subject, $message, $header) ? true : false;
    }

    /**
     *  Send a password change link
     *  Fails when the email doesn't exist
     *  @param string $email 
     *  @return void
     *  @author FURIBAITO
     */
    public function send_password_change_email($email)
    {
        $this->load->helper('url');
        
        // Create a 64 byte random string as a key
        $this->db->select('id, email, email_recovery');
        $this->db->where('email', $email);
        $this->db->or_where('email_recovery', $email);
        $this->db->limit(1);

        $query_row = $this->db->get('accounts')->row();

        if (empty($query_row))
        {
            return;
        }

        $account_id = $query_row->id;
        $account_email = $query_row->email;
        $account_email_recovery = $query_row->email_recovery;

        echo var_dump($query_row);

        $verification_code = bin2hex(openssl_random_pseudo_bytes(32));
        $activation_url = site_url() . 'accounts/change_password/' . $account_id . '_' . $verification_code;
        
        // Store the validation code in the DB
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $this->db->update('accounts', array('verification_code' => $verification_code));

        // Send the email containing the link
        $subject = 'Chemistry Fair UI 2016 | Permintaan Ganti Password';

        $message = '<span style="font-family: Verdana">Kami mendeteksi alamat email anda meminta untuk merubah password akun Chemistry Fair 2016. ';
        $message .= 'Silahkan meng-klik link ini untuk mengganti password akun anda. Jika anda tidak menghendaki atau mengetahui tindakan ini, harap mengabaikan email ini.</span>';

        $message .= '<a href=' . "'" . $activation_url . "'" . '>Ganti password</a>';

        $header = "From:furibaito.test@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        mail($account_email, $subject, $message, $header);
        mail($account_email_recovery, $subject, $message, $header);
    }

    /**
     *  Check the password change secret code
     *  @param integer $account_id 
     *  @param string $secret_code
     *  @return bool TRUE if the code is correct, FALSE otherwise
     *  @author FURIBAITO
     */
    public function check_password_change_code($account_id, $secret_code)
    {
        $this->db->select('verification_code');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $stored_code = $this->db->get('accounts')->row();
        if (!empty($stored_code))
        {
            $stored_code = $stored_code->verification_code;
            if (!empty($stored_code) && $stored_code === $secret_code)
            {
                return true;
            }
        }
        return false;
    }

    /**
     *  Change details of a field in the DB (Only password, fullname, phone_number, email_recovery, security_question and security_answer)
     *  @param integer $account_id 
     *  @param string $field
     *  @param mixed $value
     *  @return void
     *  @author FURIBAITO
     */
    public function change_details($account_id, $field_name, $value)
    {
        $allowed_field = array('password', 'fullname', 'phone_number', 'email_recovery', 'security_question', 'security_answer');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('id', $account_id);
            $this->db->limit(1);
            $this->db->update('accounts', array($field_name => ($field_name === 'password') ? password_hash($value, PASSWORD_DEFAULT) : $value));
        }
    }

    /**
     *  Confirms a password change
     *  @param integer $account_id 
     *  @param string $new_password
     *  @return bool TRUE if the code is correct, FALSE otherwise
     *  @author FURIBAITO
     */
    public function confirm_password_change($account_id, $new_password)
    {
        $this->change_details($account_id, 'password', $new_password);
        
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $this->db->update('accounts', array('verification_code' => NULL));
    }

    /**
     *  Validate account email if the validation code is correct
     *  @param integer $account_id 
     *  @param string $verification_code 
     *  @return bool TRUE if the code is correct, FALSE otherwise
     *  @author FURIBAITO
     */
    public function verify_account($account_id, $verification_code)
    {
        $this->db->select('verification_code');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $real_verification_code = $this->db->get('accounts')->row();
        if (!empty($real_verification_code))
        {
            $real_verification_code = $real_verification_code->verification_code;
            if (!empty($real_verification_code) && $real_verification_code === $verification_code)
            {
                // Set the account to be activated/verified/validated in the database
                $this->db->where('id', $account_id);
                $this->db->limit(1);
                $this->db->update('accounts', array('is_verified' => true, 'verification_code' => NULL));
                return true;
            }
        }
        return false;
    }
}

?>