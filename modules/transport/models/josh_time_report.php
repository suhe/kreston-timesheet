<?php
class Josh_time_report extends Model
{
	function Josh_time_report()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('*');
        //$this->db->join('josh_manager','josh_manager.id=josh_head_tr.manager_id');
        //$this->db->join('josh_staff','josh_manager.staff_no=josh_staff.no');
        $this->db->where('josh_head_tr.staff_no',$_SESSION['no']);
        $this->db->orderby('periode','DESC'); 
        //$this->db->join('josh_position','josh_position.code=josh_head_tr.pos_code');
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
    
    //Menampilkan data per Record
	function selectDetailAccRecords($id)
	{
		$data=array();
        $this->db->select('josh_details_day_tr.code as id,josh_details_day_tr.date as date,josh_details_tr.job_code,josh_job.name as name ,josh_details_day_tr.time as time,josh_details_day_tr.transport_chf as transport,app_charge,signature_charge,app_manager,signature_manager,josh_details_day_tr.location');
        $this->db->join('josh_details_tr','josh_details_tr.day_code=josh_details_day_tr.code');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
        $this->db->where('josh_details_tr.tr_code',$id);
        $this->db->where('josh_details_tr.code_type','CHF');
        $this->db->where('josh_details_day_tr.type_job','chf');
        $this->db->orderby('josh_details_day_tr.date','ASC'); 
        //$this->db->get('josh_details_tr');
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
    
    function total_transport($id)
    {
        $this->db->select('SUM(josh_details_day_tr.transport_chf) as transport ');
        $this->db->join('josh_details_tr','josh_details_tr.day_code=josh_details_day_tr.code');
        $this->db->join('josh_job','josh_job.code=josh_details_tr.job_code');
        $this->db->where('josh_details_tr.tr_code',$id);
        $this->db->where('josh_details_tr.code_type','CHF');
        $this->db->where('josh_details_day_tr.type_job','chf'); 
		$Q=$this->db->get('josh_details_day_tr');
        
        if($Q->num_rows() > 0 )
		   {
		         
			  	foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
    }
    
    function status_acc($id)
	{	
	   $data=array();
       $option=array('tr_code'=>$id,'status_acc'=>'process');
       $Q=$this->db->select('status_acc');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 $data=array('status_acc'=>'pending');
             	 $this->db->where('tr_code',$id);
              	 $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     $data=array('status_acc'=>'process');
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
        
	}
    
        
    function selectDetailsRecords($id)
    {
        $data=array();
        $this->db->select('day_code,job_code,name as job_name,type,description,code_type');
        $this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    function selectCHFDetailsRecords($id)
    {
        $data=array();
        $this->db->select('day_code,job_code,name as job_name,type,description,code_type');
        $this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    function selectCHODetailsRecords($id)
    {
        $data=array();
        $this->db->select('day_code,job_code,name as job_name,type,description,code_type');
        $this->db->where('code_type','CHO');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    function selectNCHDetailsRecords($id)
    {
        $data=array();
        $this->db->select('day_code,job_code,name as job_name,type,description,code_type');
        $this->db->where('code_type','NCH');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    function saveJob()
	{
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
        //$this->db->where('staff_no',$_SESSION['no']);
        //$this->db->where('tr_code',$id); 
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
    
    
    
    function saveDayRecord()
    {
        $month1=substr($this->input->post('date'),5,2);
        $temp=number_format(substr($this->input->post('date'),5,2)) + 1;
        if($temp>9){
             $month2=$temp;
             } else {
             $month2='0'.$temp;}
        if (($this->input->post('day')>=21) &&($this->input->post('day')<=31)){
            $month=$month1; }
        elseif(($this->input->post('day')>=1) &&($this->input->post('day')<=20)){
            $month=$month2; }     
        //echo month1;
        $data=array();
            $this->db->select('code,date,time');
            $this->db->where('code',$this->input->xss_clean($_POST['code']));
    		//$this->db->or_where('date',$this->input->xss_clean('2010'.'-'.$month2.'-'.$this->input->xss_clean($_POST['day'])));
            $this->db->where('date',$this->input->xss_clean('2010'.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])));
            $Q=$this->db->get('josh_details_day_tr');
            if($Q->num_rows()> 0 )
    		   {
    			   $this->session->set_flashdata('message','<div class=" message errormessage">This Periode='.$this->input->xss_clean($_POST['day']).$month1.' Is Already!</div>');
    		       redirect('time_report/user/view/'.$_SESSION['tr_code'],301);
               }
            else
                {
                    $this->saveTable2();
                }   
    		$Q->free_result();
    		return $data;
    }
    
    function saveTable2()
    {
        $day=substr($this->input->post('date'),8,2);
        $month1=substr($this->input->post('date'),5,2);
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
                            'code'=>$this->input->xss_clean($_POST['code']), 
                            'date'=>$this->input->xss_clean('2010'.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])), 
                            'time'=>$this->input->xss_clean($_POST['time']),
                            'type_job'=>$this->input->xss_clean(strtolower($_POST['type'])),
                            'transport_chf'=>$this->input->xss_clean($transport)
		                  );
                } elseif(($chf=='CHO') || ($chf=='NCH')){
                       $data=array(
                            'code'=>$this->input->xss_clean($_POST['code']), 
                            'date'=>$this->input->xss_clean('2010'.'-'.$month.'-'.$this->input->xss_clean($_POST['day'])), 
                            'time'=>$this->input->xss_clean($_POST['time']),
                            'type_job'=>$this->input->xss_clean(strtolower($_POST['type'])),
                            'transport_chf'=>$this->input->xss_clean(0)
		                  );
                }             
           }
         elseif($day == '20'){
               
               $chf=$this->input->post('type');
               $transport=$this->input->post('transport');
            
               if($chf=='CHF')
                {                   
	               $data=array(
                            'code'=>$this->input->xss_clean($_POST['code']), 
                            'date'=>$this->input->xss_clean('2010'.'-'.$month1.'-'.$this->input->xss_clean($_POST['day'])), 
                            'time'=>$this->input->xss_clean($_POST['time']),
                            'type_job'=>$this->input->xss_clean(strtolower($_POST['type'])),
                            'transport_chf'=>$this->input->xss_clean($transport)
		                  );
                } elseif($chf=='CHO'){
                       $data=array(
                            'code'=>$this->input->xss_clean($_POST['code']), 
                            'date'=>$this->input->xss_clean('2010'.'-'.$month1.'-'.$this->input->xss_clean($_POST['day'])), 
                            'time'=>$this->input->xss_clean($_POST['time']),
                            'type_job'=>$this->input->xss_clean(strtolower($_POST['type'])),
                            'transport_chf'=>$this->input->xss_clean(0)
		                  );
                } elseif($chf=='NCH') {
                    $data=array(
                            'code'=>$this->input->xss_clean($_POST['code']), 
                            'date'=>$this->input->xss_clean('2010'.'-'.$month1.'-'.$this->input->xss_clean($_POST['day'])), 
                            'time'=>$this->input->xss_clean($_POST['time']),
                            'type_job'=>$this->input->xss_clean(strtolower($_POST['type'])),
                            'transport_chf'=>$this->input->xss_clean(0)
		                  );
                } 
         }
         
         
		$this->db->insert('josh_details_day_tr',$data);
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
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature');
        $this->db->where('code_type','CHF');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    //for CHO
    function selectcho($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature');
        $this->db->where('code_type','CHO');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    //for CHO
    function selectnch($id)
    {
        $data=array();
        $this->db->select('tr_code,day_code,job_code,name as job_name,type,work_description,approval,manager_id,staff_approval,staff_name,staff_signature');
        $this->db->where('code_type','NCH');
        $this->db->where('tr_code',$id);
        //$this->db->orderby('time','ASC'); 
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
    
    //Menampilkan Data Per Manager
    function selectManageRecords()
	{
		$data=array();
        $this->db->select('periode');
        $this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where_not_in('josh_staff.no',$_SESSION['no']);
        $this->db->where('josh_staff.group_id',$_SESSION['group']);
        $this->db->where('josh_position.order > ',$_SESSION['order']); 
        $this->db->groupby('josh_head_tr.periode');
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
    
    function selectManagePerPeriodeRecords($id)
    {
        $data=array();
        //$this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		/*$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where_not_in('josh_staff.no',$_SESSION['no']);
        $this->db->where('josh_staff.group_id',$_SESSION['group']);
        $this->db->where('josh_position.order > ',$_SESSION['order']);
        $Q=$this->db->get('josh_head_tr');*/
        $sql  =" SELECT josh_head_tr.tr_code,josh_staff.no,josh_staff.name,josh_staff.photo,";
        $sql .=" josh_staff.hp,josh_staff.email,josh_head_tr.pos_code,josh_head_tr.pos_code,";
        $sql .=" josh_job.code,josh_head_tr.status_manager ";
        $sql .=" FROM josh_head_tr ";
        $sql .=" JOIN josh_staff ON josh_staff.no=josh_head_tr.staff_no ";
        $sql .=" JOIN josh_details_tr ON josh_details_tr.tr_code=josh_head_tr.tr_code ";
        $sql .=" JOIN josh_job ON josh_job.code=josh_details_tr.job_code ";
        $sql .=" JOIN josh_position ON josh_position.code=josh_head_tr.pos_code ";
        $sql .=" where ";
        $sql .=" josh_job.status_job='active' AND ";
        $sql .=" josh_head_tr.periode='".$id."' AND ";
        $sql .=" josh_position.order > ".$_SESSION['order']." AND "; 
        /*
        (
        (josh_job.HRD='') OR
        (josh_job.Manager='10003')        OR
        (josh_job.Ass_Manager='')    OR
        (josh_job.Senior_Manager='') OR
        (josh_job.Senior='')	        ) 
        */
        if($_SESSION['level']=='HRD'):
            $sql .= " josh_job.HRD='".$_SESSION['no']."' ";
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
    
    function selectAdminPerPeriodeRecords($id)
    {
        $data=array();
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where_not_in('josh_staff.no',$_SESSION['no']);
        $this->db->orderby('josh_staff.group_id','ASC');
        $this->db->orderby('josh_staff.no','ASC');
        //$this->db->where('josh_staff.group_id',$_SESSION['group']);
        //$this->db->where('josh_position.order > ',$_SESSION['order']);
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
    
    function saveAproval()
    {
        $code=$this->input->xss_clean($_POST['code']);
        $data=array(
            
            'staff_approval'=>$this->input->xss_clean($_POST['approval']),
            'staff_name'=>$this->input->xss_clean($_SESSION['name']),
            'staff_signature'=>$this->input->xss_clean($_SESSION['sign'])
		); 
        
        $this->db->where('day_code',$code);
		$this->db->update('josh_details_tr',$data);
    }
    
    function saveAprovalManager()
    {
		$date=$this->input->xss_clean($_POST['date']);
		$code=$this->input->xss_clean($_POST['code']);
		$manager=$this->input->xss_clean($_POST['approval2']);
		$jumlah=count($date);
		//for($i=0;$i<$jumlah;$i++) {
			$data=array(
            'app_manager'=>$manager,
            'signature_manager'=>$this->input->xss_clean($_SESSION['sign'])
		); 
		$this->db->where('date',$date);
        $this->db->where('code',$code);
        $this->db->update('josh_details_day_tr',$data);
		//}
		
    }
    
    function saveAprovalAdmin()
    {
	  /*
        $code=$this->input->xss_clean($_POST['code']);
        $date=$this->input->xss_clean($_POST['date']);
        $data=array(
            'app_charge'=>$this->input->xss_clean($_POST['approval']),
            //'manager_name'=>$this->input->xss_clean($_SESSION['name']),
            'signature_charge'=>$this->input->xss_clean($_SESSION['sign'])
		); 
        $this->db->where('code',$code);
		$this->db->where('date',$date);
        $this->db->update('josh_details_day_tr',$data);
		*/
		$date=$this->input->xss_clean($_POST['date']);
		$code=$this->input->xss_clean($_POST['code']);
		$admin=$this->input->xss_clean($_POST['approval']);
		$jumlah=count($date);
		//for($i=0;$i<$jumlah;$i++) {
			$data=array(
            'app_charge'=>$admin,
            'signature_charge'=>$this->input->xss_clean($_SESSION['sign'])
		); 
		$this->db->where('date',$date);
        $this->db->where('code',$code);
        $this->db->update('josh_details_day_tr',$data);
		//}
		
    }
    
    // // For ACCoutning
    function selectPeriodeRecord($date,$date2,$client_name=''){
        $data=array();
		$sql="
			 SELECT SUBSTR(jddt.code,19,6) AS ccode,jc.name AS client_name,
			 SUM(jddt.`transport_chf`) AS transport
			 FROM
			 josh_details_day_tr jddt
			 INNER JOIN josh_company jc ON jc.`code`=SUBSTR(jddt.code,19,6)
			 WHERE (jddt.date>='".$date."' AND jddt.date<='".$date2."')
			 AND jddt.`transport_chf` > 0 ";
			 
		if($client_name)
			$sql.=" AND jc.name LIKE '%".$client_name."%' ";
		
		$sql.= "GROUP BY jc.`code` ORDER BY jc.`code`;";	
		
        $Query = $this->db->query($sql);
        if($Query->num_rows()> 0 ){
			   foreach ($Query->result_array() as $row){
                  $data[]=$row;
               }
		}
		   
		$Query->free_result();
		return $data;
    }

	function selectPeriodeUserRecord($date,$date2,$client){
        $data=array();
		$sql="
			 SELECT js.no,js.name,transport_chf as transport,DATE_FORMAT(jddt.date,'%d/%m/%Y') as date
				 FROM josh_details_day_tr jddt
				 INNER JOIN josh_staff js ON js.no = SUBSTR(jddt.tr_code,4,5)
				 WHERE jddt.date>='".$date."' AND jddt.date<='".$date2."'
				 AND transport_chf>0 AND SUBSTR(jddt.code,19,6) = '".$client."'
				 ORDER BY js.no asc,jddt.date asc;
		  ";
		//AND jddt.app_manager = 'yes'
        $Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row){
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }	
	
	function selectUseTransportAcc($date,$date2,$staff){
		$sql = "SELECT js.no,js.name,jj.name,DATE_FORMAT(jddt.date,'%d/%m/%Y') as date,
				jddt.transport_chf as ope
				FROM josh_details_day_tr jddt
				INNER JOIN josh_job jj ON jj.code=SUBSTR(jddt.code,19,12)
				INNER JOIN josh_staff js ON js.no = SUBSTR(jddt.tr_code,4,5)
				WHERE jddt.date>='$date' AND jddt.date<='$date2'
				AND transport_chf>0
				
				AND js.no='".$staff."'  ORDER BY jddt.date ASC ";
		$Q=$this->db->query($sql);
		//AND jddt.app_manager='yes'
        $data = array();
		if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row){
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;		
				
	}
    
    function selectACCPerPeriodeRecordPro($id)
    {
        $data=array();
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_acc','process');
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
    
     function selectACCPerPeriodeRecordApprov($id)
    {
        $data=array();
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_acc','approval');
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
    
    function acc_status($id)
    {
        $data=array();
       $option=array('tr_code'=>$id,'status_acc'=>'approval');
       $Q=$this->db->select('status_acc');
       $Q=$this->db->getwhere('josh_head_tr',$option,1);
       
	   if($Q->num_rows > 0)
            {	
			  	 //$data=array('status_manager'=>'process');
             	 $data=array(
                 'status_acc'=>$this->input->xss_clean('process'),
                 'acc_name'=>$this->input->xss_clean(''),
                 'acc_approval'=>$this->input->xss_clean('no'),
                 'acc_signature'=>$this->input->xss_clean('')
                 );
                  $this->db->where('tr_code',$id);
              	  $this->db->update('josh_head_tr',$data);
            }
            else
			{
			     //$data=array('status_manager'=>'approval');
                 $data=array(
                    'status_acc'=>$this->input->xss_clean('approval'),
                    'acc_name'=>$this->input->xss_clean($_SESSION['name']),
                    'acc_approval'=>$this->input->xss_clean('yes'),
                    'acc_signature'=>$this->input->xss_clean($_SESSION['sign'])
           );    
                 $this->db->where('tr_code',$id);
                 $this->db->update('josh_head_tr',$data);
			}    
            $Q->free_result();
            return $data;
    }
    
    function getACC_Approv($id)
	{
		$data=array();
        $this->db->select('acc_name,acc_signature');
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
    
    //For Admin
    function getADM_Approv($id)
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
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_hrd','process');
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
        $this->db->select('*');
        //$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        //$this->db->where('manager_id',$_SESSION['id']);
        //$this->db->orderby('periode','DESC'); 
		$this->db->join('josh_staff','josh_staff.no=josh_head_tr.staff_no');
        $this->db->join('josh_position','josh_staff.pos_code=josh_position.code');
        $this->db->where('periode',$id);
        $this->db->where('status_hrd','approval');
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
}
    