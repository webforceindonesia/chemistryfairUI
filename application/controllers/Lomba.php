<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lomba extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounts_model');
        $this->load->helper('titlecase');
    }

    public function show_content($view_file)
    {
        $data['page_title'] = str_replace('_', ' ', $view_file);
        $data['page_title'] = titlecase($data['page_title']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('lomba/' . $view_file);
        $this->load->view('templates/footer.php');
    }
}