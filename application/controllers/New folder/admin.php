<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','client_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
	} 
	
	/***** function for admin listing ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['adminid'] = $this->session->userdata('user_id');
		$data['page_title'] = 'admin Listing Module';
		$data['admin_listing'] = $this->client_model->admin_listing();
		$this->load->view('admin',$data);
	}
	/****** end of function *****/

	

	/***** function for admin registration ******/

	public function add_admin()
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
			/*$data['companyname'] = $this->input->post('companyname');
			$data['adminbusiness'] = $this->input->post('adminbusiness');
			$data['pbcontact'] = $this->input->post('pbcontact');
			$data['amanager'] = $this->input->post('amanager');
			$data['amemail'] = $this->input->post('amemail');
			*/
			$admin_exists = $this->client_model->client_exists($data['email'],$data['username']);
			if($admin_exists>0){
				$this->session->set_flashdata('error',"adminname/Email already exists"); 
				redirect(getUrl('admin/add_admin'));
			}else{
				$adminid = $this->client_model->client_registration($data);
				$this->session->set_flashdata('success',"admin registered successfully.");
				redirect(getUrl('admin'));
			}			
		}
		$data['page_title'] = 'admin Registration Module';
		$this->load->view('add_admin',$data);
	}
	/****** end of function *****/
	
	// delete admin record for given id
    public function delete_admin($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('user',$id);
		$this->session->set_flashdata('success',"admin deleted successfully.");
		redirect(getUrl('admin'));
    }

	public function view_admin($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['admin_detail'] = $this->client_model->admin_detail($id);
		$data['page_title'] = 'View Vatex admin ';		
		$this->load->view('viewadmin',$data);
	}


	public function settings($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		//echo "<pre>";
		//print_r($_POST);
		//exit;
		if($this->input->post('editsettings')!=''){
				
				$save = array();
				$save['vat_execution_period'] = $this->input->post('execution_period');
				$upd['user_id'] = $id;			
				$this->basic_model->customupd('user_settings',$save,$upd);			
				$this->session->set_flashdata('success',"admin Updated successfully.");
			//}

			redirect(getUrl('admin'));
		}

		$data = array();
		$data['user_id'] = $id;
		$data['settings'] = $this->client_model->get_admin_settings($id);
		$data['page_title'] = 'View Vatex admin ';		
		$this->load->view('adminsettings',$data);
	}

	public function edit_admin($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['client_detail'] = $this->client_model->client_detail($id);
		if($this->input->post('editadmin')!='')
			{
			//print_r($_POST);
			//exit;
			
			$save = array();
			if($_FILES["pimg"]["name"] != ''){
			$uploads_dir = 'uploads';
			$tmp_name = $_FILES["pimg"]["tmp_name"];
			$name = uniqid().$_FILES["pimg"]["name"];
	        move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$save['profile_img'] = $name;
			}
			$save['first_name'] = stripslashes($this->input->post('firstname'));
			$save['last_name'] = stripslashes($this->input->post('lastname'));
			$save['username'] = stripslashes($this->input->post('username'));
			$save['email'] = stripslashes($this->input->post('email'));
			$save['mobile'] = stripslashes($this->input->post('mobile'));
					
			if($this->input->post('password')!=''){
				if($this->input->post('password')==$this->input->post('passwordConfirm')){
					$save['password']   = sha1(md5($this->input->post('password')));
				}
			}

			$upd['id'] = $id;			
			$this->basic_model->customupd('user',$save,$upd);			
				$this->session->set_flashdata('success',"admin Updated successfully.");
			//}
			redirect(getUrl('admin'));
		}
		$data['page_title'] = 'admin Edit Module';		
		$this->load->view('edit_admin',$data);
	}
	
	
	public function listadmin(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		//$tblname = $_POST['tblnm'];
		$results = $this->client_model->get_cd_list('user');
		echo json_encode($results);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */