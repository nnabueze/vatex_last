<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biller extends CI_Controller {

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
		$data['page_title'] = 'Biller Listing Module';
		$data['biller_listing'] = $this->biller_model->biller_listing();
		$this->load->view('biller',$data);
	}
	/****** end of function *****/

	/***** function for biller registration ******/

	public function add_biller()
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
				$data['company_logo'] = $name;
			}
			$data['creatorId']   = $this->input->post('creatorId');
			$data['biller_username']   = $this->input->post('username');
			$data['email_address']      = $this->input->post('email');
			$data['password']   = sha1(md5($this->input->post('password')));
			$data['name']  = $this->input->post('firstname');
			$data['mobile']     = $this->input->post('mobile');
			$data['company_name'] = $this->input->post('company_name');
			$data['alternative_mobile'] = $this->input->post('alternative_mobile');
			$data['biller_acronymn'] = $this->input->post('biller_acronymn');
			if($this->input->post('service_bank_ebills')!=''){
				$data['service_bank_ebills'] = $this->input->post('service_bank_ebills');
			}
			if($this->input->post('service_cashpoint')!=''){
				$data['service_cashpoint'] = $this->input->post('service_cashpoint');
			}
			if($this->input->post('service_centralpay_ecommerce')!=''){
				$data['service_centralpay_ecommerce'] = $this->input->post('service_centralpay_ecommerce');
			}
			$data['merchantId_NIBSS']   = $this->input->post('merchantId');
			$data['billerDescription']   = $this->input->post('billerDescription');
			$data['billerAddress']   = $this->input->post('billerAddress');
			$data['date_added']   = date('Y-m-d H:i:s');
			$biller_exists = $this->biller_model->biller_exists($data['email_address'],$data['biller_username']);
			if($biller_exists>0){
				$this->session->set_flashdata('error',"Billername/Email already exists"); 
				redirect(getUrl('biller/add_biller'));
			}else{
				$this->biller_model->biller_registration($data);
				$this->session->set_flashdata('success',"Biller registered successfully.");
				redirect(getUrl('biller'));
			}			
		}
		$data['page_title'] = 'Biller Registration Module';
		$this->load->view('add_biller',$data);
	}
	/****** end of function *****/
	
	// delete biller record for given id
    public function delete_biller($id)
    {
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$this->basic_model->dele('biller',$id);
		$this->session->set_flashdata('success',"Biller deleted successfully.");
		redirect(getUrl('biller'));
    }

	public function edit_biller($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		if($this->input->post('accept')!=''){
			$save = array();
			$save['approverId'] = $this->input->post('approverId');
			$save['status'] = $this->input->post('accept');
			$save['comment'] = stripslashes($this->input->post('comment'));
			$save['approvedDate']   = date('Y-m-d H:i:s');
			$upd['id'] = $id;			
			$this->basic_model->customupd('biller',$save,$upd);			
			if($this->input->post('accept') =='1'){
				if($data['biller_detail'][0]->service_bank_ebills == '1'){
				$sql = "CREATE TABLE IF NOT EXISTS	`payment_collection_".$data['biller_detail'][0]->biller_acronymn."` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `billerID` varchar(255) NOT NULL,
						  `MerchantID` varchar(255) NOT NULL,
						  `TransactionID` varchar(255) NOT NULL,
						  `TransDate` datetime NOT NULL,
						  `PaidAmount` double(15,2) NOT NULL,
						  `SourceBank` varchar(255) NOT NULL,
						  `DestinationBank` varchar(255) NOT NULL,
						  `CustomerID` varchar(255) NOT NULL,
						  `CustomerName` varchar(255) NOT NULL,
						  `CustomerPhone` varchar(255) NOT NULL,
						  `CustomerEmail` varchar(255) NOT NULL,
						  `TransactionStatus` varchar(100) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
				$this->basic_model->updatesql($sql);
				}
				if($data['biller_detail'][0]->service_cashpoint == '1'){
					$sql1 = "CREATE TABLE IF NOT EXISTS `payment_pos_".$data['biller_detail'][0]->biller_acronymn."` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `billerID` varchar(255) NOT NULL,
							  `TransactionID` varchar(255) NOT NULL,
							  `TransDate` datetime NOT NULL,
							  `PaidAmount` double(15,2) NOT NULL,
							  `PaymentTerminalID` varchar(255) NOT NULL,
							  `DestinationBank` varchar(255) NOT NULL,
							  `CustomerID` varchar(255) NOT NULL,
							  `CustomerName` varchar(255) NOT NULL,
							  `CustomerPhone` varchar(100) NOT NULL,
							  `CustomerEmail` varchar(255) NOT NULL,
							  `TransactionStatus` varchar(100) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
					$this->basic_model->updatesql($sql1);			
				}
				if($data['biller_detail'][0]->service_centralpay_ecommerce == '1'){
					$sql2 = "CREATE TABLE IF NOT EXISTS `payment_ecommerce_".$data['biller_detail'][0]->biller_acronymn."` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `billerID` varchar(255) NOT NULL,
							  `MerchantID` varchar(255) NOT NULL,
							  `TransactionID` varchar(255) NOT NULL,
							  `TransDate` datetime NOT NULL,
							  `PaidAmount` double(15,2) NOT NULL,
							  `PaymentTerminalID` varchar(255) NOT NULL,
							  `DestinationBank` varchar(255) NOT NULL,
							  `CustomerID` varchar(255) NOT NULL,
							  `CustomerName` varchar(255) NOT NULL,
							  `CustomerPhone` varchar(100) NOT NULL,
							  `CustomerEmail` varchar(255) NOT NULL,
							  `TransactionStatus` varchar(100) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
					$this->basic_model->updatesql($sql2);			
				}
				$billerdt = $this->biller_model->biller_detail($id);
				$creatordt = $this->user_model->user_detail($billerdt[0]->creatorId);
				$approverdt = $this->user_model->user_detail($billerdt[0]->approverId);
				$pwdnew = uniqid();
				$alter = array();
				$save['password'] = sha1(md5($pwdnew));
				$upd['id'] = $id;
				$pwdupdt = $this->basic_model->customupd('biller',$save,$upd);
				$data['title']='Welcome to Smart Admin!!!!';
				$link = 'http://ravi-prakash.com/billermodule/login';
				$data['htmlmsg'] = 'We\'re so excited you joined us. Now see what\'s next.Your login credentials are as follows - <br/>Link - '.$link.'<br/>Email Address - '.$billerdt[0]->email_address.'<br/>Password - '.$pwdnew.'<br/>Username - '.$billerdt[0]->biller_username.'<br/>Please use the credentials for login to web application.';
				$this->load->library('email');
				$this->email->from('noreply@ercasng.com', 'Demo Ercasng');
				$this->email->to($billerdt[0]->email_address); 
				$this->email->subject($data['title']);
				$this->email->set_mailtype("html");
				$msg = $this->load->view('hostinghtml',$data,TRUE);
				$this->email->message($msg);
				$this->email->send();
				//Send mail to Creator & Approver User
				$data2['title']='Biller is approved successfully';
				$link = 'http://ravi-prakash.com/billermodule/login';
				$data2['htmlmsg'] = 'We\'re so excited to informed you that Biller is approved successfully. Now see what\'s next.Your login credentials are as follows - <br/>Company Name - '.$billerdt[0]->company_name.'<br/>Name - '.$billerdt[0]->name.'<br/>Email Address - '.$billerdt[0]->email_address;
				$this->email->from('noreply@ercasng.com', 'Demo Ercasng');
				$this->email->to($creatordt[0]->email); 
				$this->email->cc($approverdt[0]->email); 
				$this->email->subject($data['title']);
				$this->email->set_mailtype("html");
				$msg2 = $this->load->view('hostinghtml',$data2,TRUE);
				$this->email->message($msg2);
				$this->email->send();
				$this->session->set_flashdata('success',"Biller accepted successfully.");	
			}else{
				$this->session->set_flashdata('success',"Biller declined successfully.");
			}
			redirect(getUrl('biller'));
		}
		$data['page_title'] = 'Biller Edit Module';		
		$this->load->view('edit_biller',$data);
	}
	
	public function declined_biller(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Listing Module';
		$data['biller_listing'] = $this->biller_model->declined_biller_listing();
		$this->load->view('declined_biller',$data);	
	}

	public function approved_biller(){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Listing Module';
		$data['biller_listing'] = $this->biller_model->approved_biller_listing();
		$this->load->view('approved_biller',$data);	
	}

	public function edit_approved_biller($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Edit Module';
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		$this->load->view('edit_approved_biller',$data);
	}
	
	public function edit_declined_biller($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Edit Module';
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		$this->load->view('edit_declined_biller',$data);
	}

	public function biller_configuration($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['page_title'] = 'Biller Configuration Module';
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		$data['biller_services'] = $this->biller_model->approved_biller_configuration($id);
		$this->load->view('biller_configuration',$data);	
	}

	public function biller_configuration_change($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		
		$data = array();
		$data['page_title'] = 'Biller Table Configuration Module';
		$data['biller_detail'] = $this->biller_model->biller_detail($id);
		$data['biller_services'] = $this->biller_model->approved_biller_configuration($id);
		$servicetbl = $this->input->post('services');
		if (isset($_POST['show_structure'])) {
			$data['biller_id'] = $id;
			$data['servicedt'] = $this->biller_model->biller_services_table_structure($servicetbl);
			$data['alter_table_name'] = $servicetbl;
			$this->load->view('biller_configuration_tbl_structure',$data);			
		}
		elseif (isset($_POST['alter_table'])) {			
			$data['biller_id'] = $id;
			$data['alter_no'] = $this->input->post('alter_no');
			$data['alter_table_name'] = $servicetbl;
			$this->load->view('biller_configuration_tbl_alter',$data);
		}
	}
	
	public function alter_table($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		
		$data = array();
		$data['page_title'] = 'Biller Table Configuration Module';
		if($this->input->post('addfld')!=''){
			$biller_id = $this->input->post('biller_id');
			$i=1;
			$sqlstr = 'alter table '.$this->input->post('alter_table_name');
			while($i <= $this->input->post('alter_no')){
				$flnme = $this->input->post('fieldname_'.$i);
				$fldtype = $this->input->post('fld_type_'.$i);
				$typelngth = $this->input->post('fld_length_'.$i);
				if($flnme!= ''){
					if($fldtype!='DATE' && $fldtype!='DATETIME' && $fldtype!='TEXT'){
						$sqlstr .= ' add column '.$flnme.' '.$fldtype.'('.$typelngth.'),';
					}else{
						$sqlstr .= ' add column '.$flnme.' '.$fldtype.',';
					}
				}
				$i++;
			}
			$sql = substr($sqlstr, 0, -1);
			$this->basic_model->updatesql($sql);
			$this->session->set_flashdata('success',"Biller table altered successfully.");
			redirect(getUrl('biller/biller_configuration/'.$biller_id));
		}
		//$data['biller_detail'] = $this->biller_model->biller_detail($id);
	
	}
}

/* End of file biller.php */
/* Location: ./application/controllers/biller.php */