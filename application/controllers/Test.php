<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __constructor()
    {
        parent::__constructor();
        $this->load->library('session');
    }
    
    public function index()
	{
        $this->load->view('test/header.php', $data);
        $this->load->view('test/footer.php');
	}
}

?>