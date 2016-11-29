<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 * created by Ravi Prakash
	 */

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','vendor_model','basic_model'));
	} 
	
	public function index(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'client Listing Module';
		$data['vendor_listing'] = $this->vendor_model->vendor_listing();
		$this->load->view('vendor_listing',$data);
	
	}
	/***** function for user registration ******/

	public function add_vendor()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();		
		if($this->input->post('email')!=''){
			if($this->input->post('password') == $this->input->post('passwordConfirm')){
				if($_FILES["pimg"]["name"] != ''){
					$uploads_dir = 'uploads';
					$tmp_name = $_FILES["pimg"]["tmp_name"];
					$name = uniqid().$_FILES["pimg"]["name"];
					move_uploaded_file($tmp_name, "$uploads_dir/$name");
					$data['profile_image'] = $name;
				}
				$email = $this->input->post('email');
				$pwd = $this->input->post('password');
				$usernm = $this->input->post('username');
				$data['username']   = $this->input->post('username');
				$data['vendor_id']   = $this->input->post('vendor_id');
				$data['email']      = $this->input->post('email');
				$data['password']   = sha1(md5($this->input->post('password')));
				$data['firstname']  = $this->input->post('firstname');
				$data['lastname']   = $this->input->post('lastname');
				$data['mobile']     = $this->input->post('mobile');
				$data['ec_id'] = $this->input->post('ec_id');
				$data['prime_business_contact'] = $this->input->post('pbcontact');
				$user_exists = $this->vendor_model->username_exists($data['username']);
				if($user_exists>0){
					$this->session->set_flashdata('error',"Username already exists"); 
					redirect(getUrl('vendor/add_vendor'));
				}else{
					$this->vendor_model->vendor_registration($data);
					$save = array();
					$save['status']   = '1';
					$upd['vendor_id'] = $this->input->post('vendor_id');			
					$this->basic_model->customupd('vendor_to_ec_id',$save,$upd);	
					$data['title']='Welcome to Smart Admin!!!!';
					$link = site_url('login');
					$data['htmlmsg'] = 'We\'re so excited you joined us. Now see what\'s next.Your login credentials are as follows - <br/>Link - '.$link.'<br/>Email Address - '.$email.'<br/>Password - '.$pwd.'<br/>Username - '.$usernm.'<br/>Please use the credentials for login to web application.';
					$this->load->library('email');
					$this->email->from('noreply@ercasng.com', 'Demo Ercasng');
					$this->email->to('tenfoldweb@gmail.com'); 
					$this->email->subject($data['title']);
					$this->email->set_mailtype("html");
					$msg = $this->load->view('hostinghtml',$data,TRUE);
					$this->email->message($msg);
					$this->email->send();
					$this->session->set_flashdata('success',"User registered successfully.");
					redirect(getUrl('vendor/vendor_listing'));
				}
			}else{
				$this->session->set_flashdata('error',"Password not matched"); 
				redirect(getUrl('vendor/add_vendor'));
			}
		}
		$data['page_title'] = 'Vendor Registration Module';
		$this->load->view('add_vendor',$data);
	}
	/****** end of function *****/

	public function vendor_listing(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'client Listing Module';
		$data['vendor_listing'] = $this->vendor_model->vendor_listing();
		//print_R($data['vendor_listing']);
		$this->load->view('vendor_listing',$data);	
	}

	public function view_vendor($id){
		$data = array();
		$data['client_detail'] = $this->vendor_model->vendor_detail($id);
		$data['page_title'] = 'View Vatex Vendor ';		
		$this->load->view('view_vendor',$data);
	}

	public function edit_vendor($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['vendor_detail'] = $this->vendor_model->vendor_detail($id);
		if($this->input->post('editvendor')!='')
		{			
			$save = array();
			if($_FILES["pimg"]["name"] != ''){
				$uploads_dir = 'uploads';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$name = uniqid().$_FILES["pimg"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$save['profile_image'] = $name;
			}
			$save['username']   = $this->input->post('username');
			$save['email']      = $this->input->post('email');
			$save['firstname']  = $this->input->post('firstname');
			$save['lastname']   = $this->input->post('lastname');
			$save['mobile']     = $this->input->post('mobile');
			$save['ec_id'] = $this->input->post('ec_id');
			$save['prime_business_contact'] = $this->input->post('pbcontact');
			if($this->input->post('password')!=''){
				if($this->input->post('password')==$this->input->post('passwordConfirm')){
					$save['password']   = sha1(md5($this->input->post('password')));
				}
			}
			$upd['id'] = $id;
			$this->basic_model->customupd('vendors',$save,$upd);			
			$this->session->set_flashdata('success',"Vendor Updated successfully.");	
			redirect(getUrl('vendor'));
		}
		$data['page_title'] = 'Vendor Edit Module';		
		$this->load->view('edit_vendor',$data);
	}

	// delete client record for given id
    public function delete_vendor($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('vendors',$id);
		$this->session->set_flashdata('success',"vendor deleted successfully.");
		redirect(getUrl('vendor'));
    }

	public function login(){
		$data = array();
		$data['page_title'] = 'Vendor Login Module';		
		if($this->input->post('username')!=''){
			$data['username']      = $this->input->post('username');
			$data['password']   = $this->input->post('password');		
			$result             = $this->vendor_model->vendor_login($data);
		//	print_R($result);exit;
			if(!empty($result))
			{
				$this->session->set_userdata('vendor_id', $result[0]['id']);
				$this->session->set_userdata('vendor_ecid', $result[0]['ec_id']);
				$this->session->set_userdata('vendor_orgid', $result[0]['vendor_id']);
				$this->session->set_userdata('vendor_username', $result[0]['username']);
				
				$this->session->set_flashdata('success',"Login Successfully"); 
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error',"Please Enter Correct Email And Password");	
				redirect('vendor/login');
			}
		}
		
		$this->load->view('vendor_login',$data);
	
	}


}
/* End of file vendor.php */
/* Location: ./application/controllers/vendor.php */