<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// cfk_participants_model.php
// Interface to manage the Chemistry Art Competition (Video Competition) team data.

/* Table name 'cfk_participants'
id	                int(10) unsigned
account_id	        int(10) unsigned		
fullname	        varchar(128)				
identity_link	    varchar(255)				
institution_name	varchar(128)				
province_id	        int(10) unsigned		
youtube_video_link	varchar(255)				
payment_proof_link	varchar(255)				
is_paid	            tinyint(1)		
time_registered	    datetime				
*/

class Cfk_participants_model extends CI_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *  Get this participant data
     *  @param int $account_id
     *  @return object The object containing all about this participant data
     *  @author FURIBAITO
     */
    public function get_details($account_id)
    {
        return $this->db->get_where('cfk_participants', array('account_id' => $account_id))->row();
    }

    /**
     *  Register a new participant for an account
     *  @param int $account_id
     *  @param string $fullname 
     *  @param string $institution_name
     *  @param int $province_id 
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function register_participant($account_id, $institution_name, $fullname, $fullname_parent, $age, $phone, $competition, $type)
    {
        // Create the query builder 
        $this->db->insert('cfk_participants', array(
            'account_id'            =>  $account_id,
            'is_tk'                 =>  $type,
            'fullname'              =>  $fullname,
            'fullname_parent'       =>  $fullname_parent,
            'phone'                 =>  $phone,
            'institution_name'      =>  $institution_name,
            'age'                   =>  $age,
            'phone'                 =>  $phone,
            'competition'           =>  $competition,
            'time_registered'       =>  date('Y-m-d H:i:s')
        ));
    }

    /**
     *  Change details of a field in the DB (Only fullname, identity_link, institution_name, province_id, youtube_video_link
     *  and payment_proof_link)
     *  @param int $account_id
     *  @param string $field_name 
     *  @param mixed $value
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function change_details($account_id, $field_name, $value)
    {
        $allowed_field = array('fullname', 'fullname_parent', 'phone', 'institution_name', 'age', 'phone', 'competition');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('account_id', $account_id);
            $this->db->limit(1);
            $this->db->update('cfk_participants', array($field_name => $value));
            return true;
        }
        return false;
    }

    /**
     *  Confirm the payment of this participant
     *  @param int $account_id
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function confirm_payment($account_id)
    {
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $this->db->update('cfk_participants', array('is_paid' => true));
        return true;
    }
}

?>