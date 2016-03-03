<?php
class Admin extends Controller 
{
	function Admin()
	{
		parent::Controller();
        session_start();
        if  (($_SESSION['level']=='ADM') || ($_SESSION['level']=='ACC')  ) {
            }
        else {
            redirect('login/user/index',301);
        }
        //$this->load->module('staff');
        $this->load->model('Josh_group');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('staff','Josh_staff');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Group For HRD";
        //database
        $data['records']=$this->Josh_group->selectRecords();
        
        //web system data 
        $data['module']='Group';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Group";
        $data['bind'] = $this->Josh_staff->selectRecords(); 
        //web system data 
        $data['module']='group';
        $data['main']='admin/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_group->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('group/admin/index/',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Group Manager";  
        $data['records']=$this->Josh_group->getRecord($id);
        $data['id']=$data['records']['group_id'];
        $data['name']=$data['records']['group_name'];
        $data['bind'] = $this->Josh_staff->selectRecords();
        //web system data 
        $data['module']='group';
        $data['main']='admin/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_group->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('group/admin/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_group->deleteRecord($id);
            $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('group/admin/index',301);
	}
    
}    