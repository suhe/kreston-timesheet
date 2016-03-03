<?php

// system/application/models/user.php
class Josh_staff extends Doctrine_Record
{
        public function setTableDefinition() 
        {
            $this->hasColumn('no','string',255);
	        $this->hasColumn('name','string',255);
	    }	 
}