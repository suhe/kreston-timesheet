<?php
class Josh_sallary extends Model{
    
	function Josh_sallary(){
		parent::Model();
	}
	
	public function getEmployeeActive() {
		$data = array();
		$sql = "
			SELECT * FROM josh_staff
			WHERE status = 'active'
			ORDER BY no ASC;
		";
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ):
			   foreach ($Q->result_array() as $row):
                  $data[]=$row;
               endforeach;        
		endif; 
		$Q->free_result();
		return $data;
	}
	
	public function deletePayroll($date) {
        $this->db->where('periode',$this->input->xss_clean($date));
        $this->db->delete('josh_payroll');
    }
	
	public function insertPayroll($data) {
        $this->db->insert('josh_payroll',$data);
    }
    
	public function getSumTimeReport($employee,$date_from,$date_to) {
		$data = array();
		$sql = "
			SELECT SUM(transport_chf) as transport,
			SUM(x1) as x1,
			SUM(x2) as x2,
			SUM(x3) as x3,
			SUM(x4) as x4,
			SUM(meal) as meal
			FROM josh_details_day_tr jddt
			INNER JOIN josh_head_tr jht on jht.tr_code = jddt.tr_code
			WHERE (app_manager = 'yes' OR app_hrd = 'YES') AND status_hrd = 'approval'
			AND substr(jddt.tr_code,4,5) = '".$employee."'
			AND (jddt.date>='".$date_from."' AND jddt.date<='".$date_to."')
		";
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ):
			$data = $Q->row_array();       
		endif; 
		$Q->free_result();
		return $data;
	}
	
	public function getPayroll($periode) {
		$data = array();
		$sql = "
			SELECT *,(salary_20+overtime_05+overtime_20+reimbust_05+reimbust_20) as total
			FROM josh_payroll
			WHERE periode = '".$periode."'
			ORDER BY staff_no ASC;
		";
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ):
			   foreach ($Q->result_array() as $row):
                  $data[] = $row;
               endforeach;        
		endif; 
		$Q->free_result();
		return $data;
	}
	
	
	public function getEmployeePayroll($staff_no,$date_from,$date_to) {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(jddt.date,'%d/%m/%Y') as date,jj.name as job_name,jddt.x1,jddt.x2,jddt.x3,jddt.x4,
			(sal_bas/173) * (x1 * 1.5) as x1_total,
			(sal_bas/173) * (x2 * 2.0) as x2_total,
			(sal_bas/173) * (x3 * 3.0) as x3_total,
			(sal_bas/173) * (x4 * 4.0) as x4_total,
			(jddt.meal * 10000) as meal,
			transport_chf as transport,sal_bas as salary,type_job,
			app_manager,app_hrd,status_hrd,
			((sal_bas/173) * (x1 * 1.5)+(sal_bas/173) * (x2 * 2.0)+(sal_bas/173) * (x3 * 3.0)+(sal_bas/173) * (x4 * 4.0) + (jddt.meal * 10000) + transport_chf) as total
			FROM josh_details_day_tr jddt
			INNER JOIN josh_head_tr jht on jht.tr_code = jddt.tr_code
			INNER JOIN josh_staff js on js.no = substr(jddt.tr_code,4,5)
			INNER JOIN josh_job jj ON jj.code=SUBSTR(jddt.code,19,12)
			WHERE substr(jddt.tr_code,4,5) = '".$staff_no."'
			AND (jddt.date>='".$date_from."' AND jddt.date<='".$date_to."')
			ORDER BY jddt.date ASC;
		";
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ):
			   foreach ($Q->result_array() as $row):
                  $data[] = $row;
               endforeach;        
		endif; 
		$Q->free_result();
		return $data;
	}
	
	public function selectBindEmployee($label=''){
		$data=array();
        $this->db->select("no,name");
		$this->db->where("status","active");
        $this->db->orderby('no','ASC');
		$Q=$this->db->get('josh_staff');
		if($label)
			$data[0] = $label;
		
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[$row['no']]=$row['no'].' - '.$row['name'];
            }
		}
		$Q->free_result();
		return $data;
	}
	
	function selectRecords(){
		$data=array();
		/*$this->db->select('per_salary');
		$this->db->group_by('per_salary');
        $this->db->order_by('per_salary','DESC');
        $Q=$this->db->get("josh_salary");*/
        $this->db->select('periode as per_salary,COUNT(staff_no) as people');
        $this->db->group_by('periode');
        //$this->db->where('MONTH(periode)>= ','MONTH(CURDATE())');
        $this->db->where('status_hrd','approval');
        $this->db->order_by('periode','DESC');
        $Q=$this->db->get("josh_head_tr");
		if($Q->num_rows()> 0 ):
			   foreach ($Q->result_array() as $row):
                  $data[]=$row;
               endforeach;        
		endif; 
		$Q->free_result();
		return $data;
	}
    
    function saveRecord()
	{
		$data=array();
        $this->db->select('per_salary');
		$this->db->where('per_salary',$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
		$this->db->group_by('per_salary');
        $Q=$this->db->get('josh_salary');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Periode Is Already!</div>');
			       redirect('salary/accounting/add',301);			   }
        else{
                $this->saveTable();}   
		$Q->free_result();
		return $data;
	}
    
    function saveTable()
    { 
	    $jumlah=count($this->input->xss_clean($_POST['no1']));
		
		for($i=0;$i<$jumlah;$i++){
		$data=array(
            'per_salary'=>$this->input->xss_clean($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']),
            'staff_no'=>$this->input->xss_clean($_POST['no'][$i]),
            'basic_salary'=>$this->input->xss_clean($_POST['salary'][$i]),
            'ot_salary'=>$this->input->xss_clean($_POST['salary2'][$i]),
            'transport_salary'=>$this->input->xss_clean($_POST['salary3'][$i]),
	    'allowance'=>$this->input->xss_clean($_POST['salary4'][$i]),
            'allowance_2'=>$this->input->xss_clean($_POST['salary4_2'][$i]),
            'debt'=>$this->input->xss_clean($_POST['salary5'][$i]),
            'adjust'=>$this->input->xss_clean($_POST['salary6'][$i])    
		); 
		$this->db->insert('josh_salary',$data); }
	}
    
    function getRecords($id)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('josh_staff','josh_staff.no=josh_salary.staff_no');
		$this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
		$this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
		$this->db->where('josh_salary.per_salary',$id);
		$this->db->orderby('josh_staff.no','ASC');
        $Q=$this->db->get("josh_salary");
		if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		  else{$data[]=0;} 
		$Q->free_result();
		return $data;
	}
    
    function updateRecord()
	{
		$jumlah=count($this->input->xss_clean($_POST['no1']));
		for($i=0;$i<$jumlah;$i++)
		{
		  $data=array(
            'basic_salary'=>$this->input->xss_clean($_POST['salary'][$i]),
            'ot_salary'=>$this->input->xss_clean($_POST['salary2'][$i]),
			'allowance'=>$this->input->xss_clean($_POST['salary4'][$i]),
            'allowance_2'=>$this->input->xss_clean($_POST['salary4_2'][$i]),
            'debt'=>$this->input->xss_clean($_POST['salary5'][$i]),
            'adjust'=>$this->input->xss_clean($_POST['salary6'][$i]),      
            'transport_salary'=>$this->input->xss_clean($_POST['salary3'][$i]));
          $this->db->where('staff_no',$this->input->xss_clean($_POST['no1'][$i]));
          $this->db->where('per_salary',$this->input->xss_clean($_POST['periode']));		
		  $this->db->update('josh_salary',$data); 
		}
	}
    
    function deleteRecord($id)
    {
        $this->db->where('per_salary',$this->input->xss_clean($id));
        $this->db->delete('josh_salary');
    }
    
    function selectRecordGroup(){
        $this->db->select('*');
        $this->db->where_not_in('code','P');
        $this->db->where_not_in('code','AP');
        $this->db->where_not_in('code','SM');
        $this->db->where_not_in('code','HRD');
        $this->db->where_not_in('code','IT-SAY');
        $this->db->where_not_in('code','ADM');
        $this->db->where_not_in('code','ACC');
		$this->db->where_not_in('code','MG');
		$this->db->where_not_in('code','RCP');
		$this->db->where_not_in('code','MSN');
		$this->db->where_not_in('code','OB');
		$this->db->where_not_in('code','DRV');
        $this->db->order_by('order','ASC');
        $Q=$this->db->get("josh_position");
		if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
                  
               }
               
		   }
		  else{$data[]=0;} 
		$Q->free_result();
		return $data;
    }
    
    function selectRecordPayroll($id)
	{
	    
		$data=array();
		$this->db->select('jst.group_id,jht.tr_code,jht.periode,jht.staff_no,jht.staff_name,jht.pos_name,js.basic_salary,js.allowance,(js.basic_salary)* 0.5 as bas_salary,(js.basic_salary)/ 173 as hour_salary,SUM(over_time_app) as app,js.transport_salary as transport,sum(jddt.transport_chf) as transport2,jddt.x1,jddt.x2,jddt.x3,jddt.x4,js.ot_salary as over_meal,jddt.meal,js.debt');
        $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
        $this->db->join('josh_details_day_tr jddt','jddt.tr_code=jht.tr_code');
        $this->db->join('josh_staff jst','jst.no=jht.staff_no');
        //$this->db->where('js.per_salary',$id);
        $this->db->where('jht.periode',$id);
		$this->db->group_by('jht.tr_code');
        $this->db->group_by('jst.group_id');
        $this->db->order_by('jht.staff_no','ASC');
        $Q=$this->db->get("josh_salary js");
		if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
                  
               }
               
		   }
		  else{$data[]=0;} 
		$Q->free_result();
		return $data;
	}
	
    function selectRecordPeriodePayroll($id)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                $this->db->where('js.staff_no',$_SESSION['no']);
                //$this->db->group_by('js.per_salary'); 
                $this->db->group_by('jht.periode');  
                $this->db->order_by('js.per_salary','DESC');
                $Q=$this->db->get("josh_salary js");
		if($Q->num_rows()>= 1 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		  else{$data[]=0;} 
		$Q->free_result();
		return $data;
	}
	
	function selectRecordUserPayroll($periode,$staff)
	{
		$data=array();
		$this->db->select('jht.tr_code,jht.periode,jht.staff_no,jht.staff_name,jht.pos_name,js.basic_salary,js.allowance,(js.basic_salary)* 0.5 as bas_salary,(js.basic_salary)/ 173 as hour_salary,SUM(over_time_app) as app,js.transport_salary as transport,sum(jddt.transport_chf) as transport2,jddt.x1,jddt.x2,jddt.x3,jddt.x4,js.ot_salary as over_meal,jddt.meal');
        $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
        $this->db->join('josh_details_day_tr jddt','jddt.tr_code=jht.tr_code');
        $this->db->where('js.per_salary',$periode);
        $this->db->where('jht.periode',$periode);
        $this->db->where('jht.staff_no',$staff);
		$this->db->group_by('jht.tr_code');
        $this->db->order_by('jht.staff_no','ASC');
        $Q=$this->db->get("josh_salary js");
		if($Q->num_rows()> 0 )
		   {
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		  else{$data[]=0;} 
		$Q->free_result();
		return $data;
	}
    
}
    
