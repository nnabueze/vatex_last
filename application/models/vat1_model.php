<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Vat1 Model

 */

class Vat1_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}

	//getting vatible products
	function get_vatibles() {     
	    $query = $this->db->get('vatibles');
	    if ($query->num_rows() > 0) {
	        return $query->result_array();
	    } else {
	        return FALSE;
	    }
	}
	
	// inserting record from CSV upload
	function insert_csv($data) {
	    $this->db->insert('vatibles', $data);
	}

	//deleting vatibles record
	public function vatible_delete($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('vatibles')) {
			return true;
		}
		return false;
	}

	//function that handles the computation, deduction, email and fund sweep
	public function vat()
	{
		//get the day of current month
		$day = date("d", strtotime(date('Y-m-d')));

		//getting the configuration date for computation, deduction, email and fund sweep
	}


}