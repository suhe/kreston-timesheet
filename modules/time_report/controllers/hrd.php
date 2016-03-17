<?php 
class Hrd extends Controller{
    public function Hrd(){
        error_reporting(E_ALL);
        parent::Controller();
        session_start();
        if(!isset($_SESSION['level'])) {
                redirect('login/user/index',301);
        }
        $this->load->model('Josh_time_report');
        $this->load->module_model('staff','Josh_staff');
        $this->load->module_model('job_desc','Josh_job');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->module_model('manager','Josh_manager');
        $this->load->module_model('transport','Josh_transport');
        $this->load->helper('date');
    }
    
    public function index(){ 
        $data['title']      =   "Manage Time Report For HRD";
        $data['records']    =   $this->Josh_time_report->selectPeriodeRecord();
        $data['module']     =   'time_report';
        $data['main']       =   'hrd/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    public function listing(){
        $data['title']      =   "Manage Time Report For HRD";
        $data['records']    =   $this->Josh_time_report->selectPeriodeRecord();
        $data['module']     =   'time_report';
        $data['main']       =   'hrd/listing_index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    public function periode($id){
        unset($_SESSION['periode']);
        $_SESSION['periode']	=   $id;
        $data['title']      	=   "Manage Auditor Report For HRD";
		$data['periode']   	=   $id;
        $data['recordprocess']= $this->Josh_time_report->selectHrdPerPeriodeRecordPro($id);
		$data['recorddraft'] = $this->Josh_time_report->selectHrdPerPeriodeRecordDraft($id);
        $data['recordapprov'] = $this->Josh_time_report->selectHrdPerPeriodeRecordApprov($id);
        $data['module']       = 'time_report';
        $data['main']         = 'hrd/staff';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function listing_periode($id){
        unset($_SESSION['periode']);
        $_SESSION['periode']    = $id;
        $data['title']          = "All Report Auditor";
        $data['records']        = $this->Josh_time_report->selectHRDPerPeriodeRecords($id);
        $data['module']         = 'time_report';
        $data['main']           = 'hrd/listing_staff';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function status_hrd($id){
        $this->Josh_time_report->hrd_status_manager($id);
        $this->session->set_flashdata('message','<div class=" message success">Change Status Succesfully !</div>');
		redirect($this->input->server('HTTP_REFERER'),301);
    }
	
	function blockey($tr){
		$this->db->where('tr_code',$tr);
		$Q=$this->db->get('josh_head_tr');
		$row=$Q->row_array();
		if($row['status']==0):
			$val['status']=1;
		else:
			$val['status']=0;
		endif;
		$this->db->where('tr_code',$tr);
		$this->db->update('josh_head_tr',$val);
        $this->session->set_flashdata('message','<div class=" message success">Change Status Block Success!</div>');
		redirect($this->input->server('HTTP_REFERER'),301);
	}
    
    
    function view($id){
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        $data['action']="time_report/hrd/aproval/";
        //load staff
        $data['records']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //day
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //report for chf
        $data['chf']=$this->Josh_time_report->selectchf($id);
        //report for cho
        $data['cho']=$this->Josh_time_report->selectcho($id);
        //report for nch
        $data['nch']=$this->Josh_time_report->selectnch($id);
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
        //$mn=$m-1;
        if($mm=='01'){
			$mn=12;
		}else{
			$mn=number_format($m)-1;
	} 
        
        if ($mn<9){
            $mn='0'.$mn;
        } else {$mn=$mn;}
        //echo $m;
        
        
        if($d=='05') {
            if($m==1){
				$m=12;
			}
			else{
				$m=number_format($m)-1;
			}
            //$m=$m-1;
            $n=$m;
            $makhir=5;
            $awal=21;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=28;break;
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
             $makhir=0;
             $awal=6;
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
              
        $data['m']=$m;
        $data['mm']=$mm;
        $data['mn']=$mn;
        //$data['n']=$m+1;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        
        //tampil templates
        if (($d=='05') && ($akhir==31)){
            $data['main']='hrd/view_05_31';
             }
        elseif(($d=='05') && ($akhir==30)){
            $data['main']='hrd/view_05_30';
            }
		elseif(($d=='05') && ($akhir==28)){
            $data['main']='hrd/view_05_30';
            }	
        elseif($d=='20'){
            $data['main']='hrd/view_20';
            }
        $data['module']='time_report';    
        $this->load->vars($data);    
       	$this->load->template('default');     
    }
    
	/*
    function aproval()
	{ 
        $this->Josh_time_report->saveAproval();
        $this->session->set_flashdata('message','<div class=" message success"> Update Aproval Is Succesfully !</div>');
        //redirect('time_report/hrd/view/'.$_SESSION['tr_code'],301);
		redirect($this->input->server('HTTP_REFERER'),301);	
             		
	}*/
	
	function timeuser($id){
        
	    $data['title'] 		 = $id;
	    $data['records']	 = $this->Josh_staff->getRecord(substr($id,3,5));
		$data['checkstatus'] = $this->Josh_time_report->getRecord($id);
		$data['name']   	 = $data['records']['name'];
		$data['value']  	 = $this->Josh_time_report->selectJobReportToApproved($id,'NC100');
		$data['module'] 	 = 'time_report';    
		$data['main']   	 = 'hrd/timestaff';
        $this->load->vars($data);    
       	$this->load->template('default');  
    }	
	
	function aproval($trcode)
	{
        $this->Josh_time_report->saveAprovalHRD($trcode);
        $this->session->set_flashdata('message','<div class=" message success"> The Hour Approved by HRD !</div>');
        redirect($this->input->server('HTTP_REFERER'));      		
	}
    
    function print_out($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        //load staff
        $data['record']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['record']['no'];
        $data['name']=$data['record']['name'];
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
        $mn=$m-1;
		$y = substr($id,13,4);

        if($mm=='01'){
			$mn=12;
		}else{
			$mn=number_format($m)-1;
	} 
        
        if ($mn<9){
            $mn='0'.$mn;
        } else {$mn=$mn;}
        //echo $m;
        
        
        if($d=='05') {
            if($mm=='01'){
			$m=12;
			}else{
			$m=number_format($m)-1;
			}

            //echo $m; 
           $m=$m-1;
           $m=$m+1;
           $n=$m;
           $makhir=5;
           $awal=21;
           $m; 
           switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=28;break;
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

		   if($m == '2' && $y % 4 == 0) {
			   $akhir = 29;
		   }		   
           
           $xawal='01';
           $xakhir='05';
          
          //echo 'awal='.$awal;      
          //echo 'akhir='.$akhir;       
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           
                //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']); 
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec21']['date_h']); 
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
           $data['rec27']=day($data['rec26']['date_h']);
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
           $data['rec03']=day($data['rec29']['date_h']);
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
             $makhir=0;
             $awal=6;
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
              
        $data['m']=$m;
        $data['mm']=$mm;
        $data['mn']=$mn;
        //$data['n']=$m+1;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        //echo $mm;
        //echo $d;
        //echo $akhir;  
        //tampil templates
        $this->load->vars($data);
       
       if (($d=='05') && ($akhir==30) && ($mm=='01')){
            //$this->load->template('laporan05-31');
            $this->load->template('report_05_31');
        }
        elseif (($d=='05') && ($akhir==31)){
            //$this->load->template('laporan05-31');
            $this->load->template('report_05_31');
        }
        elseif(($d=='05') && ($akhir==30)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_30');
        }
		elseif($d=='29'){
            $this->load->template('report_29');
        }
		elseif(($d=='05') && ($akhir==29)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_29');
        }		
		elseif(($d=='05') && ($akhir==28)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_28');
        }
        elseif($d=='20'){
            //$this->load->template('laporan20');
            $this->load->template('report_20');
            } 
		else{
            //$this->load->template('laporan20');
				$this->load->template('report_05_29');
            }   	
    }
	
	function view_transport($id) {
        $data['title']="View Transport :".$id;
		$_SESSION['tr_code']=$id;
        //database
        $data['records']=$this->Josh_transport->selectDetailAccRecords($id);
        //web system data 
        $data['module']='time_report';
        $data['main']='hrd/view_transport';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	function save_transport(){
		$value['transport_chf'] = trim($this->input->post('transport'));
		$this->db->where('code',trim($this->input->post('code')));
		$this->db->where('tr_code',trim($this->input->post('tr_code')));
		$this->db->where('date',trim($this->input->post('date')));
		$this->db->update('josh_details_day_tr',$value);
		redirect($this->input->server('HTTP_REFERER'),301);
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
	
	function nch($id){
        //$periode1 ='2014-03-21';
        //$periode2 ='2014-03-25';
        $year	  = substr($id,0,4);
        $month    = substr($id,5,2);
        $day      = substr($id,8,2);
        
		$month_   = number_format($month,0)-1;
        $day_     = number_format($day,0)+1;
		
		if($month_<= 9):
			$month_='0'.$month_;
		else:
			$month_=$month_;
		endif;	
		
		$periode1 = $year.'-'.$month_.'-'.$day_;
		$periode2 = $year.'-'.$month.'-'.$day;
	   
	   $this->load->library('excel');
		set_time_limit(336000);   
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                    ->setDescription("description");
		$objPHPExcel->setActiveSheetIndex(0);
        
        $styleArray = array( 'borders' => array( 'allborders' => array(
                             'style' => Style_Border::BORDER_THIN )));
        $fill = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'CCCCCC'
      			),
      			'endcolor'   => array(
      				'argb' => 'CCCCCC'
      			)
      		);                     
		/*Data */
		$row=1;
		$col=0;
		
        /* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Periode');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($periode1).' s/d '. indo_tgl($periode2));		
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$row=$row+2;
                
		/* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Staff No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Staff Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'NC1001');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'NC1002');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'NC1003');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'NC1004');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'NC1005');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'NC1006');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'NC1007');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'NC1008');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'NC1009');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'NC1010');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+11)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+12)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getFill()->applyFromArray($fill);
		
		$sql = " SELECT js.no,js.name,js.nickname, ";
		$sql.= "(SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1001' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " ) AS NC1001 ";
		$sql.= " , ";
		$sql.= " (SELECT COUNT(jdt.job_code) "; 
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1002' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."'";   
		$sql.= " ) AS NC1002, ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1003' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " ) AS NC1003, ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1004' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " ) AS NC1004 ,";
		$sql.= " (SELECT COUNT(jdt.job_code) "; 
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND "; 
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1005' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."'  "; 
		$sql.= " ) AS NC1005, ";
		$sql.= " (SELECT COUNT(jdt.job_code) "; 
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND "; 
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= "  jdt.job_code='NC1006' AND ";
		$sql.= "  jddt.date>='".$periode1."' AND jddt.date<='".$periode2."'  "; 
		$sql.= " ) AS NC1006 ";
		$sql.= " , ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1007' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";
		$sql.= " ) AS NC1007, ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1008' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";   
		$sql.= " ) AS NC1008, ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1009' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " ) AS NC1009, ";
		$sql.= " (SELECT COUNT(jdt.job_code) ";
		$sql.= " FROM ";
		$sql.= " josh_head_tr jht ";
		$sql.= " JOIN josh_details_tr  jdt ON jdt.tr_code=jht.tr_code ";
		$sql.= " JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
		$sql.= " WHERE ";
		$sql.= " jht.staff_no=js.no  AND ";
		$sql.= " jddt.code=jdt.day_code AND ";
		$sql.= " jdt.job_code='NC1010' AND ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " ) AS NC1010 ";
		$sql.= " FROM ";
		$sql.= " josh_staff js ";
		$sql.= " WHERE js.no < '11000' AND js.status='active' ";
		$sql.= " ORDER BY js.no ASC ";
 		$Q=$this->db->query($sql);
        $records=$Q->result_array();
		$row=$row+1;
		foreach($records as $rec):
		/* Staff No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['no']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
    
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$x1=$rec['NC1001']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		
		/* Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$x2=$rec['NC1002']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        
		/* Day Attended */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$x3=$rec['NC1003']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
       
		/* Transport */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$x4=$rec['NC1004']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$x5=$rec['NC1005']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
       
		/* Overtime + Meal */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$x6=$rec['NC1006']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        
		/* Position Allowance */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$x7=$rec['NC1007']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        
		/* AK Allowance */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$x8=$rec['NC1008']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        
		/* Adjustment */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$x9=$rec['NC1009']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        
		 /* Total Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$x10=$rec['NC1010']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        
		/* Total Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$x1+$x2+$x3+$x4+$x5+$x6+$x7+$x8+$x9+$x10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
     
		$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="payroll_list.xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
		
	}
	
	function NCH_type($type,$id){
        $year	  = substr($id,0,4);
        $month    = substr($id,5,2);
        $day      = substr($id,8,2);
        
		$month_   = number_format($month,0)-1;
        $day_     = number_format($day,0)+1;
		
		if($month_<= 9):
			$month_='0'.$month_;
		else:
			$month_=$month_;
		endif;	
		
		$periode1 = $year.'-'.$month_.'-'.$day_;
		$periode2 = $year.'-'.$month.'-'.$day;
	   
	   $this->load->library('excel');
		set_time_limit(336000);   
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                    ->setDescription("description");
		$objPHPExcel->setActiveSheetIndex(0);
        
        $styleArray = array( 'borders' => array( 'allborders' => array(
                             'style' => Style_Border::BORDER_THIN )));
        $fill = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'CCCCCC'
      			),
      			'endcolor'   => array(
      				'argb' => 'CCCCCC'
      			)
      		);                     
		/*Data */
		$row=1;
		$col=0;
		
        /* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Periode Untuk : '.$type);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($periode1).' s/d '. indo_tgl($periode2));		
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$row=$row+2;
                
		/* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Tanggal');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'TR Code');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Staff No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Staff Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Manager');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Jam');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		$sql = " SELECT * ";
		$sql.= " FROM ";
		$sql.= " josh_details_day_tr jddt ";
		$sql.= " JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code ";
		$sql.= " JOIN josh_staff js ON js.no=jht.staff_no ";
		$sql.= " WHERE ";
		$sql.= " jddt.date>='".$periode1."' AND jddt.date<='".$periode2."' ";  
		$sql.= " AND jddt.code LIKE '%".$type."%' ";
		$sql.= " ORDER BY jddt.date ASC ";
 		$Q=$this->db->query($sql);
        $records=$Q->result_array();
		$row=$row+1;
		foreach($records as $rec):
		/* Staff No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['date']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['tr_code']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
    
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$x1=$rec['no']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		
		/* Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$x2=$rec['name']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        
		/* Day Attended */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$x3=$rec['group_id']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
       
		/* Transport */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$x4=$rec['time']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
     
		$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file=$type.".xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
		
	}
    
}
