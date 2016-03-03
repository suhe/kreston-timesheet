<?php
class Hrd extends Controller 
{
	function Hrd()
	{
		parent::Controller();
        session_start();
         if  ($_SESSION['level']<>'HRD') 
             {
                redirect('login/user/index',301); }
        $this->load->model('Josh_summary');
        $this->load->helper('date');
                 	
	}
    
    function index(){
        //title
        $data['title']="Pool Summary";
        //database
        $data['records']=$this->Josh_summary->selectRecords();
        //web system data 
        $data['module']='polo';
        $data['main']='hrd/index';
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function print_out($id){
        $data['title']=$id;
        $data['id']=$id;
        $data['periode']=indo_tgl($id);
        $data['records']=$this->Josh_summary->getRecords($id);
        //$data['records']=$this->Josh_summary->getRecords($id);
        //template data
        $this->load->vars($data);
		$this->load->template('pool');
    }
	
	function export_excel($id){
		$this->load->plugin('to_excel');
		//$data['records']=$this->Josh_summary->getRecords($id);
		$sql =" SELECT jht.staff_no,jj.code,SUM(jddt.time)+ SUM(jddt.over_time_app) as time,SUM(jddt.transport_chf) as transp,jj.name,js.name as staff_name,js.nickname,";
		$sql.=" jht.pos_code,DATE_FORMAT(jht.periode,'%d %M %Y') as tr_periode ";
		$sql.=" FROM josh_details_day_tr jddt ";
		$sql.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code ";
		$sql.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
		$sql.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code ";
		$sql.=" JOIN josh_staff js ON js.no=jht.staff_no ";
			/*WHERE jdt.tr_code='TR-10002-05092010'*/
		$sql.="WHERE jht.periode='".$id."'";	
		$sql.="GROUP BY jddt.code ";
		$sql.="ORDER BY js.no ASC ";
		//$query=$data['records'];
		$query=$this->db->query($sql);
		to_excel($query,$id);
	}
	
/*$this->db->use_table('tablename');
$this->db->select('field1', 'field2');
$query = $this->db->get();
to_excel($query, ['namafile']); // nama file tidak wajib, bila tidak diisi akan menggunakan nama file default 'xlsoutput'
*/
	
    /*
    function print_time($id=0){
        $data['title']=$id;
        $data['id']=$id;
        $data['periode']=$this->input->post('day').'-'.$this->input->post('month').'-'.$this->input->post('year').' To '.$this->input->post('day2').'-'.$this->input->post('month2').'-'.$this->input->post('year2');
        $data['title']=$data['periode'];
        $data['group']=$this->Josh_summary->getGroup();
        //template data
        $this->load->vars($data);
		$this->load->template('summary_time');
    }
	*/
}    
