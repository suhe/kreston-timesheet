<?php
class User extends Controller 
{
	function User()
	{
	  parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) ){
                redirect('login/user/index',301);}
        $this->load->model('Josh_staff');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('status','Josh_status');
        $this->load->model('Josh_staff');
        $this->load->helper('date');         	
	}
    
    function index()
    {
        //title
        $data['title']="My Staff";
        //database
        $data['records']=$this->Josh_staff->selectActiveRecords();
        
        //web system data 
        $data['module']='staff';
        $data['main']='user/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
}    