<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Accounts_model.php
// Interface to manage the account from the database

class Accounts_model extends CI_Model
{
    // Table names
    const ACCOUNTS_TABLE = 'accounts';
    
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *  Check if the email is already exists on the database
     *  @param string $email 
     *  @return bool True on exists, false otherwise
     *  @author FURIBAITO
     */
    public function is_email_exists($email)
    {
        $this->db->where('email', $email);
        $this->db->limit(1);
        if ($this->db->count_all_results(self::ACCOUNTS_TABLE) === 0)
        {
            return false;
        }
        return true;
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
    public function register($email, $password, $fullname, $phone_number, $institution_type, $institution_name, $email_recovery, $security_question, $security_answer)
    {
        // Check if the email is not taken yet
        if ($this->is_email_exists($email))
        {
            return false;
        }

        // Create the query builder 
        $this->db->insert('accounts', array(
            'email'             =>  $email,
            'password'          =>  password_hash($password, PASSWORD_DEFAULT),
            'fullname'          =>  $fullname,
            'phone_number'      =>  $phone_number,
            'institution_type'  =>  $institution_type,
            'institution_name'  =>  $institution_name,
            'email_recovery'    =>  $email_recovery,
            'security_question' =>  $security_question,
            'security_answer'   =>  $security_answer,
            'is_admin'          =>  false,
            'is_validated'      =>  false,
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
        if ($this->is_email_exists($email))
        {
            $this->db->select('password');
            $this->db->from('accounts');
            $this->db->where('email', $email);
            $this->db->limit(1);
            $query = $this->db->get();
            if (password_verify($password, $query->row()->password))
            {
                return true;
            }
        }
        return false;
    }
}

?>