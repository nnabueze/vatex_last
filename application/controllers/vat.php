<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vat extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','vat1_model'));
		$this->load->library('upload');
	    $this->load->helper(array('url'));
	} 
	
//test url for computing computed vat
	public function computed_vat()
	{

		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

/*		$data['date'] = $this->input->get('month');
		$data['vendor'] = $this->user_model->vendor();*/

		$vador = $this->vat1_model->vat();


	}

	
}