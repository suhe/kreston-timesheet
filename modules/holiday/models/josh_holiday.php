<?php
class Josh_Holiday extends Model
{
	function Josh_Holiday()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        //$this->db->join('josh_staff','josh_staff.no=josh_manager.staff_no');
        //$this->db->where_not_in('no','admin');
        $this->db->order_by('date_h','DESC');
        $Q=$this->db->get('josh_holiday');
        //$Q=$this->db->query("SELECT * FROM josh_manager WHERE no<>'admin' order by no ASC");
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
    
    function saveRecord()
	{
		$data=array();
        $this->db->select('date_h');
		$this->db->where('date_h',$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])));
        $Q=$this->db->get('josh_holiday');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['no_staff'].' Is Already!</div>');
		       redirect('holiday/admin/add',301);
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
            'date_h'=>$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
            'description_h'=>$this->input->xss_clean($_POST['description'])
		); 
        
		$this->db->insert('josh_holiday',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
		$this->db->where('date_h',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_holiday');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function updateRecord()
	{
		$data=array(
            'description_h'=>$this->input->xss_clean($_POST['description'])
		);    
        
        $this->db->where('date_h',$this->input->xss_clean($_POST['date']));
		$this->db->update('josh_holiday',$data);
	}
    
    function deleteRecord($id)
    {
        $this->db->where('date_h',$this->input->xss_clean($id));
        $this->db->delete('josh_holiday');
    }
    
    // For User
    function selectholiday($mm,$awal,$akhir)
    {
        $data=array();
        $this->db->select('date_h,description_h');
        $this->db->where('MONTH(date_h)',$mm);
		$this->db->where('YEAR(date_h)',date('Y'));
        $this->db->where('DAY(date_h) >= ',$awal);
        $this->db->where('DAY(date_h) <= ',$akhir);
        $this->db->order_by('date_h','ASC');
        $Q=$this->db->get('josh_holiday');
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
    
    function selectDay($day,$month)
	{
		$data=array();
        $this->db->select('date_h');
		$this->db->where('DAY(date_h)',$this->input->xss_clean($day));
        $this->db->where('MONTH(date_h)',$this->input->xss_clean($month));
        $this->db->where('YEAR(date_h)',$this->input->xss_clean(date('Y')));
		$this->db->or_where('YEAR(date_h)',$this->input->xss_clean(date('Y')+1));
		$this->db->limit(1);
		//$Q=$this->db->query("SELECT * FROM josh_holiday WHERE MONTH(date_h)='$month' AND DAY(date_h)='$day' ");
        $Q=$this->db->get('josh_holiday');
		
		if($Q->num_rows() > 0 )
		   {
		         
			  	$data=$Q->row_array();
		   }
         else
          {
                $data=$Q->row_array();
                $data['date_h']=0;
          }  
		$Q->free_result();
		return $data;
	}
    
}
    