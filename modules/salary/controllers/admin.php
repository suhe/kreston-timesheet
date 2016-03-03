<?php
class Admin extends Controller 
{
	function Admin()
	{
		parent::Controller();
        session_start();
        if  ($_SESSION['level']<>'ADM') 
             {
                redirect('login/user/index',301);
             }
        //$this->load->module('staff');
        $this->load->model('Josh_staff');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('status','Josh_status');
        $this->load->model('Josh_staff');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Staff";
        //database
        $data['records']=$this->Josh_staff->selectRecords();
        
        //web system data 
        $data['module']='staff';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Staff";
        //Database
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bindPos']=$this->Josh_status->selectRecords();
        //web system data 
        $data['module']='staff';
        $data['main']='admin/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_staff->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('staff/admin/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Profile Staff"; 
        $data['records']=$this->Josh_staff->getRecord($id);
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['photo']=$data['records']['photo'];
        $data['sex']=$data['records']['sex'];
        $data['job']=$data['records']['job_position'];
        $data['password']=$data['records']['password'];
        $data['day']= day($data['records']['birthday']); 
        $data['month']= month($data['records']['birthday']);
        $data['year']= year($data['records']['birthday']);
        $data['email']=$data['records']['email'];
        $data['address']=$data['records']['address'];
        $data['hp']=$data['records']['hp'];
        $data['city']=$data['records']['city'];
        $data['country']=$data['records']['country'];
        $data['pos_code']=$data['records']['pos_code'];
        $data['group_id']=$data['records']['group_id'];
        $data['name_p']=$data['records']['name_p'];
        $data['group_name']=$data['records']['group_name'];
        
        //web system data 
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bindPos']=$this->Josh_status->selectRecords();
        $data['module']='staff';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_staff->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('staff/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_staff->deleteRecord($id);
            $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('staff/admin/index',301);
	}
    
    
    
}    