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

	public function reset()
	{
		$email = $this->input->post('email');

		$query = $this->db->query("SELECT * FROM `admin` WHERE `email` = '$email'");
		
		if($query->num_rows() > 0)
		{	
			$newPass = substr(md5(microtime()),rand(0,26),5);
			$newPass = password_hash($newPass, PASSWORD_BCRYPT);
			$query = $this->db->query("UPDATE users SET password = '$newPass' WHERE email = '$email'");

			if($query->result())
			{
				$to = $email;
				$subject = "Your Login In " . $company ." .gethassee.com";
				$message = "Hello!
							Your Reseted Password is
							
							Password : $new_password\n
							
							For Safety Please Quickly Change Your Password!";
								   
				$headers = 'From: noreply@chemistryfair-ui.com' . "\r\n" .
							'Reply-To: chemistryfairweborn2016@gmail.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
								
					if(mail($to, $subject, $message, $headers))
					{
						
						return true;
					}
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
	}
}
?>