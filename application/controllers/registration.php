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
		if(!$this->session->userdata('user_id'))
		{  
			redirect(getUrl('login'));
		}
        $this->load->model('user_model');
	} 
	
	/***** function for user registration ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
		}
		$data = array();		
		if($this->input->post('email')!=''){			
			$username   = $this->input->post('username');
			$email      = $this->input->post('email');
			$first_name  = $this->input->post('firstname');
			$last_name   = $this->input->post('lastname');
			$mobile     = $this->input->post('mobile');
			$user_group_id = $this->input->post('user_group');
			$password   = $this->input->post('password');
			$data['username']   = $username;
			$data['email']      = $email;
			$data['first_name']  = $first_name;
			$data['last_name']   = $last_name;
			$data['mobile']     = $mobile;
			$data['user_group_id'] = $user_group_id;
			$data['password']   = sha1(md5($password));
			$user_exists = $this->user_model->user_exists($data['email'],$data['username']);
			if($user_exists>0){
				$this->session->set_flashdata('error',"Username/Email already exists"); 
				redirect(getUrl('registration'));
			}else{
				$this->user_model->user_registration($data);
								
				//send out an email to new user profile
				//$link = ERCASCONNECT_ADMINPANEL_URL;
				$link = site_url();
				$data1['title']= 'Welcome to myERCASConnect Control Panel';
				$data1['htmlmsg'] = 'We are pleased to inform that a profile has been created for you on ERCASConnect. Your login credentials are as follows - <br/>Access URL: '.$link.'<br/>Login email address: '.$email.'<br/>Login password: '.$password.'<br/>Username - '.$username.'<br/><br />Please use the credentials for login to web application. <strong>Also please endeavor to change your password from the default password sent</strong>';
				$this->load->library('email');
				$this->email->from('noreply@ercasng.com', 'ERCASConnect Account Registration');
				$this->email->to($email);  
				$this->email->bcc('olufelasoyemi@gmail.com'); 
				$this->email->subject($data['title']);
				$this->email->set_mailtype("html");
				$msg = $this->load->view('hostinghtml',$data1,TRUE);
				$this->email->message($msg);
				$this->email->send();
				
				//send a notification to the creator too
				$data2['title']='ERCASConnect user is approved successfully';
				$data2['htmlmsg'] = 'Please be informed that the user profile has been successfully approved. Please see the user profile as follows:<br/><br />Name - '.$first_name.' '.$last_name.'<br/>Email Address - '.$email.'<br />Username - '.$username.'<br />';
				$this->email->from('noreply@ercasng.com', 'ERCASConnect Account Registration');
				$this->email->to('ercas@klugandheimer.com'); 
				$this->email->cc('olufela@ercasng.com'); 
				$this->email->subject($data2['title']);
				$this->email->set_mailtype("html");
				$msg2 = $this->load->view('hostinghtml',$data2,TRUE);
				$this->email->message($msg2);
				$this->email->send();
				
				$this->session->set_flashdata('success',"User registered successfully.");
				redirect(getUrl('users'));
			}			
		}else{
		
		}
		
		$data['menu'] = 'user_privileges';
		$data['sub_menu'] = 'create_user';
		$data['page_title'] = 'User Registration';
		$this->load->view('registration',$data);
	}
	/****** end of function *****/
}

/* End of file registration.php */
/* Location: ./application/controllers/registration.php */