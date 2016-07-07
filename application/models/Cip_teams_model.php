<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cip_teams_model.php
// Interface to manage the Chemistry Innovation Project team data.

class Cip_teams_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}

?>