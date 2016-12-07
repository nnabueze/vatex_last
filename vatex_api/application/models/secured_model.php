<?php
class Secured_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	//insert open order
	public function open_order($data)
	{
		if ($insert = $this->db->insert("vat_on_hold_sweep_queue", $data)) {
			return true;
		}

		return false;
	}

	//Varifying Biller token
	public function token_verify($data)
	{
		$token = $this->db->where(array('token_id'=>$data))->get('client_settings')->row_array();

		return $token;
	}

}