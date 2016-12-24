<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/third_party/spreadsheet-reader-master/php-excel-reader/excel_reader2.php';
require APPPATH.'/third_party/spreadsheet-reader-master/SpreadsheetReader.php';

class Vat extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','vat1_model'));
	    $this->load->helper(array('url'));
	} 
	
	//test url for computing computed vat
	public function computed_vat()
	{

		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$vador = $this->vat1_model->vat();
	}

	//showing list of vatible products
	public function vatibles()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Efiling of Input VAT';
		$data['uri_segment_2'] = 'vatible';
		$data['uri_segment_3'] = 'vatible';
		$data['user'] = 'firs';
		$data['vatibles'] = $this->vat1_model->get_vatibles();

		$data['page_content'] = '03_transaction/vatible';
		$this->load->view('includes/main_content', $data);
	}

	//uploading of Non vatible product via CSV
	function importcsv() {

		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

	    $data['error'] = '';    //initialize image upload error array to empty
	
	    $config['upload_path'] = 'application/uploads/vat/';
	    $config['allowed_types'] = 'xlsx';
	    $config['max_size'] = '1000';

	    $this->load->library('upload', $config);
	
	
	    // If upload failed, display error
	    if (!$this->upload->do_upload()) {
	        $data['error'] = $this->upload->display_errors();
			$this->session->set_flashdata('error', $data['error']);
	        redirect(getUrl('vat/vatibles'));
	    } else {
	    	$data = array('upload_data' => $this->upload->data());
	    	$file_path = $data['upload_data']['full_path'];

	    	$Reader = new SpreadsheetReader($file_path);
	    	$i = 0;
	    	foreach ($Reader as $Row)
	    	{
	    		if ($i > 0) {
	    			$insert_data = array(
	    			    'product_category_id'=>$Row[0],
	    			    'product_category_name'=>$Row[1]
	    			);
	    			$this->vat1_model->insert_csv($insert_data);
	    		}
	    		$i++;
	    	}
	    	unlink($file_path);
	    	$this->session->set_flashdata('success',"Uploaded Successfully");
	    	redirect(getUrl('vat/vatibles'));
	
	    } 
	}

	//deleting vatible product from database
	public function vatible_delete($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		if ($result = $this->vat1_model->vatible_delete($id)) {
			$this->session->set_flashdata('success',"Record deleted");
			redirect(getUrl('vat/vatibles'));
		}

		$this->session->set_flashdata('error','Unable to delete record');
        redirect(getUrl('vat/vatibles'));
	}

	
}