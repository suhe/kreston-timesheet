<?php
class User extends Controller {
	function User(){
		parent::Controller();
        session_start();
        if (!ISSET($_SESSION['no']) )
             { redirect('login/user/index',301); }
        $this->load->model('Josh_job');
        $this->load->module_model('client','Josh_company');
        $this->load->module_model('report','Report');
        $this->load->helper('date');
		set_time_limit(7200);
    }
    
    function index(){
        $data['title']  =   "Manage Job Desc";
        $data['records']=   $this->Josh_job->selectUserRecords(date('Y')-1,date(Y));
        $data['module'] =   'job_desc';
        $data['main']   =   'user/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function progress() {
		$data['title'] =  "Job Progress";
		$data['module'] =   'job_desc';
		$data['main']   =   'user/progress';
		$data['client_name'] = $this->session->userdata('progress.client_name');
		$data['staff_name'] = $this->session->userdata('progress.staff_name');
		$data['date_from'] = $this->session->userdata('progress.date_from');
		$data['date_to'] = $this->session->userdata('progress.date_to');
		$data['records']=   $this->Josh_job->getJobProgress($data["client_name"],$data["staff_name"],$data["date_from"],$data["date_to"]);
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function progress_query() {
		$this->session->set_userdata('progress.client_name',$this->input->post('client_name'));
		$this->session->set_userdata('progress.staff_name',$this->input->post('staff_name'));
		$this->session->set_userdata('progress.date_from',$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'));
		$this->session->set_userdata('progress.date_to',$this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2'));
		redirect('job_desc/user/progress',301);
	}
	
	public function progress_reset() {
		$this->session->unset_userdata('progress.client_name');
		$this->session->unset_userdata('progress.staff_name');
		$this->session->unset_userdata('progress.date_from');
		$this->session->unset_userdata('progress.date_to');
		redirect('job_desc/user/progress',301);
	}
	
	public function add_progress(){
        $data['title'] = "Create A New Job Progress";
        $data['module'] = 'job_desc';
        $data['main'] = 'user/add';
		$data['bind_client'] = $this->Josh_job->selectBindJobByCode(); 
        $this->load->vars($data);
		$this->load->template('default');
        
    }
	
	public function save_progress() {
		$this->data['staff_no'] = $_SESSION['no'];
		$this->data['date'] = date('Y-m-d');
		$this->data['job_code'] = $this->input->post('job_code');
		$this->data['progress'] = $this->input->post('progress');
		$this->db->insert('josh_job_progress',$this->data);
		$this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
		redirect('job_desc/user/progress',301);
	}
	
    function approval(){
		if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='M') ){
			$data['title']  =   "Manage Job Desc";
			$data['records']=   $this->Josh_job->selectUserSQLRecords($this->session->userdata('jperiode_start'),$this->session->userdata('jperiode_end'));
			$data['module'] =   'job_desc';
			$data['main']   =   'user/index';
			$this->load->vars($data);
			$this->load->template('default');
		}
		else 
		 { redirect('social/user/index',301); }
    }
    
	public function outstanding() {
		$data['title'] = "Outstanding Job Setup";
		$data['module'] =   'job_desc';
		$data['main'] = 'user/outstanding';
		$data['periode_from'] = $this->session->userdata('outstanding.periode_from') ? $this->session->userdata('outstanding.periode_from'):(date('Y') - 1); 
		$data['periode_to'] = $this->session->userdata('outstanding.periode_to')? $this->session->userdata('outstanding.periode_to'):(date('Y') - 1);
		$data['client_name'] = $this->session->userdata('outstanding.name'); 
		$data['records'] = $this->Josh_job->getClientFromJob('active',$data['periode_from'],$data['periode_to'],$data['client_name']);
		$data['table'] = '';
		if($data['records']>0) {
			$no = 1;
			foreach($data['records'] as $row) {
				$data['table'].= '<tr>';
				$data['table'].= '<td>'.$no.'</td>';
				$data['table'].= '<td colspan="3">'.$row['client_name'].'</td>';
				$data['table'].= '<td colspan="7">'.$row['contact_name'].'</td>';
				$data['table'].= '<td colspan="7">'.$row['address'].'</td>';
				$data['table'].= '<td>'.number_format($row['transport'],2).'</td>';
				$data['table'].= '<td></td>';
				$data['table'].= '</tr>';
				
				//project
				$jobs = $this->Josh_job->getJobFromClient('active',$row['code'],$data['periode_from'],$data['periode_to']);
				if(count($jobs)>0) {
					foreach($jobs as $job) {
						$data['table'].= '<tr>';
						$data['table'].= '<td></td>';
						$data['table'].= '<td>'.$job['code'].'</td>';
						$data['table'].= '<td>'.$job['periode'].'</td>';
						$data['table'].= '<td>'.$job['Manager_name'].'</td>';
						
						$data['table'].= '<td style="text-align:right">'.number_format($job['total_budget'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['M_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['M_cost'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['AM_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['AM_cost'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['S2_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['S2_cost'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['S1_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['S1_cost'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['AS_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['AS_cost'],0).'</td>';
						
						$data['table'].= '<td style="text-align:center">'.$job['TA_hour'].'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['TA_cost'],0).'</td>';
						
						$data['table'].= '<td colspan="2" style="text-align:right">'.number_format($job['total_cost'],0).'</td>';
						$data['table'].= '<td style="text-align:right">'.number_format($job['approve_charge']?($job['approve_charge'] * 100)/$job['total_budget']:0,2).'  %</td>';
						$data['table'].= '</tr>';
						
						
						
						$users = $this->Josh_job->getStaffFromJob($job['code']);
						if(count($users)>0) {
							$M_hour = '';
							$total_m_hour = 0;
							$M_cost = 0;
							$total_m_cost = 0;
							$AM_hour = '';
							$total_am_hour = 0;
							$AM_cost = 0;
							$total_am_cost = 0;
							$S2_hour = '';
							$total_s2_hour = 0;
							$S2_cost = 0;
							$total_s2_cost = 0;
							$S1_hour = '';
							$total_s1_hour = 0;
							$S1_cost = 0;
							$total_s1_cost = 0;
							$AS_hour = '';
							$total_as_hour = 0;
							$AS_cost = 0;
							$total_as_cost = 0;
							$TA_hour = '';
							$total_ta_hour = 0;
							$TA_cost = 0;
							$total_ta_cost = 0;
							$total_cost = 0;
							$x = 1;
							foreach($users as $user) {
								if($user['pos_code']=='M') {
									$M_hour = $user['hour'];
									$total_m_hour+=$user['hour'];
									$M_cost = $user['hour'] * $job['M'];
									$total_m_cost+= $user['hour'] * $job['M'];
								}
									
									
								if($user['pos_code']=='AM') {
									$AM_hour = $user['hour'];
									$total_am_hour+=$user['hour'];
									$AM_cost = $user['hour'] * $job['AM'];
									$total_am_cost+= $user['hour'] * $job['AM'];
								}
									
								if($user['pos_code']=='S2') {
									$S2_hour = $user['hour'];
									$total_s2_hour+=$user['hour'];
									$S2_cost = $user['hour'] * $job['S2'];
									$total_s2_cost+= $user['hour'] * $job['S2'];
								}
								
								if($user['pos_code']=='S1') {
									$S1_hour = $user['hour'];
									$total_s1_hour+=$user['hour'];
									$S1_cost = $user['hour'] * $job['S1'];
									$total_s1_cost+= $user['hour'] * $job['S1'];
								}
									
								if($user['pos_code']=='AS') {
									$AS_hour = $user['hour'];
									$total_as_hour+=$user['hour'];
									$AS_cost = $user['hour'] * $job['AS'];
									$total_as_cost+= $user['hour'] * $job['AS'];
								}
								
								if($user['pos_code']=='TA') {
									$TA_hour = $user['hour'];
									$total_ta_hour+=$user['hour'];
									$TA_cost = $user['hour'] * $job['TA'];
									$total_ta_cost+= $user['hour'] * $job['TA'];
								}
								
								$class = "color:red";
								
								$data['table'].= '<tr>';
								$data['table'].= '<td></td>';
								$data['table'].= '<td><a  style="'.$class.'" href="'.base_url().'/job_desc/user/timeuser/'.$user['staff_no'].'/'.$job['code'].'"/>'.$user['staff_no'].'</a></td>';
								$data['table'].= '<td colspan="2"><a style="'.$class.'"href="'.base_url().'/job_desc/user/timeuser/'.$user['staff_no'].'/'.$job['code'].'"/>'.$user['staff_name'].'</a></td>';
								$data['table'].= '<td style="text-align:center">'.$user['pos_code'].'</td>';
							
								$data['table'].= '<td style="text-align:center">'.$M_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($M_cost,0).'</td>';
								
								$data['table'].= '<td style="text-align:center">'.$AM_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($AM_cost,0).'</td>';
								
								$data['table'].= '<td style="text-align:center">'.$S2_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($S2_cost,0).'</td>';	
								
								$data['table'].= '<td style="text-align:center">'.$S1_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($S1_cost,0).'</td>';	
								
								$data['table'].= '<td style="text-align:center">'.$AS_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($AS_cost,0).'</td>';	
								
								$data['table'].= '<td style="text-align:center">'.$TA_hour.'</td>';
								$data['table'].= '<td style="text-align:right">'.number_format($TA_cost,0).'</td>';
								
								$data['table'].= '<td style="text-align:right" colspan="2">'.number_format($user['transport'],0).'</td>';
								$data['table'].= '<td style="text-align:right"></td>';
								
								$data['table'].= '</tr>';
								
								//clear text
								$M_hour = '';
								$M_cost = 0;
								$AM_hour = '';
								$AM_cost = 0;
								$S2_hour = '';
								$S2_cost = 0;
								$S1_hour = '';
								$S1_cost = 0;
								$AS_hour = '';
								$S1_cost = 0;
								$TA_hour = '';
								$TA_cost = 0;
								$total_cost = 0;
								$x++;
 								
							}
							
							//total budget hour
							$data['table'].= '<tr>';
							$data['table'].= '<td rowspan="2" colspan="2">Total Hour</td>';
							$data['table'].= '<td colspan="3">Budget</td>';
							$data['table'].= '<td style="text-align:center">M</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['M_time'].'</td>';
							$data['table'].= '<td style="text-align:center">AM</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['AM_time'].'</td>';
							$data['table'].= '<td style="text-align:center">S2</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['S2_time'].'</td>';
							$data['table'].= '<td style="text-align:center">S1</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['S1_time'].'</td>';
							$data['table'].= '<td style="text-align:center">AS</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['AS_time'].'</td>';
							$data['table'].= '<td style="text-align:center">TA</td>';	
							$data['table'].= '<td style="text-align:center">'.$job['TA_time'].'</td>';
							$data['table'].= '<td style="text-align:center" colspan="3"></td>';
							$data['table'].= '</tr>';
							
							//total Real hour
							$data['table'].= '<tr>';
							$data['table'].= '<td colspan="3">Real</td>';
							$data['table'].= '<td style="text-align:center">M</td>';
							$data['table'].= '<td style="text-align:center">'.$total_m_hour.'</td>';
							$data['table'].= '<td style="text-align:center">AM</td>';	
							$data['table'].= '<td style="text-align:center">'.$total_am_hour.'</td>';
							$data['table'].= '<td style="text-align:center">S2</td>';	
							$data['table'].= '<td style="text-align:center">'.$total_s2_hour.'</td>';
							$data['table'].= '<td style="text-align:center">S1</td>';	
							$data['table'].= '<td style="text-align:center">'.$total_s1_hour.'</td>';
							$data['table'].= '<td style="text-align:center">AS</td>';	
							$data['table'].= '<td style="text-align:center">'.$total_as_hour.'</td>';
							$data['table'].= '<td style="text-align:center">TA</td>';	
							$data['table'].= '<td style="text-align:center">'.$total_ta_hour.'</td>';
							$data['table'].= '<td style="text-align:center" colspan="3"></td>';
							$data['table'].= '</tr>';
							
							//total budget cost
							$data['table'].= '<tr>';
							$data['table'].= '<td rowspan="2" colspan="2">Total Cost</td>';
							$data['table'].= '<td colspan="3">Budget</td>';
							$data['table'].= '<td style="text-align:center">M</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['M_time'] * $job['M'] ,2).'</td>';
							$data['table'].= '<td style="text-align:center">AM</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['AM_time'] * $job['AM'],2).'</td>';
							$data['table'].= '<td style="text-align:center">S2</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['S2_time'] * $job['S2'],2) .'</td>';
							$data['table'].= '<td style="text-align:center">S1</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['S1_time'] * $job['S1'],2).'</td>';
							$data['table'].= '<td style="text-align:center">AS</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['AS_time'] * $job['AS'],2).'</td>';
							$data['table'].= '<td style="text-align:center">TA</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($job['TA_time'] * $job['TA'],2).'</td>';
							$data['table'].= '<td style="text-align:center" colspan="3">-</td>';
							$data['table'].= '</tr>';
							
							//total Real cost
							$data['table'].= '<tr>';
							$data['table'].= '<td colspan="3">Real</td>';
							$data['table'].= '<td style="text-align:center">M</td>';
							$data['table'].= '<td style="text-align:center">'.number_format($total_m_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center">AM</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($total_am_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center">S2</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($total_s2_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center">S1</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($total_s1_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center">AS</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($total_as_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center">TA</td>';	
							$data['table'].= '<td style="text-align:center">'.number_format($total_ta_cost,2).'</td>';
							$data['table'].= '<td style="text-align:center" colspan="3">-</td>';
							$data['table'].= '</tr>';
							
							
							
							
						}
						
					}
				}
				
				$no++;
			}
			
		}
		$this->load->vars($data);
		$this->load->template('default');
	}
	
	public function timeuser($no,$job_code) {
        $data['title']=" Job Desc Details"; //title
        $data['records'] = $this->Josh_job->getEmployeeTimeUser($no,$job_code); 
		$data['module']='job_desc';
        $data['main']='user/timeuser';
		$data['table'] = "";
		//bind
		if($data['records']) {
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
			$time = 0;
			$xclass = 1;
			foreach( $data['records'] as $row) {
				$data['table'] .= "<tr>";
				$data['table'] .= "<td>".$i."</td>";
				$data['table'] .= "<td>".$row['date']."</td>";
				$data['table'] .= "<td>".$row['job_name']."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['time']."</td>";
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
				$data['table'] .= "<td style='text-align:right'>".strtoupper($row['app'])."</td>";
				$data['table'] .= "<td style='text-align:right'>".number_format($row['total'],2)."</td>";
				$data['table'] .= "<td style='text-align:right'>".$row['activity']."</td>";
				$data['table'] .= "</tr>";
				$i++;
				$xclass++;
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
				$time+=$row["time"];
				
				if(strtoupper($row['app'])=='YES')
					$total_app+=$row['total'];
			}
			
			//subtotal
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='3' style='text-align:right'>Total</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".$time."</td>";
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
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'></td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'>".number_format($total,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'></td>";
			$data['table'] .= "</tr>";
			
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='15' style='text-align:right;padding:15px 5px'></td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'></td>";
			$data['table'] .= "</tr>";
			
			
			//total by App
			$data['table'] .= "<tr>";
			$data['table'] .= "<td colspan='15' style='text-align:right'>Sub Total By Approved</td>";
			$data['table'] .= "<td style='text-align:right'>".number_format($total_app,2)."</td>";
			$data['table'] .= "<td style='text-align:right;font-weight:bolder'></td>";
			$data['table'] .= "</tr>";
			
		}
        $this->load->vars($data);
		$this->load->template('default');
    }
	
	public function outstanding_query() {
		$this->session->set_userdata('outstanding.periode_from',$_POST['year_from']);
		$this->session->set_userdata('outstanding.periode_to',$_POST['year_to']);
		$this->session->set_userdata('outstanding.name',$_POST['query']);
		redirect('job_desc/user/outstanding',301);
	}
	
	public function outstanding_excel() {
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("Job Project")
                    ->setDescription("Job Project By Client  ");
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
		
		//start
		$row=1;
		$col=0;
		
		/* No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,'No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 0)->setWidth(5);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 0,$row+2);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row + 1)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row + 2)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Client Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,'Client Name');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 1,$row,$col + 3,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Contact Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,'Contact Name');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 4,$row,$col + 9,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Location */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,'Location');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 10,$row,$col + 15,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Transport */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,'Transport');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 16)->setWidth(18);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Recovery Rate */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,'Recovery Rate');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 17)->setWidth(15);
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 17,$row,$col + 17,$row+1);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row + 1)->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row + 2)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		// baris kedua
		
		$row++;
		
		/* Job Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,'Job Code');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 1)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Periode */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2,$row,'Periode');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 2)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Manager */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,'Manager');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 3)->setWidth(25);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Total Budget */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 4)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Manager */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,'Manager');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 5,$row,$col + 6,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* ASS Manager */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,'Ass.Manager');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 7,$row,$col + 8,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Senior 2 */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,'Senior 2');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 9,$row,$col + 10,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Senior 1 */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,'Senior 1');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 11,$row,$col + 12,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* AS */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,'Assistant');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 13,$row,$col + 14,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* TA */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,'Tech Assistant');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 15,$row,$col + 16,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		
		
		$row++;
		/* Staff No */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,'Staff No');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 1)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2,$row,'Staff Name');
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 2,$row,$col + 3,$row);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Pos */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,'Position');
		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 1)->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Manager Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 5)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Manager Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 6)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Ass Manager Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 7)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Ass Manager Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 8)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* S2 Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 9)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* S2 Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 10)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* S1 Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 11)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* S1 Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 12)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* AS Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 13)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* AS Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 14)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* TA Real Hour */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,'Real Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 15)->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* TA Real Cost */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,'Real Cost');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 16)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		/* Transport  */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,'Transport');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 17)->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getFill()->applyFromArray($fill);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
		
		
		//calculation
		$data['periode_from'] = $this->session->userdata('outstanding.periode_from') ? $this->session->userdata('outstanding.periode_from'):(date('Y') - 1); 
		$data['periode_to'] = $this->session->userdata('outstanding.periode_to')? $this->session->userdata('outstanding.periode_to'):(date('Y') - 1);
		$data['client_name'] = $this->session->userdata('outstanding.name'); 
		$data['records'] = $this->Josh_job->getClientFromJob('active',$data['periode_from'],$data['periode_to'],$data['client_name']);
		
		if(count($data['records'])) {
			$row++;
			$no = 1;
			foreach($data['records'] as $client) {
				/* No */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,$no);
				//$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 0,$row + 2);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row + 1)->applyFromArray($styleArray);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row + 2)->applyFromArray($styleArray);
				
				/* Client Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,$client["client_name"]);
				$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 1,$row,$col + 3,$row);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_LEFT);
				
				/* Contact Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,$client["contact_name"]);
				$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 4,$row,$col + 9,$row);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_LEFT);
				
				/* Location */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$client["address"]);
				$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 10,$row,$col + 15,$row);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_LEFT);
				
				/* Transport */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$client["transport"]);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getNumberFormat()->setFormatCode('#,##0');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row + 1)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row + 2)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
				//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_RIGHT);
				
				/* Recovery Rate */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,"");
				//$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 17,$row,$col + 17,$row + 2);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row + 1)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row + 2)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
				
				$jobs = $this->Josh_job->getJobFromClient('active',$client['code'],$data['periode_from'],$data['periode_to']);
				if($jobs) {
					$no2 = 1;
					$row++;
					foreach($jobs as $job) {
						/** No **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,$no.'.'.$no2);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
						
						/** Job Code **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,$job["code"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
						
						/** Periode **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2,$row,$job["periode"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
						
						/** Manager Name **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,$job["Manager_name"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
						
						/** Total Budget **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,$job["total_budget"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** Manager Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,$job["M_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
						
						/** Manager Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$job["M_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** Ass Manager Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,$job["AM_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
						
						/** ASS Manager Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$job["AM_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** S2 Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,$job["S2_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
						
						/** S2 Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$job["S2_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** S1 Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,$job["S1_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
						
						/** S1 Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$job["S1_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** AS Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,$job["AS_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
						
						/** AS Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$job["AS_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** TA Real **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,$job["TA_hour"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
						
						/** TA Cost **/
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$job["TA_cost"]);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getNumberFormat()->setFormatCode('#,##0');
						
						/** Recovery Rate **/
						
						$rate = $job['approve_charge']?($job['approve_charge'] * 100)/$job['total_budget']:0;
						
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,$rate);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getNumberFormat()->setFormatCode('#,##0.00');
						
						$users = $this->Josh_job->getStaffFromJob($job['code']);
						if(count($users)>0) {
							$row++;
							$no3 = 1;
														$M_hour = '';
							$total_m_hour = 0;
							$M_cost = 0;
							$total_m_cost = 0;
							$AM_hour = '';
							$total_am_hour = 0;
							$AM_cost = 0;
							$total_am_cost = 0;
							$S2_hour = '';
							$total_s2_hour = 0;
							$S2_cost = 0;
							$total_s2_cost = 0;
							$S1_hour = '';
							$total_s1_hour = 0;
							$S1_cost = 0;
							$total_s1_cost = 0;
							$AS_hour = '';
							$total_as_hour = 0;
							$AS_cost = 0;
							$total_as_cost = 0;
							$TA_hour = '';
							$total_ta_hour = 0;
							$TA_cost = 0;
							$total_ta_cost = 0;
							$total_cost = 0;
							
							$x = 1;
							foreach($users as $user) {
								if($user['pos_code']=='M') {
									$M_hour = $user['hour'];
									$total_m_hour+=$user['hour'];
									$M_cost = $user['hour'] * $job['M'];
									$total_m_cost+= $user['hour'] * $job['M'];
								}
									
									
								if($user['pos_code']=='AM') {
									$AM_hour = $user['hour'];
									$total_am_hour+=$user['hour'];
									$AM_cost = $user['hour'] * $job['AM'];
									$total_am_cost+= $user['hour'] * $job['AM'];
								}
									
								if($user['pos_code']=='S2') {
									$S2_hour = $user['hour'];
									$total_s2_hour+=$user['hour'];
									$S2_cost = $user['hour'] * $job['S2'];
									$total_s2_cost+= $user['hour'] * $job['S2'];
								}
								
								if($user['pos_code']=='S1') {
									$S1_hour = $user['hour'];
									$total_s1_hour+=$user['hour'];
									$S1_cost = $user['hour'] * $job['S1'];
									$total_s1_cost+= $user['hour'] * $job['S1'];
								}
									
								if($user['pos_code']=='AS') {
									$AS_hour = $user['hour'];
									$total_as_hour+=$user['hour'];
									$AS_cost = $user['hour'] * $job['AS'];
									$total_as_cost+= $user['hour'] * $job['AS'];
								}
								
								if($user['pos_code']=='TA') {
									$TA_hour = $user['hour'];
									$total_ta_hour+=$user['hour'];
									$TA_cost = $user['hour'] * $job['TA'];
									$total_ta_cost+= $user['hour'] * $job['TA'];
								}
								
								/* Staff No */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,$no.'.'.$no2.'.'.$no3);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_LEFT);
								
								
								/* Staff No */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1,$row,$user["staff_no"]);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_LEFT);
								
								/* Staff Name */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2,$row,$user["staff_name"]);
								$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 2,$row,$col + 3,$row);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
								
								/* Pos */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 4,$row,$user["pos_code"]);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 1)->setWidth(20);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* Manager Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,$M_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 5)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getFill()->applyFromArray($fill);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* Manager Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$M_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 6)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getFill()->applyFromArray($fill);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* Ass Manager Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,$AM_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 7)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* Ass Manager Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$AM_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 8)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* S2 Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,$S2_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 9)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* S2 Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$S2_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 10)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* S1 Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,$S1_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 11)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* S1 Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$S1_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 12)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* AS Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,$AS_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 13)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* AS Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$AS_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 14)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* TA Real Hour */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,$TA_hour);
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 15)->setWidth(10);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* TA Real Cost */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$TA_cost);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 16)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								/* Transport */
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,$user["transport"]);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getNumberFormat()->setFormatCode('#,##0');
								//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col + 16)->setWidth(15);
								$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getFill()->applyFromArray($fill);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
								//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
												
																	
								//clear text
								$M_hour = '';
								$M_cost = 0;
								$AM_hour = '';
								$AM_cost = 0;
								$S2_hour = '';
								$S2_cost = 0;
								$S1_hour = '';
								$S1_cost = 0;
								$AS_hour = '';
								$S1_cost = 0;
								$TA_hour = '';
								$TA_cost = 0;
								$total_cost = 0;
								$no3++;
								$row++;
								//$x++;
 								
							}
							
							$row++;
							//Total Subtotal
							/* Total Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,"Total");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 2,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Budget */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,"Budget");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 3,$row,$col + 4,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,"M");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$job["M_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,"AM");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$job["AM_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,"S2");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$job["S2_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* S1  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,"S1");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S1 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$job["S1_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* AS  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,"AS");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* AS Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$job["AS_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* TA  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,"TA");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* TA Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$job["TA_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							
							/* Blank */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,"");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							
							
							
							$row++;
							
							/* Total Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,"Hour");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 2,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
								
								
							/* Real */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,"Real");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 3,$row,$col + 4,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,"M");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$total_m_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,"AM");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$total_am_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,"S2");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$total_s2_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* S1  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,"S1");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S1 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$total_s1_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* AS  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,"AS");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* AS Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$total_as_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* TA  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,"TA");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* TA Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$total_ta_hour);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							
							/* Blank */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,"");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							$row = $row + 2;
							
							/* Total Cost */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,"Total");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 2,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Budget */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,"Budget");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 3,$row,$col + 4,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,"M");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$job["M"] * $job["M_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,"AM");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$job["AM"] * $job["AM_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,"S2");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$job["S2"] * $job["S2_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* S1  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,"S1");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S1 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$job["S1"] * $job["S1_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* AS  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,"AS");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* AS Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$job["AS_time"] * $job["AS_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* TA  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,"TA");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* TA Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$job["TA"] * $job["TA_time"]);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							
							/* Blank */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,"");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							$row++;
							
							/* Total Cost */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 0,$row,"Cost");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 0,$row,$col + 2,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 1,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 2,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 0,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							
								
								
							/* Real */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 3,$row,"Real");
							$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col + 3,$row,$col + 4,$row);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 4,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 3,$row)->getAlignment()->setHorizontal(Style_Alignment::HORIZONTAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 5,$row,"M");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 5,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 6,$row,$total_m_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 6,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 7,$row,"AM");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 7,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Ass Manager Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 8,$row,$total_am_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 8,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 9,$row,"S2");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 9,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S2 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 10,$row,$total_s2_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 10,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							
							/* S1  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 11,$row,"S1");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 11,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* S1 Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 12,$row,$total_s1_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 12,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* AS  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 13,$row,"AS");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 13,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* AS Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 14,$row,$total_as_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 14,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
											
							/* TA  Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 15,$row,"TA");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 15,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* TA Real Hour */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 16,$row,$total_ta_cost);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 16,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
							
							/* Blank */
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 17,$row,"");
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col + 17,$row)->getAlignment()->setVertical(Style_Alignment::VERTICAL_CENTER);
										
								
							
							
							
						}
						
						$row++;
						$no2++;
					}
				}
				
				$no++;
				$row++;
			}
		}
		
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel2007");
		$file="Job-Project.xlsx";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
		
		
	}
	
	function refreshjob(){
		$jobs = $this->Josh_job->selectJobRefresh();
		foreach($jobs as $v){
			switch($v['pos']){
				case 'M'  : $update = " M_hour  = ".$v['thour'];break;
				case 'AM' : $update = " AM_hour = ".$v['thour'];break;
				case 'S2' : $update = " S2_hour = ".$v['thour'];break;
				case 'S1' : $update = " S1_hour = ".$v['thour'];break;
				case 'AS' : $update = " AS_hour = ".$v['thour'];break;
				case 'TA' : $update = " TA_hour = ".$v['thour'];break;
			}
			//update
			$sql = " UPDATE josh_job SET $update WHERE code = '".$v['job']."'";	
			$this->db->query($sql); 
		}
		redirect('job_desc/user/approval',301);
	}
	
	
	
	function export_excel(){
        $records = $this->Josh_job->selectUserSQLRecords($this->session->userdata('jperiode_start'),$this->session->userdata('jperiode_end'));
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
		
       
                
		/* NIK */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Job Code');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Periode');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Job Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Manager');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Hour Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);

		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'M Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'M Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'AM Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+11)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,'AM Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+12)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+13)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,'S2 Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+14)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+15)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,'S2 Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+16)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+17)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,'S1 Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+18)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+19)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,'S1 Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+20)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+21,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+21)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+22,$row,'AS Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+22)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+23,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+23)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,'AS Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+24)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+25,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+25)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+26,$row,'TA Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+26)->setWidth(5);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+27,$row,'Total Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+27)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+28,$row,'TA Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+28)->setWidth(5);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+29,$row,'Total Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+29)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+30,$row,'Hour Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+30)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+31,$row,'Budget Real');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+31)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+32,$row,'Selisih Hour');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+32)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+33,$row,'Selisih Budget');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+33)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->getFill()->applyFromArray($fill);
		
		$row=$row+1;
		
		foreach($records as $rec):
			/*  No */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['code']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
			
			/* Name */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['periode']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
		
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
			
			/*  */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['Manager_name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,$hour_budget=$rec['M_time']+$rec['AM_time']+$rec['S2_time']+$rec['S1_time']+$rec['AS_time']+$rec['TA_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$budget=$rec['approve_charge']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,$m_time=$rec['M_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$mbudget=$rec['M_time']*$rec['M']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$m_hour=$rec['M_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$m=$rec['M_hour']*$rec['M']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$am_time=$rec['AM_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$ambudget=$rec['AM_time']*$rec['AM']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$am_hour=$rec['AM_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,$am=$rec['AM_hour']*$rec['AM']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,$s2_time=$rec['S2_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,$s2budget=$rec['S2_time']*$rec['S2']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,$s2_hour=$rec['S2_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,$s2=$rec['S2_hour']*$rec['S2']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,$s1_time=$rec['S1_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,$s1budget=$rec['S1_time']*$rec['S1']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,$s1_hour=$rec['S1_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+21,$row,$s1=$rec['S1_hour']*$rec['S1']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+22,$row,$as_time=$rec['AS_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+23,$row,$asbudget=$rec['AS_time']*$rec['AS']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,$as_hour=$rec['AS_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+24,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+25,$row,$as=$rec['AS_hour']*$rec['AS']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+26,$row,$ta_time=$rec['TA_time']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+27,$row,$tabudget=$rec['TA_time']*$rec['TA']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+28,$row,$ta_hour=$rec['TA_hour']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+29,$row,$ta=$rec['TA_hour']*$rec['TA']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);
			
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+30,$row,$hour_real= $m_hour+$am_hour+$s2_hour+$s1_hour+$as_hour+$ta_hour );
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);
			
			/* d */
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+31,$row,$real=$m+$am+$s2+$s1+$as+$ta);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
		    
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+32,$row,$hour_budget-$hour_real);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+33,$row,$budget-$real);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);
			
			$row++;
			$ov =$users = $this->Josh_job->selectUserJob($rec['code']);
			if($ov){
			 foreach($ov as $v){
				/*  No */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
				
				/* Name */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$v['staff_no']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
			
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$v['staff_name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
				
				/*  */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$v['pos_code']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$v['M']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$m_budget=$v['M_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$v['AM']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,$am_budget=$v['AM_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,$v['S2']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,$s2_budget=$v['S2_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
				
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,$v['S1']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+21,$row,$s1_budget=$v['S1_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+21,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+22,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+22,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+23,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+23,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+24,$row,$v['ASS']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+25,$row,$as_budget=$v['ASS_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+25,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+26,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+26,$row)->applyFromArray($styleArray);
				
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+27,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+27,$row)->applyFromArray($styleArray);
				
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+28,$row,$v['TA']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+28,$row)->applyFromArray($styleArray);
				
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+29,$row,$ta_budget=$v['TA_budget']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+29,$row)->applyFromArray($styleArray);
				
				/* d  $m_budget+$am_budget+$s2_budget+$s1_budget+$as_budget+$ta_budget */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+30,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+30,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+31,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+31,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+32,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+32,$row)->applyFromArray($styleArray);
				
				/* d */
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+33,$row,'');
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+33,$row)->applyFromArray($styleArray);
				
				$row++;
			} 
			}
			$row++;
			$row=$row+1;
		endforeach;
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="JobDesc.xls";
		$objWriter->save($file);
		redirect($file,301);
	}
	
	function searchjob(){
		$this->session->set_userdata('jperiode_start',$this->input->post('month').'-'.$this->input->post('year'));
		$this->session->set_userdata('jperiode_end',$this->input->post('month2').'-'.$this->input->post('year2'));
		redirect($this->input->server('HTTP_REFERER'),301);
	}
  
    function export_excel2($id=0) {
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
           $file="assets/excel/activity_code.xls";
	   $objWriter->save($file);
           $this->index(); //CALL DISPLAY
	   redirect('/'.$file,301);
    }

}    
