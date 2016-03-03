<?php
class Login extends Model{
	function Login(){
		parent::Model();
	}
    
    function verifyUser($u,$pw){
        $this->db->select('no,name,pos_code,name_p,division,group_id,order,signature');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code','INNER');
        $this->db->where('no',$this->input->xss_clean($u));
        $this->db->where('password',MD5($this->input->xss_clean($pw)));
        $this->db->where('status','active');
        $this->db->limit(1);
        $this->db->protect_identifiers("josh_staff");
        $Q=$this->db->get('josh_staff');
        if($Q->num_rows()>0):
            $row=$Q->row_array();
            return $row;
        else:
            return  array(); 
	    endif;   
    } 

	function searchManager($group){
		$sql = " SELECT no FROM josh_staff WHERE group_id = $group AND pos_code='M' AND status='active' ";
		$Q=$this->db->query($sql);
		
		if($Q->num_rows() > 0) {
			$row=$Q->row_array();
			return $row;
		}
		
		return false;
	}	
    
}        
