<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cip_participants_model.php
// Interface to manage the Chemistry Innovation Project team data.

/* 'cip_participants' table structure
id	                    int(10) unsigned	
account_id	            int(10) unsigned			
type	                enum('highschool','university')
fullname_member1	    varchar(128)
fullname_member2	    varchar(128)
fullname_member3	    varchar(128)
identity_member1_link	varchar(255)			
identity_member2_link	varchar(255)			
identity_member3_link	varchar(255)
id_number_member1 	    int			
id_number_member2   	int			
id_number_member3 	    int		
passphoto_link1     	varchar(255)			
passphoto_link2	        varchar(255)			
passphoto_link3	        varchar(255)	
institution_name	    varchar(128)
province_id	            int(11) unsigned
teacher_name 
teacher_phone
teacher_email
lodging_days	        int(11)			
need_transport	        tinyint(1)
abstract_link	        varchar(255)			
abstract_passed	        tinyint(1)	
payment_proof_link	    varchar(255)			
is_paid	                tinyint(1)
time_registered	        datetime
*/

class Cip_participants_model extends CI_Model
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
        $this->db->select('cip_participants.*');
        $this->db->where('account_id', $account_id);
        $this->db->limit(1);
        return $this->db->get('cip_participants')->row();
    }

    /**
     *  Register a new participant for an account
     *  @param int $account_id
     *  @param enum $type 
     *  @param string $fullname_member1
     *  @param string $fullname_member2 
     *  @param string $fullname_member3 
     *  @param string $institution_name 
     *  @param int $province_id 
     *  @param int $lodging_days 
     *  @param bool $need_transport 
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function register_participant($account_id, $type, $fullname_member1, $fullname_member2, $fullname_member3,
    $id_number_member1, $id_number_member2, $id_number_member3, $institution_name, $province_id, $lodging_days, $need_transport, $teacher_name, $teacher_phone, $teacher_email)
    {
        // Create the query builder 
        $this->db->insert('cip_participants', array(
            'account_id'            =>  $account_id,
            'type'                  =>  $type,
            'fullname_member1'      =>  $fullname_member1,
            'fullname_member2'      =>  $fullname_member2,
            'fullname_member3'      =>  $fullname_member3,
            'id_number_member1'	    =>  $id_number_member1,
            'id_number_member2'		=>  $id_number_member2,
            'id_number_member3'	    =>  $id_number_member3,
            'institution_name'      =>  $institution_name,
            'province_id'           =>  $province_id, 
            'lodging_days'          =>  $lodging_days,
            'need_transport'        =>  $need_transport,
            'teacher_name'          =>  $teacher_name,
            'teacher_phone'         =>  $teacher_phone,
            'teacher_email'         =>  $teacher_email,
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
        $allowed_field = array('type', 'fullname_member1', 'fullname_member2', 'fullname_member3', 'identity_member1_link', 'identity_member2_link',
        'identity_member3_link', 'institution_name', 'province_id', 'lodging_days', 'need_transport', 'abstract_link', 'payment_proof_link'
        , 'teacher_name', 'teacher_phone', 'teacher_email', 'id_number_member1', 'id_number_member2', 'id_number_member3');
        if (in_array($field_name, $allowed_field, true))
        {
            $this->db->where('id', $account_id);
            $this->db->limit(1);
            $this->db->update('cip_participants', array($field_name => $value));
            return true;
        }
        return false;
    }

    /**
     *  Let this participant pass the abstract selection
     *  @param int $account_id
     *  @return bool True on success, false otherwise
     *  @author FURIBAITO
     */
    public function pass_abstract($account_id)
    {
        $this->db->where('id', $account_id);
        $this->db->limit(1);
        $this->db->update('cip_participants', array('abstract_passed' => true));
        return true;
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
        $this->db->update('cip_participants', array('is_paid' => true));
        return true;
    }
}

?>