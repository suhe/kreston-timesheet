<?php
class Josh_time_report extends Model{
	
	function Josh_time_report(){
		parent::Model();
	}
    
    function groupAccess(){
        $data=array();
        $this->db->select('*');
        $this->db->or_where('partner',$_SESSION['no']);
        $this->db->or_where('manager',$_SESSION['no']);
        $this->db->or_where('ass_manager',$_SESSION['no']);
        $this->db->or_where('senior',$_SESSION['no']);
        $this->db->limit(1);
		$Q=$this->db->get('josh_group');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data; 
    }
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('*');
        $this->db->where('josh_head_tr.staff_no',$_SESSION['no']);
		$this->db->where('substr(josh_head_tr.periode,1,4)>=','2014');
        $this->db->orderby('periode','DESC'); 
		$Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
	}
    
    function status_manager($id)
	{	
	   $data=array();
       $option=array('tr_code'=>$id,'status_manager'=>'process');
       $Q=$this->db->select('status_manager');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 $data=array('status_manager'=>'pending');
             	 $this->db->where('tr_code',$id);
              	 $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     $data=array('status_manager'=>'process');
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
        
	}
    
    function status_hrd($id)
	{	
	   $data=array();
       $option=array('tr_code'=>$id,'status_hrd'=>'process');
       $Q=$this->db->select('status_hrd');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 $data=array('status_hrd'=>'pending');
             	 $this->db->where('tr_code',$id);
              	 $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     $data=array('status_hrd'=>'process');
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
	}
    
    function saveRecord()
	{
		$data=array();
        $this->db->select('periode');
		$this->db->where('periode',$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])));
        $this->db->where('staff_no',$this->input->xss_clean($_SESSION['no']));
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['year'])).' Is Already!</div>');
		       redirect('time_report/user/add',301);
           }
        else
            {	
				$this->saveTable();
            }   
		$Q->free_result();
		return $data;
	}
    
    function saveTable()
    {
		$data=array(
            'tr_code'	=>	'TR-'.$this->input->xss_clean($_SESSION['no']).'-'.$this->input->xss_clean($_POST['day']).$this->input->xss_clean($_POST['month'].$this->input->xss_clean($_POST['year'])),
            'periode'	=>	$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
            'pos_code'	=>	$this->input->xss_clean($_SESSION['level']),
            'pos_name'	=>	$this->input->xss_clean($_SESSION['pos']),
            'staff_no'	=>	$this->input->xss_clean($_SESSION['no']),
            'staff_name'=>	$this->input->xss_clean($_SESSION['name'])); 
		$this->db->insert('josh_head_tr',$data);
	}
    
    function selectHeadRecord($id){
		$data=array();
        $this->db->select('tr_code,status_manager,status_hrd');
        $this->db->where('josh_head_tr.tr_code',$id);
		$Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
	}
    
    function selectDetailsRecords($id){
        $data=array();
        $this->db->select('date,day_code,job_code,name as job_name,type,description,code_type');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
        $this->db->join('josh_details_day_tr','josh_details_day_tr.code=josh_details_tr.day_code');
        $this->db->where('josh_details_tr.tr_code',$id);
        $this->db->groupby('josh_job.code');
		$Q=$this->db->get('josh_details_tr');
        
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	function selectJobReportToApproved($id,$nch=''){
		$data = array();
		$sql = " 
		        SELECT jddt.code,DATE_FORMAT(DATE,'%d/%m/%Y') AS date,jj.name as job,type_job,jddt.time,jddt.over_time,jddt.over_time_app,x1,x2,x3,x4,
				over_manager,transport_chf,app_manager,app_hrd,SUBSTR(jddt.code,19,12) as job_code
				FROM josh_details_day_tr jddt
				INNER JOIN josh_job jj ON jj.code = REPLACE(SUBSTR(jddt.code,19,12),'-NCH','')
				Where jddt.tr_code='".$id."'
		       ";
		if($_SESSION['level']=='M')   $sql.=" AND jj.Manager='".$_SESSION['no']."' ";
		if($_SESSION['level']=='AM')  $sql.=" AND jj.Ass_Manager='".$_SESSION['no']."' ";
		if($_SESSION['level']=='S2')  $sql.=" AND jj.Senior2='".$_SESSION['no']."' ";
		if($_SESSION['level']=='S1')  $sql.=" AND jj.Senior1='".$_SESSION['no']."' ";
		if($_SESSION['level']=='AS')  $sql.=" AND jj.Ass_Senior='".$_SESSION['no']."' ";
		
		$sql.= " ORDER BY jddt.date ASC;";
		
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
		
	}
    
    function selectDetailsRecords2($id){
        $data=array();
        $this->db->select('josh_details_tr.tr_code,day_code,job_code,name as name,type,description,code_type');
		$this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
        $this->db->join('josh_details_day_tr','josh_details_day_tr.code=josh_details_tr.day_code');
        $this->db->where('josh_details_tr.tr_code',$id);
        $this->db->groupby('josh_job.code');
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function selectCHFDetailsRecords($id){
        $data=array();
        
		/*
		$this->db->select('day_code,job_code,name as job_name,type,josh_job.description,code_type');
        $this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$Q=$this->db->get('josh_details_tr');*/
		$sql = "
			SELECT jdt.day_code,jdt.job_code,jj.name as job_name,type,jj.description,code_type, 0 as SP_hour,SP_time,0 as PC_hour,PC_time,SM_hour,SM_time,M_hour,M_time,AM_time,AM_hour,S2_time,S2_hour,S1_time,S1_hour,AS_time,AS_hour,TA_time,TA_hour,
			CASE
				WHEN ((0/jj.SP_time) * 100) >= 51 AND ((0/jj.SP_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((0/jj.SP_time) * 100) >= 91) OR ((jj.SP_time - 0) < 1)  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SP,
			
			CASE
				WHEN ((0/jj.PC_time) * 100) >= 51 AND ((0/jj.PC_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((0/jj.PC_time) * 100) >= 91) OR ((jj.PC_time - 0) < 1)  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS PC,
			
			CASE
				WHEN ((jj.SM_hour/jj.SM_time) * 100) >= 51 AND ((jj.SM_hour/jj.SM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.SM_hour/SM_time) * 100) >= 91) OR ((jj.SM_time - SM_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SM,
			
			CASE
				WHEN ((jj.M_hour/M_time) * 100) >= 51 AND ((jj.M_hour/M_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.M_hour/M_time) * 100) >= 91) OR ((jj.M_time - M_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS M,
			
			CASE
				WHEN ((jj.AM_hour/jj.AM_time) * 100) >= 51 AND ((jj.AM_hour/jj.AM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.AM_hour/AM_time) * 100) >= 91) OR ((jj.AM_time - AM_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AM,
			
			CASE
				WHEN ((S2_hour/S2_time) * 100) >= 51 AND ((S2_hour/S2_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.S2_hour/S2_time) * 100) >= 91) OR ((jj.S2_time - S2_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S2,
			
			CASE
				WHEN ((S1_hour/S1_time) * 100) >= 51 AND ((S1_hour/S1_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.S2_hour/S1_time) * 100) >= 91) OR ((jj.S1_time - S1_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S1,
			
			CASE
				WHEN ((AS_hour/AS_time) * 100) >= 51 AND ((AS_hour/AS_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.AS_hour/AS_time) * 100) >= 91) OR ((jj.AS_time - AS_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS `AS`,
			
			CASE
				WHEN ((TA_hour/TA_time) * 100) >= 51 AND ((TA_hour/TA_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.TA_hour/TA_time) * 100) >= 91) OR ((jj.TA_time - TA_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS TA,jj.note
			
			from josh_details_tr jdt
			inner join josh_job jj  on jj.code = jdt.job_code
			where code_type = 'CHF'
			and jdt.tr_code = '".$id."'
		";
		
		$Q = $this->db->query($sql);
		
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function selectCHODetailsRecords($id)
    {
        $data=array();
        /*$this->db->select('day_code,job_code,name as job_name,type,josh_job.description,code_type');
        $this->db->where('code_type','CHO');
        $this->db->where('tr_code',$id);
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->group_by('job_code');
		$Q=$this->db->get('josh_details_tr');**/
        $sql = "
			SELECT jdt.day_code,jdt.job_code,jj.name as job_name,type,jj.description,code_type, 0 as SP_hour,SP_time,0 as PC_hour,PC_time,SM_hour,SM_time,M_hour,M_time,AM_time,AM_hour,S2_time,S2_hour,S1_time,S1_hour,AS_time,AS_hour,TA_time,TA_hour,
			CASE
				WHEN ((0/jj.SP_time) * 100) >= 51 AND ((0/jj.SP_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((0/jj.SP_time) * 100) >= 91) OR ((jj.SP_time - 0) < 1)  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SP,
			
			CASE
				WHEN ((0/jj.PC_time) * 100) >= 51 AND ((0/jj.PC_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((0/jj.PC_time) * 100) >= 91) OR ((jj.PC_time - 0) < 1)  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS PC,
			
			CASE
				WHEN ((jj.SM_hour/jj.SM_time) * 100) >= 51 AND ((jj.SM_hour/jj.SM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.SM_hour/SM_time) * 100) >= 91) OR ((jj.SM_time - SM_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SM,
			
			CASE
				WHEN ((jj.M_hour/M_time) * 100) >= 51 AND ((jj.M_hour/M_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.M_hour/M_time) * 100) >= 91) OR ((jj.M_time - M_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS M,
			
			CASE
				WHEN ((jj.AM_hour/jj.AM_time) * 100) >= 51 AND ((jj.AM_hour/jj.AM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.AM_hour/AM_time) * 100) >= 91) OR ((jj.AM_time - AM_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AM,
			
			CASE
				WHEN ((S2_hour/S2_time) * 100) >= 51 AND ((S2_hour/S2_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.S2_hour/S2_time) * 100) >= 91) OR ((jj.S2_time - S2_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S2,
			
			CASE
				WHEN ((S1_hour/S1_time) * 100) >= 51 AND ((S1_hour/S1_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.S2_hour/S1_time) * 100) >= 91) OR ((jj.S1_time - S1_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S1,
			
			CASE
				WHEN ((AS_hour/AS_time) * 100) >= 51 AND ((AS_hour/AS_time) * 100) <= 91  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.AS_hour/AS_time) * 100) >= 91) OR ((jj.AS_time - AS_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS `AS`,
			
			CASE
				WHEN ((TA_hour/TA_time) * 100) >= 51 AND ((TA_hour/TA_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN (((jj.TA_hour/TA_time) * 100) >= 91) OR ((jj.TA_time - TA_hour) < 1)   THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS TA,jj.note
			
			from josh_details_tr jdt
			inner join josh_job jj  on jj.code = jdt.job_code
			where code_type = 'CHO'
			and jdt.tr_code = '".$id."'
		";
		
		$Q = $this->db->query($sql);
		
		
		if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function selectNCHDetailsRecords($id)
    {
        $data=array();
        $this->db->select('day_code,job_code,name as job_name,type,josh_job.description,code_type');
        $this->db->where('code_type','NCH');
        $this->db->where('tr_code',$id);
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		//$this->db->group_by('job_code');
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function saveJob()
	{
        if($this->input->post('job_code')== ''){
            $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['year'])).' Is Already!</div>');
            redirect('time_report/user/addjob',301);
        }
		$data=array();
        $this->db->select('*');
		$this->db->where('day_code',$_SESSION['tr_code'].$this->input->xss_clean($_POST['job_code']).$this->input->xss_clean($_POST['type']));
        $this->db->where('code_type',$this->input->xss_clean($_POST['type']));
        $Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['year'])).' Is Already!</div>');
		       redirect('time_report/user/addjob',301);
           }
        else
            {
                $this->saveJob2();
            }   
		$Q->free_result();
		return $data;
	}
    
    function saveJob2()
    {
        $data=array(
            'day_code'=>$_SESSION['tr_code'].'-'.$this->input->xss_clean($_POST['job_code']).'-'.$this->input->xss_clean($_POST['type']),
            'tr_code'=>$_SESSION['tr_code'],
            'job_code '=>$this->input->xss_clean($_POST['job_code']),
            'code_type'=>$this->input->xss_clean($_POST['type']),
            'work_description'=>$this->input->xss_clean($_POST['description'])
		); 
		$this->db->insert('josh_details_tr',$data);
    }
    
    
    function saveNonJob()
	{
		$data=array();
        $this->db->select('*');
		$this->db->where('day_code',$_SESSION['tr_code'].$this->input->xss_clean($_POST['job_code']).$this->input->xss_clean('NCH'));
        $this->db->where('code_type',$this->input->xss_clean('NCH'));
        $Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['year'])).' Is Already!</div>');
		       redirect('time_report/user/addNonjob',301);
           }
        else
            {
                $this->saveNonJob2();
            }   
		$Q->free_result();
		return $data;
	}
    
    function saveNonJob2()
    {
        $data=array(
            'day_code'=>$_SESSION['tr_code'].'-'.$this->input->xss_clean($_POST['job_code']).'-'.$this->input->xss_clean('NCH'),
            'tr_code'=>$_SESSION['tr_code'],
            'job_code '=>$this->input->xss_clean($_POST['job_code']),
            'code_type'=>$this->input->xss_clean('NCH'),
            'work_description'=>$this->input->xss_clean($_POST['description'])
		); 
		$this->db->insert('josh_details_tr',$data);
    }
    
    function selecttime()
    {
        $data=array();
        $this->db->select('day,time');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
    function getJobtype($daycode)
	{
		$this->db->select('code_type');
		$this->db->where('day_code',$daycode);
		$this->db->limit(1);
		$Q = $this->db->get('josh_details_tr');
		$data = $Q->row_array();
		if($data)
			$code = strtolower($data['code_type']);
		else 
			$code = '';
		return $code ;
		//echo $this->db->last_query();
	}
	
	function checktimereport(){
		$date    = $this->input->post('date');
		$year    = substr($date,0,4);
		$month   = substr($date,5,2);
		$periode = substr($date,8,2);
		$day     = $this->input->post('day');
		$time    = $this->input->xss_clean($this->input->post('time'));
		$code    = $this->input->xss_clean($this->input->post('code'));
		
		/** check month **/
		if ($periode=='05') {
			if (($day>=21) &&($day<=31))
				$month = number_format($month); 	
			else
				$month = number_format($month)+1; 
		} else {
			$month = number_format($month);
		}	
		
		if($month>12){
			$month = 1;
			$year  = $year+1;
		}
		$month = digitTwo($month);
		
		$sql = " SELECT SUM(time) as total_time FROM josh_details_day_tr WHERE tr_code='$_SESSION[tr_code]' AND date='$year-$month-$day' ";
		//echo $sql;
		$q   = $this->db->query($sql);
		$row = $q->row_array(); 
		if($row)
			$data = $row['total_time'];
		else
			$data = 0;
		return $data;	
	}
	
	public function savetimereport() {
		$date    = $this->input->post('date');
		$year    = substr($date,0,4);
		$month   = substr($date,5,2);
		$periode = substr($date,8,2);
		$day     = $this->input->post('day');
		$hour_1  = $this->input->post('hour_1');
		$hour_2  = $this->input->post('hour_2');
		
		
		$tm1 = number_format(substr($hour_1,0,2));
		$tm2 = number_format(substr($hour_2,0,2));
		
		$min=0;
		for($i=$tm1;$i<=$tm2;$i++){
			if($i==12)
				$min = $min+1;
		}
		
		if($tm2==12)
			$min=$min-1;
		

		$time    = selisih($hour_1,$hour_2);
		$time    = $time - $min;
		if($time>8)
			$time = 8;
			
		$code    = $this->input->xss_clean($this->input->post('code'));
		
		/** check month **/
		if ($periode=='05') {
			if (($day>=21) &&($day<=31))
				$month = number_format($month); 	
			else
				$month = number_format($month) + 1; 
		} else {
			$month = number_format($month);
		}	
		
		
		if($month == 13)
		{
			$month = 1;
			$year = $year + 1;
		}
		
		$month = digitTwo($month);
		//echo $this->input->xss_clean($year.'-'.$month.'-'.$day);
			
		$checkjobsql   = " SELECT date FROM josh_details_day_tr WHERE code='$code' AND date='$year-$month-$day'; ";
		$checkjobquery = $this->db->query($checkjobsql);
		$checkjobexe   = $checkjobquery->row_array();
		if(!$checkjobexe){
			$timestart = $this->input->xss_clean($_POST['time_1']);
			$timeend   = $this->input->xss_clean($_POST['time_2']);
		
			if(($timestart)&&($timeend)){
				$over = selisih($this->input->xss_clean($_POST['time_1']),$this->input->xss_clean($_POST['time_2']));
				$tm1 = number_format(substr($this->input->xss_clean($_POST['time_1']),0,2));
				$tm2 = number_format(substr($this->input->xss_clean($_POST['time_2']),0,2));
				//echo $tm1;
				//echo $this->input->xss_clean($_POST['time_2']);
				$min=0;
				for($i=$tm1;$i<=$tm2;$i++){
					if($i==12)
						$min = $min + 1;
					if(($i==19)&& ($tm1!=19))
						$min = $min + 1;	
				}
				//echo $min;
				
				if( ($tm2==12) || ($tm2==19) )
					$min=$min-1;
				
	
			
				$over = $over-$min;	
				
			} else { 	
				$over = 0;
			}	
			
			$jobcode = substr($this->input->xss_clean($code),18,6);
			$checktrpsql   = " SELECT transport,address FROM josh_company jc inner join josh_job jj ON jj.company_code=jc.code WHERE jc.code='$jobcode' limit 1; ";
			//echo $checktrpsql;
			$checktrpquery = $this->db->query($checktrpsql);
			$checktrpexe   = $checktrpquery->row_array();
			
			$jobtype = $this->getJobtype($this->input->xss_clean($_POST['code']));
			//echo $jobtype;
			
			if($jobtype=='chf'){
				$transp   = $checktrpexe['transport'];
				$location = $checktrpexe['address'];	
			} else {
				$transp   = 0;
				$location = 'Office';	
			}
			if(($_SESSION['level']=="M") || ($_SESSION['level']=="SM") || ($jobtype<>"chf"))
			    $transp = 0;
           
			if($location==NULL)
			    $location = 'Check Client Transport';
			
			$data=array(
            'code'		   => $this->input->xss_clean($code),
            'tr_code'	   => $this->input->xss_clean($_SESSION['tr_code']),
            'date'		   => $this->input->xss_clean($year.'-'.$month.'-'.$day), 
            'active_date'  => $this->input->xss_clean($year.'-'.$month.'-'.$day),
			'hour_1' 	   => $this->input->xss_clean($hour_1),
			'hour_2' 	   => $this->input->xss_clean($hour_2),
		    'time' 		   => $this->input->xss_clean($time),
			'over_time'	   => $this->input->xss_clean($over),
			'time_1'	   => $this->input->xss_clean($timestart),
            'time_2'	   => $this->input->xss_clean($timeend),
			'type_job'	   => $jobtype,
			'app_draft'	   => 'yes',
			'activity'	   => $this->input->xss_clean($this->input->post('activity')),
            'transport_chf'=> $this->input->xss_clean($transp),
			'location'	   => $location	);      
			$this->db->insert('josh_details_day_tr',$data);
			
			//progress
			$progress =  $this->input->xss_clean($this->input->post('progress'));
			if($progress) {
				$data2['date'] = $this->input->xss_clean($year.'-'.$month.'-'.$day);
				$data2['job_code'] = substr($this->input->xss_clean($code),18,12);
				$data2['tr_code'] = $this->input->xss_clean($_SESSION['tr_code']);
				$data2['progress'] = $progress;
				$data2['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('josh_job_progress',$data2);
				
				//updated job code
				$data3['progress'] = $progress;
				$this->db->where('code',substr($this->input->xss_clean($code),18,12));
				$this->db->update('josh_job',$data3);
				
			}
			
			//save hour to job
			$job_code = substr($this->input->xss_clean($code),18,12);
			$pos = $_SESSION['level'];
			$total_hour = $this->SUMTimeReportUser($job_code,$pos);
			$jobVal[$pos."_hour"] = $total_hour;
			//$this->db->where('code',$job_code);
			//$this->db->update('josh_job',$jobVal);
			if(($jobVal) && ($job_code) && ($pos)){
				$this->db->where('code',$job_code);
				$this->db->update('josh_job',$jobVal);
			}
			
 		}
	}
	
	public function SUMTimeReportUser($code,$pos) {
		$data = array();
		if(!$code)
		{
			$code = 'null';
		}
		
		if(!$pos)
		{
			$pos = 'S3';
		}
		
        $sql = "
			SELECT SUM(time + over_time_app) as total
			FROM josh_details_day_tr jddt
			INNER JOIN josh_head_tr jht ON jht.tr_code = jddt.tr_code
			WHERE substr(code,19,12) = '".$code."' AND jht.pos_code='".$pos."'
			AND (jddt.app_manager = 'yes' OR jddt.app_draft = 'yes' OR jddt.app_hrd = 'YES' OR jht.manager_approval='yes' OR jht.hrd_approval='yes') ";
		
		$Q=$this->db->query($sql);	
        
		$sum = 0;
		if($Q->num_rows()> 0 ){
			$data = $Q->row_array();
			$sum = $data["total"];
        }
		$Q->free_result();
		return $sum;
	}
	
    function saveDayRecord(){
		$date=$this->input->post('date');
		
        $month1=substr($this->input->post('date'),5,2);
        $day=substr($this->input->post('date'),8,2);
        if ($day == '05') {
               if (($day>=21) &&($day<=31)){
                    $month=number_format($month1);}
                elseif(($this->input->post('day')>='01') && ($this->input->post('day')<= '5')){
                    $month=number_format($month1) + 1; }             
         }
         elseif($day == '20'){
               $month=number_format($month1);
         }
		 
		 elseif($day == '15'){
               $month=number_format($month1);
         }
		 
		 elseif($day == '28'){
               $month=number_format($month1);
         }
		 elseif($day == '29'){
               $month=number_format($month1);
         }
		 
		 elseif($day == '30'){
               $month=number_format($month1);
         }
		 
		 elseif($day == '31'){
               $month=number_format($month1);
         }
         
         if($month > 9 )
         { $month=$month; 
		  }else{
           $month='0'.$month;
         }
           
          $_SESSION['day']=$day;
          $_SESSION['month']=$month;
           
         $month = $_SESSION['month'];
		 $year  = date('Y');
		 if($month>12):
			$month='01';
			$year = $year+1;
		 else:
			$year = $year;
		 endif;	
		 
		 $jobtype = $this->getJobtype($this->input->xss_clean($_POST['code']));
		 
         $data=array();
            $this->db->select('code,date,time');
            $this->db->where('code',$this->input->xss_clean($_POST['code']));
            $this->db->where('type_job',$jobtype);
            $this->db->where('date',$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])));
            $Q=$this->db->get('josh_details_day_tr');
            if($Q->num_rows()> 0 )
    		   { $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).$month1.' Is Already!</div>');
    		       redirect('time_report/user/view/'.$_SESSION['tr_code'],301);}
            else {
                    $this->cekday(); }   
    		$Q->free_result();
    		return $data;
    }
    
    
    function cekday(){
          $month=$_SESSION['month'];
		  $year = date('Y');
		  if($month>12):
				$month= '01';
				$year = $year+1;
			else:
				$year = $year;
			endif;
		
		  //if(($month=='12') && ($year=='20143'))
		//	$year = 2014;		
		 
          $tanggal = $this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day']));    
          //Holiday Hari besar /Nasional
          $query2 = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";
		  $Q2=$this->db->query($query2);
		  if($Q2->num_rows()>=1 ){
                $this->saveDayRecordOvertime();
             } else {
		          			
		          $tanggal = $this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])); 
		          $query = "SELECT datediff('$tanggal', CURDATE()) as day";
		          $Q=$this->db->query($query);
		          $row=$Q->row_array();
		          //$row->free_result();
		          $x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
		          $namahari = date("l", $x);
				  
				  $query2 = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";
				  $Q2=$this->db->query($query2);
		
				  
		          if(($namahari == 'Saturday') || ($namahari == 'Sunday') || ($Q2->num_rows() > 0 ) ){
			           $this->saveDayRecordOvertime();
		          } else {
		               //$active=$tanggal;
                       $this->saveDayRecordActive();
                  }
                   //Holiday Saturday AND Monday
		         }   
    }
    
    function saveDayRecordActive(){
        $month=$_SESSION['month'];
		$year = date('Y');
		if($month>=12):
			$month='01';
			$year=$year+1;
		else:
			$year=$year;
		endif;	 
		 
        $time=$this->input->xss_clean($this->input->post('time'));
		
		
        if ($time>8){
			 $this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time > 8</div>');
		     redirect('time_report/user/view/'.$_SESSION['tr_code'],301); 
           }
        $this->db->select('SUM(time) as time');							
	    $this->db->where('date',$this->input->xss_clean($year.'-'.$month.'-'.$this->input->post('day')));
		$this->db->where('tr_code',$this->input->xss_clean($_SESSION['tr_code']));
	    $Q=$this->db->get('josh_details_day_tr');
		if($Q->num_rows()>=1){
			$row=$Q->row_array();
			$a = 8;
			$time=$row['time'];
			if ( $this->input->xss_clean($this->input->post('time')) <= ($a - $time))
			   {
				   $this->saveTableDay();
			   }
			else{
					$this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time > '.$a - $time.'</div>');
					redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
				}			
		} else {
			$a=8;
			if ( $this->input->xss_clean($this->input->post('time')) <= $a )
			   {
				   $this->saveTableDay();
			   }
			
			 else{
			          $this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time is error </div>');
					  redirect('time_report/user/view/'.$_SESSION['tr_code'],301);	
				  }			 
		}   
    }
    
    function saveDayRecordOvertime(){
        $this->saveTableOvertime2();

    } 
    
    function saveTableDay() {
        $month= $_SESSION['month'];
		$year = year(date('Y-m-d'));
		if($month>12){
			$month = '01';
			$year  = $year+1;
		}
		
		elseif(($month=='12') && ($year=='2014')){
			$month = $month;
			$year  = $year;
		}	
		
		else {
			$month=$month;
			$year = $year;
		}
		if($month<=9){
			$month = '0'.$month;
		}
		
		$timestart = $this->input->xss_clean($_POST['time_1']);
		$timeend   = $this->input->xss_clean($_POST['time_2']);
		
		if(($timestart)&&($timeend)){
			$over = selisih($this->input->xss_clean($_POST['time_1']),$this->input->xss_clean($_POST['time_2'])); }
		else {	
			$over = 0;
		}
		$jobtype   = $this->getJobtype($this->input->xss_clean($_POST['code']));
		
        $chf=$this->input->post('type');
		$type = $this->input->post('day_code');
        //$xchf=$this->input->xss_clean(strtolower($_POST['type']));
		$xchf=$jobtype;
		$jobcode=substr($this->input->xss_clean($_POST['code']),18,6);
		/* Otomatic Transport */
				$this->db->select('*');
				$this->db->join('josh_job','josh_job.company_code=josh_company.code','LEFT');
				$this->db->where('josh_company.code',$jobcode);
				$this->db->limit(1);
				$Q=$this->db->get('josh_company');
				$row=$Q->row_array();
				if(COUNT($row)<1):
					$transp=0;
				else:
				   /*if($_SESSION['group']>=4):
					  $transp=$row['transport2'];
				   else:
					  $transp=$row['transport'];
				   endif;*/
				   $transp=$row['transport'];
				   $location=$row['address'];	
				endif;
				
				$transp=$transp;
				if(($_SESSION['level']=="M") || ($_SESSION['level']=="SM") || ($_SESSION['level']=="MG") || ($chf<>"CHF")){
					$transp=0;
					$location='';
				}
                                
		/* */
		if($location==NULL){
			$location = 'Check Client Transport';
		}
		
		if(($month=='12') && ($year=='2014'))
			$year = $year;
			
		$jobtype = $this->getJobtype($this->input->xss_clean($_POST['code']));	
        $data=array(
            'code'		   => $this->input->xss_clean($_POST['code']),
            'tr_code'	   => $this->input->xss_clean($_SESSION['tr_code']),
            'date'		   => $this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($this->input->post('day'))), 
            'active_date'  => $this->input->xss_clean($year.'-'.$month.'-'.$this->input->post('day')),
		    'time' 		   => $this->input->xss_clean($_POST['time']),
			'over_time'	   => $this->input->xss_clean($over),
			'time_1'	   => $this->input->xss_clean($timestart),
            'time_2'	   => $this->input->xss_clean($timeend),
			'type_job'	   => $jobtype,
            'transport_chf'=> $this->input->xss_clean($transp),
			'location'	   => $location	
            );      
		//echo $data['date'];		
		$this->db->insert('josh_details_day_tr',$data);
	}
    
    function saveTableOvertime2(){
		$year = year(date('Y-m-d')); 
        $month=$_SESSION['month'];
		if($month>12):
			$month='01';
			$year = $year+1;
		else:
			$year = $year;
		endif;	
		
        $chf=$this->input->post('type');
		$jobcode=substr($this->input->xss_clean($_POST['code']),18,6);
		/* Otomatic Transport */
				$this->db->select('josh_company.transport,josh_company.address');
				$this->db->join('josh_job','josh_job.company_code=josh_company.code','LEFT');
				$this->db->where('josh_company.code',$jobcode);
				$this->db->limit(1);
				$Q=$this->db->get('josh_company');
				$row=$Q->row_array();
				if(COUNT($row)<1):
					$transp=0;
				else:
				  if($_SESSION['group']>=4):
					  $transp=$row['transport2'];
				  else:
					  $transp=$row['transport'];	
				  endif;		
					$location=$row['address'];
				endif;
				
				$transp=$transp;
				if(($_SESSION['level']=="M") || ($_SESSION['level']=="SM") || ($_SESSION['level']=="MG") || ($chf<>"CHF")){
					$transp=0;
					$location='';
				}
		/* */	
        $over=$this->input->xss_clean($this->input->post('time'));
		$tt=9 + $over;
		$time_1='09:00:00';
		$time_2=$tt.':00:00';
		
        if($chf=='NCH'){
            $data=array(
            'code'=>$this->input->xss_clean($_POST['code']),
            'tr_code'=>$this->input->xss_clean($_SESSION['tr_code']),
            'date'=>$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])), 
            'active_date'=>'0000-00-00',
		    'over_time'=>0,
            'type_job'=>$this->input->xss_clean(strtolower($chf)),
            'transport_chf'=>$this->input->xss_clean(0)
            ); 
        }
		elseif($chf=='CHF'){
        $data=array(
            'code'=>$this->input->xss_clean($_POST['code']),
            'tr_code'=>$this->input->xss_clean($_SESSION['tr_code']),
            'date'=>$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])), 
            'active_date'=>'0000-00-00',
		    'over_time'=>$over,
			'time_1'=>$time_1,
			'time_2'=>$time_2,
            'type_job'=>$this->input->xss_clean(strtolower($chf)),
            'transport_chf'=>$this->input->xss_clean($transp),
			'location'	=> $location
            ); 
         }   
        else{
        $data=array(
            'code'=>$this->input->xss_clean($_POST['code']),
            'tr_code'=>$this->input->xss_clean($_SESSION['tr_code']),
            'date'=>$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])), 
            'active_date'=>'0000-00-00',
		    'over_time'=>$over,
			'time_1'=>$time_1,
			'time_2'=>$time_2,
            'type_job'=>$this->input->xss_clean(strtolower($chf)),
            'transport_chf'=>$this->input->xss_clean(0)
            ); 
         }          
		$this->db->insert('josh_details_day_tr',$data);
		
		        //$tanggal = $this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])); 
				//$query = "SELECT datediff('$tanggal', CURDATE()) as day";
				//$Q=$this->db->query($query);
				//$row=$Q->row_array();
				//$x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
				//$namahari = date("l", $x);
				//if(($namahari == 'Saturday') || ($namahari == 'Sunday'))
				//   {
					//$active='';
				//     if ($over >= 9){
				//		    $data['x1']=0;
                //            $data['x2']=7; // 7 jam Pertama
                //            $data['x3']=1;  //8 Jam 
                //            $data['x4']=$over-($data['x2'] + $data['x3']) ; // 9 jam ke atas  
                //      }
                //     elseif (($over >= 8) && ($over<= 8)) {
				//		    $data['x1']=0; 
                //            $data['x2']=7; // 7 Jam Pertama 
                //            $data['x3']=1; // 8 Jam
                //            $data['x4']=0; 
                //           }
                //    elseif (($over >= 1) && ($over <= 7) ){
				//	        $data['x1']=0;
                //            $data['x2']=$over; 
                //            $data['x3']=0; 
                //            $data['x4']=0;
				//         }			
					//
				//   } 
				//else 
				//   { 
				//        //bukan hari libur
						//$active='';
				//		if($over <= 1) {
				//		   $data['x1']=1;
                //           $data['x2']=0;
                //           $data['x3']=0;
                //           $data['x4']=0;
				//		} 
                        
				//	    elseif ($ov >= 2 ){
				//	       $data['x1']=1;
				//	       $data['x2']=$over - 1;
                //           $data['x3']=0;
                //           $data['x4']=0;
                //            } 
                //     }		
					//bukan hari libur		
				   
                //End Holiday Saturday AND Monday
				
				//Start Holiday Hari besar /Nasional
                //$query2 = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";
				//$Q2=$this->db->query($query2);
				//if($Q2->num_rows() > 0 )
				//{
			  	      //$active='';
				//	  $data['x1']=0;
				//	  $data['x2']=0;
				//	  $data['x3']=$over;
				//	  $data['x4']=0;
		        //}  
				
				//End Holiday Hari Nasional  
				
                 //$this->db->where('date',$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])));
				 //$this->db->where('code',$this->input->xss_clean($_POST['code']));
                 //bn$this->db->update('josh_details_day_tr',$data);
    }
    
    
    function cekdayUpdate(){
          $tanggal=$this->input->xss_clean($this->input->post('date'));
          //Holiday Hari besar /Nasional
          $query2 = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";
		  $Q2=$this->db->query($query2);
		  if($Q2->num_rows()>=1 ){
                $this->saveDayRecordOvertime();
             } else {
		          
		          $tanggal=$this->input->post('date');
                  $query = "SELECT datediff('$tanggal', CURDATE()) as day";
		          $Q=$this->db->query($query);
		          $row=$Q->row_array();
		          //$row->free_result();
		          $x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
		          $namahari = date("l", $x);
		          if(($namahari == 'Saturday') || ($namahari == 'Sunday')){
			           $this->UpdateDayRecordOvertime();
		          } else {
		               //$active=$tanggal;
                       $this->UpdateDayRecordActive();
                  }
                   //Holiday Saturday AND Monday
		         }   
          
				
    }
    
	
	function UpdateDayRecordActive(){
	    if ($this->input->xss_clean($this->input->post('time')) < 1 ) 
            {
					$this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time < 0</div>');
					redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
            }
		$this->db->select('SUM(time) as time');							
	    $this->db->where('date',$this->input->xss_clean($this->input->post('date')));
		$this->db->where('tr_code',$this->input->xss_clean($_SESSION['tr_code']));
	    $Q=$this->db->get('josh_details_day_tr');
		if($Q->num_rows()>=1){
			$row=$Q->row_array();
			$a = 8;
			$time=$row['time'];
			if ( $this->input->xss_clean($this->input->post('time')) <= ($a - ($time - $this->input->post('time_hidden'))) )
			   {
				   $this->UpdateDayRecord2();
			   }
			else{
					$this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time < '.$a - $time.'</div>');
                }			
		} else {
			$a=8;
			if ( $this->input->xss_clean($this->input->post('time')) <= $a )
			   {
				   $this->UpdateDayRecord2();
			   }
			else
               {
					$this->session->set_flashdata('message','<div class=" message errormessage">Your Regular Time < '.$a.'</div>');
               }			   
		}
	} 
	
	function UpdateDayRecord2()
    {
        $data['time']= $this->input->xss_clean($_POST['time']);							
	    $this->db->where('date',$this->input->xss_clean($this->input->post('date')));
		$this->db->where('code',$this->input->xss_clean($this->input->post('code')));
	    $this->db->update('josh_details_day_tr',$data);
        
        $data = array('staff_approval'=>'no',
					  'staff_signature'=>'',
					  'staff_name'=>'', 
					  'staff_approval2'=>'no',
					  'staff_signature2'=>'',
					  'staff_name2'=>''
                     );
					 
	    //$this->db->where('date',$this->input->xss_clean($this->input->post('date')));
		$this->db->where('day_code',$this->input->xss_clean($this->input->post('code')));
	    $this->db->update('josh_details_tr',$data);
    } 
    
    function UpdateDayRecordOvertime(){
        $data['over_time']= $this->input->xss_clean($_POST['time']);							
	    $this->db->where('date',$this->input->xss_clean($this->input->post('date')));
		$this->db->where('code',$this->input->xss_clean($this->input->post('code')));
	    $this->db->update('josh_details_day_tr',$data);
        
        $data = array('staff_approval'=>'no',
					  'staff_signature'=>'',
					  'staff_name'=>'', 
					  'staff_approval2'=>'no',
					  'staff_signature2'=>'',
					  'staff_name2'=>''
                     );
					 
	    //$this->db->where('date',$this->input->xss_clean($this->input->post('date')));
		$this->db->where('day_code',$this->input->xss_clean($this->input->post('code')));
	    $this->db->update('josh_details_tr',$data);
    }   		
    
    function saveDayOvertimeRecord2()
    {
        
        $month1=substr($this->input->post('date'),5,2);
        $day=substr($this->input->post('date'),8,2);
        if ($day == '05')
           {
               if (($this->input->post('day')>=21) &&($this->input->post('day')<=31)){
                    $month=number_format($month1);}
                elseif(($this->input->post('day')>='01') && ($this->input->post('day')<= '5')){
                    $month=number_format($month1) + 1; }             
           }
         elseif($day == '20'){
               $month=number_format($month1);
         }
         
         if($month > 9 )
         { $month=$month; }else{
            $month='0'.$month;
         }
         
         $_SESSION['month']=$month;
		 $month=$_SESSION['month'];
         
		 if($month>12):
			$month='01';
			$year='2014';
		 else:
			$year='2014';
		 endif;	 		 
        
 
        $data=array();
            $this->db->select('code,date,time');
            $this->db->where('code',$this->input->xss_clean($_POST['code']));
            $this->db->where('type_job',$this->input->xss_clean(strtolower($_POST['type'])));
            $this->db->where('date',$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])));
            $Q=$this->db->get('josh_details_day_tr');
            if($Q->num_rows()> 0 )
    		   {   //$this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).$month1.' Is Already!</div>');
    		       //redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
                   $this->saveTableOvertime();
               } else {
                    //$this->saveTable2();
                    $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).$month1.' Is Not Already Please Input Time!</div>');
    		       //redirect('time_report/user/view/'.$_SESSION['tr_code'],301); 
                    }   
    		$Q->free_result();
    		return $data;
    }
    
    //function saveTableOvertime()
    function saveDayOvertimeRecord()
    {
	    $this->input->post('date'); 	 
        $day=substr($this->input->post('date'),8,2);
        $month1=substr($this->input->post('date'),5,2);
        $over=selisih($this->input->xss_clean($_POST['time_1']),$this->input->xss_clean($_POST['time_2']));
        //echo $over;
        $month1=substr($this->input->post('date'),5,2);
        $day=substr($this->input->post('date'),8,2);
        if ($day == '05')
           {
               if (($this->input->post('day')>=21) &&($this->input->post('day')<=31)){
                    $month=number_format($month1);}
                elseif(($this->input->post('day')>='01') && ($this->input->post('day')<= '5')){
                    $month=number_format($month1) + 1; }             
           }
         elseif($day == '20'){
               $month=number_format($month1);
         }
         
         if($month > 9 )
         { $month=$month; }else{
            $month='0'.$month;
         }
         
         $_SESSION['month']=$month;  
        //Holiday
        
		
		if ($day == '05')
           {
                $temp=number_format(substr($this->input->post('date'),5,2)) + 1;
                if($month2=$temp>9)
                    {$month2=$temp;}else {$month2='0'.$temp;}
                if (($this->input->post('day')>=21) &&($this->input->post('day')<=31)){
                    $month=$month1; }
                elseif(($this->input->post('day')>='01') && ($this->input->post('day')<= '5')){
                    $month=$month2; }
                
                $chf=$this->input->post('type');
                $transport=$this->input->post('transport');
                
                if($chf=='CHF')
                {                   
	               $data=array(
                            'over_time'=>$over,
                            'time_1'=>$this->input->xss_clean($_POST['time_1']),
                            'time_2'=>$this->input->xss_clean($_POST['time_2'])
		                  );
                } elseif(($chf=='CHO') || ($chf=='NCH')){
                       $data=array(
                            'over_time'=>$over,
                            'time_1'=>$this->input->xss_clean($_POST['time_1']),
                            'time_2'=>$this->input->xss_clean($_POST['time_2'])
		                  );
                }             
           }
         elseif($day == '20'){
               
               $chf=$this->input->post('type');
               $transport=$this->input->post('transport');
            
               if($chf=='CHF')
                {          
                    
	               $data=array(
                            'over_time'=>$over,
                            'time_1'=>$this->input->xss_clean($_POST['time_1']),
                            'time_2'=>$this->input->xss_clean($_POST['time_2'])
		                  );
                } elseif($chf=='CHO'){
                       $data=array(
                            'over_time'=>$over,
                            'time_1'=>$this->input->xss_clean($_POST['time_1']),
                            'time_2'=>$this->input->xss_clean($_POST['time_2'])
		                  );
                } elseif($chf=='NCH') {
                    $data=array(
                            'over_time'=>$over,
                            'time_1'=>$this->input->xss_clean($_POST['time_1']),
                            'time_2'=>$this->input->xss_clean($_POST['time_2'])
		                  );
                } 
         }
        $month=$_SESSION['month'];
        if($month>12):
			$month='01';
			$year='2014';
		else:
			$year='2014';
		endif;	 		
		
        $this->db->where('date',$this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day']))); 
        $this->db->where('code',$this->input->xss_clean($_POST['client']));
        $this->db->where('type_job',$this->input->xss_clean(strtolower($_POST['type']))); 
        $this->db->update('josh_details_day_tr',$data); 

                    
        if($over >= 3){
            $data['meal']=1;
        } else {
            $data['meal']=0;
        } 
    //Start Holiday Saturday AND Monday tgl yang akan dicari nama harinya				
	$tanggal = $this->input->xss_clean($year.'-'.$month.'-'.$this->input->xss_clean($_POST['day']));
    $code    = $this->input->xss_clean($_POST['client']);
	$query = "SELECT datediff('$tanggal', CURDATE()) as day";
	$Q=$this->db->query($query);
	$row=$Q->row_array();
	//$x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
	
	/*$namahari = date("l", $x);
	if(($namahari == 'Saturday') || ($namahari == 'Sunday')){
        if ($over >= 9){
               $data['x1']=0;
               $data['x2']=7; // 7 jam Pertama
               $data['x3']=1;  //8 Jam 
               $data['x4']=$over-($data['x2'] + $data['x3']) ; // 9 jam ke atas  
           }
       elseif (($over >= 8) && ($over<= 8)) {
               $data['x1']=0; 
               $data['x2']=7; // 7 Jam Pertama 
               $data['x3']=1; // 8 Jam
               $data['x4']=0; 
              }
       elseif (($over >= 1) && ($over <= 7) ){
	       $data['x1']=0;
               $data['x2']=$over; 
               $data['x3']=0; 
               $data['x4']=0; }			
     } 
      else  { 
        //non holiday
		if($over <= 1) { 
                   $data['x1']=1;
                   $data['x2']=0;
                   $data['x3']=0;
                   $data['x4']=0;
		} 
         elseif ($over >= 2 ){
				   $data['x1']=1;
		           $data['x2']=$over - 1;
                   $data['x3']=0;
                   $data['x4']=0;
                   } 
        }		
	        //Start Holiday Hari besar /Nasional
            $query2 = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";
	        $Q2=$this->db->query($query2);
	        if($Q2->num_rows() > 0 ) {
		     //$active='';
		    $data['x1']=0;
		    $data['x2']=0;
	        $data['x3']=$over;
		    $data['x4']=0;
		 }  
	*/			
           //End Holiday Hari Nasional  			
           $this->db->where('date',$tanggal);
	   $this->db->where('code',$code);
           $this->db->update('josh_details_day_tr',$data);
	   //$i++;
        //} 
     		
    }
        
    function getRecord($id)
	{
		$data=array();
		$this->db->where('tr_code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_head_tr');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function selectdayRecord()
    {
        $data=array();
        $this->db->select('day,time');
        //$this->db->where('staff_no',$_SESSION['no']);
        $this->db->where('tr_code',$id); 
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function updateRecord()
	{
		$data=array(
            'code'=>$this->input->xss_clean($_POST['code']),
            'name'=>$this->input->xss_clean($_POST['name']),
            'description'=>$this->input->xss_clean($_POST['description'])
		); 
        
        $this->db->where('code',$this->input->xss_clean($_POST['code']));
		$this->db->update('josh_position',$data);
	}
    
    function deleteRecord($id)
    {
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->delete('josh_position');
    }
    
    //report
   
    //for CHF 
    function selectchf($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2,josh_job.Partner,josh_job.Senior_Manager,josh_job.Manager,josh_job.Ass_Manager,josh_job.Senior,HRD');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
		//$this->db->or_where('Manager',$_SESSION['no']);
        //$this->db->groupby('job_code'); 
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	//for CHF OT
    function selectchfOT($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2,josh_job.Partner,josh_job.Senior_Manager,josh_job.Manager,josh_job.Ass_Manager,josh_job.Senior,HRD');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
		$this->db->where('josh_job.gr_id',$_SESSION['group']);
        //$this->db->orderby('time','ASC'); 
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		 else {$data[]=null;}  
		$Q->free_result();
		return $data;
    }
    
    //for CHO
    function selectcho($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2,josh_job.Partner,josh_job.Senior_Manager,josh_job.Manager,josh_job.Ass_Manager,josh_job.Senior,HRD');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','CHO');
        $this->db->where('tr_code',$id);
		//$this->db->where('josh_job.gr_id',$_SESSION['group']);
        //$this->db->orderby('time','ASC'); 
		//$this->db->groupby('job_code'); 
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	//for CHO OT
    function selectchoOT($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2,josh_job.Partner,josh_job.Senior_Manager,josh_job.Manager,josh_job.Ass_Manager,josh_job.Senior,HRD');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','CHO');
        $this->db->where('tr_code',$id);
		$this->db->where('josh_job.gr_id',$_SESSION['group']);
        //$this->db->orderby('time','ASC'); 
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		else {$data[]=null;}    
		$Q->free_result();
		return $data;
    }
    
    //for NCH
    function selectnch($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','NCH');
        $this->db->where('tr_code',$id);
		//$this->db->groupby('job_code'); 
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	//for NCH
    function selectnchOT($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature,staff_approval2,staff_name2,staff_signature2');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
		$this->db->where('code_type','NCH');
        $this->db->where('tr_code',$id);
		$this->db->where('josh_job.gr_id',$_SESSION['group']);
		$Q=$this->db->get('josh_details_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		else {$data[]=null;}    
		$Q->free_result();
		return $data;
    }
    
    //Menampilkan Data Per Manager
    function selectManageRecords()
	{
		$data=array();
        $sql =" SELECT josh_head_tr.periode ";
        $sql.=" FROM josh_head_tr ";
        $sql.=" JOIN josh_details_tr ON josh_details_tr.tr_code=josh_head_tr.tr_code ";
        $sql.=" JOIN josh_job ON josh_job.code=josh_details_tr.job_code ";
        $sql.=" Where SUBSTR(josh_head_tr.periode,1,4)>='2015'";
	    if($_SESSION['level']=='P')  $sql.=" AND josh_job.Partner='".$_SESSION['no']."' ";
	    if($_SESSION['level']=='AP') $sql.=" AND josh_job.Manager='".$_SESSION['no']."' ";
	    if($_SESSION['level']=='M')  $sql.=" AND josh_job.Manager='".$_SESSION['no']."' ";
	    if($_SESSION['level']=='AM') $sql.=" AND josh_job.Ass_Manager='".$_SESSION['no']."'";
	    if($_SESSION['level']=='SM') $sql.=" AND josh_job.Senior_Manager='".$_SESSION['no']."' ";
	    if($_SESSION['level']=='S2') $sql.=" AND josh_job.Senior='".$_SESSION['no']."'";
		if($_SESSION['level']=='S1') $sql.=" AND josh_job.Senior='".$_SESSION['no']."'";
		$sql.=" GROUP BY josh_head_tr.periode "; 
		$sql.=" ORDER BY josh_head_tr.periode DESC"; 
        $Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
        }
		$Q->free_result();
		return $data;
	}
    
	function selectPeriodeDetails($id)
    {
        $data=array();
		$sql = "  SELECT josh_head_tr.tr_code,josh_staff.no,josh_staff.name,josh_staff.photo,
		          josh_staff.hp,josh_staff.email,josh_head_tr.pos_code,josh_head_tr.pos_code,
				  josh_head_tr.status_manager,josh_head_tr.status 
		          FROM josh_head_tr
				  JOIN josh_staff ON josh_staff.no=josh_head_tr.staff_no
				  JOIN josh_position ON josh_position.code=josh_head_tr.pos_code
				  where josh_head_tr.periode='".$id."'
				  and josh_position.order > ".$_SESSION['order']."
				  GROUP BY josh_head_tr.staff_no
		       ";
		
        /*$sql  =" SELECT josh_head_tr.tr_code,josh_staff.no,josh_staff.name,josh_staff.photo,";
        $sql .=" josh_staff.hp,josh_staff.email,josh_head_tr.pos_code,josh_head_tr.pos_code,";
        $sql .=" josh_job.code,josh_head_tr.status_manager,josh_head_tr.status ";
        $sql .=" FROM josh_head_tr ";
        $sql .=" JOIN josh_staff ON josh_staff.no=josh_head_tr.staff_no ";
        $sql .=" JOIN josh_details_tr ON josh_details_tr.tr_code=josh_head_tr.tr_code ";
        $sql .=" JOIN josh_job ON josh_job.code=josh_details_tr.job_code ";
        $sql .=" JOIN josh_position ON josh_position.code=josh_head_tr.pos_code ";
        $sql .=" where ";
        $sql .=" josh_job.status_job='active' AND ";
        $sql .=" josh_head_tr.periode='".$id."' AND ";
        $sql .=" josh_position.order > ".$_SESSION['order']." AND "; 
        
        if($_SESSION['level']=='HRD'):
            $sql .= " josh_job.HRD='".$_SESSION['no']."' ";
        endif; 
        
		if($_SESSION['level']=='P'):
            $sql .= " josh_job.Partner='".$_SESSION['no']."' ";
        endif;
		
        if($_SESSION['level']=='M'):
            $sql .= " josh_job.Manager='".$_SESSION['no']."' ";
        endif; 
        
        if($_SESSION['level']=='AM'):
            $sql .= " josh_job.Ass_Manager='".$_SESSION['no']."' ";
        endif; 
        
        if(($_SESSION['level']=='S2') || ($_SESSION['level']=='S1')):
            $sql .= " josh_job.Senior='".$_SESSION['no']."' ";
        endif; 
        
        if($_SESSION['level']=='SM'):
            $sql .= " josh_job.Senior_Manager='".$_SESSION['no']."' ";
        endif; 
           

        $sql .= " AND ";
        $sql .= " josh_job.code NOT IN ('NC1001') AND ";
        $sql .= " josh_job.code NOT IN ('NC1002') AND ";
        $sql .= " josh_job.code NOT IN ('NC1003') AND ";
        $sql .= " josh_job.code NOT IN ('NC1004') AND ";
        $sql .= " josh_job.code NOT IN ('NC1005') AND ";
        $sql .= " josh_job.code NOT IN ('NC1006') AND ";
        $sql .= " josh_job.code NOT IN ('NC1007') AND ";
        $sql .= " josh_job.code NOT IN ('NC1008') AND ";
        $sql .= " josh_job.code NOT IN ('NC1009') AND ";
        $sql .= " josh_job.code NOT IN ('NC1010') ";          

        $sql .= " GROUP BY josh_head_tr.staff_no ";
        $sql .= " order by josh_head_tr.staff_no ASC ";
		*/
		
        $Q=$this->db->query($sql); 
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	
	 /*
        (
        (josh_job.HRD='') OR
        (josh_job.Manager='10003')        OR
        (josh_job.Ass_Manager='')    OR
        (josh_job.Senior_Manager='') OR
        (josh_job.Senior='')	        ) 
        */
    function selectManagePerPeriodeRecords($id)
    {
		//if($_SESSION['level']=='P')  $sql.=" josh_job.Partner='".$_SESSION['no']."' ";
		//AND josh_staff.`group_id`=$_SESSION[group]
		$data = array();
		/*$sql  = " SELECT josh_head_tr.tr_code,josh_staff.no,josh_staff.name,josh_staff.photo, 
				  josh_staff.hp,josh_staff.email,josh_head_tr.pos_code,josh_head_tr.pos_code,
				  josh_head_tr.status_manager,josh_head_tr.status 
				  FROM josh_head_tr
				  INNER JOIN josh_details_tr on josh_details_tr.tr_code =  josh_head_tr.tr_code
				  INNER JOIN josh_job on josh_job.code = josh_details_tr.job_code
				  INNER JOIN josh_staff ON josh_staff.no=josh_head_tr.staff_no 
				  INNER JOIN josh_position ON josh_position.code=josh_head_tr.pos_code 
				  WHERE josh_head_tr.periode = '$id' 
				  AND josh_position.order > $_SESSION[order]
		";
		*/
		$sql = "
			SELECT jdt.`tr_code`,js.`no`,js.`name`,js.`photo`,js.`hp`,js.`email`,jht.`pos_code`,jht.status_manager,jht.status,js.`group_id` 
			FROM josh_details_tr jdt
			INNER JOIN josh_staff js ON js.no=SUBSTR(jdt.`tr_code`,4,5)
			INNER JOIN josh_head_tr jht ON jht.tr_code =  jdt.tr_code
			INNER JOIN josh_job jj ON jj.code = jdt.job_code
			INNER JOIN josh_position jp ON jp.`code`=jht.pos_code
			WHERE jht.periode = '".$id."'
			AND jp.order > $_SESSION[order]
		";
		
		if($_SESSION['level']=='M')   $sql.=" AND jj.Manager='".$_SESSION['no']."' ";
		if($_SESSION['level']=='AM')  $sql.=" AND jj.Ass_Manager='".$_SESSION['no']."' ";
		if($_SESSION['level']=='S2')  $sql.=" AND jj.Senior2='".$_SESSION['no']."' ";
		if($_SESSION['level']=='S1')  $sql.=" AND jj.Senior1='".$_SESSION['no']."' ";
		if($_SESSION['level']=='AS')  $sql.=" AND jj.Ass_Senior='".$_SESSION['no']."' ";
		
		$sql.=" GROUP BY jht.`tr_code` ORDER BY jht.staff_no ASC LIMIT 1000;";
		
        $Q=$this->db->query($sql); 
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	function selectManagePerPeriodeRecordsOT($id)
    {
        $data=array();
        $this->db->select('josh_head_tr.tr_code,josh_staff.no,josh_staff.name,josh_staff.photo,josh_staff.hp,josh_staff.email,josh_position.name_p,josh_staff.pos_code,josh_group.group_name,status_manager');
	$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
	$this->db->join('josh_details_tr','josh_details_tr.tr_code=josh_head_tr.tr_code');
	$this->db->join('josh_job','josh_details_tr.job_code=josh_job.code');
        $this->db->where('josh_head_tr.periode',$id);
	//$this->db->where('josh_job.gr_id',$_SESSION['group']);
        $this->db->where_not_in('josh_staff.no',$_SESSION['no']);
        $this->db->where_not_in('josh_staff.group_id',$_SESSION['group']);
        
        //tambahan untuk partner
        if($_SESSION['level']=='P'){
             $where="josh_staff.group_id <= 9";
             $this->db->or_where($where);
             $this->db->where('josh_head_tr.periode',$id);
             $this->db->where('josh_staff.pos_code','M');
        }
        //End Of tambahan untuk SM
         //tambahan untuk partner
        if($_SESSION['level']=='SM'){
             $where="josh_staff.group_id <= 5";
             $this->db->or_where($where);
             $this->db->where('josh_head_tr.periode',$id);
             //$this->db->where('josh_staff.pos_code','M');
        }
        //End Of tambahan untuk parner
        $this->db->where('josh_position.order > ',$_SESSION['order']);
		$this->db->groupby('josh_head_tr.tr_code');
        $this->db->orderby('josh_position.order','ASC');
        $this->db->orderby('josh_staff.no','ASC');  
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function selectHRDPerPeriodeRecords($id)
    {
        $data=array();
        $this->db->select('*'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where_not_in('josh_staff.no',$_SESSION['no']);
        //$this->db->where('josh_staff.group_id',$_SESSION['group']);
        //tambahan untuk partner
        if($_SESSION['level']=='P'){
             $where="josh_staff.group_id <= 9";
             $this->db->or_where($where);
             $this->db->where('periode',$id);
             $this->db->where('josh_staff.pos_code','M');
        }
        //End Of tambahan untuk parner
        //$this->db->where('josh_position.order > ',$_SESSION['order']);
        $this->db->orderby('josh_position.order','ASC');
        $this->db->orderby('josh_staff.no','ASC');  
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function saveAproval($trcode)
    {
		$type_job = $this->input->post('type_job');
        /** Approval Per Job Timereport **/
		$sql = " SELECT * from josh_details_tr WHERE tr_code='".$trcode."' AND code_type='".$type_job."' ";
		$Q = $this->db->query($sql);
		$rows = $Q->result_array();
		if($rows){
			foreach($rows as $v){
				 $appdata = array('staff_approval'  => 'yes',
							  'staff_name'		=> $this->input->xss_clean($_SESSION['name']),
							  'staff_signature' => $this->input->xss_clean($_SESSION['sign']),
							  'staff_approval2' => 'yes',
							  'staff_name2'     => $this->input->xss_clean($_SESSION['name']),
							  'staff_signature2'=> $this->input->xss_clean($_SESSION['sign'])	  
				 );
				 $this->db->where('day_code',$v['day_code']);
				 $this->db->update('josh_details_tr',$appdata);
			}
		}
        /** End Of Approval Per Job Timereport 
		
        /** Approve Time & Overtime **/
        $code = $this->input->post('code');
        $datex = $this->input->post('date');
        $totalcode = count($code);
        for($i=0;$i<$totalcode;$i++){
            if($i<$totalcode){
			    //pecah code
				$assets = $code[$i];
				$array  = explode(";",$assets);
				$codeid = $array[0];
				$dateid = $array[1];
				$date = mysqldate($dateid);
				$time = $this->input->post('time'.$codeid.$date);
				$overtime = $this->input->post('overtime'.$codeid.$date);
				
                //Aproval Manager/HRD 
               
                $data['over_time_app']     = $overtime;
				$data['time']     		   = $time;
				$data['app_manager']       = 'yes';
                $data['over_manager']      = 'yes';
                $data['over_manager_sign'] = $_SESSION['sign'];
                if($overtime >= 3)
                    $data['meal'] = 1;
                else
                    $data['meal'] = 0;
                
                //Perhitungan Disnaker Lembur
                
                //Hari Libur , diinput di timereport
                $qholiday = "SELECT date_h as day FROM josh_holiday WHERE date_h='".$date."'";
		        $holiday=$this->db->query($qholiday);
                
                //Hari Sabtu/Minggu
                $qweekend = "SELECT datediff('".$date."', CURDATE()) as day";
                $weekend  = $this->db->query($qweekend);
                $row=$weekend->row_array();
                $x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
		        $dayname = date("l", $x);
                
                //jika hari libur nasional
                if($holiday->num_rows()>0){
                    $x1 = 0;
                    $x2 = 0;
                    $x3 = $overtime;
                    $x4 = 0;
                
                //jika weekend    
                } elseif(($dayname == 'Saturday') || ($dayname == 'Sunday')){
                    if ($overtime>= 9){
		              $x1 = 0;
		              $x2 = 7; // 7 jam Pertama
		              $x3 = 1;  //8 Jam 
		              $x4 = $overtime-($x2 + $x3) ; // 9 jam ke atas  
                    }
	                elseif (($overtime >= 8) && ($overtime<= 8)) {
		              $x1 = 0; 
		              $x2 = 7; // 7 Jam Pertama 
		              $x3 = 1; // 8 Jam
		              $x4 = 0; 
							   }
		            elseif (($overtime <= 7) ){
		              $x1 = 0;
                      $x2 = $overtime; 
		              $x3 = 0; 
		              $x4 = 0;
                    }
                
                //weekday  			
                } else { 
		            if(($overtime >= 1 ) && ($overtime <= 1 )) {
			             $x1 = 1;
			             $x2 = 0;
					     $x3 = 0;
					     $x4 = 0;
                    } elseif ($overtime>= 2 ){
			             $x1 = 1;
			             $x2 = $overtime- 1;
			             $x3 = 0;
			             $x4 = 0;
	                } 
					else{
						 $x1 = 0;
			             $x2 = 0;
					     $x3 = 0;
					     $x4 = 0;
					}
	            }
                
                
                $data['x1'] = $x1;
                $data['x2'] = $x2;
                $data['x3'] = $x3;
                $data['x4'] = $x4;	
                
                //update data details
				$data['app_draft'] = 'no';
                $this->db->where('date',$date);
	            $this->db->where('code',$codeid);
                $this->db->update('josh_details_day_tr',$data);
                
                $sql  = " SELECT pos_code as pos from josh_head_tr WHERE tr_code='".$trcode."'";
				$Q    = $this->db->query($sql);
				$posx = $Q->row_array();
				$pos  = $posx['pos'];
				
				//save hour to job
				$job_code = substr($this->input->xss_clean($codeid),18,12);
				$pos = $pos;
				$total_hour = $this->SUMTimeReportUser($job_code,$pos);
				$jobVal[$pos."_hour"] = $total_hour;
				if(($jobVal) && ($job_code))
				{
					$this->db->where('code',$job_code);
					$this->db->update('josh_job',$jobVal);
				}
				
            }
        }
        /** End Approve Time & Overtime **/
        
    }
	
	public function saveAprovalHRD($trcode) {
		$code = $this->input->post('code');
		$totalcode = count($code);
		for($i=0;$i<$totalcode;$i++) {
			//$app = $this->input->post('app');
			$array  = explode(";",$code[$i]);
			$codeid = $array[0];
			$trcode = $trcode;
			$date = mysqldate($array[1]);
			$time = $this->input->post('time'.$codeid.$date);
			$app_manager = $this->input->post('app_manager'.$codeid.$date);
			$app_hrd = $this->input->post('app'.$codeid.$date);
			$transport = $this->input->post('transport'.$codeid.$date);
			$overtime = $this->input->post('over_time_app'.$codeid.$date);
			
			if($overtime >= 3)
				$data['meal'] = 1;
			else
				$data['meal'] = 0;
				
			$qholiday = "SELECT date_h as day FROM josh_holiday WHERE date_h='".$date."'";
			$holiday=$this->db->query($qholiday);
					
			$qweekend = "SELECT datediff('".$date."', CURDATE()) as day";
			$weekend  = $this->db->query($qweekend);
			$row=$weekend->row_array();
			$x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
			$dayname = date("l", $x);	
			
			$x1 = 0;
			$x2 = 0;
			$x3 = 0;
			$x4 = 0;
			if($holiday->num_rows() > 0) {
				$x1 = 0;
				$x2 = 0;
				$x3 = $overtime;
				$x4 = 0;
			}else if(($dayname == 'Saturday') || ($dayname == 'Sunday')){
				if ($overtime>= 9){
					$x1 = 0;
					$x2 = 7; // 7 jam Pertama
					$x3 = 1;  //8 Jam 
					$x4 = $overtime-($x2 + $x3) ; // 9 jam ke atas  
				}
				else if (($overtime >= 8) && ($overtime<= 8)) {
					$x1 = 0; 
					$x2 = 7; // 7 Jam Pertama 
					$x3 = 1; // 8 Jam
					$x4 = 0; 
				}else{
					$x1 = 0;
					$x2 = $overtime; 
					$x3 = 0; 
					$x4 = 0;
				}
			}
			else{ 
				if(($overtime >= 1 ) && ($overtime <= 1 )) {
					$x1 = 1;
					$x2 = 0;
					$x3 = 0;
					$x4 = 0;
				} elseif ($overtime>= 2 ){
					$x1 = 1;
					$x2 = $overtime- 1;
					$x3 = 0;
					$x4 = 0;
				} 
			}
			
			$data['x1'] = $x1;
			$data['x2'] = $x2;
			$data['x3'] = $x3;
			$data['x4'] = $x4;
			$data['transport_chf'] = $transport;
			$data['over_time_app'] = $overtime;	
			$data['app_manager'] = 'yes';
			$data['app_hrd']  = $app_hrd == 1 ? "YES" : "NO";
			//update data details
			$this->db->where('date',$date);
			$this->db->where('code',$codeid);
			$this->db->update('josh_details_day_tr',$data);
			
			//update josh_details_tr
			$appdata['hrd_approval'] = 'yes';
			$appdata['hrd_name']     = $this->input->xss_clean($_SESSION['name']);
			$appdata['hrd_signature']= $this->input->xss_clean($_SESSION['sign']);
			
			
			$sqlx = "SELECT * from josh_details_tr WHERE day_code = '".$codeid."' LIMIT 1";
			$vmex  = $this->db->query($sqlx);
			$v = $vmex->row_array();
			
			if(($v['staff_approval2'] == 'no') || (!$v['staff_approval2'])) {
				$appdata['staff_approval2'] = 'yes';
				$appdata['staff_name2']     = $this->input->xss_clean($_SESSION['name']);
				$this->db->where('day_code',$codeid);
				$this->db->update('josh_details_tr',$appdata);
			}
			
			$sql  = " SELECT pos_code as pos from josh_head_tr WHERE tr_code='".$trcode."'";
			$Q    = $this->db->query($sql);
			$posx = $Q->row_array();
			$pos  = $posx['pos'];
					
			//save hour to job
			$job_code = substr($this->input->xss_clean($codeid),18,12);
			$pos = $pos;
			$total_hour = $this->SUMTimeReportUser($job_code,$pos);
			$jobVal[$pos."_hour"] = $total_hour;
			if(($jobVal) && ($job_code)) {
				$this->db->where('code',$job_code);
				$this->db->update('josh_job',$jobVal);
			}
		}		
	}	
	
	function saveAprovalHRD2($trcode)
    {
        /** Approve Time & Overtime **/
        $code = $this->input->post('code');
		$app = $this->input->post('app');
        $totalcode = count($code);
		if($totalcode) {
			for($i=0;$i<$totalcode;$i++) {
				if(isset($code[$i])) {
					//Aproval Manager/HRD 
					$assets = $code[$i];
					$array  = explode(";",$assets);
					$codeid = $array[0];
					$dateid = $array[1];
					$date = mysqldate($dateid);
					$time = $this->input->post('time'.$codeid.$date);
					$overtime = $this->input->post('over_time_app'.$codeid.$date);
					$app_manager = $this->input->post('app_manager'.$codeid.$date);
					$transport = $this->input->post('transport'.$codeid.$date);
					
					//cek hari libur
					$qholiday = "SELECT date_h as day FROM josh_holiday WHERE date_h='".$date."'";
					$holiday=$this->db->query($qholiday);
					
					$qweekend = "SELECT datediff('".$date."', CURDATE()) as day";
						$weekend  = $this->db->query($qweekend);
					$row=$weekend->row_array();
					$x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
					$dayname = date("l", $x);
					
					
					
					/** Approval Per Job Timereport **/
					$sql = " SELECT * from josh_details_tr WHERE day_code='".$codeid."' ";
					$Q = $this->db->query($sql);
					$rows = $Q->result_array();
					if($rows){
						foreach($rows as $v){
							 $appdata['hrd_approval'] = 'yes';
							 $appdata['hrd_name']     = $this->input->xss_clean($_SESSION['name']);
							 $appdata['hrd_signature']= $this->input->xss_clean($_SESSION['sign']);
							 
							 if(($v['staff_approval2']=='no') || (!$v['staff_approval2'])){
								$appdata['staff_approval2'] = 'yes';
								$appdata['staff_name2']     = $this->input->xss_clean($_SESSION['name']);
								$appdata['staff_name2']     = $this->input->xss_clean($_SESSION['sign']);
							 }
							 $this->db->where('day_code',$v['day_code']);
							 $this->db->update('josh_details_tr',$appdata);
						}
					}
					/** End Of Approval Per Job Timereport **/
					
					$data['time']= $time;
					$data['transport_chf']= $transport;
					$data['app_hrd']  = 'yes';	
					if($code[$i] == $app[$i]) {
						//app manager
						$data['app_manager'] = 'yes';
						if($overtime >= 3)
							$data['meal'] = 1;
						else
							$data['meal'] = 0;
						
						//Perhitungan Disnaker Lembur
						//Hari Libur , diinput di timereport
						$qholiday = "SELECT date_h as day FROM josh_holiday WHERE date_h='".$date."'";
						$holiday=$this->db->query($qholiday);
						
						//Hari Sabtu/Minggu
						$qweekend = "SELECT datediff('".$date."', CURDATE()) as day";
						$weekend  = $this->db->query($qweekend);
						$row=$weekend->row_array();
						$x  = mktime(0, 0, 0, date("m"), date("d")+$row['day'], date("Y"));
						$dayname = date("l", $x);
						
						//jika hari libur nasional
						if($holiday->num_rows()>0) {
							$x1 = 0;
							$x2 = 0;
							$x3 = $overtime;
							$x4 = 0;
						
						//jika weekend    
						} elseif(($dayname == 'Saturday') || ($dayname == 'Sunday')){
							if ($overtime>= 9){
							  $x1 = 0;
							  $x2 = 7; // 7 jam Pertama
							  $x3 = 1;  //8 Jam 
							  $x4 = $overtime-($x2 + $x3) ; // 9 jam ke atas  
							}
							elseif (($overtime >= 8) && ($overtime<= 8)) {
							  $x1 = 0; 
							  $x2 = 7; // 7 Jam Pertama 
							  $x3 = 1; // 8 Jam
							  $x4 = 0; 
									   }
							elseif (($overtime <= 7) ){
							  $x1 = 0;
							  $x2 = $overtime; 
							  $x3 = 0; 
							  $x4 = 0;
							}
						
						//weekday  			
						} else { 
							if(($overtime >= 1 ) && ($overtime <= 1 )) {
								 $x1 = 1;
								 $x2 = 0;
								 $x3 = 0;
								 $x4 = 0;
							} elseif ($overtime>= 2 ){
								 $x1 = 1;
								 $x2 = $overtime- 1;
								 $x3 = 0;
								 $x4 = 0;
							} 
							else{
								 $x1 = 0;
								 $x2 = 0;
								 $x3 = 0;
								 $x4 = 0;
							}
						}
						
						
						$data['x1'] = $x1;
						$data['x2'] = $x2;
						$data['x3'] = $x3;
						$data['x4'] = $x4;
						$data['over_time_app'] = $overtime;	
					}else {
						$data['app_hrd']  = 'NO';	
						$data['x1'] = 0;
						$data['x2'] = 0;
						$data['x3'] = 0;
						$data['x4'] = 0;
						$data['over_time_app'] = 0;	
					}					
					//update data details
					$this->db->where('date',$date);
					$this->db->where('code',$codeid);
					$this->db->update('josh_details_day_tr',$data);
					
					$sql  = " SELECT pos_code as pos from josh_head_tr WHERE tr_code='".$trcode."'";
					$Q    = $this->db->query($sql);
					$posx = $Q->row_array();
					$pos  = $posx['pos'];
					
					//save hour to job
					$job_code = substr($this->input->xss_clean($codeid),18,12);
					$pos = $pos;
					$total_hour = $this->SUMTimeReportUser($job_code,$pos);
					$jobVal[$pos."_hour"] = $total_hour;
					if(($jobVal) && ($job_code))
					{
						$this->db->where('code',$job_code);
						$this->db->update('josh_job',$jobVal);
					}
				}
			}
		}
      
        /** End Approve Time & Overtime **/
        
    }
    
    function selectPeriodeRecord(){
        $data=array();
        $this->db->select('periode'); 
        $this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no'); 
        $this->db->groupby('josh_head_tr.periode');
        $this->db->where('josh_staff.division',$_SESSION['division']);
        $this->db->orderby('josh_head_tr.periode','DESC'); 
		$Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }  
    
    function selectAdminPerPeriodeRecordPro($id)
    {
        $data=array();
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_manager','process');
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
     function selectAdminPerPeriodeRecordApprov($id)
    {
        $data=array();
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_manager','approval');
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }  
    
    function adm_status_manager($id)
    {
        $data=array();
       $option=array('tr_code'=>$id,'status_manager'=>'approval');
       $Q=$this->db->select('status_manager');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 //$data=array('status_manager'=>'process');
             	 $data=array(
                 'status_manager'=>$this->input->xss_clean('process'),
                 'manager_name'=>$this->input->xss_clean(''),
                 'manager_approval'=>$this->input->xss_clean('no'),
                 'manager_signature'=>$this->input->xss_clean('')
                 );
                  $this->db->where('tr_code',$id);
              	  $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     //$data=array('status_manager'=>'approval');
                 $data=array(
                    'status_manager'=>$this->input->xss_clean('approval'),
                    'manager_name'=>$this->input->xss_clean($_SESSION['name']),
                    'manager_approval'=>$this->input->xss_clean('yes'),
                    'manager_signature'=>$this->input->xss_clean($_SESSION['sign'])
           );    
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
    }
    
    function getAdm_Approv($id)
	{
		$data=array();
        $this->db->select('manager_name,manager_signature');
        //$this->db->where('manager_approval','yes');
        //$this->db->where_not_in('manager_signature','');
		$this->db->where('tr_code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_head_tr');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	} 
    
    // FOR HRD 
    function selectHRDPerPeriodeRecordPro($id)
    {
        $data=array();
        $this->db->select('*,josh_head_tr.status');
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_hrd','process');
        $this->db->where('division',$_SESSION['division']);
        $this->db->orderby('josh_staff.no','ASC');
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
	
	function selectHRDPerPeriodeRecordDraft($id)
    {
        $data=array();
        $this->db->select('*,josh_head_tr.status');
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_hrd','pending');
        $this->db->where('division',$_SESSION['division']);
        $this->db->orderby('josh_staff.no','ASC');
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function selectHrdPerPeriodeRecordApprov($id)
    {
        $data=array();
        $this->db->select('*,josh_head_tr.status');
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_hrd','approval');
        $this->db->where('division',$_SESSION['division']);
        $this->db->orderby('josh_staff.no','ASC');
        $Q=$this->db->get('josh_head_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    } 
    
    function hrd_status_manager($id)
    {
        $data=array();
       $option=array('tr_code'=>$id,'status_hrd'=>'approval');
       $Q=$this->db->select('status_hrd');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 //$data=array('status_manager'=>'process');
             	 $data=array(
                 'status_hrd'=>$this->input->xss_clean('process'),
                 'hrd_name'=>$this->input->xss_clean(''),
                 'hrd_approval'=>$this->input->xss_clean('no'),
                 'hrd_signature'=>$this->input->xss_clean('')
                 );
                  $this->db->where('tr_code',$id);
              	  $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     //$data=array('status_manager'=>'approval');
                 $data=array(
                    'status_hrd'=>$this->input->xss_clean('approval'),
                    'hrd_name'=>$this->input->xss_clean($_SESSION['name']),
                    'hrd_approval'=>$this->input->xss_clean('yes'),
                    'hrd_signature'=>$this->input->xss_clean($_SESSION['sign'])
           );    
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
    }
    
    function getHrd_Approv($id)
	{
		$data=array();
        $this->db->select('hrd_name,hrd_signature');
        //$this->db->where('manager_approval','yes');
        //$this->db->where_not_in('manager_signature','');
		$this->db->where('tr_code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_head_tr');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}  

    function selectovertime($id)
    {
		$data=array();
        $this->db->select('DAY(josh_details_day_tr.date) as day,SUM(josh_details_day_tr.over_time_app) as over_time_app ');
        $this->db->where('josh_details_tr.tr_code',$id);
		$this->db->where('over_charge','yes');
		$this->db->where('over_manager','yes');
        $this->db->groupby('josh_details_day_tr.date'); 
        $this->db->join('josh_details_tr','josh_details_tr.day_code=josh_details_day_tr.code');
		$Q=$this->db->get('josh_details_day_tr');
        if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    //tambahan
	public function getBudgetJobHour($data)
	{
		
		$sql = " SELECT * FROM josh_job jj WHERE jj.code = '".$data['job_code']."' ";
		$query = $this->db->query($sql);
		$status = true;
		
		
		if($query->num_rows()>0)
		{
			$row = $query->row_array();
			$time = $data['time'];
			$budget = 0;
			$real = 0;
			
			switch($_SESSION['level'])
			{
				case 'SP' :
					$budget = $row['SP_time'];
					$real = 0;
					break;
				case 'PC' :
					$budget = $row['PC_time'];
					$real = 0;
					break;
				case 'SM' :
					$budget = $row['SM_time'];
					$real = $row['SM_hour'];
					break;
				case 'M' :
					$budget = $row['M_time'];
					$real = $row['M_hour'];
					break;
				case 'AM' :
					$budget = $row['AM_time'];
					$real = $row['AM_hour'];
					break;
				case 'S2' :
					$budget = $row['S2_time'];
					$real = $row['S2_hour'];
					break;
				case 'S1' :
					$budget = $row['S1_time'];
					$real = $row['S1_hour'];
					break;
				case 'AS' :
					$budget = $row['AS_time'];
					$real = $row['AS_hour'];
					break;
				case 'TA' :
					$budget = $row['TA_time'];
					$real = $row['TA_hour'];
					break;
			}
			
			$real = $real + $time;
			
			if(substr($row['code'],0,3) == "NC1")
				$status = true;
			else if($real > $budget)
				$status = false;
			else
				$status = true;
		}
		
		return $status;
	}
}
    
