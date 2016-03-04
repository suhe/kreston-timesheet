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
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getNumberFormat()->setFormatCode('#,##.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec['overtime']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['x1']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec['x2']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec['x3']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['x4']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$rec['meal']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getNumberFormat()->setFormatCode('#,##.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$rec['totalov']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##.00');
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
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$v['x1']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$v['x2']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$v['x3']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$v['x4']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$v['meal']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getNumberFormat()->setFormatCode('#,##.00');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$v['totalov']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##.00');
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
	
	
	public function client() {
		$data['title']="Report overtime by client";
		$data['client_name'] = $this->session->userdata('overtime.client.name');
		$data['date_from'] = $this->session->userdata('overtime.client.date_from') ? $this->session->userdata('overtime.client.date_from') : "2009-01-01";
		$data['date_to'] = $this->session->userdata('overtime.client.date_to') ? $this->session->userdata('overtime.client.date_to') : "2009-01-01";
		$data['master'] = $this->Josh_time_report->getClientByProject($data['client_name'],$data['date_from'],$data['date_to']);
		$table = '';
		if($data['master']){
			foreach($data['master'] as $mst){
				$table.='<tr>';
				$table.='<td>'.$mst['code'].'</td>';
				$table.='<td colspan="9">'.$mst['name'].'</td>';
				$table.='<td>'.$mst['city'].'</td>';
				$table.='<td>'.$mst['country'].'</td>';
				$table.='</tr>';
				
				$data['details'] = $this->Josh_time_report->getOvertimeHourByEmployee($mst['code'],$data['date_from'],$data['date_to']);
				if($data['details']) {
					$ot = 0;
					$x1 = 0;
					$x2 = 0;
					$x3 = 0;
					$x4 = 0;
					$meal = 0;
					$cost = 0;
					foreach ($data['details'] as $dt) {
						$ot+=$dt['overtime'];
						$x1+=$dt['x1'];
						$x2+=$dt['x2'];
						$x3+=$dt['x3'];
						$x4+=$dt['x4'];
						$meal+=$dt['meal'];
						$cost+=$dt['cost'];
						$table.='<tr>';
						$table.='<td>'.$dt['date'].'</td>';
						$table.='<td>'.$dt['day_name'].'</td>';
						$table.='<td>'.$dt['staff_no'].'</td>';
						$table.='<td>'.$dt['staff_name'].'</td>';
						$table.='<td>'.$dt['pos_code'].'</td>';
						$table.='<td style="text-align:right">'.$dt['overtime'].'</td>';
						$table.='<td style="text-align:right">'.$dt['x1'].'</td>';
						$table.='<td style="text-align:right">'.$dt['x2'].'</td>';
						$table.='<td style="text-align:right">'.$dt['x3'].'</td>';
						$table.='<td style="text-align:right">'.$dt['x4'].'</td>';
						$table.='<td style="text-align:right">'.number_format($dt['meal'],2).'</td>';
						$table.='<td style="text-align:right">'.number_format($dt['cost'],2).'</td>';
						$table.='</tr>';
					}
					
					//subtotal
					$table.='<tr>';
					$table.='<td colspan="5" style="text-align:right">Subtotal</td>';
					$table.='<td style="text-align:right">'.number_format($ot,0).'</td>';
					$table.='<td style="text-align:right">'.number_format($x1,0).'</td>';
					$table.='<td style="text-align:right">'.number_format($x2,0).'</td>';
					$table.='<td style="text-align:right">'.number_format($x3,0).'</td>';
					$table.='<td style="text-align:right">'.number_format($x4,0).'</td>';
					$table.='<td style="text-align:right">'.number_format($meal,2).'</td>';
					$table.='<td style="text-align:right">'.number_format($cost,2).'</td>';
					$table.='</tr>';
					
					//empty
					$table.='<tr>';
					$table.='<td colspan="12" style="padding:10px"></td>';
					$table.='</tr>';
					
				}
				
			}
		}
		$data['module']='overtime';
		$data['bind_client']   =   $this->Josh_job->selectBindJob('All Client'); 	
		$data['main']='accounting/client';
		$data['table'] =$table;
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function bulk_client() {
		$this->session->set_userdata('overtime.client.name',$this->input->post('client_name'));
		$this->session->set_userdata('overtime.client.date_from',$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'));
		$this->session->set_userdata('overtime.client.date_to',$this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2'));
		redirect('overtime/accounting/client',301);
	}
	
	public function client_export_excel(){
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
		
		$date_from = $this->session->userdata('overtime.client.date_from');
		$date_to   = $this->session->userdata('overtime.client.date_to');
		$client_name = $this->session->userdata('overtime.client.name');
	
		/* Keterangan */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Tanggal :');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($date_from).' s/d '.indo_tgl($date_to));
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$row=$row+2;
	
		/* Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,'Client Code');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 0)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getFill()->applyFromArray($fill);
		
	
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 1,$row,$col + 9,$row);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,'Client Name');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		
	
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,'City');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 10)->setWidth(25);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFill()->applyFromArray($fill);
	
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,'Country');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 11)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFill()->applyFromArray($fill);
	
		$row++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,'Date');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 0)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getFill()->applyFromArray($fill);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,'Day');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 1)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 2)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,'Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 3)->setWidth(25);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 4)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,'OT');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 5)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,'X1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 6)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,'X2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 7)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,'X3');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 8)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,'X4');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 9)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,'Meal');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,'Cost');
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
		
		$row++;
	
				
		
		$data['master'] = $this->Josh_time_report->getClientByProject($client_name,$date_from,$date_to);
		
		foreach($data['master'] as $mst) {
			/*  Code */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,$mst['code']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
				
			/* Name */
			$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 1,$row,$col + 9,$row);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,$mst['name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$mst["city"]);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
				
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,$mst["country"]);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
			
				
			$data['details'] = $this->Josh_time_report->getOvertimeHourByEmployee($mst['code'],$date_from,$date_to);
				
				
			$row++;
			$ot = 0;
			$x1 = 0;
			$x2 = 0;
			$x3 = 0;
			$x4 = 0;
			$meal = 0;
			$cost = 0;
			foreach($data['details'] as $dt){
				$ot+=$dt['overtime'];
				$x1+=$dt['x1'];
				$x2+=$dt['x2'];
				$x3+=$dt['x3'];
				$x4+=$dt['x4'];
				$meal+=$dt['meal'];
				$cost+=$dt['cost'];
				
				/*  No */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$dt["date"]);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
				
				/* Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$dt['day_name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$dt['staff_no']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$dt['staff_name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$dt['pos_code']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$dt['overtime']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$dt['x1']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$dt['x2']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$dt['x3']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$dt['x4']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$dt['meal']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getNumberFormat()->setFormatCode('#,##.00');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$dt['cost']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getNumberFormat()->setFormatCode('#,##.00');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
		
				
				$row++;
			}
				
			//SUBTOTAL
			$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0, $row,$col + 4, $row);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,'SUBTOTAL');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+0,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,$ot);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$x1);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
				
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,$x2);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$x3);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,$x4);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$meal);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,$cost);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getNumberFormat()->setFormatCode('#,##.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
			
			$row = $row + 2;
		}
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="./assets/overtime_client.xls";
		$objWriter->save($file);
		redirect($file,301);
	}
	
}