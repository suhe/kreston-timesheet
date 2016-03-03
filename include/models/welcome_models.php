<?php

// system/application/models/user.php
class welcome_models extends Doctrine_Record
{
        public function setTableDefinition() 
        {
	        //$this->hasColumn('code', 'string', 255);
	        $this->hasColumn('name', 'string', 255);
	    }	 
}