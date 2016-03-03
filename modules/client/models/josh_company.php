<?php
class Josh_company extends Model{

	function Josh_company(){
		parent::Model();
	}
    
	function selectRecords(){
		$data=array();
        $this->db->select('*');
        $this->db->where('scope',$_SESSION['division']);
        $this->db->orderby('code','ASC');
		$Q=$this->db->get('josh_company');
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
        $this->db->select('code');
		$this->db->where('code',$_POST['code']);
        $Q=$this->db->get('josh_company');
        if($Q->num_rows()> 0 ){
			   $this->session->set_flashdata('message','<div class=" message errormessage">This Staff='.$_POST['code'].' Is Already!</div>');
		       redirect('client/admin/add',301);
        } else {
                $this->saveTable(); }   
		$Q->free_result();
		return $data;
	}
    
    function saveTable(){
		$data=array(
            'code'      =>  $this->input->xss_clean($_POST['code']),
            'scope'     =>  $this->input->xss_clean($_SESSION['division']),
            'name'      =>  $this->input->xss_clean($_POST['name']),
            'company_cp'=>  $this->input->xss_clean($_POST['cp']),
            'email'     =>  $this->input->xss_clean($_POST['email']),
            'address'   =>  $this->input->xss_clean($_POST['address']),
			'tlp_1'     =>  $this->input->xss_clean($_POST['tlp_1']),
			'fax'       =>  $this->input->xss_clean($_POST['fax']),
            'city'      =>  $this->input->xss_clean($_POST['city']),
            'country'   =>  $this->input->xss_clean($_POST['country']),
			'transport' =>  $this->input->xss_clean($_POST['transport']),
            'sector'    =>  $this->input->xss_clean($_POST['sector'])
		); 
		$this->db->insert('josh_company',$data);
	}
    
    function getRecord($id)
	{
		$data=array();
		$this->db->where('code',$this->input->xss_clean($id));
		$Q=$this->db->get('josh_company');
		
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
            'code'      =>  $this->input->xss_clean($_POST['code']),
            'scope'     =>  $this->input->xss_clean($_SESSION['division']),
            'name'      =>  $this->input->xss_clean($_POST['name']),
            'company_cp'=>  $this->input->xss_clean($_POST['cp']),
            'email'     =>  $this->input->xss_clean($_POST['email']),
            'address'   =>  $this->input->xss_clean($_POST['address']),
			'tlp_1'     =>  $this->input->xss_clean($_POST['tlp_1']),
			'fax'       =>  $this->input->xss_clean($_POST['fax']),
            'city'      =>  $this->input->xss_clean($_POST['city']),
            'country'   =>  $this->input->xss_clean($_POST['country']),
			'transport' =>  $this->input->xss_clean($_POST['transport']),
            'sector'    =>  $this->input->xss_clean($_POST['sector'])
		); 
        $this->db->where('code',$this->input->xss_clean($_POST['code']));
		$this->db->update('josh_company',$data);
	}
    
    function deleteRecord($id){
        $this->db->where('code',$this->input->xss_clean($id));
        $this->db->delete('josh_company');
    }
    
}
    