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
	
	public function getUsername ($username, $password)
	{
		$query = $this->db->query("SELECT * FROM `admin` WHERE `username` = '$username'");
		
		if($query->num_rows() > 0)
		{	
			$row = $query->result();
			$content['title'] = $row->title;
			$content['content'] = $row->content;
			$content['created'] = $row->created;
		
			return $content;
		}else
		{
			return false;
		}
	}
}
?>