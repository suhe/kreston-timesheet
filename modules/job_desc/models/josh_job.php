<?php
class Josh_job extends Model{
	function Josh_job(){
		parent::Model();
	}
    
	function selectRecords(){
		$data=array();
        $this->db->select("*,josh_job.code");
        $this->db->join('josh_company','josh_company.code=josh_job.company_code','INNER');
		$this->db->where('josh_company.scope',$_SESSION['division']);
        $this->db->where_not_in('josh_job.code','NC1001');
        $this->db->where_not_in('josh_job.code','NC1002');
        $this->db->where_not_in('josh_job.code','NC1003');
        $this->db->where_not_in('josh_job.code','NC1004');
        $this->db->where_not_in('josh_job.code','NC1005');
        $this->db->where_not_in('josh_job.code','NC1006');
        $this->db->where_not_in('josh_job.code','NC1007');
        $this->db->where_not_in('josh_job.code','NC1008');
        $this->db->where_not_in('josh_job.code','NC1009');
        $this->db->where_not_in('josh_job.code','NC1010');
        $this->db->orderby('josh_job.code','ASC');
		$Q=$this->db->get('josh_job');
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function selectBindJob($label=''){
		$data=array();
        $this->db->select("code,name");
        $this->db->orderby('josh_job.code','ASC');
		$this->db->groupby('josh_job.name','ASC');
		if($label)
			$data[0] = $label;
		$Q=$this->db->get('josh_job');
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[$row['name']]=$row['name'];
            }
		}
		$Q->free_result();
		return $data;
	}
	
	public function selectBindJobByCode($label=''){
		$data=array();
        $this->db->select("code,name");
		$this->db->where("status_job","active");
        $this->db->orderby('josh_job.code','ASC');
		if($label)
			$data[0] = $label;
		$Q=$this->db->get('josh_job');
        if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[$row['code']] = $row['code'].' '.$row['name'];
            }
		}
		$Q->free_result();
		return $data;
	}
	
	
	public function getJobProgress($client_name='',$staff_name='',$date_from='',$date_to='') {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(date,'%d/%m/%Y') as date,jjp.job_code,jj.name as job_name,SUBSTR(tr_code,4,5) as staff_no,js.name as staff_name,jjp.progress
			FROM josh_job_progress jjp
			INNER JOIN josh_job jj ON jj.code =jjp.job_code
			INNER JOIN josh_staff js ON js.no = substr(jjp.tr_code,4,5)
			WHERE jjp.date<>''	
		";
		if ($client_name)
			$sql.=" AND jj.name LIKE '%".$client_name."%' ";
		
		if ($staff_name)
			$sql.=" AND js.name LIKE '%".$staff_name."%' ";
		
		if ($date_from)
			$sql.=" AND date>='".$date_from."' AND date<='".$date_to."' ";
			
			
		$sql.="ORDER BY date ASC";
		
		$q = $this->db->query($sql);
		if($q->num_rows()>0) {
			foreach($q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$q->free_result();
		return $data;
	}
	
	function selectUserJob($jobcode){
		/*$sql = "SELECT  SUBSTR(jddt.code,19,12) AS job_code,jddt.code,SUBSTR(jddt.code,4,5) AS staff_no,js.name
				FROM josh_details_day_tr jddt
				INNER JOIN josh_staff js ON js.`no`= SUBSTR(jddt.code,4,5)
				WHERE SUBSTR(jddt.code,19,12) = '".$jobcode."'
				GROUP BY SUBSTR(jddt.code,4,5)
				ORDER BY SUBSTR(jddt.code,19,12)  DESC;
			   ";*/
		$sql = "SELECT jht.staff_no,jht.staff_name,jht.pos_code,
				IF(jht.pos_code='M',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS M,
				IF(jht.pos_code='M',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS M_budget,
				IF(jht.pos_code='AM',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS AM,
				IF(jht.pos_code='AM',jj.AM * (SUM(jddt.time) + SUM(jddt.over_time)),0) AS AM_budget,
				IF(jht.pos_code='S2',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS S2,
				IF(jht.pos_code='S2',jj.S2* (SUM(jddt.time) + SUM(jddt.over_time)),0) AS S2_budget,
				IF(jht.pos_code='S1',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS S1,
				IF(jht.pos_code='S1',jj.S1* (SUM(jddt.time) + SUM(jddt.over_time)),0) AS S1_budget,
				IF(jht.pos_code='AS',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS ASS,
				IF(jht.pos_code='AS',jj.AS* (SUM(jddt.time) + SUM(jddt.over_time)),0) AS ASS_budget,
				IF(jht.pos_code='TA',(SUM(jddt.time) + SUM(jddt.over_time)),0) AS TA,
				IF(jht.pos_code='TA',jj.TA* (SUM(jddt.time) + SUM(jddt.over_time)),0) AS TA_budget
				FROM josh_details_day_tr jddt
				INNER JOIN josh_head_tr jht ON jht.`tr_code` =  SUBSTR(jddt.`code`,1,17)
				INNER JOIN josh_job jj ON jj.code = SUBSTR(jddt.code,19,12)
				WHERE SUBSTR(jddt.code,19,12) = '".$jobcode."'
				GROUP BY jht.staff_no,jht.`pos_code`
				ORDER BY jht.staff_no ASC LIMIT 5;
			  ";	   
		$q = $this->db->query($sql);
		$rows = $q->result_array();
		if($rows)
			return $rows;
		else
			return $rows=0;
	}
  
    function selectUserRecords($year_start='',$year_end=''){
	    //if ($_SESSION['level'] == 'M'):
			//$this->db->where('jj.Manager',$_SESSION['no']);
		//endif;
		//$this->db->where('jc.scope',$_SESSION['division']);
		//$this->db->where('ABS(substr(jj.periode,4,4))>=',2012);
		//if($year_start){
		  //  $this->db->where('ABS(substr(jj.periode,4,4))>=',$year_start);
			//$this->db->where('ABS(substr(jj.periode,4,4))<=',$year_end);
		//}  
		$data=array();
        $this->db->select("*,jj.code");
        //$this->db->join('josh_group jg','jg.group_id=jj.gr_id','LEFT');
		$this->db->join('josh_company jc','jc.code=jj.company_code','INNER');
        /*$this->db->where_not_in('jj.code','NC1001');
        $this->db->where_not_in('jj.code','NC1002');
        $this->db->where_not_in('jj.code','NC1003');
        $this->db->where_not_in('jj.code','NC1004');
        $this->db->where_not_in('jj.code','NC1005');
        $this->db->where_not_in('jj.code','NC1006');
        $this->db->where_not_in('jj.code','NC1007');
        $this->db->where_not_in('jj.code','NC1008');
        $this->db->where_not_in('jj.code','NC1009');
        $this->db->where_not_in('jj.code','NC1010');
        $this->db->where('jj.status_job','active');
		$this->db->like('jj.name','Novo');*/
		$this->db->where('jj.status_job','active');
        $this->db->orderby('jj.code','ASC');
		$Q=$this->db->get('josh_job jj');
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row){
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
	}
	
	function selectUserSQLRecords($periodestart='',$periodeend=''){
		$month_start = substr($periodestart,0,2);
		$year_start  = substr($periodestart,3,4);
		
		$month_end   = substr($periodeend,0,2);
		$year_end    = substr($periodeend,3,4);
		
		$sql="  Select *  
				from josh_job jj
				where status_job='active'
		     ";
		if($periodestart){
			$sql.=" and (substr(periode,1,2)>='$month_start' AND substr(periode,4,4)>='$year_start') ";
			$sql.=" and (substr(periode,1,2)<='$month_end' AND substr(periode,4,4)<='$year_end') ";
		} else { 
			$sql.=" and substr(periode,4,4)>='2012'"; }
		
		if($_SESSION['level']!='HRD')
			$sql.=" and Manager = '$_SESSION[manager]'"; 
		
		
		$Q=$this->db->query($sql);
		if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row){
                  $data[]=$row;
               }
		} else {
			$data = '';
		}
		$Q->free_result();
		return $data;
	}
	
	public function getClientFromJob($status = 'active',$periode_from,$periode_to,$name='') {
		$data = array();
		$sql = "
			SELECT jc.code,jc.name as client_name,jc.company_cp as contact_name,transport,
			CONCAT(address,' ',city,' ',country) as address
			FROM
			josh_job jj
			INNER JOIN josh_company jc on jc.code = jj.company_code
			WHERE jj.status_job = 'active' AND
			(substr(jj.periode,4,4) >= '".$periode_from."' AND substr(jj.periode,4,4) <= '".$periode_to."')
			
		";
		
		if($name)
			$sql.=" AND jc.name LIKE '%".$name."%' ";
		
		if(($_SESSION['level']=='M') || ($_SESSION['level']=='AM') || ($_SESSION['level']=='S2')|| ($_SESSION['level']=='S1') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='TA'))
			$sql.= " AND jj.Manager = '".$_SESSION['manager']."' ";
		
		$sql.=" GROUP BY jc.code ORDER BY jc.code ASC";
		
		$Q = $this->db->query($sql);
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		
		$Q->free_result();
		return $data;
	}
	
	public function getJobFromClient($status = 'active',$client_code,$periode_from,$periode_to) {
		$data = array();
		$sql = "
			SELECT jj.code,jj.periode,jj.Manager_name,
			jj.M_time,jj.SM_time,jj.AM_time,jj.S2_time,jj.S1_time,AS_time,TA_time,
			((jj.SP * jj.SP_time) + (jj.PC * jj.PC_time) + (jj.SM * jj.SM_time) + (jj.M * jj.M_time) + (jj.AM * jj.AM_time) + (jj.S2 * jj.S2_time) + (jj.S1 * jj.S1_time) + (jj.AS * jj.AS_time) + (jj.TA * jj.TA_time)) as total_budget,
			M,AM,S2,S1,`AS`,TA,
			M_hour,(M*M_hour) as M_cost,AM_hour,(AM*AM_hour) as AM_cost,S2_hour,(S2*S2_hour) as S2_cost,S1_hour,(S1*S1_hour) as S1_cost,AS_hour,(`AS`*AS_hour) as AS_cost,TA_hour,(TA*TA_hour) as TA_cost,
			((jj.SP * 0) + (jj.PC * 0) + (jj.SM * jj.SM_hour) + (jj.M * jj.M_hour) + (jj.AM * jj.AM_hour) + (jj.S2 * jj.S2_hour) + (jj.S1 * jj.S1_hour) + (jj.AS * jj.AS_hour) + (jj.TA * jj.TA_hour)) as total_cost,approve_charge
			FROM
			josh_job jj
			WHERE jj.status_job = 'active' AND jj.company_code = '".$client_code."' AND
			(substr(jj.periode,4,4) >= '".$periode_from."' AND substr(jj.periode,4,4) <= '".$periode_to."')
			ORDER BY jj.code ASC
		";
		$Q = $this->db->query($sql);
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		
		$Q->free_result();
		return $data;
	}
	
	public function getStaffFromJob($job_code) {
		$data = array();
		$sql = "
			SELECT SUM(jddt.time) as hour,jht.staff_no,jht.pos_code,jht.staff_name,SUM(transport_chf) as cost,SUM(transport_chf) as transport
			FROM
			josh_details_day_tr jddt
			inner join josh_head_tr jht on jht.tr_code = jddt.tr_code
			WHERE substr(jddt.code,19,12) = '".$job_code."' AND jddt.app_manager='yes'
			GROUP BY jht.staff_no,jht.pos_code
		";
		$Q = $this->db->query($sql);
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		
		$Q->free_result();
		return $data;
	}
	
	public function getEmployeeTimeUser($staff_no,$job_code) {
		$data = array();
		$sql = "
			SELECT DATE_FORMAT(jddt.date,'%d/%m/%Y') as date,jj.name as job_name,jddt.x1,jddt.x2,jddt.x3,jddt.x4,jddt.time,
			(sal_bas/173) * (x1 * 1.5) as x1_total,
			(sal_bas/173) * (x2 * 2.0) as x2_total,
			(sal_bas/173) * (x3 * 3.0) as x3_total,
			(sal_bas/173) * (x4 * 4.0) as x4_total,
			(jddt.meal * 10000) as meal,
			sal_bas as salary,activity,
			transport_chf as transport,
			IF(RIGHT(jddt.code,2)='NCH',jddt.app_hrd,app_manager) as app,
			((sal_bas/173) * (x1 * 1.5)+(sal_bas/173) * (x2 * 2.0)+(sal_bas/173) * (x3 * 3.0)+(sal_bas/173) * (x4 * 4.0) + (jddt.meal * 10000) + transport_chf) as total
			FROM josh_details_day_tr jddt
			INNER JOIN josh_staff js on js.no = substr(jddt.tr_code,4,5)
			INNER JOIN josh_job jj ON jj.code=SUBSTR(jddt.code,19,12)
			WHERE SUBSTR(jddt.code,19,12) = '".$job_code."'
			AND js.no = '".$staff_no."'
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
 
    function numRecord($code){
        $data=array();
        $this->db->select('code');
		$this->db->where('code',$code);
        $Q=$this->db->get('josh_job');
        return $Q->num_rows();
    }
    
    function saveTable(){
        $sp	=	$this->input->post('partner');
		$sp2=	$this->input->post('partner2');
        $pc	=	$this->input->post('ass_partner');
        $sm	=	$this->input->post('sn_manager');
        $m	=	$this->input->post('manager');
        $am	=	$this->input->post('ass_manager');
		$s2	=	$this->input->post('senior2');
        $s	=	$this->input->post('senior');
		$as	=	$this->input->post('as');
		$ta	=	$this->input->post('ta');
        $hrd=	$this->input->post('hrd');
        
        if ($hrd) :
           $this->db->select('name');
           $this->db->where('no',$hrd);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $hrd=$row['name'];
        endif;
        
        if ($sp) :
           $this->db->select('name');
           $this->db->where('no',$sp);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sp=$row['name'];
        endif;
		
		if ($sp2) :
           $this->db->select('name');
           $this->db->where('no',$sp2);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sp2=$row['name'];
        endif;
        
        if ($pc) :
           $this->db->select('name');
           $this->db->where('no',$pc);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $pc=$row['name'];
        endif; 
        
        if ($sm) :
           $this->db->select('name');
           $this->db->where('no',$sm);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sm=$row['name'];
        endif;
        
        if ($m) :
           $this->db->select('name');
           $this->db->where('no',$m);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $m=$row['name'];
        endif;
        
        if ($am) :
           $this->db->select('name');
           $this->db->where('no',$am);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $am=$row['name'];
        endif;
        
        if ($s2) :
           $this->db->select('name');
           $this->db->where('no',$s2);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s2=$row['name'];
        endif;
		
		if ($s) :
           $this->db->select('name');
           $this->db->where('no',$s);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s=$row['name'];
        endif;
		
		if ($as) :
           $this->db->select('name');
           $this->db->where('no',$as);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $as=$row['name'];
        endif;
		
		if ($ta) :
           $this->db->select('name');
           $this->db->where('no',$ta);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $ta=$row['name'];
        endif;
        
        if($_SESSION['division']=='Kuningan'):
            $code = $this->input->xss_clean($_POST['code']).$this->input->xss_clean($_POST['job']).$this->input->xss_clean($_POST['month']).$this->input->xss_clean(substr($_POST['year'],2,2));
        else:
            $code = $this->input->xss_clean($_POST['job_code']);
        endif;
        
		$data=array(
            'code'			=>	$code,
            'company_code'	=>	$this->input->xss_clean($_POST['code']),
            'periode'		=>	$this->input->xss_clean($_POST['month']).'-'.$this->input->xss_clean($_POST['year']),
            'name'			=>	$this->input->xss_clean($_POST['name']),
            'description'	=>	$this->input->xss_clean($_POST['description']),
            'check'			=>	$this->input->xss_clean($_POST['check']),
            'gr_id'			=>	$this->input->xss_clean($_POST['group']),
            'SP'			=>	$this->input->xss_clean($_POST['sp_budget']),
            'PC'			=>	$this->input->xss_clean($_POST['pc_budget']),
            'SM'			=>	$this->input->xss_clean($_POST['sm_budget']),
            'M'				=>	$this->input->xss_clean($_POST['m_budget']),
            'AM'			=>	$this->input->xss_clean($_POST['am_budget']),
            'S2'			=>	$this->input->xss_clean($_POST['s2_budget']),
            'S1'			=>	$this->input->xss_clean($_POST['s1_budget']),
            'AS'			=>	$this->input->xss_clean($_POST['as_budget']),
            'TA'			=>	$this->input->xss_clean($_POST['ta_budget']),
			'SP_time'		=>	$this->input->xss_clean($_POST['sp_time']),
            'PC_time'		=>	$this->input->xss_clean($_POST['pc_time']),
            'SM_time'		=>	$this->input->xss_clean($_POST['sm_time']),
            'M_time'		=>	$this->input->xss_clean($_POST['m_time']),
            'AM_time'		=>	$this->input->xss_clean($_POST['am_time']),
            'S2_time'		=>	$this->input->xss_clean($_POST['s2_time']),
            'S1_time'		=>	$this->input->xss_clean($_POST['s1_time']),
            'AS_time'		=>	$this->input->xss_clean($_POST['as_time']),
            'TA_time'		=>	$this->input->xss_clean($_POST['ta_time']),
            'HRD'			=> 	$this->input->xss_clean($_POST['hrd']),
            'HRD_name'		=> 	$this->input->xss_clean($hrd),
			'Partner'		=> 	$this->input->xss_clean($_POST['partner']),
            'Partner_name'	=> 	$this->input->xss_clean($sp),
			'Partner2'		=> 	$this->input->xss_clean($_POST['partner2']),
            'Partner2_name'	=> 	$this->input->xss_clean($sp2),
            'Senior_Manager'=>	$this->input->xss_clean($_POST['sn_manager']),
            'Senior_Manager_name'=>$this->input->xss_clean($sm),
            'Manager'		=> 	$this->input->xss_clean($_POST['manager']),
            'Manager_name'	=> 	$this->input->xss_clean($m),
            'Ass_Manager'	=> 	$this->input->xss_clean($_POST['ass_manager']),
            'Ass_Manager_name'=> $this->input->xss_clean($am),
			'Senior2'		=> 	$this->input->xss_clean($_POST['senior2']),
            'Senior2_name'	=> 	$this->input->xss_clean($s2), 
            'Senior'		=> 	$this->input->xss_clean($_POST['senior']),
            'Senior_name'	=> 	$this->input->xss_clean($s),
			'Ass_Senior'	=> 	$this->input->xss_clean($_POST['as']),
            'Ass_Senior_name'=> $this->input->xss_clean($as),
			'Tech_Ass'		=> 	$this->input->xss_clean($_POST['ta']),
            'Tech_Ass_name' =>  $this->input->xss_clean($ta)); 
		$this->db->insert('josh_job',$data);
	}
    
    function getRecord($id){
		$data=array('*,josh_job.description');
        $this->db->join('josh_group','josh_group.group_id=josh_job.gr_id','LEFT'); 
		$this->db->where('code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_job');
		
		if($Q->num_rows() > 0 ){
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function updateRecord(){
		$sp=$this->input->post('partner');
		$sp2=$this->input->post('partner2');
        $pc=$this->input->post('ass_partner');
        $sm=$this->input->post('sn_manager');
        $m=$this->input->post('manager');
        $am=$this->input->post('ass_manager');
        $s2	=	$this->input->post('senior2');
        $s	=	$this->input->post('senior');
		$as	=	$this->input->post('as');
		$ta	=	$this->input->post('ta');
        $hrd=$this->input->post('hrd');
        
        if ($hrd) :
           $this->db->select('name');
           $this->db->where('no',$hrd);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $hrd=$row['name'];
        endif;
        
        if ($sp) :
           $this->db->select('name');
           $this->db->where('no',$sp);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sp=$row['name'];
        endif;
		
		if ($sp2) :
           $this->db->select('name');
           $this->db->where('no',$sp2);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sp2=$row['name'];
        endif;
        
        if ($pc) :
           $this->db->select('name');
           $this->db->where('no',$pc);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $pc=$row['name'];
        endif; 
        
        if ($sm) :
           $this->db->select('name');
           $this->db->where('no',$sm);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $sm=$row['name'];
        endif;
        
        if ($m) :
           $this->db->select('name');
           $this->db->where('no',$m);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $m=$row['name'];
        endif;
        
        if ($am) :
           $this->db->select('name');
           $this->db->where('no',$am);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $am=$row['name'];
        endif;
        
        if ($s2) :
           $this->db->select('name');
           $this->db->where('no',$s2);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s2=$row['name'];
        endif;
		
		if ($s) :
           $this->db->select('name');
           $this->db->where('no',$s);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s=$row['name'];
        endif;
		
		if ($as) :
           $this->db->select('name');
           $this->db->where('no',$as);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $as=$row['name'];
        endif;
		
		if ($ta) :
           $this->db->select('name');
           $this->db->where('no',$ta);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $ta=$row['name'];
        endif;
        
		$data=array(
            'name'			=>	$this->input->xss_clean($_POST['name']),
            'check'			=>	$this->input->xss_clean($_POST['check']),
            'description'	=>	$this->input->xss_clean($_POST['description']),
			'note'			=>	$this->input->xss_clean($_POST['note']),
            'gr_id'			=>	$this->input->xss_clean($_POST['group']),
            'SP'			=>	$this->input->xss_clean($_POST['sp_budget']),
            'PC'			=>	$this->input->xss_clean($_POST['pc_budget']),
            'SM'			=>	$this->input->xss_clean($_POST['sm_budget']),
            'M'				=>	$this->input->xss_clean($_POST['m_budget']),
            'AM'			=>	$this->input->xss_clean($_POST['am_budget']),
            'S2'			=>	$this->input->xss_clean($_POST['s2_budget']),
            'S1'			=>	$this->input->xss_clean($_POST['s1_budget']),
            'AS'			=>	$this->input->xss_clean($_POST['as_budget']),
            'TA'			=>	$this->input->xss_clean($_POST['ta_budget']),
			'SP_time'		=>	$this->input->xss_clean($_POST['sp_time']),
            'PC_time'		=>	$this->input->xss_clean($_POST['pc_time']),
            'SM_time'		=>	$this->input->xss_clean($_POST['sm_time']),
            'M_time'		=>	$this->input->xss_clean($_POST['m_time']),
            'AM_time'		=>	$this->input->xss_clean($_POST['am_time']),
            'S2_time'		=>	$this->input->xss_clean($_POST['s2_time']),
            'S1_time'		=>	$this->input->xss_clean($_POST['s1_time']),
            'AS_time'		=>	$this->input->xss_clean($_POST['as_time']),
            'TA_time'		=>	$this->input->xss_clean($_POST['ta_time']),
            'HRD'			=> 	$this->input->xss_clean($_POST['hrd']),
            'HRD_name'		=> 	$this->input->xss_clean($hrd),
            'Partner'		=> 	$this->input->xss_clean($_POST['partner']),
            'Partner_name'	=> 	$this->input->xss_clean($sp),
			'Partner2'		=> 	$this->input->xss_clean($_POST['partner2']),
            'Partner2_name'	=> 	$this->input->xss_clean($sp2),
            'Senior_Manager'=>	$this->input->xss_clean($_POST['sn_manager']),
            'Senior_Manager_name'=>$this->input->xss_clean($sm),
            'Manager'		=> 	$this->input->xss_clean($_POST['manager']),
            'Manager_name'	=> 	$this->input->xss_clean($m),
            'Ass_Manager'	=> 	$this->input->xss_clean($_POST['ass_manager']),
            'Ass_Manager_name'=>$this->input->xss_clean($am),
            'Senior2'		=> 	$this->input->xss_clean($_POST['senior2']),
            'Senior2_name'	=> 	$this->input->xss_clean($s2), 
            'Senior'		=> 	$this->input->xss_clean($_POST['senior']),
            'Senior_name'	=> 	$this->input->xss_clean($s),
			'Ass_Senior'	=> 	$this->input->xss_clean($_POST['as']),
            'Ass_Senior_name'=> $this->input->xss_clean($as),
			'Tech_Ass'		=> 	$this->input->xss_clean($_POST['ta']),
            'Tech_Ass_name' =>  $this->input->xss_clean($ta),
            'approve_charge'=> 	$this->input->xss_clean($_POST['approval'])); 
        $this->db->where('code',$this->input->xss_clean($_POST['code']));
		$this->db->update('josh_job',$data);
	}
    
    function active($id){
        $data['status_job']='active';
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->update('josh_job',$data);
    }
    
    function deactive($id){
        $data['status_job']='deactive';
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->update('josh_job',$data);
    }
    
    function deleteRecord($id){
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->delete('josh_job');
    }
	
	function selectJobRefresh(){
		$sql = " SELECT  SUBSTR(jddt.`code`,19,12) AS job,
				jht.`pos_code` AS pos,
				SUM(jddt.time) + SUM(jddt.over_time_app) AS thour,
				IF(jht.pos_code='M',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS M,
				IF(jht.pos_code='AM',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS AM,
				IF(jht.pos_code='S2',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS S2,
				IF(jht.pos_code='S1',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS S1,
				IF(jht.pos_code='AS',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS ASS,
				IF(jht.pos_code='TA',SUM(jddt.time) + SUM(jddt.over_time_app),0) AS TA
				FROM josh_details_day_tr jddt
				INNER JOIN josh_head_tr jht ON jht.`tr_code` =  SUBSTR(jddt.`code`,1,17)
				GROUP BY SUBSTR(jddt.`code`,19,12),jht.`pos_code`;
		    ";
			
		$Q=$this->db->query($sql);
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row){
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;	
	}
}
    
