<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** PHPExcel */
/**
* 
*/
class Excel
{
    
    function __construct()
    {
        require_once APPPATH.'/libraries/PHPExcel.php';
        require_once APPPATH.'/libraries/PHPExcel/IOFactory.php';
    }
}  