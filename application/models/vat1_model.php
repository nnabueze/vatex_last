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
		$result = $this->db->get('sweep_settings')->row_array();

		$fund_sweep_date = $result['sweep_execution_day'];
		$deduction_date = $result['sweep_execution_day'] - 4;
		$email_date = $result['sweep_execution_day'] - 3;
		$computation_date = $result['vat_computation_hold'];
		//echo "<pre>"; print_r($computation_date); die;

		switch ('th') {
			case $fund_sweep_date:
				//fund sweep
				break;
			case $deduction_date:
				//deduct VAT
				break;
			case $email_date:
				//send email
				break;
			case 'th':
				echo "string";
				break;
			default:
				# code...
				break;
		}
	}

	//computing previous month VAT
	private function comput_vat()
	{
		echo "yes computation working";
		die;
	}


}