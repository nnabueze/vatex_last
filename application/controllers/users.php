<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','basic_model'));
		$this->load->library('upload');
	    $this->load->helper(array('url'));
	} 
	
	/***** function for user listing ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'userlisting';
		$data['page_title'] = 'Admin User Listing';
		$data['user_listing'] = $this->user_model->user_listing();
		$data['page_content'] = '05_useradministration/list_user';
		$this->load->view('includes/main_content', $data);
	}
	
	public function listing()
	{		
		redirect(getUrl('users'));
	}
	/****** end of function *****/

	public function newuser()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();		
		if($this->input->post('email')!=''){			
			$username   = $this->input->post('username');
			$email      = $this->input->post('email');
			$first_name  = $this->input->post('firstname');
			$last_name   = $this->input->post('lastname');
			$user_group_id = $this->input->post('user_group');
			$password   = $this->input->post('password');
			$data['username']   = $username;
			$data['email']      = $email;
			$data['first_name']  = $first_name;
			$data['last_name']   = $last_name;
			$data['user_group_id'] = $user_group_id;
			$data['password']   = sha1(md5($password));
			$data['added_date']   = date('Y-m-d H:i:s');
			$user_exists = $this->user_model->user_exists($data['email'],$data['username']);
			if($user_exists>0){
				$this->session->set_flashdata('error',"Username/Email already exists"); 
				redirect(getUrl('users/newuser'));
			}else{
				$this->user_model->user_registration($data);
								
				//send out an email to new user profile
				//$link = ERCASCONNECT_ADMINPANEL_URL;
				$link = site_url();
				$data1['title']= 'Welcome to myFIRS-VATCollect Control Panel';
				$data1['htmlmsg'] = 'We are pleased to inform that a profile has been created for you on FIRS-VATCollect Portal. <br>Please see your login credentials as follows: <br/>Access URL: '.$link.'<br/>Login email address: '.$email.'<br/>Login password: '.$password.'<br/>Username - '.$username.'<br/><br />Please use the credentials for login to web application. <strong>Also please ensure you change your password from the default password sent</strong>.';
				$this->load->library('email');
				$this->email->from('noreply@klugandheimer.com', 'FIRS VATCollect Account Registration');
				$this->email->to($email);  
				$this->email->bcc('olufelasoyemi@gmail.com'); 
				$this->email->subject($data['title']);
				$this->email->set_mailtype("html");
				$msg = $this->load->view('hostinghtml',$data1,TRUE);
				$this->email->message($msg);
				$this->email->send();
				
				//send a notification to the creator too
				$data2['title']='FIRS VATCollect user profile successfully created!';
				$data2['htmlmsg'] = 'Please be informed that the user profile has been successfully created for the user profile as follows:<br/><br />Name - '.$first_name.' '.$last_name.'<br/>Email Address - '.$email.'<br />Username - '.$username.'<br />';
				$this->email->from('noreply@ercasng.com', 'FIRS VATCOllect Account Registration');
				$this->email->to('ercas@klugandheimer.com'); 
				$this->email->cc('olufela@ercasng.com'); 
				$this->email->subject($data2['title']);
				$this->email->set_mailtype("html");
				$msg2 = $this->load->view('hostinghtml',$data2,TRUE);
				$this->email->message($msg2);
				$this->email->send();
				
				$this->session->set_flashdata('success',"New user registered successfully.");
				redirect(getUrl('users'));
			}			
		}else{
		
		}
		
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'newuser';
		$data['page_title'] = 'Create New Admin User';
		$data['page_content'] = '05_useradministration/add_user';
		$this->load->view('includes/main_content', $data);
	}
	/****** end of function *****/

	/******* Edit User function ********/
	public function edit_user($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();		
		if($this->input->post('updateuser')!=''){
			$save = array();
			//if($this->input->post('password')!=''){
				//$save['password']   = sha1(md5($this->input->post('password')));
			//}			
			$save['username']  = $this->input->post('username');
			//$save['email']  = $this->input->post('email');
			$save['first_name']  = $this->input->post('firstname');
			$save['last_name']   = $this->input->post('lastname');
			$save['user_group_id'] = $this->input->post('user_group');
			$save['date_modified']   = date('Y-m-d H:i:s');
			$upd['id'] = $id;
			$this->basic_model->customupd('user',$save,$upd);
			$this->session->set_flashdata('success',"User profile edited successfully.");
			redirect(getUrl('users/edit_user/'.$id));
		}
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'userlisting';
		$data['page_title'] = 'Edit User Module';
		$data['user_detail'] = $this->user_model->user_detail($id);
		$data['page_content'] = '05_useradministration/edit_user';
		$this->load->view('includes/main_content', $data);
	}
	/****** EOF ******/
	
	public function profile(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$id = $this->session->userdata('user_id');
		$data = array();
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'profile';
		$data['uri_segment_3'] = 'userprofile';
		$data['page_title'] = 'Profile Management';
		$data['user_detail'] = $this->user_model->user_detail($id);
		$data['page_content'] = '05_useradministration/profile';
		$this->load->view('includes/main_content', $data);
	}
	
	public function editprofile()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$id = $this->session->userdata('user_id');
		$data = array();
		if($this->input->post('updateuser')!='')
		{
			$save = array();

			if($_FILES["pimg"]["name"] != '')
			{
				$uploads_dir = 'uploads/user_img';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$name = uniqid().$_FILES["pimg"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				/*
				$uploads_dir = '../uploads/user_img';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$name = uniqid().$_FILES["pimg"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				*/
				$save['profile_img'] = $name;
			}
				
			if($this->input->post('password')!=''){
				$save['password']   = sha1(md5($this->input->post('password')));
			}
					
			$save['first_name']  = $this->input->post('firstname');
			$save['last_name']   = $this->input->post('lastname');
			//$save['username']   = $this->input->post('username');	
			$save['date_modified']   = date('Y-m-d H:i:s');		
			$upd['id'] = $id;
			$this->basic_model->customupd('user',$save,$upd);
			$this->session->set_flashdata('success',"Profile edited successfully.");
			redirect(getUrl('users/profile'));
		}		
		
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'profile';
		$data['uri_segment_3'] = 'editprofile';
		$data['page_title'] = 'Profile Management';
		$data['user_detail'] = $this->user_model->user_detail($id);
		$data['page_content'] = '05_useradministration/profile_management';
		$this->load->view('includes/main_content', $data);
	}
	/*****  EOF ****/

	// delete user record for given id
    public function delete_user($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('user',$id);
		$this->session->set_flashdata('success',"User account deleted successfully.");
		redirect(getUrl('users'));
    }
	
	/*-----Userprivileges----*/
	public function privileges()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'privileges';
		$data['page_title'] = 'Usergroup/Privileges';
		$data['user_listing'] = $this->user_model->user_listing();
		$data['page_content'] = '05_useradministration/usergroup_privileges';
		$this->load->view('includes/main_content', $data);
	}
	/****** end of function *****/

	public function add_usergroup(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		if($this->input->post('user_group')!=''){
			$save = array();		
			$save['user_group']  = $this->input->post('user_group');
			$save['status']   = $this->input->post('user_group_status');		
			$lastid = $this->basic_model->savedata('user_group',$save);			
			$save['permissions']   = $this->input->post('permissions');	
			foreach($save['permissions'] as $permissions){
				$savedata = array();
				$savedata['user_group_id'] = $lastid;				
				$savedata['user_permissions'] = $permissions;
				$this->basic_model->savedata('user_group_permissions_setting',$savedata);							
			}
			$this->session->set_flashdata('success',"User Group Added successfully.");
			redirect(getUrl('users/privileges'));
		}
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'add_usergroup';
		$data['page_title'] = 'Add Usergroup/Privileges';
		$data['user_listing'] = $this->user_model->user_listing();
		$data['page_content'] = '05_useradministration/usergroup_privileges';
		$this->load->view('includes/main_content', $data);
	}
	
	public function edit_usergroup_privileges($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['user_group_dt'] = $this->user_group_model->user_group_detail($id);
		$data['usergr_permission_dt'] = $this->user_group_model->user_group_permissions_detail($id);
		if($this->input->post('user_group')!=''){
			$save = array();
			$save['user_group']  = $this->input->post('user_group');
			$save['status']   = $this->input->post('user_group_status');			
			$upd['id'] = $id;
			$this->basic_model->customupd('user_group',$save,$upd);
			$save['permissions']   = $this->input->post('permissions');	
			$this->user_group_model->delete_user_group_permissions($id);
			foreach($save['permissions'] as $permissions){
				$savedata = array();
				$savedata['user_group_id'] = $id;				
				$savedata['user_permissions'] = $permissions;
				$this->basic_model->savedata('user_group_permissions_setting',$savedata);							
			}
			$this->session->set_flashdata('success',"User Group edited successfully.");
			redirect(getUrl('users/privileges'));
		}	
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'users';
		$data['uri_segment_3'] = 'edit_usergroup_privileges';
		$data['page_title'] = 'Edit Usergroup/Privileges';
		$data['user_listing'] = $this->user_model->user_listing();
		$data['page_content'] = '05_useradministration/usergroup_privileges';
		$this->load->view('includes/main_content', $data);	
	}
	
	// delete user record for given id
    public function delete_usergroup_privileges($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('user_group',$id);
		$this->user_group_model->delete_user_group_permissions($id);
		$this->session->set_flashdata('success',"Usergroup Privileges deleted successfully.");
		redirect(getUrl('users/privileges'));
    }
	
	public function update_client($id)
	{	
		if($id!=NULL)
		{			
			$save = array();
			$save['first_name'] = stripslashes($this->input->post('firstname'));
			$save['last_name'] = stripslashes($this->input->post('lastname'));
			$save['email'] = stripslashes($this->input->post('email'));
			$save['client_name'] = stripslashes($this->input->post('client_name'));
			$save['password'] = stripslashes($this->input->post('business_type'));
			$data['date_modified']   = date('Y-m-d H:i:s');
			/*$save['company_logo'] = '';*/	
			
			if($_FILES["pimg"]["name"] != '')
			{
				$uploads_dir = 'uploads';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$name = uniqid().$_FILES["pimg"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$save['company_logo'] = $name;
			}
			else
			{
				$save['company_logo'] = '';	
			}
						
			$upd['id'] = $id;			
			$this->basic_model->customupd('client',$save,$upd);			
			$this->session->set_flashdata('success',"Client profile updated successfully.");
			//echo 'problem dey!';
			redirect(getUrl('clientadmin/edit_client/'.$id));
		}
		
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */