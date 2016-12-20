<?php

$this->load->view('includes/header_main');

if ($user == "vendor") {
	$this->load->view('includes/vendor_sidebar'); 
	$this->load->view('includes/vendor_breadcrumbs'); 
}else{
	$this->load->view('includes/sidebar'); 
	$this->load->view('includes/breadcrumbs'); 
}


$this->load->view($page_content);
$this->load->view('includes/footer_main'); 

?>