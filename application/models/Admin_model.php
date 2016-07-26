<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function getParticipants ($lomba)
	{
		return $this->db->get($lomba.'_participants')->result();
	}
}
?>