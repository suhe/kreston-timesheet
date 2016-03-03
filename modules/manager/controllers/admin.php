<?php
class Admin extends Controller 
{
	function Admin()
	{
		parent::Controller();
        session_start();
        if ($_SESSION['no']<>'admin') 
             {
                redirect('login/admin/index',301);
             }
        //$this->load->module('staff');
        $this->load->model('Josh_manager');
        $this->load->module_model('staff','Josh_staff');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Manager";
        //database
        $data['records']=$this->Josh_manager->selectRecords();
        
        //web system data 
        $data['module']='manager';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Manager";
        $data['bind'] = $this->Josh_staff->selectRecords(); 
        //web system data 
        $data['module']='manager';
        $data['main']='admin/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_manager->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('manager/admin/',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Profile Manager"; 
        $data['bind'] = $this->Josh_staff->selectRecords(); 
        $data['records']=$this->Josh_manager->getRecord($id);
        $data['staff_no']=$data['records']['staff_no'];
        $data['status']=$data['records']['status'];
        $data['signature']=$data['records']['signature'];
        
        //web system data 
        $data['module']='manager';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_manager->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('manager/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_manager->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('manager/admin/index',301);
	}
    
    
    
}    