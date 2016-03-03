<?php
class User extends Controller {
	function User() {
        parent::Controller();
	    ob_start();
        session_start();
	    ob_end_clean();	
        $this->load->model('Login');
        $this->load->library('encrypt');
	}
    
    function index(){
        $data['title']="Login Staff";
        $data['module']='login';
        $data['main']='login';      
        $this->load->vars($data);
		$this->load->template('login');
    }
     
	public function do_login(){
	    $u = $this->input->xss_clean($_POST['no']);
        $pw = $this->input->xss_clean($_POST['password']);
		$row = $this->Login->verifyUser($u,$pw);
		if(count($row)){
	   $_SESSION['no']	=	$this->input->xss_clean($row['no']);
           $_SESSION['name']	=	$this->input->xss_clean($row['name']);
           $_SESSION['level']	=	$this->input->xss_clean($row['pos_code']);
           $_SESSION['pos']	    =	$this->input->xss_clean($row['name_p']);
           $_SESSION['group']	=	$this->input->xss_clean($row['group_id']);
           $_SESSION['order']	=	$this->input->xss_clean($row['order']);
           $_SESSION['sign']	=	$this->input->xss_clean($row['signature']);
	   $_SESSION['division']=	$this->input->xss_clean($row['division']);
		   
		   //check group
		   if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='ADM') ){
		   		$_SESSION['manager'] =  "no";
		   } else {
				$log = $this->Login->searchManager($_SESSION['group']);
				$_SESSION['manager'] = isset($log)? $this->input->xss_clean($log['no']) : "";
		   }
		   $auth = array(
				'division'=>$this->input->xss_clean($row['division'])
			);
		   $this->session->set_userdata($auth);	
		   
		   $lv=$_SESSION['level'];
            		switch($lv) {
				case "P"    : $this->menu_p();break; //for Partner
                case "SM"   : $this->menu_sm();break; //for Manager
				case "M"    : $this->menu_m();break; //for Manager
				case "AM"   : $this->menu_am();break; //for Assistant MANAGER
				case "S2"   : $this->menu_s2();break; //For Senior 2 
				case "S1"   : $this->menu_s1();break; //For Senior 1 
				case "AS"   : $this->menu_as();break;//for Assistant Senior 
				case "TA"   : $this->menu_ta();break; //for Technical Assistant (Lower Worker)
                case "MG"   : $this->menu_mg();break; //for Technical Assistant (Lower Worker)        
				case "ADM"  : $this->menu_adm();break; //for Admin / Manager In Charge
				case "HRD"  : $this->menu_hrd();break; //for HRD
				case "IT"   : $this->menu_it();break; //for IT
				case "ACC"  : $this->menu_acc();break; //for Accounting    
           } 
			redirect('social/user/dashboard',301);
		
		}
		else {
			$this->session->set_flashdata('error_msg','NIK OR Password Wrong , Please Try Again !');
			redirect('/',301);
		}
    }
	
	/**
	<a href=".base_url()."overtime/manage/index>M.Overtime</a>|
	*/
	public function menu_p()
	{
		$_SESSION['menu']="
			<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."job_desc/user/approval>My Job</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
                        <a href=".base_url()."time_report/manage/index>M.Time Report</a>|
			<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
	}
    
    public function menu_sm()
    {
		$_SESSION['menu']="
			<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."job_desc/user/approval>My Job</a>|
                        <a href=".base_url()."staff/user/index>My Staff</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
                        <a href=".base_url()."time_report/admin/index>M.Staff</a>|
                        <a href=".base_url()."time_report/manage/index>M.Time Report</a>|
			<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }

	public function menu_m()
    {
		$_SESSION['menu']="
			<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."job_desc/user/approval>My Job</a>|
                        <a href=".base_url()."staff/user/index>My Staff</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
                        <a href=".base_url()."time_report/manage/index>M.Time Report</a>|
			<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }
	
	public function menu_am(){
		$_SESSION['menu']="
			<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."job_desc/user/approval>My Job</a>|
                        <a href=".base_url()."staff/user/index>My Staff</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
			<a href=".base_url()."time_report/manage/index>M.TimeReport</a>|
			<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }
	
	public function menu_s2(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|                           
						<a href=".base_url()."job_desc/user/approval>My Job Setup</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
                        <a href=".base_url()."time_report/manage/index>M.TimeReport</a>|					
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }
	
	public function menu_s1(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|                 
                        <a href=".base_url()."job_desc/user/approval>My Job Setup</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
                        <a href=".base_url()."time_report/manage/index>M.TimeReport</a>|
						<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
                       
    }
    
    public function menu_as(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."job_desc/user/approval>My Job Setup</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
						<a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";                      
    }
	
    public function menu_ta(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|                 
                        <a href=".base_url()."job_desc/user/approval>My Job Setup</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }
     
    public function menu_mg(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|               
                        <a href=".base_url()."job_desc/user/approval>My Job</a>|
                        <a href=".base_url()."staff/user/index>My Friend</a>|
                        <a href=".base_url()."time_report/user/index>My TimeReport</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }
    
    public function menu_adm(){
		$_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
						<a href=".base_url()."home/user/index>My Profile</a>|                 
                        <a href=".base_url()."client/user/index>Client</a>|
                        <a href=".base_url()."status/admin/index>Status</a>|
                        <a href=".base_url()."group/admin/index>Group</a>|
                        <a href=".base_url()."staff/admin/index>Staff</a>|
				        <a href=".base_url()."holiday/admin/index>Holiday</a>|
                        <a href=".base_url()."client/admin/index>Client</a>|
                        <a href=".base_url()."job_desc/admin/index>Job Setup</a>|
                        <a href=".base_url()."overtime/admin/index>Overtime</a>|
                        <a href=".base_url()."time_report/admin/index>Time Report</a>|
                        <a href=".base_url()."transport/admin/index>Transport</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
    }	
    
	function menu_hrd(){
	    if($_SESSION['division']=='Kuningan'):   
            $_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."client/accounting/index>Client</a>|
                        <a href=".base_url()."job_desc/accounting/index>Job Setup</a>|
                        <a href=".base_url()."staff/hrd/index>Staff</a>|
				        <a href=".base_url()."holiday/hrd/index>Holiday</a>|
                        <a href=".base_url()."time_report/hrd/index>Time Rport</a>|
						<a href=".base_url()."salary/accounting/basic>Basic Salary</a>|
						<a href=".base_url()."salary/accounting/payroll>Payroll</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>"; 
         else:
            $_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."client/accounting/index>Client</a>|
                        <a href=".base_url()."job_desc/accounting/index>Job Setup</a>|
                        <a href=".base_url()."staff/hrd/index>Staff</a>|
                        <a href=".base_url()."time_report/hrd/index>Time Report</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";
         endif;                           						
     }
     
     function menu_acc(){
        $_SESSION['menu']="
						<a href=".base_url()."social/user/index>Home</a>|
                        <a href=".base_url()."home/user/index>My Profile</a>|
                        <a href=".base_url()."staff/user/index>Staff</a>|
                        <a href=".base_url()."job_desc/accounting/index>Job Setup</a>|
                        <a href=".base_url()."salary/accounting/payroll>Payroll</a>|
                        <a href=".base_url()."salary/accounting/staff_check>Export Transport</a>|
				        <a href=".base_url()."home/user/password>Change Password</a>|
                        <a href=".base_url()."login/user/logout>Log Out</a>";               
     }
     
     function logout() {    
         unset($_SESSION['no']);
		 unset($_SESSION['division']);
         unset($_SESSION['name']);
         unset($_SESSION['level']);
         unset($_SESSION['pos']);
         unset($_SESSION['group']);
         unset($_SESSION['order']);
         unset($_SESSION['sign']);
         unset($_SESSION['tr_code']);
         redirect('login/user/index',301);
     }
}    
