<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function contactus ($data)
	{
		$subject  = "Kontak Peserta";

		$headers  = "From: kontak-kami@chemistryfair-ui.com \r\n";
		$headers .= "Reply-To: chemistryfair2016@gmail.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message  = "<html><body>";
		$message .= "<h2>".$data['name']."</h2>";
		$message .= '<table border="1px">';
		$message .= "<tr>";
		$message .= "<td>Nama</td><td>".$data['name']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Email</td><td>".$data['email']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Content</td><td>".$data['content']."</td>";
		$message .= "</tr>";
		$message .= "</table>";
		$message .= "</body></html>";


		if(mail($data['email'], $subject, $message, $headers))
		{
			return true;
		}else
		{
			return false;
		}
	}
}
?>