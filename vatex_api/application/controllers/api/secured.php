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
        $data['Ecommerce_Id']   = $this->post('Ecommerce_Id');
        $data['Vendor_Id']   = $this->post('Vendor_Id');
        $data['Order_Id']   = $this->post('Order_Id');
        $data['Order_Amount']   = $this->post('Order_Amount');
        $data['Quantity']   = $this->post('Quantity');
        $data['Order_date']   = $this->post('Order_date');
        $data['cost_price']   = $this->post('cost_price');
        $data['selling_price']   = $this->post('selling_price');
        $data['Purchase_Price']   = $this->post('Purchase_Price');
        $data['Product_Description']   = $this->post('Product_Description');
        $data['Product_Category']   = $this->post('Product_Category');
        $data['Net_VAT']   = $this->post('Net_VAT');
        $data['Vendor_TIN']   = $this->post('Vendor_TIN');
        $data['token']   = $this->post('token');
        $data['ecommerce_name']   = $this->ecommerce($this->post('Ecommerce_Id'));
        $data['vendor_name']   = $this->vendor($this->post('Vendor_Id'));
        //////////////////////////////////////////////////////////////////////////
        $data['return_policy']   = $this->post('return_policy');
        $data['warranty_period']   = $this->post('warranty_period');
        $data['commission']   = $this->post('commission');
        $data['shipping_fee']   = $this->post('shipping_fee');

        //check if any of the parameters are empty
        if (empty($this->post('Transaction_Id')) || empty($this->post('Vendor_Id'))|| empty($this->post('Order_Id'))|| empty($this->post('Order_Amount'))|| empty($this->post('Quantity')) || empty($this->post('Order_date')) || empty($this->post('Purchase_Price')) || empty($this->post('Product_Description')) || empty($this->post('Product_Category')) || empty($this->post('Order_date'))|| empty($this->post('cost_price')) || empty($this->post('selling_price')) || empty($this->post('Ecommerce_Id')) || empty($this->post('Vendor_TIN'))|| empty($this->post('return_policy')) || empty($this->post('warranty_period')) || empty($this->post('commission')) || empty($this->post('shipping_fee'))) {

            $this->response(array('error' => 'parameter missing'), 404);
        }

        //varify token
        if (!$token = $this->token_verify($data)) {
            //return $token;
            $this->response(array('error' => 'Token Mismatch'), 404);
        }

        //checking if order id exist already
        if ($order = $this->secured_model->order_check( $this->post('Order_Id') )) {
          
            $this->response(array('error' => 'Order ID already exist'), 404);
        }

        //check if vendor exist under ecommerce
        if (! $vendor = $this->secured_model->vendor_check($data)) {
            $this->response(array('error' => 'Vendor does not exist'), 404);
        }

        //checking if vendor tin exist
        if (! $vendor_tin = $this->secured_model->vendor_tin_check($data['Vendor_TIN'])) {
            $this->response(array('error' => 'Vendor tin does not exist'), 404);
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

    //Api for closing order
    public function close_order_post()
    {
        //accept parameters
        $data['Ecommerce_Id']   = $this->post('Ecommerce_Id');
        $data['Transaction_Id']   = $this->post('Transaction_Id');
        $data['Payment_Date']   = $this->post('Payment_Date');
        $data['Payment_Type']   = $this->post('Payment_Type');
        $data['Delivery_Date']   = $this->post('Delivery_Date');
        $data['Order_Status']   = "1";
        $data['delivery_mode']   = $this->post('delivery_mode');
        $data['token']   = $this->post('token');

        //validated parameters
        if (empty($this->post('Ecommerce_Id')) || empty($this->post('Transaction_Id'))|| empty($this->post('Payment_Date'))|| empty($this->post('Payment_Type'))|| empty($this->post('Delivery_Date')) || empty($this->post('delivery_mode')) ) {

            $this->response(array('error' => 'parameter missing'), 404);
        }

        //check if token exist
        //varify token
        if (!$token = $this->token_verify($data)) {
            //return $token;
            $this->response(array('error' => 'Token Mismatch'), 404);
        }

        //check if transaction id exist
        if (!$transaction = $this->secured_model->transaction_check( $data )) {

            $this->response(array('error' => 'Transaction ID does not exist'), 404);
        }

        //update transaction
        if ($data = $this->secured_model->close_order( $data )) {
            
            //return successful message
            $this->response(array('message' => 'Succefully Updated Transaction'), 200);
        }

        //return error unable to insert record
        $this->response(array('error' => 'Unable to update transaction'), 404);
    }

    //token verification
    private function token_verify($request)
    {
        $token = $this->secured_model->token_verify( $request);
        return $token;
    }

    //Api to onboard a vendor
    public function vendor_post()
    {
        $data['Ecommerce_Id']   = $this->post('Ecommerce_Id');
        $data['Vendor_Id']   = $this->post('Vendor_Id');
        $data['date']   = date('Y-m-d h:i:s');
        $data['token']   = $this->post('token');
        $data['first_name']   = $this->post('first_name');
        $data['last_name']   = $this->post('last_name');
        $data['email']   = $this->post('email');
        $data['mobile']   = $this->post('phone');
        $data['tin']   = $this->post('tin');

        //validated parameters
        if (empty($this->post('Ecommerce_Id')) || empty($this->post('Vendor_Id')) || empty($this->post('phone')) || empty($this->post('tin'))) {

            $this->response(array('error' => 'parameter missing'), 404);
        }

        //varify token
        if (!$token = $this->token_verify($data)) {
            //return $token;
            $this->response(array('error' => 'Token Mismatch'), 404);
        }

        //check if vendor exist
        if ($vendor = $this->secured_model->vendor_check($data)) {
            $this->response(array('error' => 'Vendor already exist'), 404);
        }

        //generate vendor key
       // $data['key_id']  = md5(uniqid(rand(), true));

        //insert vendor
        if ($result = $this->secured_model->insert_vendor($data)) {
            $this->response(array('message' => 'Vendor registeration successful'), 404);
        }

        $this->response(array('error' => 'Unable to register vendor'), 404);
    }


    //getting ecommerce name
    private function ecommerce($data)
    {
        $name = $this->secured_model->ecommerce($data);

        return $name;
    }

    //getting vendor name
    private function vendor($data)
    {
        $name = $this->secured_model->vendor($data);

        return $name;
    }
	
}