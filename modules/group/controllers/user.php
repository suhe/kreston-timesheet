<?php
class User extends Controller 
{
	function User()
	{
		parent::Controller();
        session_start();
        if  (!isset($_SESSION['no'])) {
                redirect('login/user/index',301); }
        //$this->load->module('staff');
        $this->load->model('Josh_group');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('staff','Josh_staff');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Group";
        //database
        $data['records']=$this->Josh_group->selectRecords();
        //web system data 
        $data['module']='group';
        $data['main']='user/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
}    