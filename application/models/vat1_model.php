<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Vat1 Model

 */

class Vat1_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}

	//computing Net vat for specific month and each vendor
/*	public function computed_vat1($data)
	{
		if (count($data['vendor']) > 0) {
			$result = array();
			
			foreach ($data['vendor'] as  $value) {
				
				///computing Net Vat for each vendor
				$orders = $this->db->where(array('Ecommerce_Id'=>$value['Ecommerce_Id']))->where('Vendor_Id',$value['Vendor_Id'])->where('Order_Status','1')->get('vat_on_hold_sweep_queue')->result_array();

				foreach($orders as $order){
					$result['transaction_amount'] += $order['Order_Amount'];
					$result['output_vat'] += $order['Output_VAT'];
				}

				$result['ecommerce_id'] = $data['vendor'][0]['Ecommerce_Id'];
				$result['vendor_id'] = $data['vendor'][0]['Vendor_Id'];
				$result['net_vat'] = $result['output_vat'];
				$result['input_vat'] = "0";
				$result['period'] = date('Y-m-d H:i:s');
				$result['date'] = date('Y-m-d H:i:s');

				$insert = $this->db->insert("computed_vat", $result);
			}


			echo "<pre>";
			print_r($result);
			die;
		}


	}*/

	//computing vat
	public function vat()
	{
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$end_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));


		//get the day of current month
		$day = date("d", strtotime(date('Y-m-d')));
		

			//comput net vat for each client
		foreach ($clients as $client) {
				//checking if the current day of the month is equal to set excuation day
			if ($day == $client['vat_computation_hold']) {

				$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();

				if (count($vendors) > 0) {
					foreach ($vendors as $vendor) {
						$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))->where('Vendor_Id',$vendor['Vendor_Id'])->where('Order_Status','1')->where('Payment_Date >=',$start_of_last_month)->where('Payment_Date <=',$end_of_last_month)->get('vat_on_hold_sweep_queue')->result_array();

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

							}
						}

					}
				}

			}
		}
	}


}