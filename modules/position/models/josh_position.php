<?php

class Josh_position extends Model
{
	function Josh_position()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('*');
        $this->db->orderby('code','ASC');
		$Q=$this->db->get('josh_position');
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
        $this->db->select('code');
		$this->db->where('code',$_POST['code']);
        $Q=$this->db->get('josh_position');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['code'].' Is Already!</div>');
		       redirect('position/admin/add',301);
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
            'code'=>$this->input->xss_clean($_POST['code']),
            'name'=>$this->input->xss_clean($_POST['name']),
            'description'=>$this->input->xss_clean($_POST['description'])
		); 
		$this->db->insert('josh_position',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
		$this->db->where('code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_position');
		
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
    
}
    