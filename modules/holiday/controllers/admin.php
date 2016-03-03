<?php
class Admin extends Controller 
{
	function Admin()
	{
		parent::Controller();
        session_start();
        if ($_SESSION['level']<>'ADM') 
             {
                redirect('login/admin/index',301);
             }
        //$this->load->module('staff');
        $this->load->model('Josh_holiday');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Holiday";
        //database
        $data['records']=$this->Josh_holiday->selectRecords();
        
        //web system data 
        $data['module']='holiday';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Holday";
        //$data['bind'] = $this->Josh_staff->selectRecords(); 
        //web system data 
        $data['module']='holiday';
        $data['main']='admin/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_holiday->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('holiday/admin/index/',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Profile Manager";  
        $data['records']=$this->Josh_holiday->getRecord($id);
        $data['date']=$data['records']['date_h'];
        $data['description']=$data['records']['description_h'];
       
        //web system data 
        $data['module']='holiday';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_holiday->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('holiday/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_holiday->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('holiday/admin/index',301);
	}
    
    
    
}    