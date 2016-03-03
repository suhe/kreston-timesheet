<?php
class User extends Controller 
{
	function User()
	{
		parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) )
             { redirect('login/user/index',301); }
        $this->load->model('Josh_company');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Client";
        //database
        $data['records']=$this->Josh_company->selectRecords();
        //web system data 
        $data['module']='client';
        $data['main']='user/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
}    