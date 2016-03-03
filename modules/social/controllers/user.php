<?php
class User extends Controller
{
    function User()
    {
         parent::Controller();
         session_start(); 
         if (!ISSET($_SESSION['no'])){
                redirect('login/user/index',301);
         }      
		 $this->load->model('Josh_social'); 		 
         $this->load->helper('date');
    }
    
    function index(){
        $this->dashboard();    
    }
    
    function dashboard(){
        $data['title']      =     "My Status";
		$data['action']     =     site_url('social/user/saveStatus');
		$data['open']       =     site_url('social/user/saveComment');
		$data['user']       =     $this->Josh_social->getRecord($_SESSION['no']);
		$data['users']      =     $this->Josh_social->getRecordSelf($_SESSION['no']);
        $data['records']    =     $this->Josh_social->selectRecords();
        //$data['comments']   =     $this->Josh_social->selectRecordsComment();
        $data['module']     =     'social';
        $data['main']       =     'user/index';
        $this->load->vars($data);
		$this->load->template('default');
     }
	 
	 function saveStatus(){
		if($this->input->post('content')):
			$this->Josh_social->updateStatus();
			$this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        endif;
		redirect($this->input->server('HTTP_REFERER'),301);          		
     } 
	 
	 function saveComment(){
		if($this->input->post('comment')):
			$this->Josh_social->updateComment();
			$this->session->set_flashdata('message','<div class=" message success"> Update Comment !</div>');
        endif;
		redirect($this->input->server('HTTP_REFERER'),301);          		
     } 
    
}
