<?php

class Time_report extends Controller {

	function Time_report()
	{
		parent::Controller();
        
	}
	
	function index()
	{
		//$this->load->module_view('welcome','welcome_message');
		$data['module']='time_report';
        $data['main']='index';			
		$this->load->vars($data);
		$this->load->template('default');
	}
       
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */