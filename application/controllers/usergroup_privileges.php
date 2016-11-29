<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usergroup_privileges extends CI_Controller {

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
        $this->load->model(array('user_model','basic_model','user_group_model'));
		$this->load->library('upload');
	    $this->load->helper(array('url'));
	} 
	
	/***** function for user group listing ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
		}
		$data = array();
		$data['menu'] = 'user_privileges';
		$data['sub_menu'] = 'index';
		$data['page_title'] = 'User Group Listing Module';
		$data['user_listing'] = $this->user_model->user_listing();
		$this->load->view('usergroup_privileges',$data);
	}
	/****** end of function *****/

	public function add_usergroup(){
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
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
			redirect(getUrl('usergroup_privileges'));
		}
		$data['page_title'] = 'Add User Group Module';
		$data['menu'] = 'user_privileges';
		$data['sub_menu'] = 'index';
		$this->load->view('usergroup_privileges',$data);
	}
	
	public function edit_usergroup_privileges($id){
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
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
			redirect(getUrl('usergroup_privileges'));
		}
		$data['page_title'] = 'Edit User Group Privileges Module';
		$data['menu'] = 'user_privileges';
		$data['sub_menu'] = 'index';
		$this->load->view('usergroup_privileges',$data);		
	}
	
	// delete user record for given id
    public function delete_usergroup_privileges($id)
    {
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
		}
		$data = array();
		$this->basic_model->dele('user_group',$id);
		$this->user_group_model->delete_user_group_permissions($id);
		$this->session->set_flashdata('success',"Usergroup Privileges deleted successfully.");
		redirect(getUrl('usergroup_privileges'));
    }
	 


}

/* End of file users.php */
/* Location: ./application/controllers/users.php */