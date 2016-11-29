<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: APImodel
 * Description	: This model is for API 
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class API_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}


	
	/*
	 * Function check_valid_settings checks whether settings are right or not for users which is passed from third party server.
	 * Added By Ravi Prakash
	 */
   function check_valid_settings($identifier,$apikey,$token)
    {
      $res = $this->db->select('id')->where(array('username'=>$identifier,'user_group_id'=>3,'status'=>1))->get('user')->result();
		//echo $this->db->last_query();
		if(sizeof($res)>0){
			$userid = $res[0]->id;
				$res = $this->db->select('id')->where(array('user_id'=>$userid,'api_key'=>$apikey,'token_id'=>$token))->get('user_settings')->result();
				if(sizeof($res)>0){
					return 1;
				} else {
					return 2;
				}
		} else {
			return 0;
		}
	  
    }	
	/****** EOF *****/
	
	function get_user_id_by_identifier($identifier){
		$res = $this->db->select('id')->where(array('username'=>$identifier,'user_group_id'=>3,'status'=>1))->get('user')->result();
		//echo $this->db->last_query();
		if(sizeof($res)>0){
			return $userid = $res[0]->id;
		} else {
			return '';
		}
	}
	
	function batch_insert($tblname,$savedata){
		$this->db->insert_batch($tblname, $savedata);
		return $this->db->insert_id();
	}	
	
	function vendor_check($id){
		$res = $this->db->select('*')->where(array('vendor_id'=>$id))->get('vendor_to_ec_id')->result();
		return sizeof($res);
	}
	
	function get_payment_sweep_queue_ids($orderid){
		
	}
	
}


