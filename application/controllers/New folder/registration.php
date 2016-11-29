<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

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
        $this->load->model('user_model');
	} 
	
	/***** function for user registration ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();		
		if($this->input->post('email')!=''){
			$email = $this->input->post('email');
			$pwd = $this->input->post('password');
			$usernm = $this->input->post('username');
			$data['username']   = $this->input->post('username');
			$data['email']      = $this->input->post('email');
			$data['password']   = sha1(md5($this->input->post('password')));
			$data['first_name']  = $this->input->post('firstname');
			$data['last_name']   = $this->input->post('lastname');
			$data['mobile']     = $this->input->post('mobile');
			$data['user_group_id'] = $this->input->post('user_group');
			$user_exists = $this->user_model->user_exists($data['email'],$data['username']);
			if($user_exists>0){
				$this->session->set_flashdata('error',"Username/Email already exists"); 
				redirect(getUrl('registration'));
			}else{
				$this->user_model->user_registration($data);
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
				redirect(getUrl('users'));
			}			
		}else{
		
		}
		$data['page_title'] = 'Client User Registration Module';
		$this->load->view('registration',$data);
	}
	/****** end of function *****/
}

/* End of file registration.php */
/* Location: ./application/controllers/registration.php */