<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cc_teams_model.php
// Interface to manage the Chemistry Competition team data.

class Cc_teams_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}

?>