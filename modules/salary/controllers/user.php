<?php
class User extends Controller 
{
	function User()
	{
	  parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) ){
                redirect('login/user/index',301);}
        //$this->load->module('staff');
        $this->load->module_model('salary','Josh_sallary');
        $this->load->module_model('status','Josh_status');
        $this->load->module_model('staff','Josh_staff');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        $data['title']='Salary Per User';
        $data['records']=$this->Josh_sallary->selectRecordPeriodePayroll($_SESSION['no']);
        //web system data 
        $data['module']='salary';
        $data['main']='user/index';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
	
	function print_out($periode,$staff)
    {
        $data['title']=$periode .','.$staff;
		//load staff
        $data['records']=$this->Josh_staff->getRecord($staff);
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['periode']=$periode;
        $data['records']=$this->Josh_sallary->selectRecordUserPayroll($periode,$staff);
        //web system data 
        //$data['bindGroup']=$this->Josh_group->selectRecords();
        //$data['bindPos']=$this->Josh_status->selectRecords();
        //$data['module']='salary';
        //$data['main']='accounting/staff';
        //template data
        $this->load->vars($data);
		$this->load->template('basic_salary'); 
    }
    
}    
