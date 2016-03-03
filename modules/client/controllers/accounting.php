<?php
class Accounting extends Controller 
{
	function Accounting(){
		parent::Controller();
        session_start();
        if(($_SESSION['level'] == 'HRD') || ($_SESSION['level'] == 'P') ) {
			
        }
		else {
			redirect('login/user/index',301);
		}
        $this->load->model('Josh_company');
        $this->load->helper('date');
                 	
	}
    
    function index(){
        $data['title']="Manage Company Client";
        $data['records']=$this->Josh_company->selectRecords();
        $data['module']='client';
        $data['main']='accounting/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add(){
        $data['title']="Create A New Client";
        $data['module']='client';
        $data['main']='accounting/add';
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save(){ 
        $this->Josh_company->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('client/accounting/index',301); 
             		
	}
    
    function view($id=0){
        $data['title']      =   "Edit Profile Client"; 
        $data['records']    =   $this->Josh_company->getRecord($id);
        $data['code']       =   $data['records']['code'];
        $data['name']       =   $data['records']['name'];
        $data['cp']         =   $data['records']['company_cp'];
        $data['sector']     =   $data['records']['sector'];
        $data['email']      =   $data['records']['email'];
        $data['address']    =   $data['records']['address'];
		$data['tlp_1']      =   $data['records']['tlp_1'];
		$data['fax']        =   $data['records']['fax'];
		$data['transport']  =   $data['records']['transport'];
        $data['city']       =   $data['records']['city'];
        $data['country']    =   $data['records']['country'];
        $data['module']='client';
        $data['main']='accounting/edit';
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update(){ 
        $this->Josh_company->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('client/accounting/index',301);          		
	}
    
    function drop($id){
		$this->Josh_company->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('client/accounting/index',301);
	}
    
}    