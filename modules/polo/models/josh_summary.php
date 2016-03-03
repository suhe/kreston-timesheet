<?php
class Josh_summary extends Model {
	function Josh_summary() {
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('periode');
        $this->db->groupby('periode');
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
    
    function getRecords($id)
    {
        $data=array();
		//$_SESSION['prd']=$id;
        /*
		$this->db->select('*');
        $this->db->join('josh_staff s','t.staff_no=s.no');
		$this->db->join('josh_details_tr jdt','jdt.tr_code=t.tr_code');
		$this->db->where('t.periode',$id);
		$this->db->groupby('s.no');
		$this->db->orderby('s.no','ASC');
        $Q=$this->db->get('josh_head_tr t');
		*/
		$sql =" SELECT jht.staff_no,jj.code,SUM(jddt.time) + SUM(jddt.over_time_app) as time,SUM(jddt.transport_chf) as transp,jj.name,js.name as staff_name,js.nickname,";
		$sql.=" jht.pos_code,DATE_FORMAT(jht.periode,'%d %M %Y') as tr_periode ";
		$sql.=" FROM josh_details_day_tr jddt ";
		$sql.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code ";
		$sql.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
		$sql.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code ";
		$sql.=" JOIN josh_staff js ON js.no=jht.staff_no ";
			/*WHERE jdt.tr_code='TR-10002-05092010'*/
		$sql.="WHERE jht.periode='".$id."'";	
		$sql.="GROUP BY jddt.code ";
		$sql.="ORDER BY js.no ASC ";
		$Q   = $this->db->query($sql);  
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
    
	/*
    function getRecords($id)
	{
		$data=array();
        $this->db->select('jht.tr_code,jht.periode,jjb.name,jdt.job_code,SUM(jddt.time) as time,SUM(jddt.over_time_app) as over_time,jjb.SP as P,jjb.SM,jjb.SM,jjb.M,jjb.AM,jjb.S2,jjb.S1,jjb.AS,jjb.TA,jjb.SP_time as P_time,jjb.SM_time,jjb.SM_time,jjb.M_time,jjb.AM_time,jjb.S2_time,jjb.S1_time,jjb.AS_time,jjb.TA_time');
        $this->db->join('josh_details_tr jdt','jdt.tr_code=jht.tr_code');
        $this->db->join('josh_job jjb','jjb.code=jdt.job_code');
        $this->db->join('josh_details_day_tr jddt','jddt.code=jdt.day_code');
        $this->db->groupby('jdt.job_code');
        $this->db->where('jht.periode',$id);
        $this->db->where_not_in('jdt.job_code','NC1001');
        $this->db->where_not_in('jdt.job_code','NC1002');
        $this->db->where_not_in('jdt.job_code','NC1003');
        $this->db->where_not_in('jdt.job_code','NC1004');
        $this->db->where_not_in('jdt.job_code','NC1005'); 
		$this->db->where_not_in('jdt.job_code','NC1006');
        $this->db->where_not_in('jdt.job_code','NC1007');
        $this->db->where_not_in('jdt.job_code','NC1008');
		$this->db->where_not_in('jdt.job_code','NC1009');
        $this->db->where_not_in('jdt.job_code','NC1010');
		$Q=$this->db->get('josh_head_tr jht');
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
	}
	*/
}    
