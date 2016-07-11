<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounts_model');
    }

	public function index()
	{
        // $this->accounts_model->register('furibaito@live.com', 'garen', 'Lee Sin', '08176425732', 2, 'SMA EX', 'recov@gmail.com', 'Howdy', 'No shit');
        $this->load->view('admin_view');
	}

    // Splits the verification code and checks if it's correct
    public function email_validation($validation_code)
    {
        $separated_data = explode('_', $validation_code, 2);
        echo $this->accounts_model->verify_account($separated_data[0], $separated_data[1]) ? 'Verified' : 'Ayy no';
    }
}

?>