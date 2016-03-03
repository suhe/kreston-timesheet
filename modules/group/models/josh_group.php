<?php
class Josh_group extends Model
{
	function Josh_group()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        //$this->db->join('josh_staff','josh_staff.no=josh_manager.staff_no');
        //$this->db->where_not_in('no','admin');
        $this->db->order_by('group_id','ASC');
        $Q=$this->db->get('josh_group');
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
        $this->db->select('group_name');
		$this->db->where('group_name',$_POST['name']);
        $Q=$this->db->get('josh_group');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['name'].' Is Already!</div>');
		       redirect('group/admin/add',301);
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
            'group_name'=>$this->input->xss_clean($_POST['name']),
            'partner'=>$this->input->xss_clean($_POST['partner']),
            'manager'=>$this->input->xss_clean($_POST['manager']),
            'ass_manager'=>$this->input->xss_clean($_POST['ass_manager']),
            'senior'=>$this->input->xss_clean($_POST['senior'])
		); 
		$this->db->insert('josh_group',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
		$this->db->where('group_id',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_group');
		
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
            'group_name'=>$this->input->xss_clean($_POST['name']),
            'partner'=>$this->input->xss_clean($_POST['partner']),
            'manager'=>$this->input->xss_clean($_POST['manager']),
            'ass_manager'=>$this->input->xss_clean($_POST['ass_manager']),
            'senior'=>$this->input->xss_clean($_POST['senior'])
		);  
        
        $this->db->where('group_id',$this->input->xss_clean($_POST['id']));
		$this->db->update('josh_group',$data);
	}
    
    function deleteRecord($id)
    {
        $this->db->where('group_id',$this->input->xss_clean($id));
        $this->db->delete('josh_group');
    }
    
}
    