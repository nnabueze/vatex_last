<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biller_administration extends CI_Controller {

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
        $this->load->model(array('user_model','biller_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
	} 
	
	/***** function for biller listing ******/

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Administration Module';
		$data['biller_listing'] = $this->biller_model->approved_biller_listing();
		$this->load->view('biller_administration',$data);
	}
	/****** end of function *****/

	public function edit_biller($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		
		if($this->input->post('accept')!=''){
			$save = array();
			$save['approverId'] = $this->input->post('approverId');
			$save['status'] = $this->input->post('accept');
			$save['comment'] = stripslashes($this->input->post('comment'));
			$save['approvedDate']   = date('Y-m-d H:i:s');
			$upd['id'] = $id;
			$this->basic_model->customupd('biller',$save,$upd);
			$this->session->set_flashdata('success',"Biller edited successfully.");
			redirect(getUrl('biller'));
		}
		$data['page_title'] = 'Biller Edit Module';
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		$this->load->view('edit_biller',$data);
	}	
}

/* End of file biller_administration.php */
/* Location: ./application/controllers/biller_administration.php */