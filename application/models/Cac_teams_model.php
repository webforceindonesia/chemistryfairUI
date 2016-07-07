<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cac_teams_model.php
// Interface to manage the Chemistry Art Competition team data.

class Cac_teams_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}

?>