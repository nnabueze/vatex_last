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

					$item['period'] = date("F,Y",strtotime("-1 month"));	

						//select vendor previous month computation vat
					if ($net_vat = $this->db->where(array('period'=>$item['period']))->where(array('vendor_id'=>$vendor['vendor_id']))->get('computed_vat')->row_array()) {

						if (count($orders) > 0) {
							foreach($orders as $order){
								$result['input_vat'] += $order['input_vat'];

								$status['status'] = '1';

								//updating the status showing that input vat have been calculated
								$this->db->where('id', $order['id']);
								$this->db->update('vat_on_hold_sweep_queue', $status);
							}
							
							//get the actual net vat
							$result['net_vat'] = $net_vat['Output_VAT'] - $result['input_vat'];
							$result['status'] = '1';

							//update the input and net vat in the computation table.
							$this->db->where('vendor_id', $vendor['vendor_id']);
							$this->db->where('period', $item['period']);
							$this->db->update('computed_vat', $result);

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
		$total_result = array();
			//comput net vat for each client
		foreach ($clients as $client) {
			
				//get all vendors under a specific ecommers
			$vendors = $this->db->where('Ecommerce_Id',$client['api_key'])->get('vendor')->result_array();

			if (count($vendors) > 0) {
				foreach ($vendors as $vendor) {
					$orders = $this->db->where(array('Ecommerce_Id'=>$vendor['Ecommerce_Id']))
					->where('Vendor_Id',$vendor['Vendor_Id'])
					->where('Status','1')
					->where('period',$period)
					->get('computed_vat')
					->row_array();

					if ($orders) {

						$result['Ecommerce_Id'] = $vendor['Ecommerce_Id'];
						$result['vendor_id'] = $vendor['Vendor_Id'];
						$result['period'] = $result['period'];
						$result['transaction_amount'] = $result['transaction_amount'];
						$result['output_vat'] = $result['output_vat'];
						$result['input_vat'] = $result['input_vat'];
						$result['net_vat'] = $result['net_vat'];
						$result['total_vat'] += $result['net_vat'];
					}

					array_push($total_result, $result);

				}

				//send email to ecommerce
				'protocol' => 'smtp',//sendmail
				'smtp_host' => 'ssl://smtp.googlemail.com',//your domain SMTP host
				'smtp_port' => 465,//25
				'smtp_user' => 'oparannabueze@gmail.com',//SMTP Username
				'smtp_pass' => 'tomorro2',//SMTP Password
				'smtp_timeout' => '4',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
				);

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");

				$this->email->from('oparannabueze@gmail.com', 'Firs Admin');
				$this->email->to($client['contact_email']);  
				$this->email->subject("Firs Remittance Report"); 
				
				$body = $this->load->view('emails/anillabs.php',$total_result,TRUE);
				$this->email->message($body);   
				$this->email->send();
			}
		}
	}


}