<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cc_teams_model.php
// Interface to manage the Chemistry Competition team data.

/* 'cc_participants' table structure
id	                    int(10) unsigned
account_id	            int(10) unsigned	
fullname_member1	    varchar(128)				
fullname_member2	    varchar(128)				
identity_member1_link	varchar(255)			
identity_member2_link	varchar(255)				
institution_name	    varchar(128)				
province_id	int(11)     unsigned		
teacher_name	        varchar(128)			
teacher_phone_number	varchar(16)			
lodging_days	        int(11)			
teacher_needs_lodging	tinyint(1)			
need_transport	        tinyint(1)			
payment_proof_link	    varchar(255)			
is_paid	                tinyint(1)			
time_registered	        datetime			
*/

class Cc_participants_model extends CI_Model
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
        $this->db->select('fullname_member1, fullname_member2, identity_member1_link, identity_member2_link, 
        province_id, teacher_name, teacher_phone_number, lodging_days, teacher_needs_lodging, need_transport, payment_proof_link
        , is_paid, time_registered');
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        return $this->db->get('cc_participants')->row();
    }

    /**
     *  Register a new participant for an account
     *  @param int $account_id
     *  @param string $fullname_member1 
     *  @param string $fullname_member2
     *  @param string $institution_name 
     *  @param int $province_id 
     *  @param string $teacher_name 
     *  @param string $teacher_phone_number 
     *  @param int $lodging_days 
     *  @param bool $teacher_needs_lodging 
     *  @param bool $need_transport 
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function register_participant($account_id, $fullname_member1, $fullname_member2, $institution_name, $province_id,
    $teacher_name, $teacher_phone_number, $lodging_days, $teacher_needs_lodging, $need_transport)
    {
        // Create the query builder 
        $this->db->insert('seminar_participants', array(
            'account_id'            =>  $account_id,
            'fullname_member1'      =>  $fullname_member1,
            'fullname_member2'      =>  $fullname_member2,
            'institution_name'      =>  $institution_name,
            'province_id'           =>  $province_id,
            'teacher_name'          =>  $teacher_name,
            'teacher_phone_number'  =>  $teacher_phone_number, 
            'lodging_days'          =>  $lodging_days,
            'teacher_needs_lodging' =>  $teacher_needs_lodging,
            'need_transport'        =>  $need_transport,
            'time_registered'       =>  date('Y-m-d H:i:s')
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
        $allowed_field = array('fullname_member1', 'fullname_member2', 'identity_member1_link', 'identity_member2_link', 'institution_name', 'province_id',
        'teacher_name', 'teacher_phone_number', 'lodging_days', 'teacher_needs_lodging', 'need_transport', 'payment_proof_link');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('id', $account_id);
            $this->db->limit(1);
            $this->db->update('cc_participants', array($field_name => $value));
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
        $this->db->update('cc_participants', array('is_paid' => true));
        return true;
    }
}

?>