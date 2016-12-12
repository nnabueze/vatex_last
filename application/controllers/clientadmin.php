<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientadmin extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','client_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
	} 
	
	/***** function for client listing ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		redirect('clientadmin/listing');
	}
	
	public function listing()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'client Listing Module';
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'clientlisting';
		$data['client_listing'] = $this->client_model->client_listing();
		$data['page_content'] = '02_clientadmin/list_client';
		$this->load->view('includes/main_content', $data);
	}
	/****** end of function *****/

	

	/***** function for client registration ******/

	public function add_client()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		if($this->input->post('email')!=''){
			//echo "<pre>";print_R($_POST);exit;
			if($_FILES["pimg"]["name"] != ''){
			$uploads_dir = 'uploads';
			$tmp_name = $_FILES["pimg"]["tmp_name"];
			$name = uniqid().$_FILES["pimg"]["name"];
	        move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$data['profile_img'] = $name;
			}
			$data['creatorId']   = $this->session->userdata('user_id');
			$data['first_name']   = $this->input->post('firstname');
			$data['last_name']      = $this->input->post('lastname');
			$data['password']   = sha1(md5($this->input->post('password')));
			$data['email']  = $this->input->post('email');
			$data['username']     = $this->input->post('username');
			$data['mobile'] = $this->input->post('mobile');
			$data['added_date']   = date('Y-m-d H:i:s');
			$data['user_group_id'] = $this->input->post('usergroup');
			$data['status'] = 1;
			$data['companyname'] = $this->input->post('companyname');
			$data['clientbusiness'] = $this->input->post('clientbusiness');
			$data['pbcontact'] = $this->input->post('pbcontact');
			$data['amanager'] = $this->input->post('amanager');
			$data['amemail'] = $this->input->post('amemail');
			
			$client_exists = $this->client_model->client_exists($data['email'],$data['username']);
			if($client_exists>0){
				$this->session->set_flashdata('error',"clientname/Email already exists"); 
				redirect(getUrl('client/add_client'));
			}else{
				$clientid = $this->client_model->client_registration($data);
				$api_key = md5(uniqid(rand(), true));
				$tokenid = sha1(md5(uniqid(rand(), true)));
				$data = array();
				$data['user_id'] = $clientid;
				$data['api_key'] = $api_key;
				$data['token_id'] = $tokenid;
				$clientid = $this->client_model->add_client_settings($data);

				$this->session->set_flashdata('success',"client registered successfully.");
				redirect(getUrl('client'));
			}			
		}
		
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'clientadd';
		
		$data['page_title'] = 'client Registration Module';
		$this->load->view('add_client',$data);
	}
	
	public function create_new()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		if($this->input->post('contact_email')!='')
		{
			if($_FILES["pimg"]["name"] != '')
			{
				$uploads_dir = 'uploads';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$name = uniqid().$_FILES["pimg"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$data['company_logo'] = $name;
			}
			
			//$data['creatorId'] = $this->session->userdata('user_id');
			$data['client_name'] = $this->input->post('client_name');
			$data['unique_identifier'] = $this->input->post('unique_identifier');
			$data['contact_name'] = $this->input->post('contact_name');
			$data['contact_phone'] = $this->input->post('contact_phone');
			$data['contact_email'] = $this->input->post('contact_email');
			$data['business_type'] = $this->input->post('business_type');
			$data['client_name'] = $this->input->post('client_name');
			$data['date_created']   = date('Y-m-d H:i:s');
			$data['key_id']   = 'VA'.md5(uniqid(rand(), true));
			$data['status'] = 1;
			
			$client_exists = $this->client_model->client_exists($data['contact_email'],$data['client_name']);
			if($client_exists>0){
				$this->session->set_flashdata('error',"clientname/Email already exists"); 
				redirect(getUrl('clientadmin/create_new'));
			}else{
				$clientid = $this->client_model->client_registration($data);
				$api_key = $data['key_id'];
				$tokenid = sha1(md5(uniqid(rand(), true)));
				$data = array();
				$data['contact_email'] = $this->input->post('contact_email');
				$data['client_id'] = $clientid;
				$data['api_key'] = $api_key;
				$data['token_id'] = $tokenid;
				$clientid = $this->client_model->add_client_settings($data);

				$this->session->set_flashdata('success',"client registered successfully. API_KEY: ".$api_key);
				redirect(getUrl('clientadmin'));
			}			
		}
		
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'clientadd';
		
		$data['page_title'] = 'client Registration Module';
		//$this->load->view('add_client',$data);
		$data['page_content'] = '02_clientadmin/add_client';
		$this->load->view('includes/main_content', $data);
	}
	/****** end of function *****/
	
	// delete client record for given id
    public function delete_client($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('client',$id);
		$this->session->set_flashdata('success',"client deleted successfully.");
		redirect(getUrl('client'));
    }

	public function view_client($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['client_detail'] = $this->client_model->client_detail($id);
		$data['page_title'] = 'View ECommerce Provider';		
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'clientlisting';
		
		$data['page_content'] = '02_clientadmin/view_client';
		$this->load->view('includes/main_content', $data);
	}

	public function fundsweep_config($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['client_config_listing'] = $this->client_model->get_client_settings();
		if($id)
		{
			$data['client_detail'] = $this->client_model->get_client_settings($id);	
		}
		if($this->input->post('update_fs_configuration') != '')
		{
			$save = array();
			$save['sweep_execution_day'] = $this->input->post('sweep_execution_day');
			$save['vat_computation_hold'] = $this->input->post('vat_computation_hold');
						
			$upd['client_id'] = $id;			
			$this->basic_model->customupd('client_settings',$save,$upd);			
			$this->session->set_flashdata('success',"Client funds sweeping settings updated successfully.");
		
			redirect(getUrl('clientadmin/fundsweep_config'));
		}
		$data['page_title'] = 'Funds Sweep Settings';		
		
		$data['datatable'] = TRUE;
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'client_fundssweep_settings';
		
		$data['page_content'] = '02_clientadmin/fundssweep_settings';
		$this->load->view('includes/main_content', $data);
	}


	public function settings($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		if($id==''){ $id = $this->session->userdata('user_id');}
		//echo "<pre>";
		//print_r($_POST);
		//exit;
		if($this->input->post('editsettings')!=''){
				
				$save = array();
				$save['vat_execution_period'] = $this->input->post('execution_period');
				$save['vat_execution_mode'] = $this->input->post('vat_execution_mode');
				$upd['user_id'] = $id;			
				$this->basic_model->customupd('user_settings',$save,$upd);			
				$this->session->set_flashdata('success',"Settings Updated successfully.");
			//}

			redirect(getUrl('client/settings/'.$id));
		}

		$data = array();
		$data['user_id'] = $id;
		$data['settings'] = $this->client_model->get_client_settings($id);
		$data['page_title'] = 'View Vatex client ';		
		$this->load->view('clientsettings',$data);
	}

	public function edit_client($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		
		$data = array();
		$data['client_detail'] = $this->client_model->client_detail($id);
		if($this->input->post('updateclient'))
		{			
			$save = array();
			$save['contact_name'] = stripslashes($this->input->post('contact_name'));
			$save['unique_identifier'] = stripslashes($this->input->post('unique_identifier'));
			$save['contact_email'] = stripslashes($this->input->post('contact_email'));
			$save['contact_phone'] = stripslashes($this->input->post('contact_phone'));
			$save['client_name'] = stripslashes($this->input->post('client_name'));
			$save['business_type'] = stripslashes($this->input->post('business_type'));
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
		
		//else{echo 'what have i done wrong';}
		
		$data['formelements'] = TRUE;
		$data['uri_segment_2'] = 'clientadmin';
		$data['uri_segment_3'] = 'clientlisting';
		
		$data['page_title'] = 'Edit Client Profile';
		$data['page_content'] = '02_clientadmin/edit_client';
		$this->load->view('includes/main_content', $data);
	}
	
	public function update_client($id)
	{	
		if($id!=NULL)
		{			
			$save = array();
			$save['contact_name'] = stripslashes($this->input->post('contact_name'));
			$save['unique_identifier'] = stripslashes($this->input->post('unique_identifier'));
			$save['contact_email'] = stripslashes($this->input->post('contact_email'));
			$save['contact_phone'] = stripslashes($this->input->post('contact_phone'));
			$save['client_name'] = stripslashes($this->input->post('client_name'));
			$save['business_type'] = stripslashes($this->input->post('business_type'));
			$data['date_modified']   = date('Y-m-d H:i:s');
			/*$save['company_logo'] = '';*/	
			
			if($_FILES["pimg"]["name"] != '')
			{
				$uploads_dir = 'uploads/client_img';
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
	
	
	public function listclient(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		//$tblname = $_POST['tblnm'];
		$results = $this->client_model->get_cd_list('user');
		echo json_encode($results);
	}
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */