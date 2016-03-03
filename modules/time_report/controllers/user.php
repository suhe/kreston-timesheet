<?php 
class User extends Controller
{
    function User(){
        parent::Controller();
        session_start();
         if (!ISSET($_SESSION['no']) ){
                redirect('login/user/index',301); }
		$this->load->module_model('staff','Josh_staff');			
        $this->load->model('Josh_time_report');
        $this->load->module_model('job_desc','Josh_job');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->module_model('manager','Josh_manager');
		$this->load->module_model('transport','Josh_transport');
        $this->load->helper('date');
    }
    
    function index(){
        $data['title']="Manage Time Report";
        $data['records']=$this->Josh_time_report->selectRecords($_SESSION['no']);
        $data['module']='time_report';
        $data['main']='user/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
	
	function requestapp($id){
		$this->Josh_time_report->status_manager($id); 
		$this->Josh_time_report->status_hrd($id);
		$this->session->set_flashdata('message','<div class=" message success">Change Status Succesfully !</div>');
		redirect('time_report/user/index');
	}
	
    function status_manager($id){
        $this->Josh_time_report->status_manager($id); 
        redirect('time_report/user/index');
    }
    
    function status_hrd($id){
        //$query = "SELECT COUNT(DISTINCT(date)) as total,SUM(time) as time FROM josh_details_day_tr WHERE tr_code='$id'";
        //$Q=$this->db->query($query);
        //$row=$Q->row_array();
        $this->Josh_time_report->status_hrd($id);
        //$this->session->set_flashdata('message','<div class=" message success">Change Status Succesfully !</div>');
		redirect($this->input->server('HTTP_REFERER'));
    }
	
    
    function delete_report($no,$code){
        $this->db->where('tr_code',$code);
        $this->db->where('staff_no',$_SESSION['no']);
        $this->db->delete('josh_head_tr');

        $this->db->where('tr_code',$code);
        $this->db->delete('josh_details_tr');
        
        $this->db->where('tr_code',$code);
        $this->db->delete('josh_details_day_tr');
        
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfull !</div>');
        redirect('time_report/user/index',301);
    }
    
    function add(){
        $data['title']="Create A New Time Report"; 
        $data['module']='time_report';
        $data['main']='user/add';
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save(){ 
        $this->Josh_time_report->saveRecord();
        $this->session->set_flashdata('message','<div class="message success"> Save Succesfully !</div>');
        redirect('time_report/user/',301);     		
	}
    
    function addjob(){
        $data['title']  =   "Create A New Job For Time Report";
        $data['bind']   =   $this->Josh_job->selectUserRecords(); 
        $data['module'] =   'time_report';
        $data['main']   =   'user/addjob';
        if(isset($_POST['go'])){
              $data['ringkasan'] = ''; 
              $data['ringkasan'] = $this->input->post('code');
              $this->session->set_userdata('sess_ringkasan', $data['ringkasan']);} 
        else {
	               $data['ringkasan'] = '';
        }
        $data['jobcode']=$data['ringkasan'];      
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function addnonjob(){
        $data['title']="Create A New Non Job For Time Report";
        $data['bind'] = $this->Josh_job->selectRecords(); 
        $data['module']='time_report';
        $data['main']='user/addnonjob';
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function saveJob(){ 
	    $job  = $this->input->post('job_code');
		$type = $this->input->post('type');
		$code = $_SESSION['tr_code'].'-'.$job.'-'.$type;
		$checkjob = $this->Josh_time_report->getJobtype($code);
		//echo 'isi'.$checkjob;
		if($checkjob ==""){
                $this->Josh_time_report->saveJob();
                $this->session->set_flashdata('message','<div class=" message success"> Your Job Setup Has Created !</div>');
                //echo $code;
				redirect('time_report/user/view/'.$_SESSION['tr_code'],301); 
            } else {
                $this->session->set_flashdata('message','<div class=" message success"> Your Job Setup Not Created , Your Job Is Already ! !</div>');
                redirect('time_report/user/view/'.$_SESSION['tr_code'],301); 
         }           		
	}
    
    function saveNonJob() { 
	   if($this->input->post('job_code')){
            $this->Josh_time_report->saveNonJob();
            $this->session->set_flashdata('message','<div class=" message success"> Save This Day Is Succesfully !</div>');
            redirect('time_report/user/view/'.$_SESSION['tr_code'],301); 
          }
        else {
                $this->session->set_flashdata('message','<div class=" message success"> Save This Day Is Succesfully !</div>');
                redirect('time_report/user/addnonjob/',301); 
         }                  		
	}

    function view_list($id=0){
        $this->db->where('tr_code',$id);
        $this->db->limit(1); 
        $QQ=$this->db->get('josh_head_tr');
        $row=$QQ->row_array();
        if(($row['status_manager']=='pending') OR ($row['status_manager']=='pending')):  
                redirect('time_report/user/view/'.$id);        
        else:
                $this->session->set_flashdata('message','<div class=" message error"> Sorry Your Report is process or Approval And Do Not delete or edit !</div>');
                redirect('time_report/user/index/',301);
        endif;
    }
    
    function view($id=0,$day='')
    {
	    if($day){
			$daytitle = 'WEEKEND & HOLIDAY';
		} else {
			$daytitle = 'WEEKDAY';
		}
	    $data['daytitle'] = $daytitle;
		$data['xday']  = $day;
        $this->db->where('tr_code',$id);
        $this->db->limit(1); 
        $QQ=$this->db->get('josh_head_tr');
        $row=$QQ->row_array();
        if(($row['status_manager']=='pending') AND ($row['status_hrd']=='pending')):          
        $data['title']="View Detailed Time Report";
        unset($_SESSION['tr_code']);
        $_SESSION['tr_code']=$id;
        $d = substr($id,9,2); 
        $m = substr($id,11,2);
        $y = substr($id,13,4);
		$y2 = $y;
		
		
        if($d=='05') {
			if($m == 1) {
				$m = 12;
			}
			else {
				$m = number_format($m) - 1;
			}
            
			$makhir = 5;
            $awal = 21;
			
			
            switch($m) {
                case '1' :  $akhir=31;break;
                case '2' :  $y % 4 == 0 ? $akhir = 29 : $akhir=28;break;
                case '3' :  $akhir=31;break;
                case '4' :  $akhir=30;break;
                case '5' :  $akhir=31;break;
                case '6' :  $akhir=30;break;
                case '7' :  $akhir=31;break;
                case '8' :  $akhir=31;break;
                case '9' :  $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
			$m2 = $m + 1;	
        }
		   
        else if($d=='20') {
            $akhir=20;
            $m=number_format($m,0);
            $makhir=0;
            $awal =6;
			$m2 = $m + 1; 
        }
		   
		else if($d=='15') {
            $akhir=15;
            $m=number_format($m,0);
            $makhir=0;
            $awal=1; 
			$m2 = $m+1; 
        }
		   
		else if($d=='28') {
            $akhir=28;
            $m=number_format($m,0);
            $makhir=0;
            $awal=16; 
			$m2 = $m+1; 
        }
		
		else if($d=='29') {
            $akhir=29;
            $m=number_format($m,0);
            $makhir=0;
            $awal=16; 
			$m2 = $m+1; 
        }
		
		else if($d=='30') {
            $akhir=30;
            $m=number_format($m,0);
            $makhir=0;
            $awal=16; 
			$m2 = $m+1; 
        }
		
		else if($d=='31') {
            $akhir=31;
            $m = number_format($m,0);
            $makhir=0;
            $awal=16; 
			$m2 = $m + 1; 
        }
		   
        $data['d']=$d;
        
		if($m <= 9){
			$m='0'.$m;
		} else{
			$m = $m;
		}
		
		if(($d=='05') && ($m == '12')) {
			$m2 = '01';
			$y = $y - 1;
			$y2 = $y2;
		}
		else if($m == '12') {
			$m2 = $m2 - 1;
		}
		
		//echo $m.'-'.$y;
		//echo $m2.'-'.$y2;
		
        $data['m'] = $m;
		$data['m2']= digitTwo($m2);
        $data['y'] = $y;
		$data['y2'] = $y2;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        $data['recapp']=$this->Josh_time_report->selectHeadRecord($id);
        $data['records']=$this->Josh_time_report->selectCHFDetailsRecords($id);
        $data['records2']=$this->Josh_time_report->selectCHODetailsRecords($id);
        $data['records3']=$this->Josh_time_report->selectNCHDetailsRecords($id);    
        $data['bind'] = $this->Josh_job->selectRecords();
        $data['module']='time_report';
        $data['main']='user/view2';
        $this->load->vars($data);
		$this->load->template('default');
        else:
             $this->session->set_flashdata('message','<div class=" message error"> Sorry Your Report is process or Approval And Do Not delete or edit !</div>');
             redirect('time_report/user/index/',301);
        endif; 
    }
    
    function saved()
	{
		
		$hour1     = $this->input->post('hour_1');
		$hour2     = $this->input->post('hour_2');
		$ov_start = $this->input->post('time_1');
		$ov_end   = $this->input->post('time_2');
		
		$min=0;
		$isa =  number_format(substr($hour1,0,2));
		$isb =  number_format(substr($hour2,0,2));
		for($i=$isa;$i<=$isb;$i++){
			if($i==12)
				$min=$min+1;
		}
		
		
		$time = selisih($hour1,$hour2);
		$time = $time - $min;
		
		if($time>8)
			$time = 8;
			
		//check max job setup
		//TR-10023-05012016-ACP001GA1215-CHF 
		$code = $this->input->xss_clean($this->input->post('code'));
		$data['job_code'] = substr($code,18,12);
		$data['time'] = $time;
		
		/**
		 * Ovebudget */
		$job_check = $this->Josh_time_report->getBudgetJobHour($data);
		
		if($job_check == false)
		{
			$this->session->set_flashdata('message','<div class=" message success"> You Job Setup does not any more budget please check over budget job setup from this url : <a href="'.base_url().'/report/user/maxjobhour'.'">Over Budget Report</a></div>');
			redirect($this->input->server('HTTP_REFERER'),301);	
		}
			
		$overtime = selisih($ov_start,$ov_end);
		$check = $this->Josh_time_report->checktimereport();
		$check = $check + $time;
		if($check<=8){
			$this->Josh_time_report->savetimereport();
			$this->session->set_flashdata('message','<div class=" message success"> time report has been updated !</div>');
		} elseif(($time==0) && ($overtime>0) ){
			$this->Josh_time_report->savetimereport();
			$this->session->set_flashdata('message','<div class=" message success"> time report has been updated !</div>');
		} else {
			$this->session->set_flashdata('message','<div class=" message success"> your time has been limited at 8 (eight) hour (normal work) !</div>');
		}	
		redirect($this->input->server('HTTP_REFERER'),301);
	}
	
	function edittime()
	{
		$this->Josh_time_report->cekdayUpdate();
        $this->session->set_flashdata('message','<div class=" message success"> Update This Day Is Succesfully But Manager Approval is empty !</div>');
        redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
	}
    
    function saveOvertime()
	{ 
        $this->Josh_time_report->saveDayOvertimeRecord();
        unset($_SESSION['month']);
        $this->session->set_flashdata('message','<div class=" message success"> Save This Day Is Succesfully !</div>');
        redirect('time_report/user/view/'.$_SESSION['tr_code'],301);         		
	}
    
    function delete_code($code){
        $user=substr($code,3,5);
        if(isset($_SESSION['no'])<> $user) {
            $this->session->set_flashdata('message','<div class=" message error"> You Do not Previleges to delete this Code !</div>');
        }
        else{
            //details day
            $this->db->where('day_code',$code);
            $this->db->delete('josh_details_tr');
            //details day tr
            $this->db->where('code',$code);
            $this->db->delete('josh_details_day_tr');
            $this->session->set_flashdata('message','<div class=" message success"> Delete This Day Is Succesfully But Manager Approval is empty !</div>');
            //redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
			redirect($this->input->server('HTTP_REFERER'),301);	
        }    
    }
    
    function delete_day($code,$date){
        $this->db->where('code',$code);
        $this->db->where('DAY(date)',$date);
        $this->db->delete('josh_details_day_tr');
        
        $data = array('staff_approval'=>'no','staff_signature'=>'','staff_approval2'=>'no','staff_signature2'=>'');
        $this->db->where('day_code',$code);
        $this->db->update('josh_details_tr',$data);
		
		//update job setup
		$job_code = substr($this->input->xss_clean($code),18,12);
		$pos = $_SESSION['level'];
		$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,$pos);
		$jobVal[$pos."_hour"] = $total_hour;
		if($jobVal && $pos && $job_code)
		{
			$this->db->where('code',$job_code);
			$this->db->update('josh_job',$jobVal);
		}
		
        
        $this->session->set_flashdata('message','<div class=" message success"> Delete This Day Is Succesfully But Manager Approval is empty !</div>');
        //redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
		redirect($this->input->server('HTTP_REFERER'),301);	
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
        //day
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //report for chf
        $data['chf']=$this->Josh_time_report->selectchf($id);
        //report for cho
        $data['cho']=$this->Josh_time_report->selectcho($id);
        //report for nch
        $data['nch']=$this->Josh_time_report->selectnch($id);
		//report for Overtime Approval
		$data['overtime']=$this->Josh_time_report->selectovertime($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //web system data 
        $data['module']='time_report';
        $data['main']='user/view';
        //template data
        $this->load->vars($data);
        //Menentukan Laporan Template
        $d=substr($id,9,2);
        $m=substr($id,11,2);
        $mm=substr($id,11,2);
		
		if($mm=='01'){
			$mn=12;
		}else{
			$mn=number_format($m)-1;
		}
        
        if ($mn<9){
            $mn='0'.$mn;
        } else {$mn=$mn;}
        
        if($d=='05') {
			if($mm=='01'){
			$m=12;
			}else{
			$m=number_format($m)-1;
			}
            $n=$m;
            
            $makhir=5;
            $awal=21;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=29;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
           $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']); 
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec22']['date_h']); 
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mn);
           $data['rec27']=day($data['rec27']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mn);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mn);
           $data['rec29']=day($data['rec29']['date_h']);
           //for 30
           $data['rec30']=$this->Josh_holiday->selectDay(30,$mn);
           $data['rec30']=day($data['rec30']['date_h']);
           //for 31
           $data['rec31']=$this->Josh_holiday->selectDay(31,$mn);
           $data['rec31']=day($data['rec31']['date_h']);
           //for 01
           $data['rec01']=$this->Josh_holiday->selectDay(01,$mm);
           $data['rec01']=day($data['rec01']['date_h']);
           //for 02
           $data['rec02']=$this->Josh_holiday->selectDay(02,$mm);
           $data['rec02']=day($data['rec02']['date_h']);
           //for 03
           $data['rec03']=$this->Josh_holiday->selectDay(03,$mm);
           $data['rec03']=day($data['rec03']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec04']=$this->Josh_holiday->selectDay(04,$mm);
           $data['rec04']=day($data['rec04']['date_h']); 
           //for 05
           $data['rec05']=$this->Josh_holiday->selectDay(05,$mm);
           $data['rec05']=day($data['rec05']['date_h']); 
           
           }
           elseif($d=='20') {
             $akhir=20;
             $awal=6;
             $makhir=0;
             $xawal=1;
             $xakhir=5; 
            //echo $mm; 
             //$data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$xawal,$xakhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$awal,$akhir);
           //for 21
           $data['rec06']=$this->Josh_holiday->selectDay('06',$mm);
           $data['rec06']=day($data['rec06']['date_h']); 
           //for 22
           $data['rec07']=$this->Josh_holiday->selectDay('07',$mm);
           $data['rec07']=day($data['rec07']['date_h']); 
           //for 23
           $data['rec08']=$this->Josh_holiday->selectDay('08',$mm);
           $data['rec08']=day($data['rec08']['date_h']);
           //for 24
           $data['rec09']=$this->Josh_holiday->selectDay('09',$mm);
           $data['rec09']=day($data['rec09']['date_h']);
           //for 25
           $data['rec10']=$this->Josh_holiday->selectDay('10',$mm);
           $data['rec10']=day($data['rec10']['date_h']);
           //for 26
           $data['rec11']=$this->Josh_holiday->selectDay('11',$mm);
           $data['rec11']=day($data['rec11']['date_h']);
           //for 27
           $data['rec12']=$this->Josh_holiday->selectDay('12',$mm);
           $data['rec12']=day($data['rec12']['date_h']);
           //for 28
           $data['rec13']=$this->Josh_holiday->selectDay('13',$mm);
           $data['rec13']=day($data['rec13']['date_h']);
           //for 29
           $data['rec14']=$this->Josh_holiday->selectDay('14',$mm);
           $data['rec14']=day($data['rec14']['date_h']);
           //for 30
           $data['rec15']=$this->Josh_holiday->selectDay('15',$mm);
           $data['rec15']=day($data['rec15']['date_h']);
           
           //for 01
           $data['rec16']=$this->Josh_holiday->selectDay('16',$mm);
           $data['rec16']=day($data['rec16']['date_h']);
           //for 02
           $data['rec17']=$this->Josh_holiday->selectDay('17',$mm);
           $data['rec17']=day($data['rec17']['date_h']);
           //for 03
           $data['rec18']=$this->Josh_holiday->selectDay('18',$mm);
           $data['rec18']=day($data['rec18']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec19']=$this->Josh_holiday->selectDay('19',$mm);
           $data['rec19']=day($data['rec19']['date_h']); 
           //for 05
           $data['rec20']=$this->Josh_holiday->selectDay('20',$mm);
           $data['rec20']=day($data['rec20']['date_h']); 
           
           }
		   
		 elseif($d=='15') {
            $akhir=15;
            $awal=1;
            $makhir=0;
            $xawal=1;
            $xakhir=5; 
            
			$data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$awal,$akhir);
			//for 01
			$data['rec01']=$this->Josh_holiday->selectDay('01',$mm);
			$data['rec01']=day($data['rec01']['date_h']); 
			//for 02
			$data['rec02']=$this->Josh_holiday->selectDay('02',$mm);
			$data['rec02']=day($data['rec02']['date_h']); 
			//for 03
			$data['rec03']=$this->Josh_holiday->selectDay('03',$mm);
			$data['rec03']=day($data['rec03']['date_h']);
			//for 04
			$data['rec04']=$this->Josh_holiday->selectDay('04',$mm);
			$data['rec04']=day($data['rec04']['date_h']);
			//for 05
			$data['rec05']=$this->Josh_holiday->selectDay('05',$mm);
			$data['rec05']=day($data['rec05']['date_h']);
			//for 06
			$data['rec06']=$this->Josh_holiday->selectDay('06',$mm);
			$data['rec06']=day($data['rec06']['date_h']);
			//for 07
			$data['rec07']=$this->Josh_holiday->selectDay('07',$mm);
			$data['rec07']=day($data['rec07']['date_h']);
			//for 08
			$data['rec08']=$this->Josh_holiday->selectDay('08',$mm);
			$data['rec08']=day($data['rec08']['date_h']);
			//for 09
			$data['rec09']=$this->Josh_holiday->selectDay('09',$mm);
			$data['rec09']=day($data['rec09']['date_h']);
			//for 10
			$data['rec10']=$this->Josh_holiday->selectDay('10',$mm);
			$data['rec10']=day($data['rec10']['date_h']);
			//for 11
			$data['rec11']=$this->Josh_holiday->selectDay('11',$mm);
			$data['rec11']=day($data['rec11']['date_h']);
			//for 12
			$data['rec12']=$this->Josh_holiday->selectDay('12',$mm);
			$data['rec12']=day($data['rec12']['date_h']);
			//for 13
			$data['rec13']=$this->Josh_holiday->selectDay('13',$mm);
			$data['rec13']=day($data['rec13']['date_h']);
			//for 14
			$data['rec14']=$this->Josh_holiday->selectDay('14',$mm);
			$data['rec14']=day($data['rec14']['date_h']); 
			//for 15
			$data['rec15']=$this->Josh_holiday->selectDay('15',$mm);
			$data['rec15']=day($data['rec15']['date_h']); 
        }

		elseif($d=='31') {
			if($mm=='01'){
			$m=12;
			}else{
			$m=number_format($m)-1;
			}
            $n=$m;
            
            $makhir=31;
            $awal=16;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=29;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
           $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 16
           $data['rec16']=$this->Josh_holiday->selectDay(16,$mn);
           $data['rec16']=day($data['rec16']['date_h']); 
           //for 17
           $data['rec17']=$this->Josh_holiday->selectDay(17,$mn);
           $data['rec17']=day($data['rec17']['date_h']); 
           //for 18
           $data['rec18']=$this->Josh_holiday->selectDay(18,$mn);
           $data['rec18']=day($data['rec18']['date_h']);
           //for 19
           $data['rec19']=$this->Josh_holiday->selectDay(19,$mn);
           $data['rec19']=day($data['rec19']['date_h']);
           //for 20
           $data['rec20']=$this->Josh_holiday->selectDay(20,$mn);
           $data['rec20']=day($data['rec20']['date_h']);
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']);
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec22']['date_h']);
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mm);
           $data['rec27']=day($data['rec27']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mm);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mm);
           $data['rec29']=day($data['rec29']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 30
           $data['rec30']=$this->Josh_holiday->selectDay(30,$mm);
           $data['rec30']=day($data['rec30']['date_h']); 
           //for 31
           $data['rec31']=$this->Josh_holiday->selectDay(31,$mm);
           $data['rec31']=day($data['rec31']['date_h']); 
           
        }
		
		elseif($d=='29') {
			if($mm=='01'){
			$m=12;
			}else{
			$m=number_format($m)-1;
			}
            $n=$m;
            
            $makhir=29;
            $awal=16;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=29;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
           $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 16
           $data['rec16']=$this->Josh_holiday->selectDay(16,$mn);
           $data['rec16']=day($data['rec16']['date_h']); 
           //for 17
           $data['rec17']=$this->Josh_holiday->selectDay(17,$mn);
           $data['rec17']=day($data['rec17']['date_h']); 
           //for 18
           $data['rec18']=$this->Josh_holiday->selectDay(18,$mn);
           $data['rec18']=day($data['rec18']['date_h']);
           //for 19
           $data['rec19']=$this->Josh_holiday->selectDay(19,$mn);
           $data['rec19']=day($data['rec19']['date_h']);
           //for 20
           $data['rec20']=$this->Josh_holiday->selectDay(20,$mn);
           $data['rec20']=day($data['rec20']['date_h']);
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']);
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec22']['date_h']);
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mm);
           $data['rec27']=day($data['rec27']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mm);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mm);
           $data['rec29']=day($data['rec29']['date_h']);
           
        }
		
		elseif($d=='30') {
			if($mm=='01'){
			$m=12;
			}else{
			$m=number_format($m)-1;
			}
            $n=$m;
            
            $makhir=30;
            $awal=16;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=29;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
           $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 16
           $data['rec16']=$this->Josh_holiday->selectDay(16,$mn);
           $data['rec16']=day($data['rec16']['date_h']); 
           //for 17
           $data['rec17']=$this->Josh_holiday->selectDay(17,$mn);
           $data['rec17']=day($data['rec17']['date_h']); 
           //for 18
           $data['rec18']=$this->Josh_holiday->selectDay(18,$mn);
           $data['rec18']=day($data['rec18']['date_h']);
           //for 19
           $data['rec19']=$this->Josh_holiday->selectDay(19,$mn);
           $data['rec19']=day($data['rec19']['date_h']);
           //for 20
           $data['rec20']=$this->Josh_holiday->selectDay(20,$mn);
           $data['rec20']=day($data['rec20']['date_h']);
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']);
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec22']['date_h']);
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mm);
           $data['rec27']=day($data['rec27']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mm);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mm);
           $data['rec29']=day($data['rec29']['date_h']);
		   
		   //for 30
           $data['rec30']=$this->Josh_holiday->selectDay(30,$mm);
           $data['rec30']=day($data['rec30']['date_h']);
           
        }
	   
        $data['m']=$m;
        $data['mm']=$mm;
        $data['mn']=$mn;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        $data['id']=$id;
        $this->load->vars($data);
		$d=trim($d);
        if (($d=='05') && ($akhir==30) && ($mm=='01')){
            $this->load->template('report_05_31');
        }        
        elseif (($d=='05') && ($akhir==31)){
            $this->load->template('report_05_31');
        }
                
        elseif(($d=='05') && ($akhir==30)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_30');
        }
		elseif(($d=='05') && ($akhir==28)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_28');
        }
		elseif(($d=='05') && ($akhir==29)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_29');
        }		
        elseif($d=='15'){
            //$this->load->template('laporan20');
            $this->load->template('report_15');
        }
		elseif($d=='29'){
            $this->load->template('report_29');
        }
		elseif($d=='30'){
            $this->load->template('report_30');
        }
		elseif($d=='31'){
            $this->load->template('report_31');
        }
		elseif($d=='20'){
            $this->load->template('report_20');
        }	
		else{
			echo 'x';
		}
    }
	
	function print_ov($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        
        /*
        $no=$_SESSION['no'];
        $name=$_SESSION['name'];
        $data['no']=$no;
        $data['name']=$name;
        */
        $data['record']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['record']['no'];
        $data['name']=$data['record']['name'];
        
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //database
        $data['records']=$this->Josh_time_report->selectDetailsRecords2($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //Aproval By ACC
        //$data['acc_approval']=$this->Josh_time_report->getACC_Approv($id);
        //$data['acc_name']=$data['acc_approval']['acc_name'];
        //$data['acc_signature']=$data['acc_approval']['acc_signature'];
        //web system data 
        //$data['module']='transport';
        //$data['main']='user/view2';
        
        //template data
        $this->load->vars($data);
		$this->load->template('overtime');
    }

    function print_transport($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        
        /*
        $no=$_SESSION['no'];
        $name=$_SESSION['name'];
        $data['no']=$no;
        $data['name']=$name;
        */
        $data['record']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['record']['no'];
        $data['name']=$data['record']['name'];

        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //database
        $data['records']=$this->Josh_transport->selectDetailAccRecords($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_transport->getADM_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_transport->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //Aproval By ACC
        //$data['acc_approval']=$this->Josh_time_report->getACC_Approv($id);
        //$data['acc_name']=$data['acc_approval']['acc_name'];
        //$data['acc_signature']=$data['acc_approval']['acc_signature'];
        //web system data 
        //$data['module']='transport';
        //$data['main']='user/view2';
        
        //template data
        $this->load->vars($data);
		$this->load->template('transport');
    }
    
}
