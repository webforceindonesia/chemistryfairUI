<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Accounts_model.php
// Interface to manage the account from the database

class Accounts_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}

?>