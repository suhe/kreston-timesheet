<?php
class User extends Controller 
{
	function User()
	{
		parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) )
             { redirect('login/user/index',301); }
        //$this->load->module('staff');
        $this->load->model('Josh_job');
        $this->load->module_model('client','Josh_company');
        $this->load->helper('date');
                 	
	}
    
    function index()
    {
        //title
        $data['title']="Manage Job Desc";
        //database
        $data['records']=$this->Josh_job->selectUserRecords();
        
        //web system data 
        $data['module']='job_desc';
        $data['main']='user/index';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
  
            function export_excel($id=0) {
             $this->load->library("excel");
             $objPHPExcel = new PHPExcel();
             $objPHPExcel->getProperties()->setTitle("title")
                         ->setDescription("description");
             // Assign cell values
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
	  
	     $sql="SELECT * FROM josh_job "; 
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
$i++;
            endforeach; 		
           // Save it as an excel 2003 file
           $objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
           $file="activity_code.xls";
	   $objWriter->save($file);
           $this->index(); //CALL DISPLAY
	   redirect('/'.$file,301);
    }

}    
