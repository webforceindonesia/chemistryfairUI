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
	
	public function getNews ()
	{
		$this->db->order_by("id","desc");
        $this->db->limit(6);
		return $this->db->get('cms_news', 6)->result();
	}

	public function totalNews ()
	{
		return $this->db->get('cms_news')->num_rows();
	}

	public function pull_one ($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('cms_news')->row();
	}

	public function write ()
	{	
		$this->title = $this->input->post('title');
		$this->content = $this->input->post('content');
		$this->created = date('Ymd');
		
		$data = array(
			'title' => $this->title,
			'content' => $this->content,
			'created' => $this->created
		);
		
		$this->db->insert('cms_news', $data);
	}

	public function edit($id)
	{
		$this->title = $this->input->post('title');
		$this->content = $this->input->post('content');
		$this->created = date('Ymd');

		$data = array(
			'title' => $this->title,
			'content' => $this->content,
			'created' => $this->created
		);

		$this->db->where('id', $id);
		$this->db->update('cms_news',$data);
	}
}
?>