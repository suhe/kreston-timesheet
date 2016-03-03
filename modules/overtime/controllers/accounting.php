<?php 
class Accounting extends Controller
{
    function Accounting()
    {
        parent::Controller();
        session_start();
        if  (isset($_SESSION['level'])<>'HRD')
             {
                redirect('login/user/index',301);
             }
        $this->load->model('Josh_time_report');
        $this->load->module_model('staff','Josh_staff');
        $this->load->module_model('job_desc','Josh_job');
        $this->load->module_model('holiday','Josh_holiday');
        $this->load->module_model('manager','Josh_manager');
        $this->load->helper('date');
		ini_set('max_execution_time',3600);
    }
    
    public function index() {
        $data['title']=" Overtime Report"; //title
		$data['date_from'] = $this->session->userdata('overtime.date_from');
		$data['date_to'] = $this->session->userdata('overtime.date_to');
		$data['client_name'] = $this->session->userdata('overtime.client_name');
        $data['records']=$this->Josh_time_report->selectPeriodeRecord($data['date_from'],$data['date_to'],$data['client_name']);
        $data['bind_client']   =   $this->Josh_job->selectBindJob('All Client'); 
		$data['module']='overtime';
        $data['main']='accounting/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function bulk_overtime(){
		$this->session->set_userdata('overtime.date_from',$this->input->post('year_from').'-'.$this->input->post('month_from').'-'.$this->input->post('day_from'));
		$this->session->set_userdata('overtime.date_to',$this->input->post('year_to').'-'.$this->input->post('month_to').'-'.$this->input->post('day_to'));
		
		$this->session->set_userdata('overtime.print_date_from',$this->input->post('day_from').'/'.$this->input->post('month_from').'/'.$this->input->post('year_from'));
		$this->session->set_userdata('overtime.print_date_to',$this->input->post('day_to').'/'.$this->input->post('month_to').'/'.$this->input->post('year_to'));
		
		$this->session->set_userdata('overtime.client_name',$this->input->post('client_name'));
		
		redirect('overtime/accounting/index',301);
	}
	
	function export_excel(){
        $date_from = $this->session->userdata('overtime.date_from');
		$date_to = $this->session->userdata('overtime.date_to');
		$client_name = $this->session->userdata('overtime.client_name');
		
		$print_date_from = $this->session->userdata('overtime.print_date_from');
		$print_date_to = $this->session->userdata('overtime.print_date_to');
		
        $records = $this->Josh_time_report->selectPeriodeRecord($date_from,$date_to,$client_name);
		$this->load->library('excel');
		set_time_limit(336000);   
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                    ->setDescription("description");
		$objPHPExcel->setActiveSheetIndex(0);
        
        $styleArray = array( 'borders' => array( 'allborders' => array(
                             'style' => Style_Border::BORDER_THIN )));
        $fill = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'CCCCCC'
      			),
      			'endcolor'   => array(
      				'argb' => 'CCCCCC'
      			)
      		);                     
		/*Data */
		$row=1;
		$col=0;
		
       /* Keterangan */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Overtime :');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$print_date_from.' To '.$print_date_to);		
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		$row++;
		/* Keterangan II */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Client Name Keyword  :');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$client_name);		
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		$row=$row+2;
                
		/* NIK */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(22);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Nama');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Salary');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Tanggal');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'X1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'X2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'X3');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'X4');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Meal');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
		$row=$row+1;
		
		foreach($records as $rec):
			/*  No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['no']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['salary']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec['overtime']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['x1']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec['x2']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec['x3']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['x4']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,number_format($rec['meal']));
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,number_format($rec['totalov'],2));
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
			
			$ov = $this->Josh_time_report->selectUserOvertimeAcc($date_from,$date_to,$client_name,$rec['no']);
			$row++;
		    foreach($ov as $v){
				/*  No */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
				
				/* Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$v['name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
			
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$v['date']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$v['over_time_app']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$v['x1']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$v['x2']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$v['x3']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$v['x4']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,number_format($v['meal']));
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,number_format($v['totalov'],2));
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
				$row++;
			}
			
			$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="./assets/overtime.xls";
		$objWriter->save($file);
		redirect($file,301);
	}
	
	public function export_excel11() {
		$this->load->helper('export');
		$sql = " SELECT js.no,js.name,FORMAT(@s:=js.sal_bas/173,2) AS salary,
				 SUM(jddt.over_time_app) AS overtime,
				 SUM(jddt.x1) AS x1,
				 SUM(jddt.x2) AS x2,
				 SUM(jddt.x3) AS x3,
				 SUM(jddt.x4) AS x4,
				 SUM(jddt.meal) * 10000 as meal,
				(@s*SUM(x1)*1)+(@s*SUM(x2)*2)+(@s*SUM(x3)*3)+(@s*SUM(x4)*4)+(SUM(meal) * 10000) AS totalov,
				 SUM(transport_chf) as OPE 	
				 FROM josh_details_day_tr jddt
				 INNER JOIN josh_staff js ON js.no = SUBSTR(jddt.tr_code,4,5)
				 WHERE SUBSTR(jddt.tr_code,10,8)='".$this->session->userdata('bulk_periode')."'
				 GROUP BY js.no
				 ORDER BY js.no;
		"; 
		$query=$this->db->query($sql);
        to_excel($query,'OVERTIME'); 
	}
	
}