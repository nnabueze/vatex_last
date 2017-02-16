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
		$data = array();
		//select order from ecommerce
		$otherdb = $this->load->database('default2', TRUE);
		$query = $otherdb->order_by("id","DESC")
		->get('order_c')->row_array();

		$data['Transaction_Id'] =$query['ecommID'];

		$data['Order_Id'] =$query['ID'];
		$data['Order_Amount'] =$query['amount'];
		$data['Quantity'] =$query['qty'];
		$data['Order_date'] =$query['date'];
		$data['Purchase_Price'] =$query['amount'];
		$data['Product_Description'] =$query['item_name'];
		$data['Product_Category'] =$query['cat'];
		$data['sell_price'] = $data['Order_Amount'] / $data['Quantity'];

			//select exiting ecommerce and assign
		$ecommerce = $this->db->where("client_name", "Jumia")
		->get('client')->row_array();

			//getting vendors under ecommerce
		$vendor = $this->db->where("Ecommerce_Id", $ecommerce['key_id'])
		->get('vendor')->row_array();

		$data['Vendor_Id'] = $vendor['Vendor_Id'];
		$data['Vendor_TIN'] = $vendor['tin'];
		$data['vendor_name'] = $vendor['name'];
		$data['Ecommerce_Id'] = $vendor['Ecommerce_Id'];
		$data['ecommerce_name'] = $this->ecommerce($vendor['Ecommerce_Id']);

			//check if the transaction id exist
		$transaction = $this->db->where("Transaction_Id", $data['Transaction_Id'])
		->get('vat_on_hold_sweep_queue')->row_array();

		if (! $transaction) {

			if ($insert = $this->db->insert("vat_on_hold_sweep_queue", $data)) {
					//inserting record into transaction table
				$transaction['transaction_amount'] = $data['Order_Amount'];
				$transaction['no_of_orders'] = 1;
				$trans = $this->transaction($data['Transaction_Id']);
				if ($trans) {

						//sum up all the order amount under the transaction
					$transaction['transaction_amount']   = $transaction['transaction_amount'] + $trans['transaction_amount'];
					$transaction['no_of_orders'] = $trans['no_of_orders'] + 1;

					$this->db->where('transaction_id',$data['Transaction_Id']);
					$this->db->update('transactions', $transaction);
				}else{
					$transaction['transaction_id']   = $data['Transaction_Id'];
					$transaction['transaction_date']   = $data['Order_date'];
					$transaction['ecommerce_id']   = $data['Ecommerce_Id'];
					$transaction['ecommerce_name']   = $data['ecommerce_name'];

					$this->db->insert("transactions", $transaction);

				}
			}
		}
	}

	//getting payment
	public function payment_vat()
	{
		$otherdb = $this->load->database('default2', TRUE);
		$query = $otherdb->get('tnx')->row_array();



		$data['Transaction_Id']   = $query['payment_id'];
		$data['Payment_Date']   = $query['payment_date'];
		$data['Delivery_Date']   = $query['payment_date'];
		$data['Payment_Type']   = "Cash";
		$data['Order_Status']   = "1";

		//calculating the output VAT
		$orders = $this->db->where(array('Transaction_Id'=>$data['Transaction_Id']))
		->get('vat_on_hold_sweep_queue')->result_array();
		

		if (count($orders) > 0) {
			foreach ($orders as $order) {
		 		//check if the product category is Vatable
				$result = $this->db->where(array('product_category_name'=>$order['Product_Category']))->get('vatibles')->row_array();

				if (!$result) {
		 			//computing Output Vat for specific order
					$data1['Output_VAT'] = 0.05 * $order['Order_Amount'];

		 			//insert the output vat
					$this->db->where('Order_Id', $order['Order_Id']);
					$this->db->update('vat_on_hold_sweep_queue', $data1);
				}
			}

		//close all the order within the specified transaction.
			$this->db->where('Transaction_Id', $data['Transaction_Id']);
			$this->db->update('vat_on_hold_sweep_queue', $data);

		//updating transaction table for closed transaction
			$transaction['payment_date']   = $data['Payment_Date'];
			$transaction['Payment_Type']   = $data['Payment_Type'];

			$transaction['status']   = "1";
			$transaction['vat_deducted'] = "";
			$trans = $this->transaction_order($data['Transaction_Id']);
			if (count($trans) > 0) {
				foreach ($trans as $tran) {
					$transaction['vat_deducted']   += $tran['Output_VAT'];
				}
				$this->db->where('transaction_id',$data['Transaction_Id']);
				$this->db->update('transactions', $transaction);
			}
		}
	}

	//get ecommerce name
	public function ecommerce($data)
	{
		$name = $this->db->where(array('key_id'=>$data))
		->get('client')
		->row_array();

		return $name['client_name'];
	}


	//getting a specific transaction
	public function transaction($data)
	{
		$name = $this->db->where(array('transaction_id'=>$data))
		->get('transactions')
		->row_array();

		return $name;
	}

	//getting list of order transaction
	public function transaction_order($data)
	{
		$name = $this->db->where(array('Transaction_Id'=>$data))
		->get('vat_on_hold_sweep_queue')
		->result_array();

		return $name;
	}


}


