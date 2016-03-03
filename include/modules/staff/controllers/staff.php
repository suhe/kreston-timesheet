<?php
class Staff extends MY_Controller  
{
	function Staff()
	{
		parent::Controller();
        //$this->load->module('staff');
        //$this->load->Model('Josh_staff')
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Staff";
        //database
        //$data['records']=$this->Josh_staff->selectRecords();
        
        //web system data 
        $data['module']='staff';
        $data['main']='index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Staff";
        //$data['message']=$this->session->flashdata('message');
        //web system data 
        $data['module']='staff';
        $data['main']='add';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{
	    $this->Josh_staff->selectRecords(); 
        $this->Josh_staff->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('staff/index',301); 
             
       		
	}
    
}    