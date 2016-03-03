<?php
class Josh_manager extends Model
{
	function Josh_manager()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->join('josh_staff','josh_staff.no=josh_manager.staff_no');
        $this->db->where_not_in('no','admin');
        $this->db->order_by('no','ASC');
        $Q=$this->db->get('josh_manager');
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
        $this->db->select('staff_no');
		$this->db->where('staff_no',$_POST['no_staff']);
        $Q=$this->db->get('josh_manager');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['no_staff'].' Is Already!</div>');
		       redirect('manager/admin/add',301);
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
            'staff_no'=>$this->input->xss_clean($_POST['no_staff']),
            'status'=>$this->input->xss_clean($_POST['status'])
		); 
        
        
        //save images to assets/product
       	if ($_FILES)
           {
		      $config['upload_path'] = './assets/signatures/';
		      $config['allowed_types'] = 'gif|jpg|png';
		      $config['max_size'] = '200000';
		      $config['remove_spaces'] = true;
		      $config['overwrite'] = false;
		      //$config['max_width']  = '0';
		      //$config['max_height']  = '0';
		      $this->load->library('upload', $config);	
	
		      if (strlen($_FILES['simage']['name']))
                {
			         if(!$this->upload->do_upload('simage'))
                     {
				        $this->upload->display_errors();
				        exit();
			         }
			 $image = $this->upload->data();
		
			         if ($image['file_name'])
                    {
				        $data['signature'] = "/assets/signatures/".$image['file_name'];
		
                    }
		       }
		
		
		//if (strlen($_FILES['thumbnail']['name'])){
		//	if(!$this->upload->do_upload('thumbnail')){
				//$this->upload->display_errors();
				//exit();
			//}
			//$thumb = $this->upload->data();
	
			//if ($thumb['file_name']){
			//	$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			//}
		//}
        }
        
		$this->db->insert('josh_manager',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
		$this->db->where('staff_no',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_manager');
		
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
            'no_staff'=>$this->input->xss_clean($_POST['no_staff']),
            'status'=>$this->input->xss_clean($_POST['status'])
		); 
        
        
        //save images to assets/product
       	if ($_FILES)
           {
		      $config['upload_path'] = './assets/signatures/';
		      $config['allowed_types'] = 'gif|jpg|png';
		      $config['max_size'] = '200000';
		      $config['remove_spaces'] = true;
		      $config['overwrite'] = false;
		      //$config['max_width']  = '0';
		      //$config['max_height']  = '0';
		      $this->load->library('upload', $config);	
	
		      if (strlen($_FILES['simage']['name']))
                {
			         if(!$this->upload->do_upload('simage'))
                     {
				        $this->upload->display_errors();
				        exit();
			         }
			 $image = $this->upload->data();
		
			         if ($image['file_name'])
                    {
				        $data['signature'] = "/assets/signatures//".$image['file_name'];
		
                    }
		       }
		
		
		//if (strlen($_FILES['thumbnail']['name'])){
		//	if(!$this->upload->do_upload('thumbnail')){
				//$this->upload->display_errors();
				//exit();
			//}
			//$thumb = $this->upload->data();
	
			//if ($thumb['file_name']){
			//	$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			//}
		//}
        }   
        
        $this->db->where('id',$this->input->xss_clean($_POST['id']));
		$this->db->update('josh_manager',$data);
	}
    
    function deleteRecord($id)
    {
        $this->db->where('staff_no',$this->input->xss_clean($id));
        $this->db->delete('josh_manager');
    }
    
}
    