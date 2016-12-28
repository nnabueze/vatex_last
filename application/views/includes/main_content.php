<?php

$this->load->view('includes/header_main');

if ($user == "vendor") {
	$this->load->view('includes/vendor_sidebar'); 
	$this->load->view('includes/vendor_breadcrumbs'); 
}elseif ($user == "ecommerce") {

	$this->load->view('includes/ecommerce_sidebar'); 
	$this->load->view('includes/ecommerce_breadcrumbs'); 

}else{
	$this->load->view('includes/sidebar'); 
	$this->load->view('includes/breadcrumbs'); 
}


$this->load->view($page_content);
$this->load->view('includes/footer_main'); 

?>