<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cms_news_model extends CI_Model {

	private $title;
	private $content;
	private $created;

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function write ()
	{	
		$this->title = $_POST['title'];
		$this->content = $_POST['content'];
		$this->created = date('Ymd');
		
		$data = array(
			'title' => $this->title,
			'content' => $this->content,
			'created' => $this->created
		);
		
		$this->db->insert('cms_news', $data);
	}
	
	public function pull_last_ten ()
	{
		$counter = 0;
		$query = $this->db->get('cms_news', 10);
		
		foreach ($query->result() as $row)
		{	
			$content[$counter]['title'] = $row->title;
			$content[$counter]['content'] = $row->content;
			$content[$counter]['created'] = $row->created;
			$counter++;
		}
		
		return $content;
			
	}
	
	public function pull_one ()
	{
		$counter = 0;
		$query = $this->db->get('cms_news');
		
		foreach ($query->result() as $row)
		{	
			$content['title'] = $row->title;
			$content['content'] = $row->content;
			$content['created'] = $row->created;
		}
		
		return $content;
	}
	
	public function edit()
	{
		
		
	}	
}
?>