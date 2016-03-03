<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
        
	}
	
	function index()
	{
		
        
	}
    
    function test() 
    {
            $u = new Josh_staff;
            $u->no ='1121';
	        $u->name = 'rere2';
	       // $u->save();
	        echo "added 2 users";
              
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */