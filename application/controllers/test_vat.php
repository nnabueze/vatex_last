<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Test_vat extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('test_model'));
	    $this->load->helper(array('url'));
	} 

	//getting orders from ecommerces
	public function order_vat()
	{
		$this->test_model->test_vat();
	}

	//getting payment
	public function payment_vat()
	{
		$this->test_model->payment_vat();
	}

	//calculating vat for vendors
	public function compute_vat()
	{
		$this->test_model->compute_vat();
	}
	
	
}