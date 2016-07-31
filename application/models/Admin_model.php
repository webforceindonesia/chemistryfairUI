<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function getParticipants ($lomba, $limit='')
	{
		if($limit == '')
		{
			return $this->db->get($lomba.'_participants', 30)->result();
		}else
		{
			$this->db->where("id >", $limit);
			return $this->db->get($lomba.'_participants', 30)->result();
		}
	}

	public function totalParticipants ($lomba)
	{
		return $this->db->get($lomba.'_participants')->num_rows();
	}

	public function getNews ($limit = '')
	{
		if($limit == '')
		{
			return $this->db->get('cms_news', 10)->result();
		}else
		{
			$this->db->where("id >", $limit);
			return $this->db->get('cms_news', 10)->result();
		}	
	}

	public function totalNews ()
	{
		return $this->db->get('cms_news')->num_rows();
	}
}
?>