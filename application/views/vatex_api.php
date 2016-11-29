<?php
require(APPPATH.'libraries/REST_Controller.php');
 
class Vatex_api extends REST_Controller {
 
	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('api_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
	} 

	function checkSettings()
    {
		$identifier=$_POST['identifier'];
		$apikey=$_POST['apikey'];
		$token = $_POST['token'];
	
		// respond with information about a user
		if($identifier==''||$apikey==''||$token=='')
        {
			
            $this->response(array('status' => 'failed', 'msg'=>'Missing Token or API Key or Identifier'), 400);
			return false;
        }
 
        $result = $this->api_model->check_valid_settings($identifier,$apikey,$token);
         
        if($result==1)
        {
            $this->response(array('status' => 'success'), 200); // 200 being the HTTP response code
        }
        else if($result==2)
        {
            $this->response(array('status' => 'failed', 'msg'=>'Invalid Token or API Key'),  404);
        } else {
			$this->response(array('status' => 'failed', 'msg'=>'Invalid Identifier'),  404);
		}
    }
     
    function vat_orders()
    {
        
		$identifier=$_POST['identifier'];
		$apikey=$_POST['apikey'];
		$token = $_POST['token'];
		
		// respond with information about a user
		if($identifier==''||$apikey==''||$token=='')
        {
			
            $this->response(array('status' => 'failed', 'msg'=>'Missing Token or API Key or Identifier'), 400);
			return false;
        }
 
        $result = $this->api_model->check_valid_settings($identifier,$apikey,$token);
		//All Api Security are ok 
        if($result==1)
        {
			$userid = $this->api_model->get_user_id_by_identifier($identifier);
			$orders = json_decode($_POST['orders']);			
			foreach($orders as $orderdata){
				$vendorchk = 
				$this->api_model->vendor_check($orderdata->Vendor_Id);
				if($vendorchk==0){
					$savedata3 = array(
								   'ec_id' => $userid, 
								   'vendor_id' => $orderdata->Vendor_Id);
					$vecid =$this->basic_model->savedata('vendor_to_ec_id', $savedata3);
				}				
				if($orderdata->Net_VAT =='' && $orderdata->Purchase_Price==''){
					$savedata = array(
								   'ec_id' => $userid, 
								   'Order_Id' => $orderdata->Order_Id,
								   'Transaction_Id' => $orderdata->Transaction_Id,
								   'Vendor_Id' => $orderdata->Vendor_Id,
								   'Order_Amount' => $orderdata->Order_Amount,
					               'Net_VAT' => $orderdata->Net_VAT,
								   'sales_date' => $orderdata->Order_date,
									'Quantity' => $orderdata->Quantity,
									'Order_date' => $orderdata->Order_date,
									'Order_Status' => $orderdata->Order_Status,
									'Purchase_Price' => $orderdata->Purchase_Price,
									'Product_Description' => $orderdata->Product_Description,
									'Product_Category' => $orderdata->Product_Category,
									'Payment_Date' => $orderdata->Payment_Date,
									'Payment_Type' => $orderdata->Payment_Type,
									'Delivery_Date' => $orderdata->Delivery_Date,
									'Vendor_TIN' => $orderdata->Vendor_TIN
								 );				
					$psqid =$this->basic_model->savedata('vat_on_hold_sweep_queue', $savedata);
					continue;
				}
				$savedata = array(
								   'ec_id' => $userid, 
								   'Order_Id' => $orderdata->Order_Id,
								   'Transaction_Id' => $orderdata->Transaction_Id,
								   'Vendor_Id' => $orderdata->Vendor_Id,
								   'Order_Amount' => $orderdata->Order_Amount,
					               'Net_VAT' => $orderdata->Net_VAT,
								   'sales_date' => $orderdata->Order_date
								 );				
				$psqid =$this->basic_model->savedata('payment_sweep_queue', $savedata);
				$savedata1 = array(
								'payment_sweep_queue_id' => $psqid,
								'Quantity' => $orderdata->Quantity,
								'Order_date' => $orderdata->Order_date,
								'Order_Status' => $orderdata->Order_Status,
								'Purchase_Price' => $orderdata->Purchase_Price,
								'Product_Description' => $orderdata->Product_Description,
								'Product_Category' => $orderdata->Product_Category,
								'Payment_Date' => $orderdata->Payment_Date,
								'Payment_Type' => $orderdata->Payment_Type,
								'Delivery_Date' => $orderdata->Delivery_Date,
								'Vendor_TIN' => $orderdata->Vendor_TIN
								);
				$osqid =$this->basic_model->savedata('order_sweep_queue', $savedata1);	
			}
			$this->response(array('status' => 'success'), 200); // 200 being the HTTP response code
        }
        else if($result==2)
        {
            $this->response(array('status' => 'failed', 'msg'=>'Invalid Token or API Key'),  404);
        } else {
			$this->response(array('status' => 'failed', 'msg'=>'Invalid Identifier'),  404);
		}
    }
}