<?php

$this->load->view('includes/header_main');
$this->load->view('includes/sidebar'); 
$this->load->view('includes/breadcrumbs'); 
$this->load->view($page_content);
$this->load->view('includes/footer_main'); 

?>