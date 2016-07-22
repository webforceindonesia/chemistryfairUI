<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

	private $title;
	private $content;
	private $created;

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function getPassword ($username)
	{
		$query = $this->db->query("SELECT * FROM `admin` WHERE `username` = '$username'");
		
		if($query->num_rows() > 0)
		{	
			foreach($query->result() as $row)
			{
				$password = $row->password;
			}

			return $password;
		}else
		{
			return false;
		}
	}

	public function login ()
	{


	}

	public function new_admin ()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$hashed = password_hash($password, PASSWORD_BCRYPT);

		$data = array(
			'username' => $username,
			'password' => $hashed,
			'email' => $email
		);
		
		$this->db->insert('admin', $data);
	}
}
?>