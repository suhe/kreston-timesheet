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
    }
    
    public function index() {
         //title
        //unset($_SESSION['tr_code']); 
        $data['title']="Manage Transport For Accounting";
        //database
		if($this->session->userdata('sdate1'))
			$data['records']=$this->Josh_time_report->selectPeriodeRecord($this->session->userdata('sdate1'),$this->session->userdata('sdate2'),$this->session->userdata('transport.client_name'));
        else
			$data['records']=0;
		$data['bind_client']   =   $this->Josh_job->selectBindJob('All Client'); 	
		//web system data 
		$table = '';
		if($data['records']){
			
			$no=25;
			foreach($data['records'] as $v){
				$table.="<tr>
						<td>".$v['ccode']."</td>
						<td>".$v['client_name']."</td>
						<td></td>
						<td></td>
						<td></td>
						<td style=text-align:right></td>
				   </tr>";
				   
				   $details = $this->Josh_time_report->selectPeriodeUserRecord($this->session->userdata('sdate1'),$this->session->userdata('sdate2'),$v['ccode']);
				   $total = 0;
				   foreach($details as $d){
					    $table.="<tr>
								<td></td>
								<td></td>
								<td>".$d['no']."</td>
								<td>".$d['name']."</td>
								<td>".$d['date']."</td>
								<td style=text-align:right>".number_format($d['transport'],0)."</td>
						      </tr>";
						$total+= $d['transport'];	  
				   }
				   
				   $table.="<tr>
								<td colspan='5' style=text-align:right><strong>SUB TOTAL</strong></td>
								<td style=text-align:right><strong>".number_format($total,0)."</strong></td>
						      </tr>";
				     
				   
				$no++;   
			}
		} 
        $data['module']='transport';
        $data['main']='accounting/index';
        $data['table'] =$table;
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function bulk_transport() {
		$this->session->set_userdata('transport.client_name',$this->input->post('client_name'));
		$this->session->set_userdata('sdate1',$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'));
		$this->session->set_userdata('sdate2',$this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2'));
		redirect('transport/accounting/index',301);
	}
	
	function export_excel(){
        $date_from = $this->session->userdata('sdate1');
		$date_to   = $this->session->userdata('sdate2');
		$client_name = $this->session->userdata('transport.client_name');
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
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Tgl :');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,indo_tgl($date_from).' s/d '.indo_tgl($date_to));		
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$row=$row+2;
                
		/* NIK */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Code');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Client Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'NIK');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(25);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Tanggal');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		$row=$row+1;
		
		
		foreach($records as $rec):
			/*  No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['ccode']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['client_name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			
			$details = $this->Josh_time_report->selectPeriodeUserRecord($this->session->userdata('sdate1'),$this->session->userdata('sdate2'),$rec['ccode']);
			$total = 0;
			
			$row++;
		    foreach($details as $v){
				/*  No */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
				
				/* Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$v['no']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$v['name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$v['date']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$v['transport']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
				
				$total += $v['transport'];
				$row++;
			}
			
			//SUBTOTAL
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'SUB TOTAL');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+0,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col+0,$row,$col+4,$row);
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+0,$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
		    $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+0,$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);	
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);	
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);	
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$total);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getNumberFormat()->setFormatCode('#,##');
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			
			
			$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="./assets/transport.xls";
		$objWriter->save($file);
		redirect($file,301);
	}
	
	
    
    function periode($id)
    {
        unset($_SESSION['periode']);
        $_SESSION['periode']=$id;
         //title 
        $data['title']="Manage Auditor Report For Accounting";
        //database
        $data['recordprocess']=$this->Josh_time_report->selectACCPerPeriodeRecordPro($id);
        $data['recordapprov']=$this->Josh_time_report->selectACCPerPeriodeRecordApprov($id);
        //web system data 
        $data['module']='transport';
        $data['main']='accounting/staff';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function status_acc($id)
    {
        $this->Josh_time_report->acc_status($id);
        $this->session->set_flashdata('message','<div class=" message success">Change Status Succesfully !</div>');
		redirect('transport/accounting/periode/'.$_SESSION['periode'],301);
    }
    
    function aproval()
	{ 
        $this->Josh_time_report->saveAproval();
        $this->session->set_flashdata('message','<div class=" message success"> Update Aproval Is Succesfully !</div>');
        redirect('transport/accounting/view/'.$_SESSION['tr_code'],301); 
             		
	}
    
    function print_out($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        //$no=$_SESSION['no'];
        //$name=$_SESSION['name'];
        $data['record']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['record']['no'];
        $data['name']=$data['record']['name'];
        
        //$data['no']=$no;
        //$data['name']=$name;
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //database
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //Aproval By ACC
        $data['acc_approval']=$this->Josh_time_report->getACC_Approv($id);
        $data['acc_name']=$data['acc_approval']['acc_name'];
        $data['acc_signature']=$data['acc_approval']['acc_signature'];
        //web system data 
        //$data['module']='transport';
        //$data['main']='user/view2';
        
        //template data
        $this->load->vars($data);
		$this->load->template('transport');
    }
    
    function view($id)
    {
        $data['title']="Listing Reimbush Transport For Accounting";
        //database
        $data['records']=$this->Josh_time_report->selectDetailAccRecords($id);
        //$data['total']=$this->Josh_time_report->total_transport($id);
        //$data['total']=$data['total']['transport'];
        //web system data 
        $data['module']='transport';
        $data['main']='accounting/view';
        
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function view2($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        //load staff
        $data['records']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //day
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //report for chf
        $data['chf']=$this->Josh_time_report->selectchf($id);
        //report for cho
        $data['cho']=$this->Josh_time_report->selectcho($id);
        //report for nch
        $data['nch']=$this->Josh_time_report->selectnch($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //web system data 
        //$data['module']='time_report';
        //$data['main']='admin/view';
        //template data
        //$this->load->vars($data);
        //Menentukan Laporan Template
        $d=substr($id,9,2);
        $m=substr($id,12,1);
        $mm=substr($id,11,2);
        $mn=$m-1;
        
        if ($mn<9){
            $mn='0'.$mn;
        } else {$mn=$mn;}
        //echo $m;
        
        
        if($d=='05') {
            $m=$m-1;
            $n=$m;
            $makhir=5;
            $awal=21;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=28;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
           $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']); 
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec21']['date_h']); 
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mn);
           $data['rec27']=day($data['rec26']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mn);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mn);
           $data['rec29']=day($data['rec29']['date_h']);
           //for 30
           $data['rec30']=$this->Josh_holiday->selectDay(30,$mn);
           $data['rec30']=day($data['rec30']['date_h']);
           //for 31
           $data['rec31']=$this->Josh_holiday->selectDay(31,$mn);
           $data['rec31']=day($data['rec31']['date_h']);
           //for 01
           $data['rec01']=$this->Josh_holiday->selectDay(01,$mm);
           $data['rec01']=day($data['rec01']['date_h']);
           //for 02
           $data['rec02']=$this->Josh_holiday->selectDay(02,$mm);
           $data['rec02']=day($data['rec02']['date_h']);
           //for 03
           $data['rec03']=$this->Josh_holiday->selectDay(03,$mm);
           $data['rec03']=day($data['rec29']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec04']=$this->Josh_holiday->selectDay(04,$mm);
           $data['rec04']=day($data['rec04']['date_h']); 
           //for 05
           $data['rec05']=$this->Josh_holiday->selectDay(05,$mm);
           $data['rec05']=day($data['rec05']['date_h']);
             
           }
           elseif($d=='20') {
             $akhir=20;
             $makhir=0;
             $awal=6;
             
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$awal,$akhir);
           //for 21
           $data['rec06']=$this->Josh_holiday->selectDay('06',$mm);
           $data['rec06']=day($data['rec06']['date_h']); 
           //for 22
           $data['rec07']=$this->Josh_holiday->selectDay('07',$mm);
           $data['rec07']=day($data['rec07']['date_h']); 
           //for 23
           $data['rec08']=$this->Josh_holiday->selectDay('08',$mm);
           $data['rec08']=day($data['rec08']['date_h']);
           //for 24
           $data['rec09']=$this->Josh_holiday->selectDay('09',$mm);
           $data['rec09']=day($data['rec09']['date_h']);
           //for 25
           $data['rec10']=$this->Josh_holiday->selectDay('10',$mm);
           $data['rec10']=day($data['rec10']['date_h']);
           //for 26
           $data['rec11']=$this->Josh_holiday->selectDay('11',$mm);
           $data['rec11']=day($data['rec11']['date_h']);
           //for 27
           $data['rec12']=$this->Josh_holiday->selectDay('12',$mm);
           $data['rec12']=day($data['rec12']['date_h']);
           //for 28
           $data['rec13']=$this->Josh_holiday->selectDay('13',$mm);
           $data['rec13']=day($data['rec13']['date_h']);
           //for 29
           $data['rec14']=$this->Josh_holiday->selectDay('14',$mm);
           $data['rec14']=day($data['rec14']['date_h']);
           //for 30
           $data['rec15']=$this->Josh_holiday->selectDay('15',$mm);
           $data['rec15']=day($data['rec15']['date_h']);
           
           //for 01
           $data['rec16']=$this->Josh_holiday->selectDay('16',$mm);
           $data['rec16']=day($data['rec16']['date_h']);
           //for 02
           $data['rec17']=$this->Josh_holiday->selectDay('17',$mm);
           $data['rec17']=day($data['rec17']['date_h']);
           //for 03
           $data['rec18']=$this->Josh_holiday->selectDay('18',$mm);
           $data['rec18']=day($data['rec18']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec19']=$this->Josh_holiday->selectDay('19',$mm);
           $data['rec19']=day($data['rec19']['date_h']); 
           //for 05
           $data['rec20']=$this->Josh_holiday->selectDay('20',$mm);
           $data['rec20']=day($data['rec20']['date_h']);
           }
              
        $data['m']=$m;
        $data['mm']=$mm;
        $data['mn']=$mn;
        //$data['n']=$m+1;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        
        //tampil templates
        if (($d=='05') && ($akhir==31)){
            $data['main']='admin/view_05_31';
             }
        elseif(($d=='05') && ($akhir==30)){
            $data['main']='admin/view_05_30';
            }
        elseif($d=='20'){
            $data['main']='admin/view_20';
            }
        $data['module']='time_report';    
        $this->load->vars($data);    
       	$this->load->template('default');     
    }
    
    
    
    
    function print_out1($id)
    {
        $data['title']=$id;
        $_SESSION['tr_code']=$id;
        //$no=$_SESSION['no'];
        //$name=$_SESSION['name'];
        //$data['no']=$no;
        //$data['name']=$name;
        //$data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //load staff
        $data['record']=$this->Josh_staff->getRecord(substr($id,3,5));
        $data['no']=$data['record']['no'];
        $data['name']=$data['record']['name'];
        $data['periode']=substr($id,9,2).'-'.substr($id,11,2).'-'.substr($id,13,4);
        //day
        $data['records']=$this->Josh_time_report->selectDetailsRecords($id);
        //report for chf
        $data['chf']=$this->Josh_time_report->selectchf($id);
        //report for cho
        $data['cho']=$this->Josh_time_report->selectcho($id);
        //report for nch
        $data['nch']=$this->Josh_time_report->selectnch($id);
        //Aproval By Admin
        //$data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        //$data['manager_name']=$data['adm_approval']['manager_name'];
        //$data['manager_signature']=$data['adm_approval']['manager_signature'];
        //$data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        //Aproval By Admin
        $data['adm_approval']=$this->Josh_time_report->getAdm_Approv($id);
        $data['manager_name']=$data['adm_approval']['manager_name'];
        $data['manager_signature']=$data['adm_approval']['manager_signature'];
        //Aproval By Hrd
        $data['hrd_approval']=$this->Josh_time_report->getHRD_Approv($id);
        $data['hrd_name']=$data['hrd_approval']['hrd_name'];
        $data['hrd_signature']=$data['hrd_approval']['hrd_signature'];
        //web system data 
        $data['module']='time_report';
        $data['main']='user/view';
        //template data
        $this->load->vars($data);
        //Menentukan Laporan Template
        $d=substr($id,9,2);
        $m=substr($id,12,1);
        $mm=substr($id,11,2);
        $mn=$m-1;
        
        if ($mn<9){
            $mn='0'.$mn;
        } else {$mn=$mn;}
        //echo $m;
        
        
        if($d=='05') {
            $m=$m-1;
            $n=$m;
            $makhir=5;
            $awal=21;
            switch($m)
            {
                case '1' : $akhir=31;break;
                case '2' : $akhir=28;break;
                case '3' : $akhir=31;break;
                case '4' : $akhir=30;break;
                case '5' : $akhir=31;break;
                case '6' : $akhir=30;break;
                case '7' : $akhir=31;break;
                case '8' : $akhir=31;break;
                case '9' : $akhir=30;break;
                case '10' : $akhir=31;break;
                case '11' : $akhir=30;break;
                case '12' : $akhir=31;break;
           }
              $xawal='01';
           $xakhir='05';
           
           $data['holiday_mn']=$this->Josh_holiday->selectholiday($mn,$awal,$akhir);
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$xawal,$xakhir);
           
           //for 21
           $data['rec21']=$this->Josh_holiday->selectDay(21,$mn);
           $data['rec21']=day($data['rec21']['date_h']); 
           //for 22
           $data['rec22']=$this->Josh_holiday->selectDay(22,$mn);
           $data['rec22']=day($data['rec21']['date_h']); 
           //for 23
           $data['rec23']=$this->Josh_holiday->selectDay(23,$mn);
           $data['rec23']=day($data['rec23']['date_h']);
           //for 24
           $data['rec24']=$this->Josh_holiday->selectDay(24,$mn);
           $data['rec24']=day($data['rec24']['date_h']);
           //for 25
           $data['rec25']=$this->Josh_holiday->selectDay(25,$mn);
           $data['rec25']=day($data['rec25']['date_h']);
           //for 26
           $data['rec26']=$this->Josh_holiday->selectDay(26,$mn);
           $data['rec26']=day($data['rec26']['date_h']);
           //for 27
           $data['rec27']=$this->Josh_holiday->selectDay(27,$mn);
           $data['rec27']=day($data['rec26']['date_h']);
           //for 28
           $data['rec28']=$this->Josh_holiday->selectDay(28,$mn);
           $data['rec28']=day($data['rec28']['date_h']);
           //for 29
           $data['rec29']=$this->Josh_holiday->selectDay(29,$mn);
           $data['rec29']=day($data['rec29']['date_h']);
           //for 30
           $data['rec30']=$this->Josh_holiday->selectDay(30,$mn);
           $data['rec30']=day($data['rec30']['date_h']);
           //for 31
           $data['rec31']=$this->Josh_holiday->selectDay(31,$mn);
           $data['rec31']=day($data['rec31']['date_h']);
           //for 01
           $data['rec01']=$this->Josh_holiday->selectDay(01,$mm);
           $data['rec01']=day($data['rec01']['date_h']);
           //for 02
           $data['rec02']=$this->Josh_holiday->selectDay(02,$mm);
           $data['rec02']=day($data['rec02']['date_h']);
           //for 03
           $data['rec03']=$this->Josh_holiday->selectDay(03,$mm);
           $data['rec03']=day($data['rec29']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec04']=$this->Josh_holiday->selectDay(04,$mm);
           $data['rec04']=day($data['rec04']['date_h']); 
           //for 05
           $data['rec05']=$this->Josh_holiday->selectDay(05,$mm);
           $data['rec05']=day($data['rec05']['date_h']);  
           }
           elseif($d=='20') {
             $akhir=20;
             $makhir=0;
             $awal=6;
           $data['holiday_mm']=$this->Josh_holiday->selectholiday($mm,$awal,$akhir);
           //for 21
           $data['rec06']=$this->Josh_holiday->selectDay('06',$mm);
           $data['rec06']=day($data['rec06']['date_h']); 
           //for 22
           $data['rec07']=$this->Josh_holiday->selectDay('07',$mm);
           $data['rec07']=day($data['rec07']['date_h']); 
           //for 23
           $data['rec08']=$this->Josh_holiday->selectDay('08',$mm);
           $data['rec08']=day($data['rec08']['date_h']);
           //for 24
           $data['rec09']=$this->Josh_holiday->selectDay('09',$mm);
           $data['rec09']=day($data['rec09']['date_h']);
           //for 25
           $data['rec10']=$this->Josh_holiday->selectDay('10',$mm);
           $data['rec10']=day($data['rec10']['date_h']);
           //for 26
           $data['rec11']=$this->Josh_holiday->selectDay('11',$mm);
           $data['rec11']=day($data['rec11']['date_h']);
           //for 27
           $data['rec12']=$this->Josh_holiday->selectDay('12',$mm);
           $data['rec12']=day($data['rec12']['date_h']);
           //for 28
           $data['rec13']=$this->Josh_holiday->selectDay('13',$mm);
           $data['rec13']=day($data['rec13']['date_h']);
           //for 29
           $data['rec14']=$this->Josh_holiday->selectDay('14',$mm);
           $data['rec14']=day($data['rec14']['date_h']);
           //for 30
           $data['rec15']=$this->Josh_holiday->selectDay('15',$mm);
           $data['rec15']=day($data['rec15']['date_h']);
           
           //for 01
           $data['rec16']=$this->Josh_holiday->selectDay('16',$mm);
           $data['rec16']=day($data['rec16']['date_h']);
           //for 02
           $data['rec17']=$this->Josh_holiday->selectDay('17',$mm);
           $data['rec17']=day($data['rec17']['date_h']);
           //for 03
           $data['rec18']=$this->Josh_holiday->selectDay('18',$mm);
           $data['rec18']=day($data['rec18']['date_h']);
           //$data['holday']=$this->Josh_holiday->selecthol($id);
           //for 04
           $data['rec19']=$this->Josh_holiday->selectDay('19',$mm);
           $data['rec19']=day($data['rec19']['date_h']); 
           //for 05
           $data['rec20']=$this->Josh_holiday->selectDay('20',$mm);
           $data['rec20']=day($data['rec20']['date_h']);
           }
              
        $data['m']=$m;
        $data['mm']=$mm;
        $data['mn']=$mn;
        //$data['n']=$m+1;
        $data['awal']=$awal;
        $data['makhir']=$makhir;
        $data['akhir']=$akhir;
        //tampil templates
        $this->load->vars($data);
        if (($d=='05') && ($akhir==31)){
            //$this->load->template('laporan05-31');
            $this->load->template('report_05_31');
             }
        elseif(($d=='05') && ($akhir==30)){
            //$this->load->template('laporan05-30');
            $this->load->template('report_05_30');
            }
        elseif($d=='20'){
            //$this->load->template('laporan20');
            $this->load->template('report_20');
            }    
    }
    
}