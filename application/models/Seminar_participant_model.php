<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Seminar_participant_model.php
// Interface to manage the Seminar participants data

/* 'seminar_participants' table structure

id	                int(10) unsigned	
account_id	        int(10) unsigned		
type	            enum('public','student')				
fullname	        varchar(128)				
institution_name	varchar(128)				
passphoto_link	    varchar(255)				
payment_proof_link	varchar(255)			
is_paid	            tinyint(1)				
time_registered	    datetime				
				
*/

class Seminar_participant_model extends CI_Model
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
        $this->db->select('type, fullname, institution_name, passphoto_link, payment_proof_link, is_paid, time_registered');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        return $this->db->get('seminar_participants')->row();
    }

    /**
     *  Register a new participant for an account
     *  @param int $account_id
     *  @param string $participant_type 
     *  @param string $fullname
     *  @param string $institution_name 
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function register_participant($account_id, $participant_type, $fullname, $institution_name)
    {
        // Create the query builder 
        $this->db->insert('seminar_participants', array(
            'account_id'        =>  $account_id,
            'type'              =>  $participant_type,
            'fullname'          =>  $fullname,
            'institution_name'  =>  $institution_name,
            'time_registered'   =>  date('Y-m-d H:i:s')
        ));
    }

    /**
     *  Change details of a field in the DB (Only type, fullname, institution_name, passphoto_link and payment_proof_link)
     *  @param int $account_id
     *  @param string $field_name 
     *  @param mixed $value
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function change_details($account_id, $field_name, $value)
    {
        $allowed_field = array('type', 'fullname', 'institution_name', 'passphoto_link', 'payment_proof_link');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('id', $account_id);
            $this->db->limit(1);
            $this->db->update('seminar_participants', array($field_name => $value));
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
        $this->db->update('seminar_participants', array('is_paid' => true));
        return true;
    }
}

?>