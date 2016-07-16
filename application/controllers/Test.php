<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __constructor()
    {
        parent::__constructor();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    
    public function index()
	{
        $this->view();
	}

    public function view($page = 'home')
    {
        $this->load->view('test/header.php', $data);
        $this->load->view('test/home.php');
        $this->load->view('test/footer.php');
    }
}

?>