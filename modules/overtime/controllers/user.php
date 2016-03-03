<?php
class User extends Controller
{
    function User()
    {
        parent::Controller();
        session_start();
         if (!ISSET($_SESSION['no']) )
             {
                redirect('login/user/index',301);
             }
        $this->load->model('Josh_time_report');
        $this->load->module_model('job_desc','Josh_job');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->module_model('manager','Josh_manager');
        $this->load->helper('date');
    }
    
    function index()
    {
         //title
        //unset($_SESSION['tr_code']); 
        $data['title']="Manage Overtime";
        //database
        $data['records']=$this->Josh_time_report->selectRecords($_SESSION['no']);
        //web system data 
        $data['module']='overtime';
        $data['main']='user/index';
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    
    function listing($id)
    {
        $data['title']="Listing Overtime";
		$_SESSION['tr_code']=$id;
        //database
        $data['records']=$this->Josh_time_report->selectDetailAccRecords($id);
        //$data['total']=$this->Josh_time_report->total_transport($id);
        //$data['total']=$data['total']['transport'];
        //web system data 
        $data['module']='overtime';
        $data['main']='user/view2';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function saveOvertime()
	{ 
        $this->Josh_time_report->updateOvertimeUser();
        $this->session->set_flashdata('message','<div class=" message success"> Update Time Report Succesfully !</div>');
        redirect($this->input->server('HTTP_REFERER'));  
             		
	}
    
    function print_out($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        $no=$_SESSION['no'];
        $name=$_SESSION['name'];
        $data['no']=$no;
        $data['name']=$name;
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //database
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //Aproval By ACC
        $data['acc_approval']=$this->Josh_time_report->getACC_Approv($id);
        $data['acc_name']=$data['acc_approval']['acc_name'];
        $data['acc_signature']=$data['acc_approval']['acc_signature'];
        //web system data 
        //$data['module']='transport';
        //$data['main']='user/view2';
        
        //template data
        $this->load->vars($data);
		$this->load->template('overtime');
    }
}