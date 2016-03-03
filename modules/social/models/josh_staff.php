<?php
class Josh_staff extends Model{
	function Josh_staff(){
		parent::Model();
	}
    
	function selectRecords(){
		$data=array();
        $this->db->select('*');
		$this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
		$this->db->where('division',$_SESSION['division']);
        $this->db->orderby('no','ASC');
		$Q=$this->db->get('josh_staff');
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
	
	function selectActiveRecords(){
		$data=array();
        $this->db->select('*');
		$this->db->where_not_in('pos_code','P');
		$this->db->where_not_in('pos_code','HRD');
		$this->db->where('status','active');
		$this->db->where('division',$_SESSION['division']);
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
        $this->db->orderby('josh_staff.no','ASC');
		$Q=$this->db->get('josh_staff');
		if($Q->num_rows()> 0 ){
			foreach ($Q->result_array() as $row){
                  $data[]=$row;
            }
		}
		$Q->free_result();
		return $data;
	}
    
    function saveRecord(){
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
            'no'			=>	$this->input->xss_clean($_POST['no']),
			'division'		=>	$this->session->userdata('division'),
            'name'			=>	$this->input->xss_clean($_POST['name']),
            'email'			=>	$this->input->xss_clean($_POST['email']),
            'password'		=>	MD5($this->input->xss_clean($_POST['password'])),
            'staff_date'	=>	$this->input->xss_clean($_POST['yearin']).'-'.$this->input->xss_clean($_POST['monthin'].'-'.$this->input->xss_clean($_POST['dayin'])),
            'birthday'		=>	$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),    
            'sex'			=>	$this->input->xss_clean($_POST['sex']),
            'address'		=>	$this->input->xss_clean($_POST['address']),
            'hp'			=>	$this->input->xss_clean($_POST['hp']),
            'city'			=>	$this->input->xss_clean($_POST['city']),
            'country'		=>	$this->input->xss_clean($_POST['country']),
            'group_id'		=>	$this->input->xss_clean($_POST['group']),
            'sal_bas'		=>	$this->input->xss_clean($_POST['sal_bas']),
            'allow_1'		=>	$this->input->xss_clean($_POST['allow_1']),
            'allow_2'		=>	$this->input->xss_clean($_POST['allow_2']), 
            'staff_transport'=>	$this->input->xss_clean($_POST['staff_transport']),
            'staff_outmeal'	=>	$this->input->xss_clean($_POST['staff_outmeal']),               
            'pos_code'		=>	$this->input->xss_clean($_POST['pos'])
		); 
        
		if($this->input->post('resign')==1):
			$data['staff_out']	=  $this->input->xss_clean($_POST['yearout']).'-'.$this->input->xss_clean($_POST['monthout'].'-'.$this->input->xss_clean($_POST['dayout'])); 
			$data['status']	    =  "deactive"; 
		endif;
		
        
       	if ($_FILES)
           {
		      $config['upload_path'] = './assets/photo/staff/';
		      $config['allowed_types'] = 'gif|jpg|png';
		      $config['max_size'] = '999900';
		      $config['remove_spaces'] = true;
		      $config['overwrite'] = false;
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
    
    function getRecord($id){
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
			'name'		=>	$this->input->xss_clean($_POST['name']),
            'email'		=>	$this->input->xss_clean($_POST['email']),
            'birthday'	=>	$this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
            'staff_date'=>$this->input->xss_clean($_POST['yearin']).'-'.$this->input->xss_clean($_POST['monthin'].'-'.$this->input->xss_clean($_POST['dayin'])),
            'sex'		=>$this->input->xss_clean($_POST['sex']),
            'address'	=>$this->input->xss_clean($_POST['address']),
            'hp'		=>$this->input->xss_clean($_POST['hp']),
            'city'		=>$this->input->xss_clean($_POST['city']),
            'country'	=>$this->input->xss_clean($_POST['country']),
            'group_id'	=>$this->input->xss_clean($_POST['group']),
            'sal_bas'	=>$this->input->xss_clean($_POST['sal_bas']),
            'allow_1'	=>$this->input->xss_clean($_POST['allow_1']),
            'allow_2'	=>$this->input->xss_clean($_POST['allow_2']), 
            'staff_transport'=>$this->input->xss_clean($_POST['staff_transport']),
            'staff_outmeal'=>$this->input->xss_clean($_POST['staff_outmeal']),      
            'pos_code'	=>$this->input->xss_clean($_POST['pos']),
			'staff_out'	=>$this->input->xss_clean($_POST['yearout']).'-'.$this->input->xss_clean($_POST['monthout']).'-'.$this->input->xss_clean($_POST['dayout'])
		);
		
		if($this->input->post('resign')==1):
			//$data['staff_out']	=  $this->input->xss_clean($_POST['yearout']).'-'.$this->input->xss_clean($_POST['monthout'].'-'.$this->input->xss_clean($_POST['dayout'])); 
			$data['status']	    =  "deactive"; 
		elseif($this->input->post('resign')==2):
			$data['status']	    =  "leave"; 
		endif;
        
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
        
        $this->db->where('no',$this->input->xss_clean($_POST['no']));
		$this->db->update('josh_staff',$data);
	}
    
    function deleteRecord($id){
        $this->db->where('no',$this->input->xss_clean($id));
        $this->db->delete('josh_staff');
    }
    
}