<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Test_vat extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('test_model'));
	    $this->load->helper(array('url'));
	} 

	//getting orders from ecommerces
	public function vat()
	{
		$this->test_model->test_vat();
	}
	
	
}