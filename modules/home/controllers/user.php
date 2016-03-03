<?php
class User extends Controller{
    
    function User(){
         parent::Controller();
         session_start(); 
         if (!ISSET($_SESSION['no'])):
            redirect('login/user/index',301);
         endif;  
         $this->load->module_model('staff','Josh_staff');  
         $this->load->helper('date');
         ini_set ('display_errors', 1);
		 error_reporting(E_ERROR | E_WARNING | E_PARSE);
    }
    
    function index(){
        $this->dashboard();    
    }
    
    function dashboard(){
        $data['title']  =   "Manage Profile";
        $data['records']=   $this->Josh_staff->myRecord();
        $data['module'] =   'home';
        $data['main']   =   'user/index';
        $this->load->vars($data);
        $this->load->template('default');
     }
     
     function edit(){
        $data['title']      =   "Edit My Profile";
        $data['records']    =   $this->Josh_staff->getRecord($_SESSION['no']);
        $data['no']         =   $data['records']['no'];
        $data['name']       =   $data['records']['name'];
        $data['nickname']   =   $data['records']['nickname'];
        $data['photo']      =   $data['records']['photo'];
        $data['sex']        =   $data['records']['sex'];
        $data['job']        =   $data['records']['job_position'];
        $data['password']   =   $data['records']['password'];
        $data['day']        =   day($data['records']['birthday']); 
        $data['month']      =   month($data['records']['birthday']);
        $data['year']       =   year($data['records']['birthday']);
        $data['email']      =   $data['records']['email'];
        $data['address']    =   $data['records']['address'];
        $data['hp']         =   $data['records']['hp'];
        $data['city']       =   $data['records']['city'];
        $data['country']    =   $data['records']['country'];
        $data['module']     =   'home';
        $data['main']       =   'user/edit';
        $this->load->vars($data);
		$this->load->template('default');
     }
	
     function password(){
        $data['records']    =   $this->Josh_staff->getRecord($_SESSION['no']);
        $data['no']         =   $data['records']['no'];
        $data['photo']      =   $data['records']['photo']; 
        $data['title']      =   "Setting Password";
        $data['module']     =   'home';
        $data['main']       =   'user/pass';
        $this->load->vars($data);
        $this->load->template('default');
     }
     
    function update(){ 
        $this->Josh_staff->updateSet();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('home/user/edit',301);          		
     }
    
    function updatepass(){ 
        $this->Josh_staff->updateSetPassword();
        $this->session->set_flashdata('message','<div class=" message success"> Update Password Succesfully !</div>');
        redirect('home/user/password',301);          		
    }

}
