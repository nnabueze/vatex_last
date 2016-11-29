<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_management extends CI_Controller {

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
        $this->load->model(array('user_model','basic_model'));
		$this->load->library('upload');
	    $this->load->helper(array('url'));
	} 
	
	
	/***** Profile Management Function to change password & contact details *****/
	public function index(){
		if(!isAdminLoggedIn())
		{
			//redirect(getUrl('login'));
		}
		$id = $this->session->userdata('user_id');
		$data = array();
		if($this->input->post('email')!=''){
			$save = array();

			if($_FILES["pimg"]["name"] != ''){
			$uploads_dir = '../uploads/user_img';
			$tmp_name = $_FILES["pimg"]["tmp_name"];
			$name = uniqid().$_FILES["pimg"]["name"];
	        move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$save['user_img'] = $name;
			}
				
			if($this->input->post('password')!=''){
				$save['password']   = sha1(md5($this->input->post('password')));
			}
					
			$save['first_name']  = $this->input->post('firstname');
			$save['last_name']   = $this->input->post('lastname');			
			$save['mobile']     = $this->input->post('mobile');
			//$save['user_group_id'] = $this->input->post('user_group');
			$upd['id'] = $id;
			$this->basic_model->customupd('user',$save,$upd);
			$this->session->set_flashdata('success',"Profile edited successfully.");
			redirect(getUrl('profile_management'));
		}
		$data['page_title'] = 'User Profile Edit Module';
		$data['menu'] = 'profile_management';
		$data['user_detail'] = $this->user_model->user_detail($id);
		$this->load->view('profile_management',$data);
	}
	/*****  EOF ****/
}

/* End of file profile_management.php */
/* Location: ./application/controllers/profile_management.php */