<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller {

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
		$data = array();
		$data['page_title'] = 'client Listing Module';
		$data['client_listing'] = $this->client_model->client_listing();
		$this->load->view('client',$data);
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
		$data['page_title'] = 'client Registration Module';
		$this->load->view('add_client',$data);
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
		$data['page_title'] = 'View Vatex client ';		
		$this->load->view('viewclient',$data);
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

	public function edit_client($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['client_detail'] = $this->client_model->client_detail($id);
		if($this->input->post('editclient')!='')
			{
			//print_r($_POST);
			//exit;
			
			$save = array();
			$save['first_name'] = stripslashes($this->input->post('firstname'));
			$save['last_name'] = stripslashes($this->input->post('lastname'));
			$save['username'] = stripslashes($this->input->post('username'));
			$save['email'] = stripslashes($this->input->post('email'));
			$save['mobile'] = stripslashes($this->input->post('mobile'));
			$save['companyname'] = stripslashes($this->input->post('companyname'));
			$save['clientbusiness'] = stripslashes($this->input->post('clientbusiness'));
			$save['pbcontact'] = stripslashes($this->input->post('pbcontact'));
			$save['amanager'] = stripslashes($this->input->post('amanager'));
			$save['amemail'] = stripslashes($this->input->post('amemail'));
					
			if($this->input->post('password')!=''){
				if($this->input->post('password')==$this->input->post('passwordConfirm')){
					$save['password']   = sha1(md5($this->input->post('password')));
				}
			}

			$upd['id'] = $id;			
			$this->basic_model->customupd('user',$save,$upd);			
				$this->session->set_flashdata('success',"client Updated successfully.");
			//}
			redirect(getUrl('client'));
		}
		$data['page_title'] = 'client Edit Module';		
		$this->load->view('edit_client',$data);
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