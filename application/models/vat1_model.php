<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Vat1 Model

 */

class Vat1_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}

	//getting vatible products
	function get_vatibles() {     
		$query = $this->db->get('vatibles');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}
	
	// inserting record from CSV upload
	function insert_csv($data) {
		$this->db->insert('vatibles', $data);
	}

	//deleting vatibles record
	public function vatible_delete($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('vatibles')) {
			return true;
		}
		return false;
	}

	//getting the configuration date
	public function config_date()
	{
		$result = $this->db->get('sweep_settings')->row_array();
		return $result;
	}

	//sending to NIBS for sweep
	public function sweep_date()
	{
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();
		$period = date("F,Y",strtotime("-1 month"));
		$list_ercommerce = array();

		//calculating the total net vat for each client
		foreach ($clients as $client) {
			
			//get all each ecommerce net vat to calculate total vat
			$vat = $this->db->where(array('period'=>$period))
						->where(array('ecommerce_id'=>$client['api_key']))
						->where(array('status'=>'1'))
						->get('computed_vat')
						->result_array();

			if ($vat) {
				if (count($vat) > 0) {
					foreach ($vat as $vat) {
						$result['total_net_vat'] += $vat['net_vat'];
						$status['status'] = '2';

						//updating status to indicate that the Net vat have been remmited
						$this->db->where('id', $vat['id']);
						$this->db->update('computed_vat', $status);
					}
				}

				$item = $this->db->where(array('id'=>$client['client_id']))
							->get('client')
							->row_array();
				$result['ecommerce_name'] = $item['client_name'];
				$result['ecommerce_id'] = $client['api_key'];

				array_push($list_ercommerce, $result);
			}
		}

		//genarate an XML file to be sent to NIBBS
		if (count($list_ercommerce) > 0) {
			$this->load->helper('xml');
			 
			$dom = xml_dom();
			$NibbsPaymentCollection = xml_add_child($dom, 'NibbsPaymentCollection');
			 
			 foreach ($list_ercommerce as $list_ercommerce) {
			 	$NibssPayment = xml_add_child($NibbsPaymentCollection, 'ns1:NibssPayment');
			 					xml_add_child($NibssPayment, 'ns1:TaxType','VAT');
			 					xml_add_child($NibssPayment, 'ns1:amount',$list_ercommerce['total_net_vat']);
			 					xml_add_child($NibssPayment, 'ns1:transactionDescription',$period.' VAT from '.$list_ercommerce['ecommerce_name']);
			 }
			 
			//xml_print($dom);
			 //Post XML file to NIBBS
			$URL = "ftp://ravi:Cjm26o3^@dev.ercasteam.com/";
			  
 			$ch = curl_init($URL);
 			//curl_setopt($ch, CURLOPT_MUTE, 1);
 			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 			curl_setopt($ch, CURLOPT_POST, 1);
 			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
 			curl_setopt($ch, CURLOPT_POSTFIELDS, $dom);
 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 			$output = curl_exec($ch);
 			$info = curl_getinfo($ch); 
 			curl_close($ch);
		}
	}

	//computing previous month VAT
	public function computation_date()
	{
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$end_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

			//comput net vat for each client
		foreach ($clients as $client) {
			
				//get all vendors under a specific ecommers
			$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();

			if (count($vendors) > 0) {
				foreach ($vendors as $vendor) {
					$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))
					->where('Vendor_Id',$vendor['Vendor_Id'])
					->where('Order_Status','1')
					->where('Payment_Date >=',$start_of_last_month)
					->where('Payment_Date <=',$start_of_current_month)
					->get('vat_on_hold_sweep_queue')
					->result_array();

					if (count($orders) > 0) {
						foreach($orders as $order){
							$result['transaction_amount'] += $order['Order_Amount'];
							$result['output_vat'] += $order['Output_VAT'];
						}

						$result['ecommerce_id'] = $vendor['Ecommerce_Id'];
						$result['vendor_id'] = $vendor['Vendor_Id'];
						$result['net_vat'] = $result['output_vat'];
						$result['input_vat'] = "0";
						$result['period'] = date("F,Y",strtotime("-1 month"));
						$result['date'] = date('Y-m-d H:i:s');

							//check if computed vendor computed vat for the month exist
						if (! $net_vat = $this->db->where(array('period'=>$result['period']))->where(array('vendor_id'=>$result['vendor_id']))->get('computed_vat')->row_array()) {

							$insert = $this->db->insert("computed_vat", $result);

							//emptying the variable for next vendor computation
							$result['transaction_amount'] = "";
							$result['output_vat'] ="";

						}
					}

				}
			}

			
		}
	}

}