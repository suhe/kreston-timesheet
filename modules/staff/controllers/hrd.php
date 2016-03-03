<?php
class Hrd extends Controller 
{
	function Hrd(){
	  parent::Controller();
        session_start();
        if  ($_SESSION['level']<>'HRD'){
                redirect('login/user/index',301);
        }
        $this->load->model('Josh_staff');
        $this->load->module_model('group','Josh_group');
        $this->load->module_model('status','Josh_status');
        $this->load->model('Josh_staff');
        $this->load->helper('date');         	
	}
    
    function index(){
        $data['title']="Manage Staff For HRD";
        $data['records']=$this->Josh_staff->selectRecords();
        $data['module']='staff';
        $data['main']='hrd/index';
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function status_active($id){
        $data['status'] = 'active';
        $this->db->where('no',$id);
        $this->db->update('josh_staff',$data);
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('staff/hrd/index',301);      
    }


   function status_deactive($id){
        $data['status'] = 'deactive';
        $this->db->where('no',$id);
        $Q= $this->db->update('josh_staff',$data);
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('staff/hrd/index',301);      
    }
    
    function add()
    {
        //title
        $data['title']="Create A New Staff";
        //Database
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bindPos']=$this->Josh_status->selectRecords();
        //web system data 
        $data['module']='staff';
        $data['main']='hrd/add';
        //template data
        $this->load->vars($data);
		$this->load->template('default');    
    }
    
    function save()
	{ 
        $this->Josh_staff->saveRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Save Succesfully !</div>');
        redirect('staff/hrd/index',301); 
             		
	}
    
    function view($id=0)
    {
        $data['title']="Edit Profile Staff"; 
        $data['records']=$this->Josh_staff->getRecord($id);
        $data['no']=$data['records']['no'];
        $data['name']=$data['records']['name'];
        $data['photo']=$data['records']['photo'];
        $data['sex']=$data['records']['sex'];
        $data['job']=$data['records']['job_position'];
        $data['password']=$data['records']['password'];
        $data['day']= day($data['records']['birthday']); 
        $data['month']= month($data['records']['birthday']);
        $data['year']= year($data['records']['birthday']);
        $data['dayin']= day($data['records']['staff_date']); 
        $data['monthin']= month($data['records']['staff_date']);
        $data['yearin']= year($data['records']['staff_date']);
		$data['dayout']= day($data['records']['staff_out']); 
        $data['monthout']= month($data['records']['staff_out']);
        $data['yearout']= year($data['records']['staff_out']);
        $data['email']=$data['records']['email'];
        $data['address']=$data['records']['address'];
        $data['hp']=$data['records']['hp'];
        $data['city']=$data['records']['city'];
        $data['country']=$data['records']['country'];
        $data['pos_code']=$data['records']['pos_code'];
        $data['group_id']=$data['records']['group_id'];
        $data['name_p']=$data['records']['name_p'];
        $data['group_name']=$data['records']['group_name'];
        $data['sal_bas']=$data['records']['sal_bas'];
        $data['allow_1']=$data['records']['allow_1'];
        $data['allow_2']=$data['records']['allow_2'];
        $data['staff_transport']=$data['records']['staff_transport'];        
        $data['staff_outmeal']=$data['records']['staff_outmeal'];        
        //web system data 
        $data['bindGroup']=$this->Josh_group->selectRecords();
        $data['bindPos']=$this->Josh_status->selectRecords();
        $data['module']='staff';
        $data['main']='hrd/edit';
        //template data
        $this->load->vars($data);
		$this->load->template('default'); 
    }
    
    function update()
	{ 
        $this->Josh_staff->updateRecord();
        $this->session->set_flashdata('message','<div class=" message success"> Update Succesfully !</div>');
        redirect('staff/hrd/index',301);          		
	}
    
    function drop($id)
	{
		$this->Josh_staff->deleteRecord($id);
            $this->session->set_flashdata('message','<div class=" message success">Delete Succesfully !</div>');
		redirect('staff/hrd/index',301);
	}
	
	function excel($id=0){
		//$_SESSION['periode']= $id;
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
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,'Staff No');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->getFill()->applyFromArray($fill);
		
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,'Staff Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+1)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->getFill()->applyFromArray($fill);
		
		/* Nick Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,'Nick Name');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+2)->setWidth(13);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->getFill()->applyFromArray($fill);
		
		
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,'Pos');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+3)->setWidth(8);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,'Tanggal Masuk');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+4)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,'Kelamin');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+5)->setWidth(15);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,'Tanggal Lahir');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+6)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,'Email');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+7)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->getFill()->applyFromArray($fill);
		
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,'Alamat');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+8)->setWidth(35);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,'Kota');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+9)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,'Warga Negara');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+10)->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,'');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+11)->setWidth(0);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,'Lembur');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+12)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,'Jam Kerja');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+13)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->getFill()->applyFromArray($fill);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,'Total');
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col+14)->setWidth(10);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->getFill()->applyFromArray($fill);
		
		$endday=date('Y')-1;
		$sql =" SELECT js.no,js.name,js.nickname,js.staff_date,js.birthday,js.sex,js.email,js.address,js.city,";
        $sql.=" js.country,js.pos_code,SUM(jddt.time) as timer,SUM(jddt.over_time) as over_time ";
		$sql.=" FROM josh_head_tr jht";
		$sql.=" JOIN josh_details_day_tr jddt ON jddt.tr_code = jht.tr_code";
		$sql.=" JOIN josh_staff js ON js.no = jht.staff_no";
		$sql.=" WHERE jddt.type_job <> 'nch' ";
                $sql.=" AND jddt.date<='$endday-12-31'";
		$sql.=" GROUP BY jht.staff_no ";
		$sql.=" ORDER BY jht.staff_no ";
		$Q = $this->db->query($sql);
		$records=$Q->result_array();
		
		$row=$row+1;
		foreach($records as $rec):
			/* Staff Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$rec['no']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row)->applyFromArray($styleArray);
		/* Staff Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1,$row,$rec['name']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+1,$row)->applyFromArray($styleArray);
    
		/* Pos Code */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row,$rec['nickname']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+2,$row)->applyFromArray($styleArray);
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+3,$row,$rec['pos_code']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+3,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+4,$row,indo_tgl($rec['staff_date']));
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+4,$row)->applyFromArray($styleArray);
       
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+5,$row,$rec['sex']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+5,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+6,$row,indo_tgl($rec['birthday']));
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+6,$row)->applyFromArray($styleArray);
       
		
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+7,$row,$rec['email']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+7,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+8,$row,$rec['address']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+8,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+9,$row,$rec['city']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+9,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+10,$row,$rec['country']);
		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+10,$row)->applyFromArray($styleArray);
        
		 /* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$rec['timer']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$rec['over_time']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
        
		/* Cust Name */  
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,$rec['timer']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
        
		/* Cust Name */  
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,$rec['timer']+$rec['over_time']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
        
		$row=$row+1;
		endforeach;
		
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
		$file="staff_list.xls";
		$objWriter->save('assets/excel/'.$file);
		redirect('assets/excel/'.$file,301);
	}
    
    
    
}    
