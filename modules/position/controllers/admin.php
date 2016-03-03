<?php
class Admin extends Controller 
{
	function Admin()
	{
		parent::Controller();
        session_start();
         if  ($_SESSION['level']<>'ADM') 
             {
                redirect('login/user/index',301); }
        //$this->load->module('staff');
        $this->load->model('Josh_position');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Position";
        //database
        $data['records']=$this->Josh_position->selectRecords();
        
        //web system data 
        $data['module']='position';
        $data['main']='index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Position";
        //web system data 
        $data['module']='position';
        $data['main']='add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_position->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('position/admin/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Position Job"; 
        $data['records']=$this->Josh_position->getRecord($id);
        $data['code']=$data['records']['code'];
        $data['name']=$data['records']['name'];
        $data['description']=$data['records']['description'];
        //web system data 
        $data['module']='position';
        $data['main']='edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_position->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('position/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_position->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('position/admin/index',301);
	}
    
}    