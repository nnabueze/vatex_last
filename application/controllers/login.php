<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function  __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
	} 

	public function index()
	{
		$data = array();
		$data['page_title'] = 'FIRS Admin Login';
		if($this->input->post('username')!='')
		{
			//print_r($_POST);
			//exit;
			$data['email']      = $this->input->post('username');
			$data['password']   = $this->input->post('password');		
			$result             = $this->user_model->login($data);
			
			if(!empty($result))
			{	
				$this->session->sess_expiration = '10'; //30 Minutes
				$this->session->sess_expire_on_close = 'true';
				$this->session->set_userdata('user_id', $result[0]['id']);
				if ($result[0]['user_status'] == 1) {
					$this->session->set_userdata('user', "ecommerce");
					$ecommerce_id = $this->user_model->ecommerce($result[0]['email']);
					
					$this->session->set_userdata('ecommerce_id', $ecommerce_id['api_key']);
				}
				$this->session->set_flashdata('success',"Login successful"); 
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error',"Please Enter Correct Email and Password");	
				redirect('login');
			}
		}
		$this->load->view('login',$data);
	}

	//vendor login
	public function vendor()
	{
		$data['ecommerce'] = $this->ecomerce_details();
		//echo "<pre>";print_r($data['ecommerce']); die;
		if ($this->input->post('username')!='') {
			$data['email']      = $this->input->post('username');
			$data['password']   = $this->input->post('password');

			$result             = $this->user_model->vendor_login($data);

			if ($result) {
				$this->session->sess_expiration = '10'; //30 Minutes
				$this->session->sess_expire_on_close = 'true';
				$this->session->set_userdata('user_id', $result['user_id']);
				$this->session->set_userdata('vendor_id', $result['Vendor_Id']);
				$this->session->set_userdata('ecommerce_Id', $result['Ecommerce_Id']);
				$this->session->set_flashdata('success',"Login successful");
				redirect('dashboard/vendor');
			}else{
				//$this->load->view('login_vendor',$data);
			}
		}

		$this->load->view('login_vendor',$data);
	}

	/**** Start  of function For logout of client ****/
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('vendor_id');
		$this->session->unset_userdata('vendor_username');
		$this->session->unset_userdata('vendor_orgid');
		$this->session->unset_userdata('vendor_ecid');
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('ecommerce_id');
		redirect(getUrl('login'));
	}

	/*********   End of function   ********/

	//getting ecommerce details
	private function ecomerce_details()
	{
		$ecommerce = $this->user_model->ecommerce_details();
		return $ecommerce;
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */