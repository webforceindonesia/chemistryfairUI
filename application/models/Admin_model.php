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
			$this->db->select('*');
			$this->db->from($lomba.'_participants');
			$this->db->join('accounts', 'accounts.id = ' . $lomba.'_participants.account_id', 'inner');
			return $this->db->get()->result();
		}else
		{
			$this->db->where("id >", $limit);
			return $this->db->get($lomba.'_participants')->result();
		}
	}

	public function getAccountInfo ($id)
	{
		return $this->db->get_where('accounts', array('id' => $id))->row();
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

	public function getAllAccounts ()
	{
		return $this->db->get_where('accounts', array('is_admin' => '0'))->result_array();
	}

	public function getParticipations ($id)
	{
		$partipations = '';

		//Check every Events
		if($this->db->get_where('cc_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Chemistry Competition, ";
		}

		if($this->db->get_where('cip_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Chemistry Innovation Competition, ";
		}

		if($this->db->get_where('cfk_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Chemistry Fair Kids, ";
		}

		if($this->db->get_where('cmp_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Chemistry Movie Project, ";
		}

		if($this->db->get_where('cp_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Chemistry Photography, ";
		}

		if($this->db->get_where('seminar_participants', array('account_id' => $id))->num_rows() > 0)
		{
			$partipations .= "Seminar Nasional, ";
		}

		if($partipations == '')
		{
			$partipations .= "Belum Mendaftar Lomba Atau Acara Apapun";
		}

		return $partipations;
	}

	public function getUser ($id)
	{
		return $this->db->get_where('accounts', array('id' => $id))->row();
	}

	public function email_new_register ($to, $lomba, $user_data)
	{
		$subject  = "Pendaftar Baru Lomba" . $lomba;

		$headers  = "From: pendaftaran@chemistryfair-ui.com \r\n";
		$headers .= "Reply-To: ticketingcf2016@gmail.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message  = "<html><body>";
		$message .= "<h2>Informasi Pendaftar Baru Lomba" . $lomba ."</h2>";
		$message .= '<table border="1px">';
		$message .= "<tr>";
		$message .= "<td>Nama</td><td>Email</td><td>No Telpon</td>";
		$message .= "</tr>";
		$message .= "<td>".$user_data->fullname."</td><td>".$user_data->email."</td><td>".$user_data->phone_number."</td>";
		$message .= "</tr>";
		$message .= "</table>";
		$message .= "</body></html>";


		if(mail($to, $subject, $message, $headers))
		{
			return true;
		}else
		{
			return false;
		}
	}
}
?>