<?php defined('BASEPATH') OR exit('No direct script access allowed');


// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Secured extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
		$this->load->model('secured_model');
    }
    

    //Api for posting open order
    public function open_order_post()
    {
        $data['Transaction_Id']   = $this->post('Transaction_Id');
        $data['Vendor_Id']   = $this->post('Vendor_Id');
        $data['Order_Id']   = $this->post('Order_Id');
        $data['Order_Amount']   = $this->post('Order_Amount');
        $data['Quantity']   = $this->post('Quantity');
        $data['Order_date']   = $this->post('Order_date');
        $data['Order_Status']   = $this->post('Order_Status');
        $data['Purchase_Price']   = $this->post('Purchase_Price');
        $data['Product_Description']   = $this->post('Product_Description');
        $data['Product_Category']   = $this->post('Product_Category');
        $data['Payment_Date']   = $this->post('Payment_Date');
        $data['Payment_Type']   = $this->post('Payment_Type');
        $data['Delivery_Date']   = $this->post('Delivery_Date');
        $data['Net_VAT']   = $this->post('Net_VAT');
        $data['Vendor_TIN']   = $this->post('Vendor_TIN');

        //check if any of the parameters are empty
        if (empty($this->post('Transaction_Id')) || empty($this->post('Vendor_Id'))|| empty($this->post('Order_Id'))|| empty($this->post('Order_Amount'))|| empty($this->post('Quantity')) || empty($this->post('Order_date')) || empty($this->post('Purchase_Price')) || empty($this->post('Product_Description')) || empty($this->post('Product_Category')) || empty($this->post('Payment_Date')) ||empty($this->post('Payment_Type'))|| empty($this->post('Delivery_Date')) || empty($this->post('Vendor_TIN'))) {

            $this->response(array('error' => 'parameter missing'), 404);
        }

        //varify token
        if (!$token = $this->secured_model->token_verify( $this->post('token') )) {
            //return $token;
            $this->response(array('error' => 'Token Mismatch'), 404);
        }

        $data['ec_id'] = $token['client_id'];

        //insert paraters into database
        if ($data = $this->secured_model->open_order( $data )) {
            
            //return successful message
            $this->response(array('message' => 'Succefully completed'), 200);
        }

        //return error unable to insert record
        $this->response(array('error' => 'Unable to insert record'), 404);
    }
	
}