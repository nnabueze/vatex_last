<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Ticket model
 * Author		: Ravi Prakash
 * Dated		: 27/05/16
 */

class Test_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	

		$db2 = $this->load->database('default2', TRUE);
	}

	//getting data from ecommerce
	public function test_vat()
	{
		echo "yes";
		die;
	}


}


