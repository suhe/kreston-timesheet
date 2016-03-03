<?php
class Josh_staff extends Model {
    
	function Josh_staff(){
		parent::Model();
	}
    
	function selectRecords($id){
        $data=array();
        $this->db->select('*');
        $this->db->join('josh_position','josh_position.code=josh_staff.pos_code');	
        $this->db->where('no',$_SESSION['no']);
        $this->db->orderby('no','ASC');
		$Q=$this->db->get('josh_staff');
        if($Q->num_rows()>0):
            foreach ($Q->result_array() as $row): 
                $data[]=$row;
            endforeach;   
        endif;
		$Q->free_result();
		return $data;
    }
    
    function getRecord(){
		$data=array();
		$this->db->where('no',$this->input->xss_clean($_SESSION['no']));
		$Q=$this->db->get('josh_staff');
		if($Q->num_rows() > 0 ):
			  	$data=$Q->row_array();
        endif;
		$Q->free_result();
		return $data;
     }
        
    function updateSet(){
        $data=array('name'      =>  $this->input->xss_clean($_POST['name']),
                    'nickname'  =>  $this->input->xss_clean($_POST['nickname']),
                    'email'     =>  $this->input->xss_clean($_POST['email']),
                    'birthday'  =>  $this->input->xss_clean($_POST['year']).'-'.$this->input->xss_clean($_POST['month'].'-'.$this->input->xss_clean($_POST['day'])),
                    'sex'       =>  $this->input->xss_clean($_POST['sex']),
                    'address'   =>  $this->input->xss_clean($_POST['address']),
                    'hp'        =>  $this->input->xss_clean($_POST['hp']),
                    'city'      =>  $this->input->xss_clean($_POST['city']),
                    'country'   =>  $this->input->xss_clean($_POST['country']));
        
       	
        $this->db->where('no',$this->input->xss_clean($_POST['no']));
		$this->db->update('josh_staff',$data);
	}
    
    function updateSetPassword()
    {
        $data=array();
        $Q=$this->db->query("select no from josh_staff WHERE no='$_SESSION[no]' AND password=MD5('$_POST[old_password]') limit 1 ");				
        if($Q->num_rows()< 1 )
		    {
		 	 $this->session->set_flashdata('message','<div class=" message errormessage">Error Update Your Password Is Wrong Can not Update !</div>');
		       redirect('home/user/password',301);
                }
        else
                {
                                $this->updateRecordNewPassword();
                }   
        $Q->free_result();
	  return $data;
    }
    
    function updateRecordNewPassword()
    {
		$data=array(
            'password'=>MD5($this->input->xss_clean($_POST['password']))
           );   
        
            $this->db->where('no',$this->input->xss_clean($_POST['no']));
		$this->db->update('josh_staff',$data);
    }	   
       
}