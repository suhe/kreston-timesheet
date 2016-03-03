<?php
class Josh_job extends Model
{
	function Josh_job()
	{
		parent::Model();
	}
    
	//Menampilkan data per Record
	function selectRecords()
	{
		$data=array();
        $this->db->select('*');
        $this->db->join('josh_group','josh_group.group_id=josh_job.gr_id','LEFT');
        $this->db->where_not_in('code','NC1001');
        $this->db->where_not_in('code','NC1002');
        $this->db->where_not_in('code','NC1003');
        $this->db->where_not_in('code','NC1004');
        $this->db->where_not_in('code','NC1005');
        $this->db->where_not_in('code','NC1006');
        $this->db->where_not_in('code','NC1007');
        $this->db->where_not_in('code','NC1008');
        $this->db->where_not_in('code','NC1009');
        $this->db->where_not_in('code','NC1010');
        $this->db->orderby('code','ASC');
		$Q=$this->db->get('josh_job');
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
    
    //for Users
    function selectUserRecords()
	{
		$data=array();
        $this->db->select('*');
        $this->db->join('josh_group','josh_group.group_id=josh_job.gr_id','LEFT');
        $this->db->where_not_in('code','NC1001');
        $this->db->where_not_in('code','NC1002');
        $this->db->where_not_in('code','NC1003');
        $this->db->where_not_in('code','NC1004');
        $this->db->where_not_in('code','NC1005');
        $this->db->where_not_in('code','NC1006');
        $this->db->where_not_in('code','NC1007');
        $this->db->where_not_in('code','NC1008');
        $this->db->where_not_in('code','NC1009');
        $this->db->where_not_in('code','NC1010');
        $this->db->where('status_job','active');
        $this->db->orderby('code','ASC');
		$Q=$this->db->get('josh_job');
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
        $Q=$this->db->get('josh_job');
        if($Q->num_rows()> 0 )
		   {
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['code'].' Is Already!</div>');
		       redirect('job_desc/admin/add',301);
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
        $sp=$this->input->post('partner');
        $pc=$this->input->post('ass_partner');
        $sm=$this->input->post('sn_manager');
        $m=$this->input->post('manager');
        $am=$this->input->post('ass_manager');
        $s=$this->input->post('senior');
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
        
        if ($s) :
           $this->db->select('name');
           $this->db->where('no',$s);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s=$row['name'];
        endif;
        
		$data=array(
            'code'=>$this->input->xss_clean($_POST['code']).$this->input->xss_clean($_POST['job']).$this->input->xss_clean($_POST['month']).$this->input->xss_clean(substr($_POST['year'],2,2)),
            'company_code'=>$this->input->xss_clean($_POST['code']),
            'periode'=>$this->input->xss_clean($_POST['month']).'-'.$this->input->xss_clean($_POST['year']),
            'name'=>$this->input->xss_clean($_POST['name']),
            'description'=>$this->input->xss_clean($_POST['description']),
           // 'remarks'=>$this->input->xss_clean($_POST['remarks']),
            'check'=>$this->input->xss_clean($_POST['check']),
            'gr_id'=>$this->input->xss_clean($_POST['group']),
            'SP'=>$this->input->xss_clean($_POST['sp']),
            'PC'=>$this->input->xss_clean($_POST['pc']),
            'SM'=>$this->input->xss_clean($_POST['sm']),
            'M'=>$this->input->xss_clean($_POST['m']),
            'AM'=>$this->input->xss_clean($_POST['am']),
            'S2'=>$this->input->xss_clean($_POST['s2']),
            'S1'=>$this->input->xss_clean($_POST['s1']),
            'AS'=>$this->input->xss_clean($_POST['as']),
            'TA'=>$this->input->xss_clean($_POST['ta']),
            'HRD'=> $this->input->xss_clean($_POST['hrd']),
            'HRD_name'=> $this->input->xss_clean($hrd),
            'Partner'=> $this->input->xss_clean($_POST['partner']),
            'Partner_name'=> $this->input->xss_clean($sp),
            'Senior_Manager'=>$this->input->xss_clean($_POST['sn_manager']),
            'Senior_Manager_name'=>$this->input->xss_clean($sm),
            //'ass_partner'=> $this->input->xss_clean($_POST['ass_partner']),
            //'ass_partner_name'=> $this->input->xss_clean($pc),
            'Manager'=> $this->input->xss_clean($_POST['manager']),
            'Manager_name'=> $this->input->xss_clean($m),
            'Ass_Manager'=> $this->input->xss_clean($_POST['ass_manager']),
            'Ass_Manager_name'=> $this->input->xss_clean($am),
            'Senior'=> $this->input->xss_clean($_POST['senior']),
            'Senior_name'=> $this->input->xss_clean($s)
		); 
		$this->db->insert('josh_job',$data);
	}
    
    function getRecord($id)
	{
		$data=array('*,josh_job.description');
        $this->db->join('josh_group','josh_group.group_id=josh_job.gr_id','LEFT');
        //$this->db->join('josh_staff','josh_staff.no=josh_job.gr_id'); 
		$this->db->where('code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_job');
		
		if($Q->num_rows() > 0 ){
			  	$data=$Q->row_array();
		   }
		$Q->free_result();
		return $data;
	}
    
    function updateRecord()
	{
	    $sp=$this->input->post('partner');
        $pc=$this->input->post('ass_partner');
        $sm=$this->input->post('sn_manager');
        $m=$this->input->post('manager');
        $am=$this->input->post('ass_manager');
        $s=$this->input->post('senior');
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
        
        if ($s) :
           $this->db->select('name');
           $this->db->where('no',$s);
           $q=$this->db->get('josh_staff');
           $row=$q->row_array();
           $s=$row['name'];
        endif;
        
		$data=array(
            'name'=>$this->input->xss_clean($_POST['name']),
            //'remarks'=>$this->input->xss_clean($_POST['remarks']),
            'check'=>$this->input->xss_clean($_POST['check']),
            'description'=>$this->input->xss_clean($_POST['description']),
            'gr_id'=>$this->input->xss_clean($_POST['group']),
            'SP'=>$this->input->xss_clean($_POST['sp']),
            'PC'=>$this->input->xss_clean($_POST['pc']),
            'SM'=>$this->input->xss_clean($_POST['sm']),
            'M'=>$this->input->xss_clean($_POST['m']),
            'AM'=>$this->input->xss_clean($_POST['am']),
            'S2'=>$this->input->xss_clean($_POST['s2']),
            'S1'=>$this->input->xss_clean($_POST['s1']),
            'AS'=>$this->input->xss_clean($_POST['as']),
            'TA'=>$this->input->xss_clean($_POST['ta']),
            'HRD'=> $this->input->xss_clean($_POST['hrd']),
            'HRD_name'=> $this->input->xss_clean($hrd),
            'Partner'=> $this->input->xss_clean($_POST['partner']),
            'Partner_name'=> $this->input->xss_clean($sp),
            'Senior_Manager'=>$this->input->xss_clean($_POST['sn_manager']),
            'Senior_Manager_name'=>$this->input->xss_clean($sm),
            //'ass_partner'=> $this->input->xss_clean($_POST['ass_partner']),
            //'ass_partner_name'=> $this->input->xss_clean($pc),
            'Manager'=> $this->input->xss_clean($_POST['manager']),
            'Manager_name'=> $this->input->xss_clean($m),
            'Ass_Manager'=> $this->input->xss_clean($_POST['ass_manager']),
            'Ass_Manager_name'=> $this->input->xss_clean($am),
            'Senior'=> $this->input->xss_clean($_POST['senior']),
            'Senior_name'=> $this->input->xss_clean($s)
		); 
        
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
    
    function deleteRecord($id)
    {
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->delete('josh_job');
    }
    
}
    