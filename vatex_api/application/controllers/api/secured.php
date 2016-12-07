<?php defined('BASEPATH') OR exit('No direct script access allowed');


// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Secured extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
/*		$this->load->model('bill_model');
		$this->load->model('payment_model');
		$this->load->model('client_model');*/
        
        
    }
    
    function bill_get()
    {	
       	$this->response(array('error' => 'No bill found!'), 404);
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        $bill = $this->bill_model->getData( $this->get('id') );
		//$bill = null;
    	
        if($bill)
        {
            $this->response($bill, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No bill found!'), 404);
        }
    }
	
}