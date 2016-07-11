<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cp_participants_model.php
// Interface to manage the Chemistry Art Competition (Photography Competition) team data.

/* 'cp_participants' table structure
id	                    int(10) unsigned
account_id	            int(10) unsigned			
fullname	            varchar(128)			
identity_link	        varchar(255)				
institution_name	    varchar(128)			
province_id	            int(10) unsigned			
instagram_photo_link	varchar(255)				
payment_proof_link	    varchar(255)				
is_paid	                tinyint(1)	
time_registered	        datetime			
*/

class Cp_participants_model extends CI_Model
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
        $this->db->select('fullname, identity_link, institution_name, province_id, 
        instagram_photo_link, payment_proof_link, is_paid, time_registered');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        return $this->db->get('cp_participants')->row();
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
    public function register_participant($account_id, $fullname, $institution_name, $province_id)
    {
        // Create the query builder 
        $this->db->insert('cp_participants', array(
            'account_id'            =>  $account_id,
            'fullname'              =>  $fullname,
            'institution_name'      =>  $institution_name,
            'province_id'           =>  $province_id,
            'time_registered'       =>  date('Y-m-d H:i:s')
        ));
    }

    /**
     *  Change details of a field in the DB (Only fullname, identity_link, institution_name, province_id, instagram_photo_link
     *  and payment_proof_link)
     *  @param int $account_id
     *  @param string $field_name 
     *  @param mixed $value
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function change_details($account_id, $field_name, $value)
    {
        $allowed_field = array('fullname', 'identity_link', 'institution_name', 'province_id', 'instagram_photo_link', 'payment_proof_link');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('id', $account_id);
            $this->db->limit(1);
            $this->db->update('cp_participants', array($field_name => $value));
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
        $this->db->update('cp_participants', array('is_paid' => true));
        return true;
    }
}

?>