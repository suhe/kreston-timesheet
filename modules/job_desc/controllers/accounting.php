<?php
class Accounting extends Controller {
	function Accounting(){
		parent::Controller();
         session_start();
         if( (isset($_SESSION['level'])== 'M') OR (isset($_SESSION['level'])== 'ACC') OR (isset($_SESSION['level'])== 'HRD')  ){
         }
         else {
                redirect('login/user/index',301);
         }    
        $this->load->module_model('staff','Josh_staff');
        $this->load->model('Josh_job');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('client','Josh_company');
        $this->load->helper('date');            	
	}
    
    function index(){
        $data['title']          =   "Manage Job Setup";
        $data['records']        =   $this->Josh_job->selectRecords();
        $data['module']         =   'job_desc';
        $data['main']           =   'accounting/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function add(){
        $data['title']          =   "Create A New Job Setup";
        $data['bindGroup']      =   $this->Josh_group->selectRecords();
        $data['module']         =   'job_desc';
        $data['main']           =   'accounting/add';
		$data['bindGroup']      =   $this->Josh_group->selectRecords();
        $data['bind']           =   $this->Josh_company->selectRecords();
        $data['bind2']          =   $this->Josh_staff->selectRecords();  
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save(){ 
        if($_SESSION['division']=='Kuningan'):
            $code = $this->input->xss_clean($_POST['code']).$this->input->xss_clean($_POST['job']).$this->input->xss_clean($_POST['month']).$this->input->xss_clean(substr($_POST['year'],2,2));
        else:
            $code = $_POST['job_code'];
        endif;
        if($this->Josh_job->numRecord($code)> 0 ):
            $this->session->set_flashdata('message','<div class=" message error"> Duplicate Cdoe !</div>');
        else:
            $this->Josh_job->saveTable();
            $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        endif;
        redirect('job_desc/accounting/index',301);      		
	}
    
    function view($id=0){
        $data['title']          =   "Edit Job Desc"; 
        $data['records']        =   $this->Josh_job->getRecord($id);
        $data['code']           =   $data['records']['code'];
        $data['name']           =   $data['records']['name'];
        $data['remarks']        =   $data['records']['remarks'];
        $data['description']    =   $data['records']['description'];
        $data['check']          =   $data['records']['check'];
        $data['group_id']       =   $data['records']['group_id'];
        $data['group_name']     =   $data['records']['group_name'];
        $data['sp']             =   $data['records']['SP'];
        $data['pc']             =   $data['records']['PC'];
        $data['sm']             =   $data['records']['SM'];
        $data['m']              =   $data['records']['M'];
        $data['am']             =   $data['records']['AM'];
        $data['s2']             =   $data['records']['S2'];
        $data['s1']             =   $data['records']['S1'];
        $data['as']             =   $data['records']['AS'];
        $data['ta']             =   $data['records']['TA'];
        $data['sp_time']        =   $data['records']['SP_time'];
        $data['pc_time']        =   $data['records']['PC_time'];
        $data['sm_time']        =   $data['records']['SM_time'];
        $data['m_time']         =   $data['records']['M_time'];
        $data['am_time']        =   $data['records']['AM_time'];
        $data['s2_time']        =   $data['records']['S2_time'];
        $data['s1_time']        =   $data['records']['S1_time'];
        $data['as_time']        =   $data['records']['AS_time'];
        $data['ta_time']        =   $data['records']['TA_time'];
        $data['hrd']            =   $data['records']['HRD'];
        $data['hrd_name']       =   $data['records']['HRD_name'];
        $data['partner']        =   $data['records']['Partner'];
        $data['partner_name']   =   $data['records']['Partner_name'];
		$data['partner2']       =   $data['records']['Partner2'];
        $data['partner2_name']  =   $data['records']['Partner2_name'];
        $data['sn_manager']     =   $data['records']['Senior_Manager'];
        $data['sn_manager_name']=   $data['records']['Senior_Manager_name'];
        $data['manager']        =   $data['records']['Manager'];
        $data['manager_name']   =   $data['records']['Manager_name'];
        $data['ass_manager']    =   $data['records']['Ass_Manager'];
        $data['ass_manager_name']=  $data['records']['Ass_Manager_name'];
		$data['senior2']        =   $data['records']['Senior2'];
        $data['senior2_name']   =   $data['records']['Senior2_name'];
        $data['senior']         =   $data['records']['Senior'];
        $data['senior_name']    =   $data['records']['Senior_name'];
		$data['ass_senior']     =   $data['records']['Ass_Senior'];
        $data['ass_senior_name']=   $data['records']['Ass_Senior_name'];
		$data['tech_ass']     	=   $data['records']['Tech_Ass'];
        $data['tech_ass_name']	=   $data['records']['Tech_Ass_name'];
		
        /*approval*/
        $data['approval']       =   $data['records']['approve_charge'];
        $data['s1']             =   $data['records']['S1'];
        $data['as']             =   $data['records']['AS'];
        $data['ta']             =   $data['records']['TA'];
		$data['note']			=   $data['records']['note'];
        $data['bindGroup']      =   $this->Josh_group->selectRecords();
        $data['bind2']          =   $this->Josh_staff->selectRecords(); 
        $data['module']         =   'job_desc';
        $data['main']           =   'accounting/edit';
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update(){ 
        $this->Josh_job->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update  Succesfully !</div>'); 
        redirect($this->input->server('HTTP_REFERER'),301);         		
	}
    
    function status_active($id){
        $this->Josh_job->active($id);
        $this->session->set_flashdata('message','<div class=" message success"> Update Status Active Succesfully !</div>');
        redirect('job_desc/accounting/index',301); 
    }
    
    function status_deactive($id){
        $this->Josh_job->deactive($id);
        $this->session->set_flashdata('message','<div class=" message success"> Update Status Active Succesfully !</div>');
        redirect('job_desc/accounting/index',301); 
    }
    
    function drop($id)
	{
		$this->Josh_job->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('job_desc/accounting/index',301);
	}
   
   function export_excel($id=0) {
        $this->load->library("excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                    ->setDescription("description");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue("A1", "ACTIVITY CODE");
        $objPHPExcel->getActiveSheet()->setCellValue("B1", "CLIENT NAME");
        $objPHPExcel->getActiveSheet()->setCellValue("C1", "BHR-SP");
        $objPHPExcel->getActiveSheet()->setCellValue("D1", "BHR-PIC");
        $objPHPExcel->getActiveSheet()->setCellValue("E1", "BHR-SM");
        $objPHPExcel->getActiveSheet()->setCellValue("F1", "BHR-M");
        $objPHPExcel->getActiveSheet()->setCellValue("G1", "BHR-AM");
        $objPHPExcel->getActiveSheet()->setCellValue("H1", "BHR-S2");
        $objPHPExcel->getActiveSheet()->setCellValue("I1", "BHR-S1");
        $objPHPExcel->getActiveSheet()->setCellValue("J1", "BHR-AS");
        $objPHPExcel->getActiveSheet()->setCellValue("K1", "BHR-TA");
        $objPHPExcel->getActiveSheet()->setCellValue("L1", "BHR-HR");
        $objPHPExcel->getActiveSheet()->setCellValue("M1", "TB-RP");
        $objPHPExcel->getActiveSheet()->setCellValue("N1", "Approved Fee");
        $objPHPExcel->getActiveSheet()->setCellValue("O1", "Group");
        $objPHPExcel->getActiveSheet()->setCellValue("P1", "Status Client");
        $objPHPExcel->getActiveSheet()->setCellValue("Q1", "Status Job");	     

        $sql=  " SELECT * FROM josh_job jb ";
        $sql.= " LEFT JOIN josh_group jg ON jg.group_id=jb.gr_id ";
        $q=$this->db->query($sql);
        $rows=$q->result_array();
        $i=2;
        
        foreach($rows as $row):
            $objPHPExcel->getActiveSheet()->setCellValue("A".$i,$row['code']);
            $objPHPExcel->getActiveSheet()->setCellValue("B".$i,$row['name']);
            $objPHPExcel->getActiveSheet()->setCellValue("C".$i,$row['SP_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("D".$i,$row['PC_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("E".$i,$row['SM_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("F".$i,$row['M_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("G".$i,$row['AM_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("H".$i,$row['S2_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("I".$i,$row['S1_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("J".$i,$row['AS_time']);
            $objPHPExcel->getActiveSheet()->setCellValue("K".$i,$row['TA_time']);
            $total=$row['SP_time']+$row['PC_time']+$row['SM_time']+$row['M_time']+$row['AM_time']+$row['S2_time']+$row['S1_time']+$row['AS_time']+$row['TA_time'];  
            $objPHPExcel->getActiveSheet()->setCellValue("L".$i,number_format($total,0));
            $budget=($row['SP_time'] * $row['SP']) + ($row['PC_time'] * $row['PC'])+($row['SM_time'] * $row['SM'])+($row['M_time'] * $row['M'])+($row['AM_time'] * $row['AM'])+($row['S2_time'] * $row['S2'])+($row['S1_time'] * $row['S1'])+($row['AS_time'] * $row['AS']) + ($row['TA_time'] * $row['TA']);
            $objPHPExcel->getActiveSheet()->setCellValue("M".$i,number_format($budget,2)); 
            $objPHPExcel->getActiveSheet()->setCellValue("N".$i,$row['approve_charge']);
            $objPHPExcel->getActiveSheet()->setCellValue("O".$i,$row['group_name']);
            $objPHPExcel->getActiveSheet()->setCellValue("P".$i,$row['status_job']);
            $objPHPExcel->getActiveSheet()->setCellValue("Q".$i,$row['check']);     		
            $i++;
        endforeach; 		
        $objWriter = IOFactory::createWriter($objPHPExcel, "Excel5"); /* Save it as an excel 2003 file*/
        $file="assets/excel/activity_code.xls";
        $objWriter->save($file);
        $this->index();
        redirect('/'.$file,301);
    }
    
}    
