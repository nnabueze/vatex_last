<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Billermodel
 * Description	: This model is for user related DB transactions, login and registration processes for biller(members)
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class Biller_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}

	/*
	 * Function isUserExists checks whether biller exists or not. It searches email ID in database.
	 * This query will be someting like this (select email from user_master where email = '$email')
	 * Added By Ravi Prakash
	 */

	/***  Function for biller login ***/
    function login($data)
    {
      $sql    = "select * from biller where email='".$data['email']."' and password='".sha1(md5($data['password']))."' and status='1'";
	  $query  = $this->db->query($sql);
	  $res = $query->result_array();
	  if(sizeof($res)>0){
		  $data = array(
               'last_login' => date('Y-m-d h:i:s') //2016-04-07 11:58:26
            );

		$this->db->where('id', $res[0]['id']);
		$this->db->update('biller', $data); 
	  }
	  return $res;
    }	
	/****** EOF *****/

	/***  Function for Biller Detail ***/
	public function biller_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('biller')->result();
		return $query;
	}
	/****** EOF *****/

	/***  Function for Biller Exists or not ***/
	public function biller_exists($email_address,$biller_username){		
		$sql = "select * from biller where email_address = '".$email_address."' or biller_username = '".$biller_username."'";
		$query  = $this->db->query($sql);
		return $query->num_rows();
	}
	/****** EOF *****/

	/***  Function for Registration of New Biller ***/
	public function biller_registration($data){
		$this->db->insert('biller', $data);	
		return $this->db->insert_id();
	}
	/****** EOF *****/

	/**** function for Biller Listing ****/
	public function biller_listing(){
		$query = $this->db->where(array('status'=>0))->get('biller')->result();
		return $query;	
	}
	/*** EOF ***/

	/**** function for Declined Biller Listing ****/
	public function declined_biller_listing(){
		$query = $this->db->where(array('status'=>2))->get('biller')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Biller Listing ****/
	public function approved_biller_listing(){
		$query = $this->db->where(array('status'=>1))->get('biller')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Biller Configuration tables ****/
	public function approved_biller_configuration($id){
		$query = $this->db->select('service_bank_ebills,service_cashpoint,service_centralpay_ecommerce')->where(array('id'=>$id))->get('biller')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Biller Configuration table structure detail ****/
	public function biller_services_table_structure($servicetbl){		
		$table = $this->db->escape_str($servicetbl);
		$sql = "DESCRIBE `$table`";
		$desc = $this->db->query($sql)->result();		
		return $desc;	
	}
	/*** EOF ***/

	public function biller_acronymn($acronymn){
		$query = $this->db->where(array('biller_acronymn'=>$acronymn))->get('biller')->result();
		return $query;	
	}


}


