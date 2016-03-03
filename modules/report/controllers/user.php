<?php 
class User extends Controller {
	
    function User() {
        parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) ){
            redirect('login/user/index',301); }
				
        $this->load->model('report');
		$this->load->module_model('job_desc','Josh_job');
		$this->load->module_model('time_report','Josh_time_report');
		ini_set('max_execution_time',3600);
    }
	
	public function index() {
		$data['title']="Report Generator";
		$data['main']='index';
		$data['module'] = 'report';
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function activity() {
		$data['title'] =  "Activity Report";
		$data['module'] =   'report';
		$data['main']   =   'activity';
		$data['client_name'] = $this->session->userdata('activity.client_name');
		$data['staff_name'] = $this->session->userdata('activity.staff_name');
		$data['date_from'] = $this->session->userdata('activity.date_from');
		$data['date_to'] = $this->session->userdata('activity.date_to');
		$data['records']=   $this->report->getActivity($data["client_name"],$data["staff_name"],$data["date_from"],$data["date_to"]);
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function activity_query() {
		$this->session->set_userdata('activity.client_name',$this->input->post('client_name'));
		$this->session->set_userdata('activity.staff_name',$this->input->post('staff_name'));
		$this->session->set_userdata('activity.date_from',$this->input->post('year_from').'-'.$this->input->post('month_from').'-'.$this->input->post('day_from'));
		$this->session->set_userdata('activity.date_to',$this->input->post('year_to').'-'.$this->input->post('month_to').'-'.$this->input->post('day_to'));
		redirect('report/user/activity',301);
	}
	
	public function activity_reset() {
		$this->session->unset_userdata('activity.client_name');
		$this->session->unset_userdata('activity.staff_name');
		$this->session->unset_userdata('activity.date_from');
		$this->session->unset_userdata('activity.date_to');
		redirect('report/user/activity',301);
	}
	
	public function timecharge_summary() {
        $data['title']=" Time Charge Summary Report"; //title
        $data['records']=$this->report->getTimeChargeSummary($this->session->userdata('timecharge_summary.name'),$this->session->userdata('timecharge_summary.status'));
        $data['module']='report';
        $data['main']='timecharge_summary';
		
		/** Perhitungan Tabel**/
		$data['table'] = '';
		$i = 1;
		foreach($data['records'] as $row)
		{
			$data['table'].= '<tr>';
			$data['table'].= '<td><a style="'.($i % 2 != 0 ? 'color:#fff"' : 'color:#222"').'  href="'.base_url().'/report/user/timecharge_client/'.$row['code'].'">'.$row['code'].'<a/></td>';
			$data['table'].= '<td><a style="'.($i % 2 != 0 ? 'color:#fff"' : 'color:#222"').'  href="'.base_url().'/report/user/timecharge_client/'.$row['code'].'">'.$row['name'].'<a/></td>';
			
			if($row['SUM_pl']>0)
				$status = "P";
			else
				$status = "L";
			
			$data['table'].= '<td style="text-align:center">'.$status.'('.number_format($row['percent'],2).' %)'.'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_time'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_hour'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_total'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_pl'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_pl_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:center">'.$row['start_date'].'</td>';
			$data['table'].= '<td style="text-align:center">'.$row['end_date'].'</td>';
			$data['table'].= '<td>'.$row['note'].'</td>';
			$data['table'].= '<td>'.$row['progress'].'</td>';
			$data['table'].= '</tr>';
			$i++;
		}
		
		
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function timecharge_summary_query() {
		$this->session->set_userdata('timecharge_summary.name',$this->input->post('query'));
		$this->session->set_userdata('timecharge_summary.status',$this->input->post('status'));
		redirect('report/user/timecharge_summary',301);
	}
	
	public function timecharge_excel() {
		set_time_limit(336000);
		$this->load->library('excel');
		$name = $this->session->userdata('timecharge_summary.name');
		$status = $this->session->userdata('timecharge_summary.status');
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("Time Charge Search By Client ".$name)
                    ->setDescription("Time Charge Search By Client  ".$name);
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
		
		$fill_red = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'FF0000'
      			),
      			'endcolor'   => array(
      				'argb' => 'FF0000'
      			)
      		);
		
		$fill_green = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => '2a9265'
      			),
      			'endcolor'   => array(
      				'argb' => '2a9265'
      			)
      		);
		
		$fill_yellow = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'def909'
      			),
      			'endcolor'   => array(
      				'argb' => 'def909'
      			)
      		);
		
		$fill_white = array(
      			'type'       => Style_Fill::FILL_SOLID,
      			'rotation'   => 0,
      			'startcolor' => array(
      				'rgb' => 'FFFFFF'
      			),
      			'endcolor'   => array(
      				'argb' => 'FFFFFF'
      			)
      		);
		
		/*Data */
		$row=1;
		$col=0;
		
        /* Periode */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Keyword : '.$name);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col+11,$row);	
		$row = $row + 3;
        
		/* No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(5);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col,$row+2);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Kode */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Kode');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(16);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+1,$row,$col+1,$row+2);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Nama Klien */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Nama Klien');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(54);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+2,$row,$col+2,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* P/L */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'P/L');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(4);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+3,$row,$col+3,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Budget */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Budget');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+4,$row,$col+23,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
		
		/* Real */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,'Real');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+24,$row,$col+43,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->applyFromArray($styleArray);
		
		/* Profilt */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+44,$row,'Profit/Loss');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+44,$row,$col+63,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->applyFromArray($styleArray);		
		
        /* Start */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+64,$row,'Start');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+64)->setWidth(14);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+64,$row,$col+64,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Finish */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+65,$row,'Finished');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+35)->setWidth(14);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+65,$row,$col+65,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Note */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+66,$row,'Note');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+66)->setWidth(25);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+66,$row,$col+66,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Progress */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+67,$row,'Progress');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+67)->setWidth(25);
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+67,$row,$col+67,$row+2);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		
		$row++;
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		
		//Budget Hour
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Hour');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+4,$row,$col+13,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
		
		//Budget Cost
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Cost');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+14,$row,$col+23,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
		
		//Real Hour
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,'Hour');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+24,$row,$col+33,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);		
		
		//Real Cost
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+34,$row,'Cost');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+34,$row,$col+43,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->applyFromArray($styleArray);
		
		//PL Hour
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+44,$row,'Hour');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+44,$row,$col+53,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->applyFromArray($styleArray);		
		
		//Real Cost
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+54,$row,'Cost');
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+54,$row,$col+63,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->applyFromArray($styleArray);		
		
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->applyFromArray($styleArray);
		
		$row++;
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		
		//Budget Hour SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
		
		//Budget Hour PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
		
		//Budget Hour SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
		
		//Budget Hour M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
		
		//Budget Hour AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
		
		//Budget Hour S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
		
		//Budget Hour S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
		
		//Budget Hour AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+11)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
		
		//Budget Hour TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+12)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
		
		//Budget Hour SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+13)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
		
		
		//Budget Cost SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+14)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
		
		//Budget Cost PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+15)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
		
		//Budget Cost SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+16)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
		
		//Budget Cost M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+17)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
		
		//Budget Cost AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+18)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
		
		//Budget Cost S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+19)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
		
		//Budget Cost S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+20)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
		
		//Budget Cost AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+21,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+21)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
		
		//Budget Cost TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+22,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+22)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
		
		//Budget Cost SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+23,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+23)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
		
		//Real Hour SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+24)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
		
		//Real Hour PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+25,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+25)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);
		
		//Real Hour SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+26,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+26)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
		
		//Real Hour M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+27,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+27)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);
		
		//Real Hour AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+28,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+28)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);
		
		//Real Hour S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+29,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+29)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);
		
		//Real Hour S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+30,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+30)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);
		
		//Real Hour AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+31,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+31)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
		
		//Real Hour TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+32,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+32)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);
		
		//Real Hour SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+33,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+33)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);
		
		
		//Real Cost SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+34,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+34)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->applyFromArray($styleArray);
		
		//Real Cost PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+35,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+35)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->applyFromArray($styleArray);
		
		//Real Cost SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+36,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+36)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->applyFromArray($styleArray);
		
		//Real Cost M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+37,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+37)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->applyFromArray($styleArray);
		
		//Real Cost AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+38,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+38)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->applyFromArray($styleArray);
		
		//Real Cost S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+39,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+39)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->applyFromArray($styleArray);
		
		//Real Cost S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+40,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+40)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->applyFromArray($styleArray);
		
		//Real Cost AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+41,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+41)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->applyFromArray($styleArray);
		
		//Real Cost TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+42,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+42)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->applyFromArray($styleArray);
		
		//Real Cost SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+43,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+43)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->applyFromArray($styleArray);
		
		//PL Hour SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+44,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+44)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->applyFromArray($styleArray);
		
		//PL Hour PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+45,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+45)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->applyFromArray($styleArray);
		
		//PL Hour SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+46,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+46)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->applyFromArray($styleArray);
		
		//PL Hour M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+47,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+47)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->applyFromArray($styleArray);
		
		//Pl Hour AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+48,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+48)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->applyFromArray($styleArray);
		
		//PL Hour S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+49,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+49)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->applyFromArray($styleArray);
		
		//PL Hour S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+50,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+50)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->applyFromArray($styleArray);
		
		//PL Hour AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+51,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+51)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->applyFromArray($styleArray);
		
		//PL Hour TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+52,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+52)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->applyFromArray($styleArray);
		
		//PL Hour SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+53,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+53)->setWidth(5);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->applyFromArray($styleArray);
		
		
		//RPL Cost SP
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+54,$row,'SP');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+54)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->applyFromArray($styleArray);
		
		//PL Cost PC
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+55,$row,'PC');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+55)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->applyFromArray($styleArray);
		
		//PL Cost SM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+56,$row,'SM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+56)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->applyFromArray($styleArray);
		
		//PL Cost M
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+57,$row,'M');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+57)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->applyFromArray($styleArray);
		
		//PL Cost AM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+58,$row,'AM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+58)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->applyFromArray($styleArray);
		
		//PL Cost S2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+59,$row,'S2');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+59)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->applyFromArray($styleArray);
		
		//PL Cost S1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+60,$row,'S1');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+60)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->applyFromArray($styleArray);
		
		//PL Cost AS
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+61,$row,'AS');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+61)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->applyFromArray($styleArray);
		
		//PL Cost TA
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+62,$row,'TA');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+62)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->applyFromArray($styleArray);
		
		//PL Cost SUM
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+63,$row,'SUM');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+63)->setWidth(14);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->applyFromArray($styleArray);
		
		$row = $row + 1;
		
        $records = $this->report->getTimeChargeDetails($name,$status);
        
		$i = 1;
		
		
		foreach($records as $rec)
		{
			/* No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$i);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* Code */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['code']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
			
			/* Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/* PL */
			if($row['SUM_pl']>0)
				$status = "P";
			else
				$status = "L";
				
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$status);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			if($rec['SP_time'])
			{
				$sp_percent = ($rec['SP_hour']/$rec['SP_time']) * 100;
				
				if(($sp_percent>=80) && ($sp_percent<100))
					$fill_sp = $fill_yellow;
				elseif($sp_percent>=100)
					$fill_sp = $fill_red;
				else
					$fill_sp = $fill_green;
			}
			else
			{
				$fill_sp = $fill_white;
			}
			
		
			if($rec['PC_time'])
			{
				$pc_percent = ($rec['PC_hour']/$rec['PC_time']) * 100;
				
				if(($pc_percent>=80) && ($pc_percent<100))
					$fill_pc = $fill_yellow;
				elseif($pc_percent>=100)
					$fill_pc = $fill_red;
				else
					$fill_pc = $fill_green;
			}
			else
			{
				$fill_pc = $fill_white;
			}
			
			
			
			if($rec['SM_time'])
			{
				$sm_percent = ($rec['SM_hour']/$rec['SM_time']) * 100;
				
				if(($pc_percent>=80) && ($sm_percent<100))
					$fill_sm = $fill_yellow;
				elseif($sm_percent>=100)
					$fill_sm = $fill_red;
				else
					$fill_sm = $fill_green;
			}
			else
			{
				$fill_sm = $fill_white;
			}
			
			
			if($rec['M_time'])
			{
				$m_percent = ($rec['M_hour']/$rec['M_time']) * 100;
				
				if(($m_percent>=80) && ($m_percent<100))
					$fill_m = $fill_yellow;
				elseif($m_percent>=100)
					$fill_m = $fill_red;
				else
					$fill_m = $fill_green;
			}
			else
			{
				$fill_m = $fill_white;
			}
			
			
			if($rec['AM_time'])
			{
				$am_percent = ($rec['AM_hour']/$rec['AM_time']) * 100;
				
				if(($am_percent>=80) && ($am_percent<100))
					$fill_am = $fill_yellow;
				elseif($am_percent>=100)
					$fill_am = $fill_red;
				else
					$fill_am = $fill_green;
			}
			else
			{
				$fill_am = $fill_white;
			}
			
			if($rec['S2_time'])
			{
				$s2_percent = ($rec['S2_hour']/$rec['S2_time']) * 100;
				
				if(($s2_percent>=80) && ($s2_percent<100))
					$fill_s2 = $fill_yellow;
				elseif($s2_percent>=100)
					$fill_s2 = $fill_red;
				else
					$fill_s2 = $fill_green;
			}
			else
			{
				$fill_s2 = $fill_white;
			}
			
			if($rec['S1_time'])
			{
				$s1_percent = ($rec['S1_hour']/$rec['S1_time']) * 100;
				
				if(($s1_percent>=80) && ($s1_percent<100))
					$fill_s1 = $fill_yellow;
				elseif($s2_percent>=100)
					$fill_s1 = $fill_red;
				else
					$fill_s1 = $fill_green;
			}
			else
			{
				$fill_s1 = $fill_white;
			}
			
			if($rec['AS_time'])
			{
				$as_percent = ($rec['AS_hour']/$rec['AS_time']) * 100;
				
				if(($as_percent>=80) && ($as_percent<100))
					$fill_as= $fill_yellow;
				elseif($as_percent>=100)
					$fill_as = $fill_red;
				else
					$fill_as = $fill_green;
			}
			else
			{
				$fill_as = $fill_white;
			}
			
			if($rec['TA_time'])
			{
				$ta_percent = ($rec['TA_hour']/$rec['TA_time']) * 100;
				
				if(($ta_percent>=80) && ($ta_percent<100))
					$fill_ta= $fill_yellow;
				elseif($ta_percent>=100)
					$fill_ta = $fill_red;
				else
					$fill_ta = $fill_green;
			}
			else
			{
				$fill_ta = $fill_white;
			}
			
			
			if($rec['SUM_time'])
			{
				$sum_percent = ($rec['SUM_hour']/$rec['SUM_time']) * 100;
				
				if(($sum_percent>=80) && ($sum_percent<100))
					$fill_sum = $fill_yellow;
				elseif($sum_percent>=100)
					$fill_sum = $fill_red;
				else
					$fill_sum = $fill_green;
			}
			else
			{
				$fill_sum = $fill_white;
			}
			
			/* SP Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec['SP_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill_sp);
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['PC_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill_pc);
			
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$rec['SM_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill_sm);
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec['M_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill_m);
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['AM_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill_am);
			
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$rec['S2_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill_s2);
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$rec['S1_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill_s1);
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$rec['AS_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill_as);
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$rec['TA_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getFill()->applyFromArray($fill_ta);
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,$rec['SUM_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->getFill()->applyFromArray($fill_sum);
			
			
			/* SP Cost */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,$rec['SP_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getFill()->applyFromArray($fill_sp);
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,$rec['P_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->getFill()->applyFromArray($fill_pc);
			
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,$rec['SM_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->getFill()->applyFromArray($fill_sm);
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,$rec['M_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->getFill()->applyFromArray($fill_m);
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,$rec['AM_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->getFill()->applyFromArray($fill_am);
			
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,$rec['S2_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->getFill()->applyFromArray($fill_s2);
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,$rec['S1_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->getFill()->applyFromArray($fill_s1);
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+21,$row,$rec['AS_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->getFill()->applyFromArray($fill_as);
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+22,$row,$rec['TA_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->getFill()->applyFromArray($fill_ta);
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+23,$row,$rec['SUM_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->getFill()->applyFromArray($fill_sum);
			
			/* SP Cost */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,$rec['SP_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getFill()->applyFromArray($fill_sp);
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+25,$row,$rec['PC_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->getFill()->applyFromArray($fill_pc);
			
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+26,$row,$rec['SM_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->getFill()->applyFromArray($fill_sm);
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+27,$row,$rec['M_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->getFill()->applyFromArray($fill_m);
			
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+28,$row,$rec['AM_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->getFill()->applyFromArray($fill_am);
						
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+29,$row,$rec['S2_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->getFill()->applyFromArray($fill_s2);
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+30,$row,$rec['S1_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->getFill()->applyFromArray($fill_s1);
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+31,$row,$rec['AS_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->getFill()->applyFromArray($fill_as);
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+32,$row,$rec['TA_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->getFill()->applyFromArray($fill_ta);
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+33,$row,$rec['SUM_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->getFill()->applyFromArray($fill_sum);
			
			/* SP Cost */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+34,$row,$rec['SP_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+34,$row)->getFill()->applyFromArray($fill_sp);
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+35,$row,$rec['PC_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->getFill()->applyFromArray($fill_pc);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+35,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+36,$row,$rec['SM_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->getFill()->applyFromArray($fill_sm);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+36,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+37,$row,$rec['M_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->getFill()->applyFromArray($fill_m);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+37,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+38,$row,$rec['AM_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->getFill()->applyFromArray($fill_am);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+38,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+39,$row,$rec['S2_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->getFill()->applyFromArray($fill_s2);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+39,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+40,$row,$rec['S1_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->getFill()->applyFromArray($fill_s1);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+40,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+41,$row,$rec['AS_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->getFill()->applyFromArray($fill_as);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+41,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+42,$row,$rec['TA_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->getFill()->applyFromArray($fill_ta);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+42,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+43,$row,$rec['SUM_total']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->getFill()->applyFromArray($fill_sum);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+43,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* SP Cost */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+44,$row,$rec['SP_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+44,$row)->getFill()->applyFromArray($fill_sp);
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+45,$row,$rec['PC_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+45,$row)->getFill()->applyFromArray($fill_pc);
			
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+46,$row,$rec['SM_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+46,$row)->getFill()->applyFromArray($fill_sm);
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+47,$row,$rec['M_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+47,$row)->getFill()->applyFromArray($fill_m);
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+48,$row,$rec['AM_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+48,$row)->getFill()->applyFromArray($fill_am);
			
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+49,$row,$rec['S2_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+49,$row)->getFill()->applyFromArray($fill_s2);
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+50,$row,$rec['S1_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+50,$row)->getFill()->applyFromArray($fill_s1);
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+51,$row,$rec['AS_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+51,$row)->getFill()->applyFromArray($fill_as);
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+52,$row,$rec['TA_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+52,$row)->getFill()->applyFromArray($fill_ta);
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+53,$row,$rec['SUM_pl']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+53,$row)->getFill()->applyFromArray($fill_sum);
			
			/* SP Cost */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+54,$row,$rec['SP_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getFill()->applyFromArray($fill_sp);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+54,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* PC  Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+55,$row,$rec['PC_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->getFill()->applyFromArray($fill_pc);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+55,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* SM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+56,$row,$rec['SM_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->getFill()->applyFromArray($fill_sm);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+56,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* M Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+57,$row,$rec['M_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->getFill()->applyFromArray($fill_m);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+57,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* AM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+58,$row,$rec['AM_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->getFill()->applyFromArray($fill_am);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+58,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* S2 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+59,$row,$rec['S2_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->getFill()->applyFromArray($fill_s2);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+59,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* S1 Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+60,$row,$rec['S1_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->getFill()->applyFromArray($fill_s1);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+60,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* AS Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+61,$row,$rec['AS_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->getFill()->applyFromArray($fill_as);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+61,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* TA Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+62,$row,$rec['TA_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->getFill()->applyFromArray($fill_ta);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+62,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* SUM Time */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+63,$row,$rec['SUM_pl_cost']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->getFill()->applyFromArray($fill_sum);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+63,$row)->getNumberFormat()->setFormatCode('#,##0.00');
			
			/* Starte */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+64,$row,$rec['start_date']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+64,$row)->applyFromArray($styleArray);
			
			/* End */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+65,$row,$rec['end_date']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+65,$row)->applyFromArray($styleArray);
			
			/* End */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+66,$row,$rec['note']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+66,$row)->applyFromArray($styleArray);
			
			/* End */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+67,$row,$rec['progress']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+67,$row)->applyFromArray($styleArray);
			
			
			$row++;
			$i++;
		}
		
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel2007");
		$file="TimeCharge Search By-".$name.".xlsx";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
	}
	
	public function timecharge_client($job_code) {
		$row = $this->report->getTimeChargeDetailsByJob($job_code);
		$jobs = $this->report->getJobProgress($job_code);
		$data['title']=" Time Charge Client "; //title
		$data['module']='report';
		$data['main']='timecharge_client';
		$data['table'] = '';
		
		/** Perhitungan Tabel**/
		$data['table'] = '';
		$data['table2'] = '';
		
		if(count($row)>0)
		{
			//$row[] = $data['record'];
			
			$data['table'].= '<tr>';
			$data['table'].= '<td>'.$row['code'].'</td>';
			$data['table'].= '<td>'.$row['name'].'</td>';
			
			if($row['SUM_pl']>0)
				$status = "P";
			else
				$status = "L";
			
			$data['table'].= '<td style="text-align:center">'.$status.'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.$row['PC_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.$row['SM_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.$row['M_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.$row['AM_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.$row['S2_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.$row['S1_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.$row['AS_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_time'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_time'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.number_format($row['SP_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.number_format($row['P_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.number_format($row['SM_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.number_format($row['M_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.number_format($row['AM_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.number_format($row['S2_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.number_format($row['S1_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.number_format($row['AS_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.$row['PC_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.$row['SM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.$row['M_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.$row['AM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.$row['S2_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.$row['S1_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.$row['AS_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_hour'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_hour'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.number_format($row['SP_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.number_format($row['PC_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.number_format($row['SM_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.number_format($row['M_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.number_format($row['AM_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.number_format($row['S2_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.number_format($row['S1_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.number_format($row['AS_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_total'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.$row['PC_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.$row['SM_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.$row['M_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.$row['AM_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.$row['S2_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.$row['S1_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.$row['AS_pl'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_pl'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_pl'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.number_format($row['SP_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['PC_style'].'">'.number_format($row['PC_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SM_style'].'">'.number_format($row['SM_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['M_style'].'">'.number_format($row['M_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AM_style'].'">'.number_format($row['AM_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S2_style'].'">'.number_format($row['S2_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['S1_style'].'">'.number_format($row['S1_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['AS_style'].'">'.number_format($row['AS_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['TA_style'].'">'.number_format($row['TA_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SUM_style'].'">'.number_format($row['SUM_pl_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:center">'.$row['start_date'].'</td>';
			$data['table'].= '<td style="text-align:center">'.$row['end_date'].'</td>';
			$data['table'].= '<td>'.$row['note'].'</td>';
			$data['table'].= '<td>'.$row['progress'].'</td>';
			$data['table'].= '</tr>';
		}
		
		if(count($jobs)>0)
		{
			$no = 1;
			foreach($jobs as $job) {
				$data['table2'].= '<tr>';
				$data['table2'].= '<td>'.$no.'</td>';
				$data['table2'].= '<td>'.$job['date'].'</td>';
				$data['table2'].= '<td>'.$job['staff_no'].'</td>';
				$data['table2'].= '<td>'.$job['staff_name'].'</td>';
				$data['table2'].= '<td>'.$job['progress'].'</td>';
				$data['table2'].= '</tr>';
				$no++;
			}
		}
		
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function timecharge_details() {
        $data['title']=" Time Charge Details Report"; //title
        $data['records']=$this->report->getTimeChargeDetails($this->session->userdata('timecharge_details.name'),$this->session->userdata('timecharge_details.status'));
        $data['module']='report';
        $data['main']='timecharge_details';
		
		/** Perhitungan Tabel**/
		$data['table'] = '';
		foreach($data['records'] as $row)
		{
			$data['table'].= '<tr>';
			$data['table'].= '<td>'.$row['code'].'</td>';
			$data['table'].= '<td>'.$row['name'].'</td>';
			
			if($row['SUM_pl']>0)
				$status = "P";
			else
				$status = "L";
			
			$data['table'].= '<td style="text-align:center">'.$status.'</td>';
			
			$data['table'].= '<td style="text-align:right">'.$row['SP_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['PC_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['SM_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['M_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AM_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S2_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S1_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AS_time'].'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_time'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_time'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right">'.number_format($row['SP_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['P_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SM_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['M_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AM_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S2_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S1_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AS_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right">'.$row['SP_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['PC_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['SM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['M_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S2_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S1_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AS_hour'].'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_hour'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_hour'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right">'.number_format($row['SP_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['PC_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SM_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['M_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AM_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S2_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S1_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AS_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_total'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_total'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right">'.$row['SP_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['PC_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['SM_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['M_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AM_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S2_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['S1_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.$row['AS_pl'].'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_pl'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_pl'],0).'</td>';
			
			$data['table'].= '<td style="text-align:right">'.number_format($row['SP_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['PC_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SM_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['M_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AM_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S2_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['S1_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['AS_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['TA_pl_cost'],0).'</td>';
			$data['table'].= '<td style="text-align:right">'.number_format($row['SUM_pl_cost'],0).'</td>';
			
			$data['table'].= '<td style="text-align:center">'.$row['start_date'].'</td>';
			$data['table'].= '<td style="text-align:center">'.$row['end_date'].'</td>';
			$data['table'].= '<td>'.$row['note'].'</td>';
			$data['table'].= '<td>'.$row['progress'].'</td>';
			$data['table'].= '</tr>';
		}
		
		
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function timecharge_details_query() {
		$this->session->set_userdata('timecharge_details.name',$this->input->post('query'));
		$this->session->set_userdata('timecharge_details.status',$this->input->post('status'));
		redirect('report/user/timecharge_details',301);
	}
	
	public function timecharge_correct(){
		$jobs = $this->report->getJobSetup();
		if($jobs)
		{
			foreach($jobs as $job)
			{
				$correct_data = $this->report->getTimeChargeDateByJob($job['code'],$sort="ASC");
				$this->report->getUpdateJob($job['code'],array('start_date' => $correct_data?$correct_data['start_date']:'0000-00-00','end_date' => $correct_data?$correct_data['end_date']:'0000-00-00'));
			}
		}
		
		redirect('report/user/timecharge',301);
	}
	
	public function employeecharge_summary() {
        $data['title']=" Employee Charge Summary Report"; //title
        $data['bind_group'] = $this->report->getGroupList();
		$data['records']=$this->report->getEmployeeChargeSummary();
        $data['module']='report';
        $data['main']='employeecharge_summary';
		
		/** Perhitungan Tabel**/
		$data['table'] = '';
		$i = 1;
		if($this->session->userdata('employeecharge_summary.date_from')) {
			foreach($data['records'] as $row) {
				if($i % 2 == 0)
					$style = "color:#fff";
				else
					$style = "color:#333";
				$data['table'].= '<tr>';
				$data['table'].= '<td style="text-align:center">'.$i.'</td>';
				$data['table'].= '<td><a style="'.$style.'" href="'.base_url().'/report/user/employeecharge_details/'.$row['staff_no'].'">'.$row['staff_no'].'</a></td>';
				$data['table'].= '<td><a style="'.$style.'" href="'.base_url().'/report/user/employeecharge_details/'.$row['staff_no'].'">'.$row['staff_name'].'</a></td>';
				$data['table'].= '<td style="text-align:center">'.$row['pos_code'].'</td>';
				$data['table'].= '<td style="text-align:right;">'.number_format($row['chargeable_hour'],0).'</td>';
				$data['table'].= '<td style="text-align:right;">'.number_format($row['nonchargeable_hour'],0).'</td>';
				$data['table'].= '</tr>';
				$i++;
			}
		}
		
		
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function employeecharge_summary_query() {
		$date_from 	= $this->input->post('year_from').'-'.$this->input->post('month_from').'-'.$this->input->post('day_from');
		$date_to 	= $this->input->post('year_to').'-'.$this->input->post('month_to').'-'.$this->input->post('day_to');
		
		$this->session->set_userdata('employeecharge_summary.date_from',$date_from);
		$this->session->set_userdata('employeecharge_summary.date_to',$date_to);
		$this->session->set_userdata('employeecharge_summary.name',$this->input->post('query'));
		$this->session->set_userdata('employeecharge_summary.group',$this->input->post('group'));
		
		$this->report->deleteEmployeeCharge();
		$employees = $this->report->getEmployeeActive($this->input->post('query'),$this->input->post('group'));
		if($employees) {
			foreach($employees as $user) {
				$data['staff_no'] = $user['no'];
				$data['staff_name'] = $user['name'];
				$data['pos_code'] = $user['pos_code'];
				$data['date_from'] = $date_from;
				$data['date_to'] = $date_to;
				$sum_ch = $this->report->getSumTimeReportByChargeable($user['no'],$date_from,$date_to);
				$data['chargeable_hour'] = $sum_ch;
				$sum_nch = $this->report->getSumTimeReportByNonChargeable($user['no'],$date_from,$date_to);
				$data['nonchargeable_hour'] = $sum_nch;
				$data['created_at'] = date('Y-m-d H:i:s');
				$this->report->getInsertEmployeeCharge($data);
				
			}
		}
		
		
		redirect('report/user/employeecharge_summary',301);
	}
	
	public function employeecharge_details($staff_no) {
        $data['title']=" Employee Charge Details"; //title
		$data['user'] = $this->report->getSingleEmployee($staff_no);
		$data['date_from'] = $this->session->userdata('employeecharge_summary.date_from');
		$data['date_to'] = $this->session->userdata('employeecharge_summary.date_to');
		$data['staff_no'] = $staff_no;
        $data['records'] = $this->report->getChargeByEmployee($data['staff_no'],$data['date_from'],$data['date_to']);
		$data['module']='report';
        $data['main']='employeecharge_details';
		$data['table'] = "";
		//bind
		if($data['staff_no']) {
			$i=1;
			$total_charge = 0;
			$total_noncharge = 0;
			foreach( $data['records'] as $row) {
				$data['table'] .= "<tr>";
				$data['table'] .= "<td>".$i."</td>";
				$data['table'] .= "<td>".$row['date']."</td>";
				$data['table'] .= "<td>".$row['job_code']."</td>";
				$data['table'] .= "<td>".$row['job_name']."</td>";
				$data['table'] .= "<td>".$row['job_type']."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['charge'],0)."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['noncharge'],0)."</td>";
				$data['table'] .= "</tr>";
				$i++;
				$total_charge+=$row['charge'];
				$total_noncharge+=$row['noncharge'];
			}
			
			//subtotal
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='5' style='text-align:right'>Total</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($total_charge,0)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($total_noncharge,0)."</td>";
			$data['table'] .= "</tr>";
		}
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function employeecharge_summary_excel(){
        $date_from = $this->session->userdata('employeecharge_summary.date_from');
		$date_to = $this->session->userdata('employeecharge_summary.date_to');
        $records = $this->report->getEmployeeChargeSummary();
		
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
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Employee Charge Summary');
		$row++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$date_from.' To '.$date_to);		
       
		$row = $row +3;
                
		/* NIK */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(5);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Nama');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Chargeable Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Non Chargeable Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		$row=$row+1;
		$i = 1;
		foreach($records as $rec) {
			/*  No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$i);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['staff_no']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['staff_name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['pos_code']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$rec['chargeable_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getNumberFormat()->setFormatCode('#,##0');
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['nonchargeable_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##0');
			
			$row++;
			$i++;
		}
		
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel2007");
		$file="./assets/Employee-Charge.xlsx";
		$objWriter->save($file);
		redirect($file,301);
	}
	
	
	public function chargeable() {
		$data['title'] = "Checking Chargeable Report"; //title
        $data['bind_client']   =   $this->Josh_job->selectBindJob("All Client"); 
		$data['bind_group'] = $this->report->getGroupList();
        $data['module'] = 'report';
        $data['main'] = 'chargeable';
		$data['table'] = '';
		if($this->session->userdata('chargeable.date_from'))
		{
			$data['records'] = $this->report->getChargeable($this->session->userdata('chargeable.name'),$this->session->userdata('chargeable.client_name'),$this->session->userdata('chargeable.group'),$this->session->userdata('chargeable.date_from'),$this->session->userdata('chargeable.date_to'),$this->session->userdata('chargeable.type'));
			$no = 1;
			foreach($data['records'] as $row)
			{
				$data['table'].= '<tr>';
				$data['table'].= '<td>'.$no.'</td>';
				$data['table'].= '<td>'.$row['date'].'</td>';
				$data['table'].= '<td>'.$row['no'].'</td>';
				$data['table'].= '<td>'.$row['name'].'</td>';
				$data['table'].= '<td style="text-align:center;font-weight:bolder">'.$row['pos_code'].'</td>';
				$data['table'].= '<td>'.$row['group_name'].'</td>';
				$data['table'].= '<td>'.$row['job_type'].'</td>';
				$data['table'].= '<td>'.$row['job_name'].'</td>';
				$data['table'].= '<td>'.$row['address'].'</td>';
				$data['table'].= '<td style="text-align:right;font-weight:bolder">'.$row['time'].'</td>';
				$data['table'].= '</tr>';
				
				$no++;
			}
		}
		
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function chargeable_query() {
		$this->session->set_userdata('chargeable.name',$this->input->post('query'));
		$this->session->set_userdata('chargeable.client_name',$this->input->post('client_name'));
		$this->session->set_userdata('chargeable.group',$this->input->post('group'));
		$this->session->set_userdata('chargeable.type',$this->input->post('type'));
		$this->session->set_userdata('chargeable.date_from',$this->input->post('year_from').'-'.$this->input->post('month_from').'-'.$this->input->post('day_from'));
		$this->session->set_userdata('chargeable.date_to',$this->input->post('year_to').'-'.$this->input->post('month_to').'-'.$this->input->post('day_to'));
		redirect('report/user/chargeable',301);
	}
	
	public function maxjobhour()
	{
		$data['title'] = "Maximum Chargeable Hour"; //title
        $data['module'] = 'report';
        $data['main'] = 'maxjobhour';
		$data['table'] = '';
		$data['records'] = $this->report->getMaxHourJob($this->session->userdata('maxjobhour.client_name'),$this->session->userdata('maxjobhour.periode'));
		$no = 1;
		foreach($data['records'] as $row)
		{
			$data['table'].= '<tr>';
			$data['table'].= '<td>'.$no.'</td>';
			$data['table'].= '<td>'.$row['code'].'</td>';
			$data['table'].= '<td>'.$row['name'].'</td>';
				
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_time'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_hour'].'</td>';
			$data['table'].= '<td style="text-align:right;'.$row['SP_style'].'">'.$row['SP_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['PC_style'].'">'.$row['PC_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['PC_style'].'">'.$row['PC_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['PC_style'].' ">'.$row['PC_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['SM_style'].'">'.$row['SM_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['SM_style'].'">'.$row['SM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['SM_style'].'">'.$row['SM_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['M_style'].'">'.$row['M_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['M_style'].'">'.$row['M_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['M_style'].'">'.$row['M_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['AM_style'].'">'.$row['AM_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['AM_style'].'">'.$row['AM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['AM_style'].'">'.$row['AM_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['S2_style'].'">'.$row['S2_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['S2_style'].'">'.$row['S2_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['S2_style'].'">'.$row['S2_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['S1_style'].'">'.$row['S1_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['S1_style'].'">'.$row['S1_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['S1_style'].'">'.$row['S1_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['AS_style'].'">'.$row['AS_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['AS_style'].'">'.$row['AS_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['AS_style'].'">'.$row['AS_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['TA_style'].'">'.$row['TA_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['TA_style'].'">'.$row['TA_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['TA_style'].'">'.$row['TA_pl'].'</td>';
				
			$data['table'].= '<td style="text-align:right; '.$row['SUM_style'].'">'.$row['SUM_time'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['SUM_style'].'">'.$row['SUM_hour'].'</td>';
			$data['table'].= '<td style="text-align:right; '.$row['SUM_style'].'">'.$row['SUM_pl'].'</td>';
				
			$data['table'].= '</tr>';
				
			$no++;
		}
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function maxjobhour_query() {
		$this->session->set_userdata('maxjobhour.client_name',$this->input->post('query'));
		$this->session->set_userdata('maxjobhour.periode',$this->input->post('periode'));
		redirect('report/user/maxjobhour',301);
	}
	
	public function jobAutoCorrect() {
		$sql = "
			SELECT *
			FROM josh_job jj
			WHERE substr(periode,4,4) >= '2014'
		";
		$q = $this->db->query($sql);
		if($q->num_rows()>0) {
			foreach($q->result_array() as $row) {
				//save hour to job
				$job_code = $row['code'];
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"M");
				$jobVal["M_hour"] = $total_hour;
				
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"AM");
				$jobVal["AM_hour"] = $total_hour;
				
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"S2");
				$jobVal["S2_hour"] = $total_hour;
				
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"S1");
				$jobVal["S1_hour"] = $total_hour;
				
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"AS");
				$jobVal["AS_hour"] = $total_hour;
				
				$total_hour = $this->Josh_time_report->SUMTimeReportUser($job_code,"TA");
				$jobVal["TA_hour"] = $total_hour;
				
				$this->db->where('code',$job_code);
				$this->db->update('josh_job',$jobVal);
			}
		}
		$q->free_result();
		redirect('report/user/maxjobhour',301);
		
	}
	
}