<?php
class Report extends Model{
    
	public function Report(){
		parent::Model();
	}
	
	public function getActivity($client_name='',$staff_name='',$date_from='',$date_to='') {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(jddt.date,'%d/%m/%Y') as date,jj.code as job_code,jj.name as job_name,SUBSTR(jddt.tr_code,4,5) as staff_no,js.name as staff_name,jddt.activity
			FROM josh_details_day_tr jddt
			INNER JOIN josh_job jj ON jj.`code` = REPLACE(SUBSTR(jddt.`code`,19,12), '-NCH','')
			INNER JOIN josh_staff js ON js.no = substr(jddt.tr_code,4,5)
			WHERE jddt.activity <>''
		";
		if ($client_name)
			$sql.=" AND jj.name LIKE '%".$client_name."%' ";
	
		if ($staff_name)
			$sql.=" AND js.name LIKE '%".$staff_name."%' ";
	
		if ($date_from)
			$sql.=" AND jddt.date>='".$date_from."' AND jddt.date<='".$date_to."' ";
							
		$sql.="ORDER BY jddt.date ASC";
	
		$q = $this->db->query($sql);
		if($q->num_rows()>0) {
			foreach($q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$q->free_result();
		return $data;
	}
    
	public function getTimeChargeDetails($name,$status){
		$data=array();
        $sql = "SELECT code,name,SP_time,PC_time,SM_time,M_time,AM_time,
		S2_time,S1_time,AS_time,TA_time,
		(SP_time+PC_time+SM_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) as SUM_time,
		(SP_time * SP) as SP_cost,
		(PC_time * PC) as P_cost,
		(SM_time * M) as SM_cost,
		(M_time * M) as M_cost,
		(AM_time * AM) as AM_cost,
		(S2_time * S2) as S2_cost,
		(S1_time * S1) as S1_cost,
		(AS_time * `AS`) as AS_cost,
		(TA_time * TA) as TA_cost,
		(SP_time * SP) + (PC_time * PC) + (SM_time * SM) + (M_time * M) + (S2_time * S2) + (S1_time * S1) + (AS_time * `AS`) + (TA_time * TA)  as SUM_cost,
		0 as SP_hour,0 as PC_hour,SM_hour,M_hour,AM_hour,S2_hour,S1_hour,AS_hour,TA_hour,
		(0+0+SM_hour+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour) as SUM_hour,
		(0 * SP) as SP_total,
		(0 * PC) as PC_total,
		(SM_hour * M) as SM_total,
		(M_hour * M) as M_total,
		(AM_hour * AM) as AM_total,
		(S2_hour * S2) as S2_total,
		(S1_hour * S1) as S1_total,
		(AS_hour * `AS`) as AS_total,
		(TA_hour * TA) as TA_total,
		(0 * SP) + (0 * PC) + (SM_hour * SM) + (M_hour * M) + (S2_hour * S2) + (S1_hour * S1) + (AS_hour * `AS`) + (TA_hour * TA)  as SUM_total,
		(SP_time - 0) as SP_pl,
		(PC_time - 0) as PC_pl,
		(SM_time - SM_hour) as SM_pl,
		(M_time - M_hour) as M_pl,
		(AM_time - AM_hour) as AM_pl,
		(S2_time - S2_hour) as S2_pl,
		(S1_time - S1_hour) as S1_pl,
		(AS_time - AS_hour) as AS_pl,
		(TA_time - TA_hour) as TA_pl,
		(SP_time - 0) + (PC_time - 0) + (SM_time - SM_hour) + (M_time - M_hour) + (S2_time - S2_hour) + (S1_time - S1_hour) + (AS_time - AS_hour) + (TA_time - TA_hour)  as SUM_pl,
		(SP_time - 0) * SP as SP_pl_cost,
		(PC_time - 0) *PC as PC_pl_cost,
		(SM_time - SM_hour) * SM as SM_pl_cost,
		(M_time - M_hour) * M as M_pl_cost,
		(AM_time - AM_hour) * AM as AM_pl_cost,
		(S2_time - S2_hour) * S2 as S2_pl_cost,
		(S1_time - S1_hour) * S1 as S1_pl_cost,
		(AS_time - AS_hour) * `AS` as AS_pl_cost,
		(TA_time - TA_hour) * TA as TA_pl_cost,
		((SP_time - 0) * SP) + ((PC_time - 0)*PC) + ((SM_time - SM_hour)*SM) + ((M_time - M_hour)*M) + ((S2_time - S2_hour)*S2) + ((S1_time - S1_hour)*S1) + ((AS_time - AS_hour)* `AS`) + ((TA_time - TA_hour)*TA)  as SUM_pl_cost,
		DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date,progress,note
		FROM josh_job Where code NOT LIKE 'NC10%'  
		";
		
		if(($_SESSION['level']=='M') || ($_SESSION['level']=='AM') || ($_SESSION['level']=='S2') || ($_SESSION['level']=='S1') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='TA'))
			$sql.= " AND Manager = '".$_SESSION['manager']."' ";
		
		if($name)
			$sql.= " AND CONCAT(code,' ',name) LIKE '%".$name."%'";
		
		if($status)
			$sql.= " AND status_job = '".$status."'";
		
		$sql.=" ORDER BY name ASC";
		
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getTimeChargeDetailsByJob($job_code){
		$data=array();
        $sql = "SELECT code,name,SP_time,PC_time,SM_time,M_time,AM_time,
		S2_time,S1_time,AS_time,TA_time,
		(SP_time+PC_time+SM_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) as SUM_time,
		(SP_time * SP) as SP_cost,
		(PC_time * PC) as P_cost,
		(SM_time * M) as SM_cost,
		(M_time * M) as M_cost,
		(AM_time * AM) as AM_cost,
		(S2_time * S2) as S2_cost,
		(S1_time * S1) as S1_cost,
		(AS_time * `AS`) as AS_cost,
		(TA_time * TA) as TA_cost,
		(SP_time * SP) + (PC_time * PC) + (SM_time * SM) + (M_time * M) + (S2_time * S2) + (S1_time * S1) + (AS_time * `AS`) + (TA_time * TA)  as SUM_cost,
		0 as SP_hour,0 as PC_hour,SM_hour,M_hour,AM_hour,S2_hour,S1_hour,AS_hour,TA_hour,
		(0+0+SM_hour+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour) as SUM_hour,
		(0 * SP) as SP_total,
		(0 * PC) as PC_total,
		(SM_hour * M) as SM_total,
		(M_hour * M) as M_total,
		(AM_hour * AM) as AM_total,
		(S2_hour * S2) as S2_total,
		(S1_hour * S1) as S1_total,
		(AS_hour * `AS`) as AS_total,
		(TA_hour * TA) as TA_total,
		(0 * SP) + (0 * PC) + (SM_hour * SM) + (M_hour * M) + (S2_hour * S2) + (S1_hour * S1) + (AS_hour * `AS`) + (TA_hour * TA)  as SUM_total,
		(SP_time - 0) as SP_pl,
		(PC_time - 0) as PC_pl,
		(SM_time - SM_hour) as SM_pl,
		(M_time - M_hour) as M_pl,
		(AM_time - AM_hour) as AM_pl,
		(S2_time - S2_hour) as S2_pl,
		(S1_time - S1_hour) as S1_pl,
		(AS_time - AS_hour) as AS_pl,
		(TA_time - TA_hour) as TA_pl,
		(SP_time - 0) + (PC_time - 0) + (SM_time - SM_hour) + (M_time - M_hour) + (S2_time - S2_hour) + (S1_time - S1_hour) + (AS_time - AS_hour) + (TA_time - TA_hour)  as SUM_pl,
		(SP_time - 0) * SP as SP_pl_cost,
		(PC_time - 0) *PC as PC_pl_cost,
		(SM_time - SM_hour) * SM as SM_pl_cost,
		(M_time - M_hour) * M as M_pl_cost,
		(AM_time - AM_hour) * AM as AM_pl_cost,
		(S2_time - S2_hour) * S2 as S2_pl_cost,
		(S1_time - S1_hour) * S1 as S1_pl_cost,
		(AS_time - AS_hour) * `AS` as AS_pl_cost,
		(TA_time - TA_hour) * TA as TA_pl_cost,
		((SP_time - 0) * SP) + ((PC_time - 0)*PC) + ((SM_time - SM_hour)*SM) + ((M_time - M_hour)*M) + ((S2_time - S2_hour)*S2) + ((S1_time - S1_hour)*S1) + ((AS_time - AS_hour)* `AS`) + ((TA_time - TA_hour)*TA)  as SUM_pl_cost,
		DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date,progress,
		CASE
				WHEN ((0/SP_time) * 100) >= 51 AND ((0/SP_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((0/SP_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SP_style,
			
			CASE
				WHEN ((0/PC_time) * 100) >= 51 AND ((0/PC_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((0/PC_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS PC_style,
			
			CASE
				WHEN ((SM_hour/SM_time) * 100) >= 51 AND ((SM_hour/SM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((SM_hour/SM_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SM_style,
			
			CASE
				WHEN ((M_hour/M_time) * 100) >= 51 AND ((M_hour/M_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((M_hour/M_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS M_style,
			
			CASE
				WHEN ((AM_hour/AM_time) * 100) >= 51 AND ((AM_hour/AM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((AM_hour/AM_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AM_style,
			
			CASE
				WHEN ((S2_hour/S2_time) * 100) >= 51 AND ((S2_hour/S2_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((S2_hour/S2_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S2_style,
			
			CASE
				WHEN ((S1_hour/S1_time) * 100) >= 51 AND ((S1_hour/S1_time) * 100) <= 90 THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((S1_hour/S1_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S1_style,
			
			CASE
				WHEN ((AS_hour/AS_time) * 100) >= 51 AND ((AS_hour/AS_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((AS_hour/AS_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AS_style,
			
			CASE
				WHEN ((TA_hour/TA_time) * 100) >= 51 AND ((TA_hour/TA_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((TA_hour/TA_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS TA_style,
		CASE
			WHEN ((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour/SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) * 100) >= 80 AND ((TA_hour/TA_time) * 100) <= 100  THEN 'background:yellow;font-weight:bolder;color:#000'
			WHEN ((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour/SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) * 100) > 100  THEN 'background:red;font-weight:bolder;color:#fff'
			ELSE 'background:green;font-weight:bolder;color:#fff'
		END AS SUM_style,note
		FROM josh_job Where code = '".$job_code."' ";
		
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	public function getTimeChargeSummary($name,$status) {
		$data=array();
		$sql = "SELECT code,name,
		(SP_time + PC_time + SM_time + M_time + AM_time + S2_time + S1_time + AS_time + TA_time) as SUM_time,
		(0       + 0       + SM_hour + M_hour + AM_hour + S2_hour + S1_hour + AS_hour + TA_hour) as SUM_hour,
		(SP_time * SP) + (PC_time * PC) + (SM_time * SM) + (M_time * M) + (AM_time * AM) + (S2_time * S2) + (S1_time * S1) + (AS_time * `AS`) + (TA_time * TA)  as SUM_cost,
		(0       * SP) + (0 	  * PC) + (SM_hour * SM) + (M_hour * M) + (AM_hour * AM) + (S2_hour * S2) + (S1_hour * S1) + (AS_hour * `AS`) + (TA_hour * TA)  as SUM_total,
		(SP_time - 0) + (PC_time - 0) + (SM_time - SM_hour) + (M_time - M_hour)+ (AM_time - AM_hour) + (S2_time - S2_hour) + (S1_time - S1_hour) + (AS_time - AS_hour) + (TA_time - TA_hour)  as SUM_pl,
		((SP_time - 0) * SP) + ((PC_time - 0)*PC) + ((SM_time - SM_hour)*SM) + ((M_time - M_hour) * M) + ((AM_time - AM_hour) * AM) + ((S2_time - S2_hour)*S2) + ((S1_time - S1_hour)*S1) + ((AS_time - AS_hour)* `AS`) + ((TA_time - TA_hour)*TA)  as SUM_pl_cost,
		DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date,progress,
		((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour)/(SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time)) * 100 as percent,
		CASE
			WHEN (SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) = 0  THEN 'background:red;font-weight:bolder;color:#fff'
			WHEN (((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour)/(SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time)) * 100) >= 51 AND (((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour)/(SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time)) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
			WHEN (((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour)/(SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time)) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
			ELSE 'background:green;font-weight:bolder;color:#fff'
		END AS SUM_style,note
		FROM josh_job Where code NOT LIKE 'NC10%' ";
		
		if(($_SESSION['level']=='M') || ($_SESSION['level']=='AM') || ($_SESSION['level']=='S2') || ($_SESSION['level']=='S1') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='TA') )
			$sql.= " AND Manager = '".$_SESSION['manager']."' ";
			
		if($name)
			$sql.= " AND CONCAT(code,' ',name) LIKE '%".$name."%'";
		
		if($status)
			$sql.= " AND status_job = '".$status."'";
		
		$sql.=" ORDER BY name ASC";
		
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	function getTimeChargeDateByJob($code,$sort="ASC"){
		$data=array();
        $sql = "SELECT MIN(DATE) AS start_date , MAX(DATE) AS end_date 
		FROM josh_details_day_tr
		WHERE SUBSTR(josh_details_day_tr.code,19,12) = '".$code."'
		ORDER BY DATE ".$sort."
		LIMIT 1
		";
		$Q=$this->db->query($sql);
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
	
	public function getEmployeeChargeSummary() {
		$data=array();
		$sql = "SELECT * FROM josh_staff_charge WHERE staff_no<>'' ";
		$sql.=" ORDER BY staff_no ASC";	
			
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getJobProgress($job_code) {
		$data=array();
		$sql = "SELECT DATE_FORMAT(jjp.date,'%d/%m/%Y') as date,substr(jjp.tr_code,4,5) as staff_no,js.name as staff_name, jjp.progress
				FROM josh_job_progress jjp
				INNER JOIN josh_staff js ON js.no = substr(jjp.tr_code,4,5)
				WHERE job_code = '".$job_code."' ";
		$sql.=" ORDER BY jjp.date  ASC";	
			
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getSingleEmployee($staff_no) {
		$data=array();
		$sql = "SELECT * FROM josh_staff WHERE no = '".$staff_no."' ";
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	public function deleteEmployeeCharge() {
        return $this->db->query("DELETE FROM josh_staff_charge");
    }
	
	public function getSumTimeReportByChargeable($staff_no,$date_from,$date_to) {
		$sum = 0;
		$sql = "SELECT SUM(time) as hour
			FROM josh_details_day_tr jddt
			WHERE substr(tr_code,4,5) = '".$staff_no."'
			AND (date >= '".$date_from."' AND date <= '".$date_to."' )
			AND (app_manager = 'yes' OR app_hrd = 'YES')
			AND (RIGHT(jddt.code,3) = 'CHF' OR RIGHT(jddt.code,3) = 'CHO')
			";
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ){
			$data = $Q->row_array();
			if($data)
				$sum = $data['hour'];
			else
				$sum = 0;
		}
		
		return $sum;
		
	}
	
	public function getSumTimeReportByNonChargeable($staff_no,$date_from,$date_to) {
		$sum = 0;
		$sql = "SELECT SUM(time) as hour
			FROM josh_details_day_tr jddt
			WHERE substr(tr_code,4,5) = '".$staff_no."'
			AND (date >= '".$date_from."' AND date <= '".$date_to."' )
			AND (app_manager = 'yes' OR app_hrd = 'YES')
			AND RIGHT(jddt.code,3) = 'NCH'
			";
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ){
			$data = $Q->row_array();
			if($data)
				$sum = $data['hour'];
			else $sum = 0;
		}
		
		return $sum;
		
	}
	
	public function getJobSetup(){
		$data = array();
		$sql = "SELECT * FROM josh_job ";
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getEmployeeActive($name='',$group = 0) {
		$data = array();
		$sql = "
			SELECT * FROM josh_staff
			WHERE status = 'active'
			AND (pos_code = 'SM' OR pos_code = 'M' OR pos_code = 'AM' OR pos_code = 'S2' OR pos_code = 'S1' OR pos_code = 'AS' OR pos_code = 'TA')  
		";
		
		if($name)
			$sql.="AND CONCAT(name,' ',no) LIKE '%".$name."%'";
		if($group)
			$sql.="AND group_id = ".$group;
			
		$sql.= " ORDER BY no ASC;";	
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ):
			   foreach ($Q->result_array() as $row):
                  $data[]=$row;
               endforeach;        
		endif; 
		$Q->free_result();
		return $data;
	}
	
	public function getInsertEmployeeCharge($data) {
		$this->db->insert('josh_staff_charge',$data);
	}
	
	public function getUpdateJob($code,$data) {
		$this->db->where('code',$this->input->xss_clean($code));
		$this->db->update('josh_job',$data);
	}
	
	public function getChargeable($name,$client_name,$group,$date_from,$date_to,$type='') {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(jddt.`date`,'%d/%m/%Y') as date,js.`no`, js.name,js.`pos_code`,jg.`group_name`,jj.`name` as job_name,jddt.`time`,jddt.`hour_1`,jddt.`hour_2`,CONCAT(jc.address,',',jc.city) as address, RIGHT(jddt.code,3) as job_type
			FROM josh_details_day_tr jddt
			INNER JOIN josh_staff js ON js.`no` = SUBSTR(jddt.`code`,4,5)
			INNER JOIN josh_group jg ON jg.`group_id` = js.`group_id`
			INNER JOIN josh_job jj ON jj.`code` = REPLACE(SUBSTR(jddt.`code`,19,12), '-NCH','')
			LEFT JOIN josh_company jc ON jc.`code` = jj.company_code
			WHERE jddt.time > 0
			
		";
		
		if($name)
			$sql.= " AND CONCAT(js.no,' ',js.`name`) LIKE '%".$name."%' ";
		
		if($client_name)
			$sql.= " AND jj.name LIKE '%".$client_name."%' ";	
		
		if($group)
			$sql.= " AND js.group_id = ".$group." ";	
		
		if($date_from && $date_to)
			$sql.= " AND jddt.`date`>='".$date_from."' AND jddt.`date`<='".$date_to."' ";
		
		if($type)
			$sql.= " AND jddt.code LIKE '%".$type."%' ";
			
		$sql.=" ORDER BY jddt.date ASC,js.`no` ASC; ";
		
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		
		$Q->free_result();
		return $data;	
	}
	
	public function getGroupList(){
		$data = array();
		$sql = "SELECT * FROM josh_group ";
		$Q=$this->db->query($sql);
		$data[0] = "All Group"; 
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[$row['group_id']]=$row['group_name'];
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getMaxHourJob($name='',$periode=''){
		$data = array();
		$sql = "
			SELECT jj.code,jj.name,
			SP_time,0 as SP_hour,(SP_time - 0) as SP_pl,
			PC_time,0 as PC_hour,(PC_time - 0) as PC_pl,
			SM_time,SM_hour,(SM_time - SM_hour) as SM_pl,
			M_time,M_hour,(M_time - M_hour) as M_pl,
			AM_time,AM_hour,(AM_time - AM_hour) as AM_pl,
			S2_time,S2_hour,(S2_time - S2_hour) as S2_pl,
			S1_time,S1_hour,(S1_time - S1_hour) as S1_pl,
			AS_time,AS_hour,(AS_time - AS_hour) as AS_pl,
			TA_time,TA_hour,(TA_time - TA_hour) as TA_pl,
			(SP_time + PC_time + SM_time + M_time + AM_time + S2_time + S1_time + AS_time + TA_time) as SUM_time,
			(0 + 0 + SM_hour + M_hour + AM_hour + S2_hour + S1_hour + AS_hour + TA_hour) as SUM_hour,
			((SP_time - 0) + (PC_time-0) + (SM_time-SM_hour) + (M_time-M_hour) + (AM_time - AM_hour) + (S2_time-S2_hour) + (S1_time-S1_hour) + (AS_time-AS_hour) + (TA_time-TA_hour)) as SUM_pl,
			
			CASE
				WHEN (SP_time - 0) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((0/SP_time) * 100) >= 51 AND ((0/SP_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((0/SP_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SP_style,
			
			CASE
				WHEN (PC_time - 0) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((0/PC_time) * 100) >= 51 AND ((0/PC_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((0/PC_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS PC_style,
			
			CASE
				WHEN (SM_time - SM_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((SM_hour/SM_time) * 100) >= 51 AND ((SM_hour/SM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((SM_hour/SM_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SM_style,
			
			CASE
				WHEN (M_time - M_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((M_hour/M_time) * 100) >= 51 AND ((M_hour/M_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((M_hour/M_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS M_style,
			
			CASE
				WHEN (AM_time - AM_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((AM_hour/AM_time) * 100) >= 51 AND ((AM_hour/AM_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((AM_hour/AM_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AM_style,
			
			CASE
				WHEN (S2_time - S2_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((S2_hour/S2_time) * 100) >= 51 AND ((S2_hour/S2_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((S2_hour/S2_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S2_style,
			
			CASE
				WHEN (S1_time - S1_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((S1_hour/S1_time) * 100) >= 51 AND ((S1_hour/S1_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((S1_hour/S1_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS S1_style,
			
			CASE
				WHEN (AS_time - AS_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((AS_hour/AS_time) * 100) >= 51 AND ((AS_hour/AS_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((AS_hour/AS_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS AS_style,
			
			CASE
				WHEN (TA_time - TA_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((TA_hour/TA_time) * 100) >= 51 AND ((TA_hour/TA_time) * 100) <= 90 THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((TA_hour/TA_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS TA_style,
			CASE
				WHEN (TA_time - TA_hour) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((TA_hour/TA_time) * 100) >= 51 AND ((TA_hour/TA_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((TA_hour/TA_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS TA_style,
			CASE
				WHEN ((SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) -  (0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour)) < 0 THEN 'background:red;font-weight:bolder;color:#fff'
				WHEN ((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour/SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) * 100) >= 80 AND ((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour/SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) * 100) <= 90  THEN 'background:yellow;font-weight:bolder;color:#000'
				WHEN ((0+0+SM_hour+M_hour+AM_hour+S2_hour+S1_hour+AS_hour+TA_hour/SP_time+PC_time+SM_time+M_time+AM_time+S2_time+S1_time+AS_time+TA_time) * 100) >= 91  THEN 'background:red;font-weight:bolder;color:#fff'
				ELSE 'background:green;font-weight:bolder;color:#fff'
			END AS SUM_style
			
			FROM josh_job jj
			where jj.status_job = 'active'
		";
		
		//if(($_SESSION['level']=='M') || ($_SESSION['level']=='AM') || ($_SESSION['level']=='S2') || ($_SESSION['level']=='S1') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='TA'))
			//$sql.= " AND jj.Manager = '".$_SESSION['manager']."' ";
		
		if($name)
			$sql.= " AND CONCAT(jj.code,' ',jj.name) LIKE '%".$name."%'";
			
		if($periode)
			$sql.= " AND RIGHT(jj.code,2) LIKE '%".$periode."%'";	
		
		$sql.=" ORDER BY jj.name ASC";
			
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function getChargeByEmployee($staff_no,$date_from,$date_to) {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(jddt.date,'%d/%m/%Y') as date,jj.name as job_name,RIGHT(jddt.code,3) as job_type,
			jj.code as job_code,jddt.time as hour,
			IF(RIGHT(jddt.code,3)='NCH',time,0) as noncharge,
			IF(RIGHT(jddt.code,3)<>'NCH',time,0) as charge
			FROM josh_details_day_tr jddt
			INNER JOIN josh_staff js on js.no = substr(jddt.tr_code,4,5)
			INNER JOIN josh_job jj ON jj.code = REPLACE(SUBSTR(jddt.code,19,12),'-NCH','')
			WHERE substr(jddt.tr_code,4,5) = '".$staff_no."'
			AND (jddt.date>='".$date_from."' AND jddt.date<='".$date_to."')
			AND (jddt.app_manager='yes' OR jddt.app_hrd='YES')
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
	
}
    
