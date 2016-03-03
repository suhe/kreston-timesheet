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
    
    function getGroup()
    {
        $data=array();
        $this->db->select('*');
        $this->db->where_not_in('group_name','Finance & Accounting');
        $this->db->where_not_in('group_name','Partner');
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
    
    function getRecords($id)
	{
		$data=array();
        $this->db->select('jht.tr_code,jht.periode,jjb.name,jdt.job_code,SUM(jddt.time) as time,SUM(jddt.over_time_app) as over_time,jjb.SP as P,jjb.SM,jjb.SM,jjb.M,jjb.AM,jjb.S2,jjb.S1,jjb.AS,jjb.TA');
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
}    