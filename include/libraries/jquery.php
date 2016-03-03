<?php
class Jquery {
   function load(){
       echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/jquery/jquery.js"></script>';
	   echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/jquery.simplemodal.js"></script>';
       echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/confirm.js"></script>';
       echo '<link type="text/css" href="'.base_url().APPPATH.'libraries/form_modal/css/confirm.css" rel="stylesheet" media="screen" />';
   }
}
?>