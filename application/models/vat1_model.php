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
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));
		$list_ercommerce = array();

		//calculating the total net vat for each client
		foreach ($clients as $client) {
			
			//get all each ecommerce net vat to calculate total vat
			$vat = $this->db->where('transaction_date >=',$start_of_last_month)
			->where('transaction_date <=',$start_of_current_month)
			->where(array('ecommerce_id'=>$client['api_key']))
			->where(array('status'=>'0'))
			->get('computed_vat')
			->result_array();

			if ($vat) {
				if (count($vat) > 0) {
					foreach ($vat as $vat) {
						$result['total_net_vat'] += $vat['output_vat'];
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

			xml_print($dom);

			 //Post XML file to NIBBS
			//$URL = "ftp://ravi:Cjm26o3^@dev.ercasteam.com/";

			//$ch = curl_init($URL);
 			//curl_setopt($ch, CURLOPT_MUTE, 1);
/*			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dom);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			$info = curl_getinfo($ch); 
			curl_close($ch);*/
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
						$result['vendor_tin'] = $vendor['tin'];
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

	//computing every day vat for each vendor
	public function current_vat()
	{	
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();

		//getting the current date
		$date = date('Y-m-d');

			//comput net vat for each client
		foreach ($clients as $client) {
			
				//get all vendors under a specific ecommers
			$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();


			if (count($vendors) > 0) {
				foreach ($vendors as $vendor) {
					$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))
					->where('Vendor_Id',$vendor['Vendor_Id'])
					->where('Order_Status','1')
					->where('Payment_Date',$date)
					->get('vat_on_hold_sweep_queue')
					->result_array();

					if (count($orders) > 0) {
						foreach($orders as $order){
							$result['transaction_amount'] += $order['Order_Amount'];
							$result['output_vat'] += $order['Output_VAT'];
						}

						$result['ecommerce_id'] = $vendor['Ecommerce_Id'];
						$result['vendor_id'] = $vendor['Vendor_Id'];
						$result['vendor_tin'] = $vendor['tin'];
						$result['net_vat'] = $result['output_vat'];
						$result['input_vat'] = "0";
						$result['transaction_date'] = date('Y-m-d');
						$result['date'] = date('Y-m-d H:i:s');

							//check if computed vendor computed vat for the month exist
						if (! $net_vat = $this->db->where(array('transaction_date'=>$result['transaction_date']))->where(array('vendor_id'=>$result['vendor_id']))->get('computed_vat')->row_array()) {

							$insert = $this->db->insert("computed_vat", $result);

							//emptying the variable for next vendor computation
							$result['transaction_amount'] = "";
							$result['output_vat'] ="";

						}else{
							$this->db->where('vendor_id', $result['vendor_id']);
							$this->db->where('transaction_date', $result['transaction_date']);
							$this->db->update("computed_vat", $result);
						}
					}

				}
			}

			
		}
	}

	//deducting previous month vat
	public function deduction_date()
	{
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();
		$period = date("F,Y",strtotime("-1 month"));

			//deducting vat for each client
		foreach ($clients as $client) {
			
				//get all vendors under a specific ecommers
			$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();

			if (count($vendors) > 0) {
				foreach ($vendors as $vendor) {
					$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))
					->where('Vendor_Id',$vendor['Vendor_Id'])
					->where('Order_Status','1')
					->where('approve','2')
					->where('status','0')
					->get('vat_on_hold_sweep_queue')
					->result_array();



						//select vendor previous month computation vat
					if ($net_vat = $this->db->where(array('period'=>$period))->where(array('vendor_id'=>$vendor['Vendor_Id']))->get('computed_vat')->row_array()) {


						if (count($orders) > 0) {
							foreach($orders as $order){
								$result['input_vat'] += $order['input_vat'];

								$status['status'] = '1';

								//updating the status showing that input vat have been calculated
								$this->db->where('id', $order['id']);
								$this->db->update('vat_on_hold_sweep_queue', $status);
							}

							
							//get the actual net vat
							$result['net_vat'] = $net_vat['output_vat'] - $result['input_vat'];
							$result['status'] = '1';



							//update the input and net vat in the computation table.
							$this->db->where('vendor_id', $vendor['Vendor_Id']);
							$this->db->where('period', $period);
							$this->db->update('computed_vat', $result);

							//emptying variables for next vendor deduction computation
							$result['net_vat'] = "";
							$result['input_vat'] = "";

						}


					}

				}
			}
			
			
		}
	}


	//sending email notification of vat deduction before fund sweep
	public function email_date()
	{
		//getting list of registered client
		$clients = $this->db->get('client_settings')->result_array();
		$period = date("F,Y",strtotime("-1 month"));

		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));



			//comput net vat for each client
		foreach ($clients as $client) {
			
			$total_result = array();
			$total_net_vat ="";
				//get all vendors under a specific ecommers
			$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();

			if (count($vendors) > 0) {
				foreach ($vendors as $vendor) {

					$amount ="";
					$vat ="";

					$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))
					->where('Vendor_Id',$vendor['Vendor_Id'])
					->where('Status','0')
					->where('transaction_date >=',$start_of_last_month)
					->where('transaction_date <=',$start_of_current_month)
					->get('computed_vat')
					->result_array();

					if ($orders) {
						
						$result['Ecommerce_Id'] = $vendor['Ecommerce_Id'];
						$result['vendor_id'] = $vendor['name'];
						$result['period'] = $period;
						foreach ($orders as $order) {
							$amount += $order['transaction_amount'];
							$vat += $order['output_vat'];
						}
						$result['output_vat'] = $vat;
						$result['transaction_amount'] = $amount;
						$total_net_vat  += $result['output_vat'];
						array_push($total_result, $result);
						
					}

				}

			}
			//send email to a specific client
			$config = Array(        
			'protocol' => 'smtp',//sendmail
			'smtp_host' => 'ssl://smtp.googlemail.com',//your domain SMTP host
			'smtp_port' => 465,//25
			'smtp_user' => 'oparannabueze@gmail.com',//SMTP Username
			'smtp_pass' => 'tomorro2',//SMTP Password
			'smtp_timeout' => '4',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
			);
			$data = array(
				'info'=> $total_result,
				'total'=> $total_net_vat
				);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('oparannabueze@gmail.com', 'Firs Admin');
			$this->email->to($client['contact_email']);  
			$this->email->subject("Firs Remittance Report"); 
			
			$body = $this->load->view('email/notification.php',$data,TRUE);
			$this->email->message($body);
			$this->email->send(); 
		}
	}

}