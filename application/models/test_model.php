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

		
	}

	//getting data from ecommerce
	public function test_vat()
	{
		$otherdb = $this->load->database('default2', TRUE);
		$query = $otherdb->select('*')->get('wp_posts')->result_array();
		  //var_dump($query);
		echo "<pre>";
		  print_r($query);
		  die;
	}


}


