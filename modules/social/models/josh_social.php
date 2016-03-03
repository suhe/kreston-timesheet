<?php

class Josh_social extends Model
{
	function Josh_social(){
		parent::Model();
	}
    
	function selectRecords(){
	  $data=array();
        $this->db->select('*,social_status.id');
	    $this->db->join('josh_staff','josh_staff.no=social_status.staff_no');	
        $this->db->orderby('social_status.id','DESC');
		$Q=$this->db->get('social_status',10);
        if($Q->num_rows()> 0 ):
            foreach ($Q->result_array() as $row):
                $data[]=$row;
            endforeach;
        endif;
		$Q->free_result();
		return $data;
    }
	
	function selectRecordsComment($status_id){
	  $data=array();
        $this->db->select('*');
	    $this->db->join('josh_staff','josh_staff.no=social_comment.staff_no');	
		$this->db->where('status_id',$status_id);
        $this->db->orderby('social_comment.id','ASC');
		$Q=$this->db->get('social_comment');
        if($Q->num_rows()> 0 ){
			   foreach ($Q->result_array() as $row)
               {
                  $data[]=$row;
               }
		   }
		$Q->free_result();
		return $data;
    }
    
    function getRecord($id){
		$data=array();
        $this->db->join('josh_group','josh_group.group_id=josh_staff.group_id');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');
		$this->db->where('no',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_staff');
		if($Q->num_rows() > 0 ):		         
 	      $data=$Q->row_array();
        endif;
		$Q->free_result();
		return $data;
	}
    
    function getRecordSelf($id){
		$data=array();
		$this->db->select('*');
		$this->db->join('josh_staff','josh_staff.no=social_status.staff_no');
		$this->db->where('staff_no',$this->input->xss_clean($id));
		$this->db->orderby('social_status.id','DESC');
		$Q=$this->db->get('social_status',1);
		if($Q->num_rows() > 0 ):
 	      $data=$Q->row_array();
        endif;
		$Q->free_result();
		return $data;
     }
        
    function updateStatus(){
		$data=array(
            'status_date'=> date("Y-m-d H:i:s"),
            'staff_no'	 => $this->input->xss_clean($_SESSION['no']),
            'content'	 => $this->input->xss_clean($_POST['content']),
            'status'     => 1 ,
           );
		$this->db->insert('social_status',$data);
	}
	
	function updateComment(){
		$data=array(
            'comment_date'=> date("Y-m-d H:i:s"),
            'staff_no'	  => $this->input->xss_clean($_SESSION['no']),
			'status_id'	  => $this->input->xss_clean($_POST['id_c']),
            'comment'	  => $this->input->xss_clean($_POST['comment']),
            'status'      => 1 ,
           );
		$this->db->insert('social_comment',$data);
	}
       
}


    
