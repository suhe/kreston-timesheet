<?php
class Josh_staff extends Model
{
	function Josh_staff()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('*');
		$this->db->where_not_in('no','admin');
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
        $this->db->orderby('josh_staff.status','active'); 
        $this->db->orderby('josh_staff.group_id','ASC');
        $this->db->orderby('josh_position.order','ASC');
        $this->db->orderby('no','ASC');
        
		$Q=$this->db->get('josh_staff');
        //$Q=$this->db->query("SELECT * FROM josh_staff WHERE no<>'admin' order by no ASC");
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
        $this->db->select('no');
		$this->db->where('no',$_POST['no']);
        $Q=$this->db->get('josh_staff');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['no'].' Is Already!</div>');
		       if  ($_SESSION['level']=='ADM') {
                   redirect('staff/admin/add',301);}
			   elseif($_SESSION['level']=='HRD'){
			       redirect('staff/hrd/add',301);}			   
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
            'no'=>$this->input->xss_clean($_POST['no']),
            'name'=>$this->input->xss_clean($_POST['name']),
            'email'=>$this->input->xss_clean($_POST['email']),
            'password'=>MD5($this->input->xss_clean($_POST['password'])),
            'birthday'=>$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
            'sex'=>$this->input->xss_clean($_POST['sex']),
            'address'=>$this->input->xss_clean($_POST['address']),
            'hp'=>$this->input->xss_clean($_POST['hp']),
            'city'=>$this->input->xss_clean($_POST['city']),
            'country'=>$this->input->xss_clean($_POST['country']),
            'group_id'=>$this->input->xss_clean($_POST['group']),
            'pos_code'=>$this->input->xss_clean($_POST['pos'])
           // 'job_position'=>$this->input->xss_clean($_POST['job'])
		); 
        
        //save images to assets/product
       	if ($_FILES)
           {
		      $config['upload_path'] = './assets/photo/staff/';
		      $config['allowed_types'] = 'gif|jpg|png';
		      $config['max_size'] = '200000';
		      $config['remove_spaces'] = true;
		      $config['overwrite'] = false;
		      //$config['max_width']  = '0';
		      //$config['max_height']  = '0';
		      $this->load->library('upload', $config);	
	
		      if (strlen($_FILES['image']['name']))
                {
			         if(!$this->upload->do_upload('image'))
                     {
				        $this->upload->display_errors();
				        exit();
			         }
			 $image = $this->upload->data();
		
			         if ($image['file_name'])
                    {
				        $data['photo'] = "/assets/photo/staff/".$image['file_name'];
		
                    }
		       }
        }
        
		$this->db->insert('josh_staff',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
		$this->db->where('no',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_staff');
		
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
		'name'=>$this->input->xss_clean($_POST['name']),
            'email'=>$this->input->xss_clean($_POST['email']),
            //'password'=>MD5($this->input->xss_clean($_POST['password'])),
            'birthday'=>$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
            'sex'=>$this->input->xss_clean($_POST['sex']),
            'address'=>$this->input->xss_clean($_POST['address']),
            'hp'=>$this->input->xss_clean($_POST['hp']),
            'city'=>$this->input->xss_clean($_POST['city']),
            'country'=>$this->input->xss_clean($_POST['country']),
            //'job_position'=>$this->input->xss_clean($_POST['job'])
            //'photo'=>$this->input->xss_clean($_FILES['image']['name'])
            'group_id'=>$this->input->xss_clean($_POST['group']),
            'pos_code'=>$this->input->xss_clean($_POST['pos'])
		);
        
        //save images to assets/product
       	if ($_FILES)
           {
		      $config['upload_path'] = './assets/photo/staff/';
		      $config['allowed_types'] = 'gif|jpg|png';
		      $config['max_size'] = '200000';
		      $config['remove_spaces'] = true;
		      $config['overwrite'] = false;
		      //$config['max_width']  = '0';
		      //$config['max_height']  = '0';
		      $this->load->library('upload', $config);	
	
		      if (strlen($_FILES['image']['name']))
                {
			         if(!$this->upload->do_upload('image'))
                     {
				        $this->upload->display_errors();
				        exit();
			         }
			 $image = $this->upload->data();
		
			         if ($image['file_name'])
                    {
				        $data['photo'] = "/assets/photo/staff/".$image['file_name'];
		
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
        
        $this->db->where('no',$this->input->xss_clean($_POST['no']));
		$this->db->update('josh_staff',$data);
	}
    
    function deleteRecord($id)
    {
        $this->db->where('no',$this->input->xss_clean($id));
        $this->db->delete('josh_staff');
    }
    
}
    
