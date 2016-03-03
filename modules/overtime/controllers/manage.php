<?php 
class Manage extends Controller
{
    function Manage()
    {
        parent::Controller();
        session_start();
        if  (($_SESSION['level'] == 'HRD') OR ($_SESSION['level'] == 'P') OR ($_SESSION['level'] == 'S1') OR ($_SESSION['level'] == 'S2') OR ($_SESSION['level'] == 'AM') OR ($_SESSION['level'] == 'M') OR ($_SESSION['level'] == 'SM') ) :
        else:
			redirect('login/user/index',301);
		endif;	
        $this->load->model('Josh_time_report');
        $this->load->module_model('staff','Josh_staff');
        $this->load->module_model('job_desc','Josh_job');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->module_model('manager','Josh_manager');
        $this->load->helper('date');
    }
    
    function index(){
        $data['title']  =   "Manage Overtime For Manager";
        $data['records']=   $this->Josh_time_report->selectPeriodeRecord();
        $data['module']='overtime';
        $data['main']='manage/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function periode($id){
        unset($_SESSION['periode']);
        $_SESSION['periode']=   $id;
        $data['title']      =   "Manage Overtime";
        $data['records']    =   $this->Josh_time_report->selectManagePerPeriodeRecords($id);
        $data['module']     =   'overtime';
        $data['main']       =   'manage/staff';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function listing($id){
        $data['title']="Listing Overtime";
		$_SESSION['tr_code']=$id;
        $data['records']=$this->Josh_time_report->selectDetailAccRecords($id);
        $data['module']='overtime';
        $data['main']='manage/view2';
        $this->load->vars($data);
		$this->load->template('default');
    }
  
    function aproval(){ 
		//if($this->input->post('ov')<1):
			//$this->session->set_flashdata('message','<div class=" message success">Aproval Is Error Do not Zero !</div>');
			//redirect($this->input->server('HTTP_REFERER'),301); 
		//else:
			$this->Josh_time_report->approvalManagerAll();
			$this->session->set_flashdata('message','<div class=" message success">Update Aproval Is Succesfully!</div>');
			redirect($this->input->server('HTTP_REFERER'),301); 
		//endif;
		       		
	}
    
    function print_out($id){
        $data['title']      =   $id;
        $_SESSION['tr_code']=   $id;
        $data['record']     =   $this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']         =   $data['record']['no'];
        $data['name']       =   $data['record']['name'];
        $data['periode']    =   substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        $data['records']    =   $this->Josh_time_report->selectDetailsRecords($id);
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        $data['acc_approval']=$this->Josh_time_report->getACC_Approv($id);
        $data['acc_name']=$data['acc_approval']['acc_name'];
        $data['acc_signature']=$data['acc_approval']['acc_signature'];
        $this->load->vars($data);
		$this->load->template('overtime');
    }
    
}
