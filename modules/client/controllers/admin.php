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
        
        $this->load->model('Josh_company');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Company Client";
        //database
        $data['records']=$this->Josh_company->selectRecords();
        
        //web system data 
        $data['module']='client';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Client";
        //web system data 
        $data['module']='client';
        $data['main']='admin/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_company->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('client/admin/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Profile Staff"; 
        $data['records']=$this->Josh_company->getRecord($id);
        $data['code']=$data['records']['code'];
        $data['name']=$data['records']['name'];
        $data['sector']=$data['records']['sector'];
        $data['email']=$data['records']['email'];
        $data['address']=$data['records']['address'];
        $data['city']=$data['records']['city'];
        $data['country']=$data['records']['country'];
        //web system data 
        $data['module']='client';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_company->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('client/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_company->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('client/admin/index',301);
	}
    
}    