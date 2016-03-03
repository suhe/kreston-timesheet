<?php 
class Hrd extends Controller
{
    function Hrd()
    {
        parent::Controller();
        session_start();
         if  ($_SESSION['level']<>'HRD') 
             {redirect('login/user/index',301);}
        $this->load->model('Josh_transport');
        $this->load->helper('date');
    }
    
    function index(){
        $data['title']="Transport Summary"; //database
        $data['records']=$this->Josh_transport->selectPeriode();
        //web system data 
        $data['module']='transport';
        $data['main']='hrd/index';
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function print_out($id){
        $data['title']=$id;
        $data['records']=$this->Josh_transport->getRecords($id);
        //template data
        $this->load->vars($data);
		$this->load->template('transp_summary');
    }
    
    
 }   