<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acara extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounts_model');
        $this->load->helper('titlecase');
    }

    public function index()
    {
        $this->show_content('acara');
    }

    public function show_content($view_file)
    {
        if (empty($view_file)) $view_file = 'acara';
        $data['title'] = str_replace('_', ' ', $view_file);
        $data['title'] = titlecase($data['title']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('acara/' . $view_file);
        $this->load->view('templates/footer.php');
    }
}