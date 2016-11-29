<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Ticket model
 * Author		: Ravi Prakash
 * Dated		: 27/05/16
 */

class Tickets_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	/***  Function for New Ticket ***/
	public function new_ticket($data){
		$this->db->insert('tickets', $data);	
		return $this->db->insert_id();
	}
	/****** EOF *****/

	/******** Function for ticket listing **********/
	public function ticket_listing($id){
	//	$query = $this->db->where(array('user_id'=>$id))->order_by("creation_date", "desc")->get('tickets')->result();
		$query = $this->db->order_by("creation_date", "desc")->get('tickets')->result();
		return $query;		
	}	
	/******** EOF *******/

	public function none_assigned_tickets(){
		$query = $this->db->where(array('user_id'=>'0'))->order_by("creation_date", "desc")->get('tickets')->result();
		return $query;	
	}

	public function accept_ticket($uid,$tid){
		$data = array(
               'user_id' => $uid
            );
		$this->db->where('id', $tid);
		$this->db->update('tickets', $data); 	
	}

	public function ticket_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('tickets')->result();
		return $query;	
	}

	public function ticket_reply($data){
		$this->db->insert('tickets_reply', $data);	
		return $this->db->insert_id();
	}

	public function tickets_replies($id){
		$query = $this->db->where(array('tickets_id'=>$id))->get('tickets_reply')->result();
		return $query;
	}

	public function tickets_closed($id,$uid){
		$data = array(
               'status' => 'closed',
			   'resolving_date' => date('Y-m-d h:i:s'),
			   'resolved_by' => $uid
            );
		$this->db->where('id', $id);
		$this->db->update('tickets', $data); 
	}

	public function closed_tickets($id){
		$query = $this->db->where(array('id'=>$id,'status'=>'closed'))->get('tickets')->result();
		return $query;
	}

	public function tickets_reopen($id){
		$data = array(
               'status' => 'Pending'
            );
		$this->db->where('id', $id);
		$this->db->update('tickets', $data);
	}

	public function all_closed_tickets(){
		$query = $this->db->where(array('status'=>'closed'))->order_by("resolving_date", "desc")->get('tickets')->result();
		return $query;	
	}
	
	public function get_open_tickets_count(){
		$query = $this->db->where(array('status'=>'Pending','user_id !='=>0))->order_by("resolving_date", "desc")->get('tickets')->result();
		return sizeof($query);
	}
}


