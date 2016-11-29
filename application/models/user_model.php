<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Usermodel
 * Description	: This model is for user related DB transactions, login and registration processes for Users(members)
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	/*
	 * Function isUserExists checks whether user exists or not. It searches email ID in database.
	 * This query will be someting like this (select email from user_master where email = '$email')
	 * Added By Ravi Prakash
	 */
	public function isUserExists($values)
	{
		$this->db->select('email');		//	select email as value in query
		$this->db->where('email', $values);	// 	where clause in query
		$query   = $this->db->get('customers');		//	Table user_master 
		$numrows = $query->num_rows();
		return $numrows;
	}	
	/****** EOF *****/

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

	/***  Function for User Detail ***/
	public function user_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('user')->result();
		return $query;
	}
	
	/****** EOF *****/

	/***  Function for check is permission allowed or not ***/
	public function isPermissionAllowed($controller,$funcnm,$groupid){
		if($funcnm!=''){
			$wherestr = $controller.'/'.$funcnm;
		} else {
			$wherestr = $controller;
		}
		$query = $this->db->where(array('user_group_id'=>$groupid, 'user_permissions'=>$wherestr))->get('user_group_permissions_setting')->result();
		//echo $this->db->last_query();
		return $query;
	}
	
	/***  Function for User Group ***/
	public function user_group(){
		$query = $this->db->where(array('status'=>'1'))->get('user_group')->result();
		return $query;
	}
	/****** EOF *****/

	/***  Function for User Group Detail ***/
	public function user_group_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('user_group')->result();
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

	/***  Function for Registration of New User ***/
	public function user_registration($data){
		$this->db->insert('user', $data);	
		return $this->db->insert_id();
	}
	/****** EOF *****/

	/**** function for client User Listing ****/
	public function user_listing(){
		$query = $this->db->get('user')->result();
		return $query;	
	}
	/*** EOF ***/
}


