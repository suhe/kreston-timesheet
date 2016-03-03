<?php
class Accounting extends Controller {
	
    function Accounting(){
	  parent::Controller();
        session_start();
		$this->load->module_model('staff','Josh_staff');
		$this->load->module_model('salary','Josh_sallary');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('status','Josh_status');
        $this->load->helper('date');
        if ((isset($_SESSION['level'])=='ACC') OR (isset($_SESSION['level'])=='HRD')):
        else:
            redirect('login/user/index',301);
        endif;  
		ini_set('max_execution_time',3600);	
	}
	
	public function payroll_details() {
        $data['title']=" Employee Details Salary"; //title
		$data['date_from'] = $this->session->userdata('payroll_details.date_from');
		$data['date_to'] = $this->session->userdata('payroll_details.date_to');
		$data['staff_no'] = $this->session->userdata('payroll_details.staff_no');
        $data['records'] = $this->Josh_sallary->getEmployeePayroll($data['staff_no'],$data['date_from'],$data['date_to']);
        $data['bind_staff']   =   $this->Josh_sallary->selectBindEmployee(); 
		$data['module']='salary';
        $data['main']='accounting/employee';
		$data['table'] = "";
		//bind
		if($data['staff_no']) {
			$i=1;
			$x1=0;
			$x1_cost = 0;
			$x2=0;
			$x2_cost = 0;
			$x3=0;
			$x3_cost = 0;
			$x4=0;
			$x4_cost = 0;
			$meal = 0;
			$transport = 0;
			$total = 0;
			$total_app = 0;
			$salary = 0;
			$is_app = false;
			foreach( $data['records'] as $row) {
				if((($row['app_hrd']=='YES') || ($row['app_manager']=='yes')) && ($row['status_hrd']== 'approval')) {
					$total_app+=$row['total'];
					$is_app = true;
				} else {
					$is_app = false;
				}
				
				$data['table'] .= "<tr>";
				$data['table'] .= "<td>".$i."</td>";
				$data['table'] .= "<td>".$row['date']."</td>";
				$data['table'] .= "<td>".$row['job_name']."</td>";
				$data['table'] .= "<td>".strtoupper($row['type_job'])."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['x1']."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['x1_total'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['x2']."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['x2_total'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['x3']."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['x3_total'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['x4']."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['x4_total'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['meal'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['transport'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".strtoupper($row['app_manager'])."</td>";
				$data['table'] .= "<td style='text-align:right'>".strtoupper($row['app_hrd'])."</td>";
				$data['table'] .= "<td style='text-align:right'>".strtoupper($row['status_hrd'])."</td>";
				$data['table'] .= "<td style='text-align:right'>".(!$is_app ? '<s>'.number_format($row['total'],2).'</s>' : '<i>'.number_format($row['total'],2).'</i>')."</td>";
				$data['table'] .= "</tr>";
				$i++;
				$x1+=$row['x1'];
				$x1_cost+=$row['x1_total'];
				$x2+=$row['x2'];
				$x2_cost+=$row['x2_total'];
				$x3+=$row['x3'];
				$x3_cost+=$row['x3_total'];
				$x4+=$row['x4'];
				$x4_cost+=$row['x4_total'];
				$transport+=$row['transport'];
				$meal+=$row['meal'];
				$salary = $row['salary'];
				$total+=$row['total'];
				
				
					
			}
			
			//subtotal
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='4' style='text-align:right'>Total</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".$x1."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($x1_cost,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".$x2."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($x2_cost,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".$x3."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($x3_cost,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".$x4."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($x4_cost,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($meal,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($transport,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder' colspan='3'></td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($total,2)."</td>";
			$data['table'] .= "</tr>";
			
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='18' style='text-align:right;padding:15px 5px'></td>";
			$data['table'] .= "</tr>";
			
			
			//total by App
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='17' style='text-align:right'>Sub Total By Approved</td>";
			$data['table'] .= "<td style='text-align:right'>".number_format($total_app,2)."</td>";
			$data['table'] .= "</tr>";
			
			//salary
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='17' style='text-align:right'>Salary</td>";
			$data['table'] .= "<td style='text-align:right'>".number_format($salary,2)."</td>";
			$data['table'] .= "</tr>";
			
			//grand total
			$grandtotal = $salary + $total_app;
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='17' style='text-align:right'>Grand Total</td>";
			$data['table'] .= "<td style='text-align:right'>".number_format($grandtotal,2)."</td>";
			$data['table'] .= "</tr>";
		}
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function payroll_details_query() {
		$this->session->set_userdata('payroll_details.date_from',$this->input->post('year_from').'-'.$this->input->post('month_from').'-'.$this->input->post('day_from'));
		$this->session->set_userdata('payroll_details.date_to',$this->input->post('year_to').'-'.$this->input->post('month_to').'-'.$this->input->post('day_to'));
		$this->session->set_userdata('payroll_details.print_date_from',$this->input->post('day_from').'/'.$this->input->post('month_from').'/'.$this->input->post('year_from'));
		$this->session->set_userdata('payroll_details.print_date_to',$this->input->post('day_to').'/'.$this->input->post('month_to').'/'.$this->input->post('year_to'));
		$this->session->set_userdata('payroll_details.staff_no',$this->input->post('staff_no'));
		redirect('salary/accounting/payroll_details',301);    
	}
    
    function index(){  		
        $data['title']="Manage Payroll";
        $data['records']=$this->Josh_sallary->selectRecords();
        $data['module']='salary';
        $data['main']='accounting/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	function basic(){
        $this->index();
    }
    
    function add(){
        $data['title']  =   "View Staff";
        $data['records']=   $this->Josh_staff->selectRecords();
        $data['module'] =   'salary';
        $data['main']   =   'accounting/add';
        $this->load->vars($data);
		$this->load->template('default');  
    }
    
    function save(){ 
        $this->Josh_sallary->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('salary/accounting/index',301);      		
	}
    
    function view($id=0){
        $data['title']  =   $id; 
        $data['records']=   $this->Josh_sallary->getRecords($id);
        $data['module'] =   'salary';
        $data['main']   =   'accounting/edit';
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update(){ 
        $this->Josh_sallary->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('salary/accounting/index',301);          		
	}
    
	
    function drop($id){
		$this->Josh_sallary->deleteRecord($id);
        $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('salary/accounting/index',301);
	} 
    
    /*function payroll(){
        $data['title']="Manage Payroll";
        $data['records']=$this->Josh_sallary->selectRecords();
        $data['module']='salary';
        $data['main']='accounting/payroll';
        $this->load->vars($data);
		$this->load->template('default');
    }*/
	
	public function payroll() {
		$data['title']="Manage Payroll";
		$data['records'] = $this->Josh_sallary->getPayroll($this->session->userdata('payroll.periode'));
		$data['table'] = '';
		
		if($this->session->userdata('payroll.periode')) {
			foreach($data['records'] as $row) {
				$data['table'].= '<tr>';
				$data['table'].= '<td>'.$row['staff_no'].'</td>';
				$data['table'].= '<td>'.$row['staff_name'].'</td>';
				$data['table'].= '<td style="text-align:center">'.$row['pos_code'].'</td>';
				$data['table'].= '<td style="text-align:right">'.number_format($row['salary_20'],2).'</td>';
				
				
				$data['table'].= '<td style="text-align:right">'.number_format($row['overtime_05'],2).'</td>';
				$data['table'].= '<td style="text-align:right">'.number_format($row['reimbust_05'],2).'</td>';
				
				//$data['table'].= '<td style="text-align:right">'.number_format($row['salary_05'],2).'</td>';
				$data['table'].= '<td style="text-align:right">'.number_format($row['overtime_20'],2).'</td>';
				$data['table'].= '<td style="text-align:right">'.number_format($row['reimbust_20'],2).'</td>';
				$data['table'].= '<td style="text-align:right">'.number_format($row['total'],2).'</td>';
				$data['table'].= '</tr>';
			}
		}
		
		$data['module'] = 'salary';
		$data['main']='accounting/payroll';
        $this->load->vars($data);
		$this->load->template('default');
	}
	
	public function bulk_payroll() {
		$day_20_to = '20';
		$day_20_from = '06';
		$month_to = $this->input->post('month');
		$year_to = $this->input->post('year');
		
		$date_20_from = $year_to.'-'.$month_to.'-'.$day_20_from;
		$date_20_to = $year_to.'-'.$month_to.'-'.$day_20_to;
		
		$this->session->set_userdata('payroll.periode',$date_20_to);
		
		
		$day_05_from = '21';
		$day_05_to   = '05';
		
		if($month_to=='01')
		{
			$month2_to = number_format($month_to,0) + 11;
			$year2_to = $year_to - 1;
		}
		else
		{
			$month2_to = number_format($month_to,0) - 1;
			$year2_to = $year_to;
		}
		
		$date_05_from =  $year2_to.'-'.digitTwo($month2_to).'-'.$day_05_from;
		$date_05_to =  $year_to.'-'.digitTwo($month_to).'-'.$day_05_to;
		
		//delete salary
		$this->Josh_sallary->deletePayroll($date_20_to);
		
		//call employee
		$employees = $this->Josh_sallary->getEmployeeActive();
		
		foreach($employees as $employee) {
			
			$data['staff_no'] = $employee['no'];
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['staff_name'] = $employee['name'];
			$data['pos_code'] = $employee['pos_code'];
			$data['staff_date'] = $employee['staff_date'];
			$data['salary_05'] = $employee['sal_bas'];
			$data['salary_20'] = $employee['sal_bas'];
			$data['periode'] = $date_20_to;
			$outmeal = 10000;
			
			//perhitungan basic salary harian
			$salary_hour = $employee['sal_bas'] / 173;
			
			// perhitungan periode 20
			$row20 = $this->Josh_sallary->getSumTimeReport($employee['no'],$date_20_from,$date_20_to);
			if($row20) {
				$x1_total = ($row20['x1'] * 1.5) * $salary_hour;
				$x2_total = ($row20['x2'] * 2.0) * $salary_hour;
				$x3_total = ($row20['x3'] * 3.0) * $salary_hour;
				$x4_total = ($row20['x4'] * 4.0) * $salary_hour;
				$meal = $outmeal * $row20['meal'] ;
				$xtotal = $x1_total + $x2_total + $x3_total + $x4_total + $meal;
				$data['overtime_20'] = $xtotal?$xtotal:0;
				$data['reimbust_20'] = $row20['transport']?$row20['transport']:0;
			}
			
			// perhitungan periode 05
			$row05 = $this->Josh_sallary->getSumTimeReport($employee['no'],$date_05_from,$date_05_to);
			if($row05) {
				$x1_total = ($row05['x1'] * 1.5) * $salary_hour;
				$x2_total = ($row05['x2'] * 2.0) * $salary_hour;
				$x3_total = ($row05['x3'] * 3.0) * $salary_hour;
				$x4_total = ($row05['x4'] * 4.0) * $salary_hour;
				$meal = $outmeal * $row05['meal'] ;
				$xtotal = $x1_total + $x2_total + $x3_total + $x4_total + $meal;
				$data['overtime_05'] = $xtotal?$xtotal:0;
				$data['reimbust_05'] = $row05['transport']?$row05['transport']:0;
			}
			
			 $this->Josh_sallary->insertPayroll($data);
		}
		
		redirect('salary/accounting/payroll',301);
	}
	
	public function export_excel() {
		//set_time_limit(336000);
		$this->load->library('excel');
		$periode = $this->session->userdata('payroll.periode');
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("Payroll ".$periode)
                    ->setDescription("Payroll Kresto Indonesia Periode ".$periode);
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
		
        /* Periode */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Periode : '.indo_tgl($periode));
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col+11,$row);	
		$row = $row + 3;
        
		/* No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(4);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col,$row+1);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Nik */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(6);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+1,$row,$col+1,$row+1);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Nama Karyawan */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Nama Karyawan');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(33);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+2,$row,$col+2,$row+1);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Posisi */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(10);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+3,$row,$col+3,$row+1);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Tanggal masuk */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Tgl.Masuk');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(18);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+4,$row,$col+4,$row+1);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Gapok */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Gaji Pokok');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(13);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+5,$row,$col+5,$row+1);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		
		/* Gapok 2015/10/02 */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'Periode 05/'.substr($periode,5,2).'/'.substr($periode,0,4));
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+6,$row,$col+7,$row);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
        /* Abasen */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Periode 20/'.substr($periode,5,2).'/'.substr($periode,0,4));
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+8,$row,$col+9,$row);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Total */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(13);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+10,$row,$col+10,$row+1);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		$row++;
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		
		/* Salary 05 */
		/*$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Salary');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		*/
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'Overtime');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Reimbust');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		/* Salary 20*/
		/*$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Salary');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		*/
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Overtime');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Reimbust');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
		
        $payrolls = $this->Josh_sallary->getPayroll($this->session->userdata('payroll.periode'));
        
		$i = 1;
		$row++;
		foreach($payrolls as $rec)
		{
			/* No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$i);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* NIK */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['staff_no']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
			
			/* Nama Karyawan */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['staff_name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/* Posisi */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['pos_code']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			/* Tgl Masuk */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,indo_tgl($rec['staff_date']));
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			
			/* Salary 05 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['salary_20']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			
			/* Overtime 05 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec['overtime_05']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* Reimbust 05 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec['reimbust_05']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* Salary 20 */
			/*$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['salary_20']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			*/
			
			/* Overtime 20 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['overtime_20']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* Reimbust 20 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$rec['reimbust_20']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* Total 20 */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$rec['total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			$row++;
			$i++;
		}
		
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel2007");
		$file="Kreston-Employee-Payroll-".$periode.".xlsx";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
	}
    
    function staff($id=0){
	    $_SESSION['periode']=$id;
        $data['title']=$id;
		if(substr($id,8,2)==20):
			$data['printer1']= 'Y';
		else:
			$data['printer1']='N';
		endif;
        $data['records']=$this->Josh_sallary->selectRecordPayroll($id);
        $data['module']='salary';
        $data['main']='accounting/staff';
        $this->load->vars($data);
		$this->load->template('default'); 
    }
	
	function print_out($id=0){
        $_SESSION['periode']=$id;
        $data['title']=$id;
        $data['id']= $id;
        $data['group']=$this->Josh_sallary->selectRecordGroup();
        $data['module']='salary';
        $data['main']='accounting/staff';
        $this->load->vars($data);
		$this->load->template('salary'); 
    }
    
    function print_month()
    {
        $_SESSION['periode']=$this->input->post('month').' s/d '.$this->input->post('month2').' '.$this->input->post('year');
        $data['title']=$_SESSION['periode'];
        $data['id']= $_SESSION['periode'];
        $data['periode']= $_SESSION['periode'];
        //$data['salary']= $this->Josh_sallary->selectRecords();
        $data['group']=$this->Josh_sallary->selectRecordGroup();
        //$data['records']=$this->Josh_sallary->selectRecordPayroll($id);
        //web system data 
        switch($this->input->post('month')):
            case '01' : $bulan1="Januari";break;
            case '02' : $bulan1="Februari";break;
            case '03' : $bulan1="Maret";break;
            case '04' : $bulan1="April";break;
            case '05' : $bulan1="Mei";break;
            case '06' : $bulan1="Juni";break;
            case '07' : $bulan1="Juli";break;
            case '08' : $bulan1="Agustus";break;
            case '09' : $bulan1="September";break;
            case '10' : $bulan1="Oktober";break;
            case '11' : $bulan1="Nopember";break;
            case '12' : $bulan1="Desember";break;
        endswitch;
        
        switch($this->input->post('month2')):
            case '01' : $bulan2="Januari";break;
            case '02' : $bulan2="Februari";break;
            case '03' : $bulan2="Maret";break;
            case '04' : $bulan2="April";break;
            case '05' : $bulan2="Mei";break;
            case '06' : $bulan2="Juni";break;
            case '07' : $bulan2="Juli";break;
            case '08' : $bulan2="Agustus";break;
            case '09' : $bulan2="September";break;
            case '10' : $bulan2="Oktober";break;
            case '11' : $bulan2="Nopember";break;
            case '12' : $bulan2="Desember";break;
        endswitch;
        
        $data['bulan1']= $bulan1;
        $data['bulan2']= $bulan2;
        //$data['bindGroup']=$this->Josh_group->selectRecords();
        //$data['bindPos']=$this->Josh_status->selectRecords();
        $data['module']='salary';
        $data['main']='accounting/staff';
        //template data
        $this->load->vars($data);
		$this->load->template('salary-2-month'); 
    }
	
	function staff_check(){
        $data['title']="Manage Staff";
        $data['records']=$this->Josh_sallary->selectRecords();
        $data['module']='salary';
        $data['main']='accounting/staff_check';
        $this->load->vars($data);
		$this->load->template('default');
		
		if($this->input->post('export')):
		$this->load->library('excel');
		set_time_limit(3360);   
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
		
		/* Job Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Code');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Customer Name');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(45);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		$row=2;
		$col=0;
		
		/* Job Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'No');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Name');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(45);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Transport');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(20);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'x1');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(5);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'x2');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(5);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'x3');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(5);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'x4');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(5);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Total Lembur ');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(15);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        //$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		$sql =" SELECT ";
		$sql.=" jc.code as job_code,jc.name "; 
		$sql.=" FROM josh_details_day_tr jddt ";
		$sql.=" JOIN josh_details_tr jdt ON jdt.tr_code=jddt.tr_code ";
		$sql.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
                $sql.=" JOIN josh_company jc ON jc.code=jj.company_code ";  
		$sql.=" WHERE jddt.date >='".$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day')."' AND jddt.date<='".$this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2')."'";
	
$sql.=" GROUP BY jc.code ";
//0,20 | 20,30 | 50,40| 90,30 | 120,40 | 160,40 | 200,40
//0,5 | 5,5 | 10,10| 20,15 | 35,20 | 55,20 | 75,30
//$sql.=" LIMIT 0,5 ";
		$q=$this->db->query($sql);
		$rows = $q->result_array();
		
		$row=3;
		$col=0;
		foreach($rows as $rec):
			/* Job Code */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['job_code']);
			/* Job Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name']);
			$sql =" SELECT *,js.name as staff_name,SUM(jddt.transport_chf) as transport_chf, ";
			$sql.=" SUM(jddt.x1) as x1, ";
			$sql.=" SUM(jddt.x2) as x2, ";
			$sql.=" SUM(jddt.x3) as x3, ";
			$sql.=" SUM(jddt.x4) as x4, ";
			$sql.=" SUM(jddt.x1) + SUM(jddt.x4) + SUM(jddt.x3) + SUM(jddt.x2)  as xtotal ";
			$sql.=" FROM josh_head_tr jht  "; 
			$sql.=" JOIN josh_details_tr jdt ON jdt.tr_code=jht.tr_code ";
			$sql.=" JOIN josh_details_day_tr jddt ON jddt.tr_code=jdt.tr_code ";
			$sql.=" JOIN josh_staff js ON js.no=jht.staff_no ";
                        $sql.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
                        $sql.=" JOIN josh_company jc ON jc.code=jj.company_code "; 
			$sql.=" WHERE jddt.date >='".$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day')."' AND jddt.date<='".$this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2')."' AND jdt.day_code=jddt.code AND  js.pos_code<>'M' ";
			$sql.=" AND jc.code='".$rec['job_code']."'";
			$sql.=" GROUP BY jht.staff_no";
			
			$q=$this->db->query($sql);
			$rows2 = $q->result_array();
			$row=$row+1;
			$col=0;
			foreach($rows2 as $rec2):
				/* Cust Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec2['staff_no']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec2['staff_name']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec2['transport_chf']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec2['x1']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec2['x2']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec2['x3']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec2['x4']);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec2['xtotal']);
				$row++;	
			endforeach;
			$row++;
		endforeach;
		
		
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="pay_list.xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
		endif;
	}
    
    
    function print_user($periode,$staff)
    {
        $data['title']=$periode .','.$staff;
		//load staff
        $data['records']=$this->Josh_staff->getRecord($staff);
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['periode']=$periode;
		$orde05 = substr($periode,0,8).'05';
		$orde20 = substr($periode,0,8).'20';
		$data['order05']=$orde05;
		$data['order20']=$orde20;
		$this->db->where('periode',$orde05);
		$this->db->where('staff_no',$staff);
		$Q=$this->db->get('josh_head_tr',1);
		$rows=$Q->row_array();
		$data['tr_code']= $rows['tr_code'];
		
		$this->db->where('periode',$orde20);
		$this->db->where('staff_no',$staff);
		$Q=$this->db->get('josh_head_tr',1);
		$rows=$Q->row_array();
		$data['tr_code2']= $rows['tr_code'];





		
		//$data['records1']=$this->Josh_sallary->selectRecordUserPayroll($orde.'05',$staff);
        $data['records']=$this->Josh_sallary->selectRecordUserPayroll($periode,$staff);
        $this->load->vars($data);
		$this->load->template('basic_salary'); 
    }
    
	function print_excel($id){
        $periode1 ='2011-02-21';
        $periode2 ='2011-03-20';
        $year	  = substr($id,0,4);
        $month    = substr($id,5,2);
        $day      = substr($id,8,2);
        
		$month_   = number_format($month,0)-1;
        $day_     = number_format($day,0)+1;
		
		if($month_<= 9):
			$month_='0'.$month_;
		else:
			$month_=$month_;
		endif;	
		
		$periode1 = $year.'-'.$month_.'-'.$day_;
		$periode2 = $year.'-'.$month.'-'.$day;
	
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
		
                /* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Periode');
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($periode2));		
                //$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		$row=$row+2;
                
		/* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Staff No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Staff Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Basic Salary');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Days Att,nd');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'U.Makan+U.Transport');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'Reimbush');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Uang Lembur');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(5);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Tunj.Jabatan');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Tunj.AK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'Adjustment');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+11)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill);
		
		$sql =" SELECT ";
		$sql.=" js.no,js.name,js.pos_code,";
		$sql.=" (SELECT SUM(jsl.basic_salary) FROM josh_salary jsl WHERE jsl.per_salary='$periode2' AND jsl.staff_no=js.no ) AS salary,";
		$sql.=" (SELECT COUNT(DISTINCT(jddt.date)) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no AND jddt.code NOT LIKE '%NC1001%' AND jddt.code NOT LIKE '%NC1002%' ) AS day_at, ";
		$sql.=" (SELECT COUNT(DISTINCT(jddt.date)) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no AND jddt.code NOT LIKE '%NC1001%' AND jddt.code NOT LIKE '%NC1002%' ) * jsy.transport_salary AS transport, ";
		$sql.=" (SELECT SUM(jddt.transport_chf) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no AND type_job='chf') AS reimbush,";
		$sql.=" ROUND((SELECT SUM(jddt.x1) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no) * 1.5 * (jsy.basic_salary/173),2) AS x1,";
		$sql.=" ROUND((SELECT SUM(jddt.x2) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no) * 2.0 * (jsy.basic_salary/173),2) AS x2,";
		$sql.=" ROUND((SELECT SUM(jddt.x3) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no) * 3.0 * (jsy.basic_salary/173),2) AS x3,";
		$sql.=" ROUND((SELECT SUM(jddt.x4) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no) * 4.0 * (jsy.basic_salary/173),2) AS x4,";
		$sql.=" ROUND((SELECT SUM(jddt.meal) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='$periode1' AND jht.periode <='$periode2'  AND jht.staff_no=js.no) * (jsy.ot_salary),2) AS ot,";
		$sql.=" (SELECT SUM(jsl.allowance) FROM josh_salary jsl WHERE jsl.per_salary='$periode2' AND jsl.staff_no=js.no ) AS allow_1, ";
		$sql.=" (SELECT SUM(jsl.allowance_2) FROM josh_salary jsl WHERE jsl.per_salary='$periode2' AND jsl.staff_no=js.no ) AS allow_2, ";
		$sql.=" (SELECT SUM(jsl.adjust) FROM josh_salary jsl WHERE jsl.per_salary='$periode2' AND jsl.staff_no=js.no ) AS adjust ";
		$sql.=" FROM josh_staff  js ";
		$sql.=" JOIN josh_salary jsy ON jsy.staff_no=js.no ";
		$sql.=" WHERE ";
		$sql.=" js.status='active' AND ";
		$sql.=" js.no < '11000' AND ";
		$sql.=" js.pos_code <>'HRD' AND ";
		$sql.=" jsy.per_salary='$periode2' ";
		$sql.=" ORDER BY js.no ASC ";
		$Q=$this->db->query($sql);
        $records=$Q->result_array();
		$row=$row+1;
		foreach($records as $rec):
		/* Staff No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['no']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
    
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['pos_code']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		
		/* Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['salary']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        
		/* Day Attended */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec['day_at']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
       
		/* Transport */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['transport']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec['reimbush']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
       
		/* Overtime + Meal */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$over=$rec['x1']+$rec['x2']+$rec['x3']+$rec['x4']+$rec['ot']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        
		/* Position Allowance */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$x2= $rec['allow_1']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        
		/* AK Allowance */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$x3= $rec['allow_2']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        
		/* Adjustment */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$rec['adjust']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        
		 /* Total Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$rec['salary']+$rec['transport']+$rec['reimbush']+$over+$rec['allow_1']+$rec['allow_2']+$rec['adjust']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
      
		$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="payroll_list.xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
	}
    
    
    function month($id){
        $year	  = substr($id,0,4);
        $month    = substr($id,5,2);
        $day      = substr($id,8,2);
        
		$month_   = number_format($month,0)-1;
        $day_     = number_format($day,0)+1;
		
		if($month_<= 9):
			$month_='0'.$month_;
		else:
			$month_=$month_;
		endif;	
		
		$periode1 		= $year.'-'.$month_.'-'.$day_; // 2011-09-21
		$periode2 		= $year.'-'.$month.'-'.$day; // 2011-10-20
		$periode3 		= $year.'-'.$month_.'-'.$day; // 2011-09-20
		$endperiode		= $year.'-'.$month_.'-'.'31';   // 2011-09-31
		$startperiode	= $year.'-'.$month.'-'.'01';   // 2011-10-01
	
		$periode21= $year.'-'.$month_.'-'.$day_;
		$periode30= $year.'-'.$month_.'-'.'31';
		$periode01= $year.'-'.$month.'-'.'01'; 
		$periode20= $year.'-'.$month.'-'.$day;
		
	
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
		
        /* Periode */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Periode');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($periode2));		
		$row=$row+2;
                
		/* Nik */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Nama Karyawan */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Nama Karyawan');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Posisi */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Tanggal masuk */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Tgl.Masuk');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(12);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		
		/* Gapok */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Gapok');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
        /* Abasen */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Absen(hari)');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'Reimbush');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		
		/* Uang Lembur Bulan I */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Lembur ke-'.$month_);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
        /* Uang Lembur Bulan II */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Lembur ke-'.$month);
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Total Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
        /* Keterangan Approval */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'Status');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
        $sql =" SELECT ";
		$sql.=" js.no,js.name,js.pos_code,DATE_FORMAT(js.staff_date,'%d-%m-%Y') as staff_date,MONTH(js.staff_date) as month_salary,MONTH(CURDATE()) as month_now,YEAR(js.staff_date) as year_salary,YEAR(CURDATE()) as year_now,";
		$sql.=" (SELECT SUM(jsl.basic_salary) FROM josh_salary jsl WHERE jsl.per_salary='".$periode20."' AND jsl.staff_no=js.no ) AS salary,";
		
		$sql.=" (SELECT COUNT(DISTINCT(jddt.date)) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode20."'  AND jht.staff_no=js.no AND jddt.code NOT LIKE '%NC1001%' AND jddt.code NOT LIKE '%NC1002%' ) AS day_at, ";
        $sql.=" (SELECT SUM(jddt.transport_chf) FROM josh_details_day_tr jddt JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode1."' AND jht.periode <='".$periode2."'  AND jht.staff_no=js.no AND type_job='chf') AS reimbush,";
		
        $sql.=" (SELECT SUM(jddt.x1 * 1.5) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode30."' AND jht.staff_no=js.no) AS x1_m,";
        $sql.=" (SELECT SUM(jddt.x1 * 1.5) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode01."' AND jddt.date <='".$periode20."' AND jht.staff_no=js.no) AS x1_a,";
		
        $sql.=" (SELECT SUM(jddt.x2 * 2) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode30."'  AND jht.staff_no=js.no)  AS x2_m,";
		$sql.=" (SELECT SUM(jddt.x2 * 2) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode01."' AND jddt.date <='".$periode20."'  AND jht.staff_no=js.no)  AS x2_a,";

        $sql.=" (SELECT SUM(jddt.x3 * 3) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode30."'  AND jht.staff_no=js.no) AS x3_m,";
		$sql.=" (SELECT SUM(jddt.x3 * 3) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode01."' AND jddt.date <='".$periode20."'  AND jht.staff_no=js.no) AS x3_a,";

        $sql.=" (SELECT SUM(jddt.x4 * 4) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode30."'  AND jht.staff_no=js.no) AS x4_m,";
		$sql.=" (SELECT SUM(jddt.x4 * 4) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode01."' AND jddt.date <='".$periode20."'  AND jht.staff_no=js.no) AS x4_a,";


        $sql.=" (SELECT SUM(jddt.meal) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode21."' AND jddt.date <='".$periode30."'  AND jht.staff_no=js.no) * (jsy.ot_salary) AS ot,";
        $sql.=" (SELECT SUM(jddt.meal) FROM josh_details_day_tr jddt INNER JOIN josh_head_tr jht ON jht.tr_code=jddt.tr_code WHERE jddt.date >='".$periode01."' AND jddt.date <='".$periode20."'  AND jht.staff_no=js.no) * (jsy.ot_salary) AS ot2";
        
		$sql.=" FROM josh_staff  js ";
        $sql.=" INNER JOIN josh_salary jsy ON jsy.staff_no=js.no ";
		$sql.=" WHERE ";
		$sql.=" js.status='active' AND ";
		$sql.=" js.no < '12000' AND ";
		$sql.=" js.pos_code <>'HRD' AND ";
		$sql.=" jsy.per_salary='".$periode20."' ";
		$sql.=" ORDER BY js.no ASC LIMIT 200 ";
		
		$Q=$this->db->query($sql);
        $records=$Q->result_array();
		$Q->free_result();
        
        
        
		$row=$row+1;
        $month=31;
        $day=11;
        $day2=20;
        $koef1=61.38;
        $koef2=111.62;
		$koef=173;
        $total_day=(11/31);
        $total_day2=(20/31);
		foreach($records as $rec):
		
        $xsql=  " SELECT staff_no ";
        $xsql.= " FROM josh_head_tr ";
        $xsql.= " WHERE status_hrd='approval' AND staff_no='".$rec['no']."' AND periode='".$periode20."' ";
        $NX=$this->db->query($xsql);
        $N=COUNT($NX->row_array());
        
		/* NIK */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['no']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		
		/* Nama Karyawan */
		if(($rec['month_salary']==$rec['month_now']) && ($rec['year_salary']==$rec['year_now'])){
			$desc=' (Kary.Baru)';
		}
		else{
			$desc= '';
		}
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name'].$desc);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		
		/* Posisi */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['pos_code']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		
		/* Tgl Masuk */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['staff_date']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		
		
		/* Salary */
		if(($rec['month_salary']==$rec['month_now']) && ($rec['year_salary']==$rec['year_now'])){
			$salary  = $rec['salary'];
			$salary_ = ((31 - substr($rec['staff_date'],0,2))/30) * $salary ;
		}
		else{
			$salary  = $rec['salary'];
			$salary_ = $salary;
		}
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$salary_);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        
      
       /* Day Attended */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$day=$rec['day_at']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
       
		
		/* Reimbust */
        if($N>0)
            $reimbush = $rec['reimbush'];
        else
            $reimbush = 0;    
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$reimbush);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
       
		/* Overtime + Meal Bulan I */
        if($N>0)
            $over =($rec['x1_m'] * ($salary/$koef) ) + ($rec['x2_m']* ($salary/$koef) ) + ($rec['x3_m'] * ($salary/$koef))+($rec['x4_m'] * ($salary/$koef))+$rec['ot'];
        else
            $over = 0;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$over);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        
       /* Overtime + Meal Bulan II */
        if($N>0)
            $over2 = ($rec['x1_a'] * ($salary/$koef) ) + ($rec['x2_a']* ($salary/$koef) ) + ($rec['x3_a'] * ($salary/$koef))+($rec['x4_a'] * ($salary/$koef))+$rec['ot2'];
        else
            $over2 = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$over2);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        
		 /* Total Salary */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$salary_+$over+$over2+$reimbush);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        
         /* Keterangan */
        if($N>0)
            $status = 'Aprroval';
        else
            $status = '-';
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$status);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
            
            
		$row=$row+1;
		endforeach;
		
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="payroll_".$periode20.".xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
	}
}    
