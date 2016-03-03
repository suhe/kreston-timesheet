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
        $this->load->model('Josh_job');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('client','Josh_company');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Job Desc";
        //database
        $data['records']=$this->Josh_job->selectRecords();
        
        //web system data 
        $data['module']='job_desc';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Job Desc";
        //web system data 
        $data['module']='job_desc';
        $data['main']='admin/add';
        //binding data client
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bind'] = $this->Josh_company->selectRecords(); 
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_job->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('job_desc/admin/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Job Desc"; 
        $data['records']=$this->Josh_job->getRecord($id);
        $data['code']=$data['records']['code'];
        $data['name']=$data['records']['name'];
        $data['remarks']=$data['records']['remarks'];
        $data['description']=$data['records']['description'];
        $data['check']=$data['records']['check'];
        $data['group_id']=$data['records']['group_id'];
        $data['group_name']=$data['records']['group_name'];
        //web system data 
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['module']='job_desc';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_job->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('job_desc/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_job->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('job_desc/admin/index',301);
	}
    
}    