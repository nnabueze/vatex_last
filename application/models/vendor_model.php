<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Usermodel
 * Description	: This model is for user related DB transactions, login and registration processes for Users(members)
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class Vendor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	/***  Function for login ***/
    function login($data)
    {
      $sql    = "select * from user where email='".$data['email']."' and password='".sha1(md5($data['password']))."' and status='1'";
	  $query  = $this->db->query($sql);
	  $res = $query->result_array();
	  if(sizeof($res)>0){
		  $data = array(
               'last_login' => date('Y-m-d h:i:s') //2016-04-07 11:58:26
            );

		$this->db->where('id', $res[0]['id']);
		$this->db->update('user', $data); 
	  }
	  return $res;
    }	
	/****** EOF *****/

	/***  Function for Vendor Detail ***/
	public function vendor_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('vendors')->result();
		return $query;
	}
	
	/****** EOF *****/
	
	/***  Function for User Exists or not ***/
	public function user_exists($email,$username){		
		//$query = $this->db->where("('email' = '".$email."' or 'username' = '".$username."')")->get('user')->result();
		$sql = "select * from user where email = '".$email."' or username = '".$username."'";
		$query  = $this->db->query($sql);
		return $query->num_rows();
	}
	/****** EOF *****/

	/***  Function for Registration of New Vendor ***/
	public function vendor_registration($data){
		$this->db->insert('vendors', $data);	
		return $this->db->insert_id();
	}
	/****** EOF *****/

	/**** function for vendor Listing ****/
	public function vendor_listing(){
		$query = $this->db->get('vendors')->result();
		return $query;	
	}
	/*** EOF ***/
	/***  Function for Username Exists or not ***/
	public function username_exists($username){		
		$sql = "select * from vendors where username = '".$username."'";
		$query  = $this->db->query($sql);
		return $query->num_rows();
	}
	/****** EOF *****/

	public function vendor_to_ec_id(){
		$query = $this->db->where(array('status'=>0))->get('vendor_to_ec_id')->result();
		return $query;
	}

	public function vendor_login($data){
		$sql    = "select * from vendors where username='".$data['username']."' and password='".sha1(md5($data['password']))."' and status='1'";
		$query  = $this->db->query($sql);
		$res = $query->result_array();
		if(sizeof($res)>0){
				$data = array(
				   'last_login' => date('Y-m-d h:i:s') //2016-04-07 11:58:26
				);

			$this->db->where('id', $res[0]['id']);
			$this->db->update('vendors', $data); 
		}
		return $res;
	}
}


