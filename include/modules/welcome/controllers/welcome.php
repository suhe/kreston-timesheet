<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
        
	}
	
	function index()
	{
		//$this->load->module_view('welcome','welcome_message'); 
		$this->load->template('default');
	}
       
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */