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
              
         $this->load->model('Josh_staff');  
         $this->load->helper('date');
    }
    
    function index()
    {
        $this->dashboard();    
    }
    
    function dashboard()
     {
        //title
        $data['title']="Manage Dashboard For Admin";
        //database
        //$data['records']=$this->Josh_staff->selectRecords($_SESSION['no']);
        
        //web system data 
        $data['module']='home';
        $data['main']='admin/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
     }
     
     function edit()
     {
        //title
        $data['title']="Edit Profile";
        //database
        $data['records']=$this->Josh_staff->getRecord();
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
        
        //web system data 
        $data['module']='home';
        $data['main']='user/edit';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
     }
     
     function update()
	 { 
        $this->Josh_staff->updateSet();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('home/user/edit',301);          		
	 }
}