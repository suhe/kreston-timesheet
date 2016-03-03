<?php
class Josh_transport extends Model {
    
    function Josh_transport()
	{
		parent::Model();
	}
    
    function selectRecords($id)
	{
		$data=array();
        $this->db->select('*');
        $this->db->where('josh_head_tr.staff_no',$_SESSION['no']);
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
    
    function selectPeriode()
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
    
    function selectDetailAccRecords($id){
		$data=array();
        $this->db->select('jddt.tr_code,jddt.code,jddt.date,jb.code as job_code,jb.name,jddt.transport_chf,jddt.app_charge,jddt.app_manager,location');
        $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
        $this->db->join('josh_job jb','jb.code=jdt.job_code');
        $this->db->where('jdt.tr_code',$id);
        $this->db->where('jddt.type_job','chf');
        $this->db->order_by('jddt.date','ASC');
		$Q=$this->db->get('josh_details_day_tr jddt');
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
    
    function saveTransport(){
        $code=$this->input->xss_clean($this->input->post('code'));
        $date=$this->input->xss_clean($this->input->post('date'));
        $tr_code=$this->input->xss_clean($this->input->post('tr_code'));
        $type=$this->input->xss_clean('chf');
        $transport=$this->input->xss_clean($this->input->post('transport'));
        $location=$this->input->xss_clean($this->input->post('location'));
        //update
        $data['transport_chf']=$transport;
        $data['location']=$location;
        $data['app_charge']='no';
        $data['signature_charge']='';
        $data['app_manager']='no';
        $data['signature_manager']='';
        //update
        $this->db->where('code',$code);
        $this->db->where('tr_code',$tr_code);
        $this->db->where('date',$date);
        $this->db->where('type_job',$type);
		$this->db->update('josh_details_day_tr',$data);
    } 
    
    //For Admin
    function getADM_Approv($id)
	{
		$data=array();
        $this->db->select('manager_name,manager_signature');
		$this->db->where('tr_code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_head_tr');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function getHrd_Approv($id)
	{
		$data=array();
        $this->db->select('hrd_name,hrd_signature');
		$this->db->where('tr_code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_head_tr');
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function getRecords($id)
	{
		$data=array();
        $this->db->select('jht.tr_code,jht.periode,jjb.name,jdt.job_code,jddt.transport_chf as transport');
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
        