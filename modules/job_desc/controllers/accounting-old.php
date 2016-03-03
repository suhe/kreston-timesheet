<?php
class Accounting extends Controller 
{
	function Accounting()
	{
		parent::Controller();
        session_start();
         if( (isset($_SESSION['level'])== 'M') OR (isset($_SESSION['level'])== 'ACC')  ){
               //redirect('job_desc/accounting/index/',301);
         }
         else {
                redirect('login/user/index',301);
         }    
        $this->load->module_model('staff','Josh_staff');
        $this->load->model('Josh_job');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('client','Josh_company');
        $this->load->helper('date');            	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Job Desc";
        //database
        $data['records']=$this->Josh_job->selectRecords();
        
        //web system data 
        $data['module']='job_desc';
        $data['main']='accounting/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Job Desc";
        //web system data 
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['module']='job_desc';
        $data['main']='accounting/add';
        //binding data client
		$data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bind'] = $this->Josh_company->selectRecords();
        $data['bind2'] = $this->Josh_staff->selectRecords();  
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_job->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('job_desc/accounting/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Job Desc"; 
        $data['records']=$this->Josh_job->getRecord($id);
        $data['code']=$data['records']['code'];
        $data['name']=$data['records']['name'];
        $data['remarks']=$data['records']['remarks'];
        $data['description']=$data['records']['description'];
        $data['check']=$data['records']['check'];
        $data['group_id']=$data['records']['group_id'];
        $data['group_name']=$data['records']['group_name'];
        $data['sp']=$data['records']['SP'];
        $data['pc']=$data['records']['PC'];
        $data['sm']=$data['records']['SM'];
        $data['m']=$data['records']['M'];
        $data['am']=$data['records']['AM'];
        $data['s2']=$data['records']['S2'];
        $data['s1']=$data['records']['S1'];
        $data['as']=$data['records']['AS'];
        $data['ta']=$data['records']['TA'];
        //
        $data['hrd']=$data['records']['HRD'];
        $data['hrd_name']=$data['records']['HRD_name'];
        
        $data['partner']=$data['records']['Partner'];
        $data['partner_name']=$data['records']['Partner_name'];
        
        $data['sn_manager']=$data['records']['Senior_Manager'];
        $data['sn_manager_name']=$data['records']['Senior_Manager_name'];
        
        $data['manager']=$data['records']['Manager'];
        $data['manager_name']=$data['records']['Manager_name'];
        
        $data['ass_manager']=$data['records']['Ass_Manager'];
        $data['ass_manager_name']=$data['records']['Ass_Manager_name'];
        
        $data['senior']=$data['records']['Senior'];
        $data['senior_name']=$data['records']['Senior_name'];
        
        $data['s1']=$data['records']['S1'];
        $data['as']=$data['records']['AS'];
        $data['ta']=$data['records']['TA'];
        //web system data 
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bind2'] = $this->Josh_staff->selectRecords(); 
        $data['module']='job_desc';
        $data['main']='accounting/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_job->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update  Succesfully !</div>');
        redirect('job_desc/accounting/index',301);          		
	}
    
    function status_active($id){
        $this->Josh_job->active($id);
        $this->session->set_flashdata('message','<div class=" message success"> Update Status Active Succesfully !</div>');
        redirect('job_desc/accounting/index',301); 
    }
    
    function status_deactive($id){
        $this->Josh_job->deactive($id);
        $this->session->set_flashdata('message','<div class=" message success"> Update Status Active Succesfully !</div>');
        redirect('job_desc/accounting/index',301); 
    }
    
    function drop($id)
	{
		$this->Josh_job->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('job_desc/accounting/index',301);
	}
    
}    