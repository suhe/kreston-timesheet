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
        $data['title']="Recovery Summary";
        //database
        $data['records']=$this->Josh_summary->selectRecords();
        //web system data 
        $data['module']='rec_summary';
        $data['main']='hrd/index';
        //template data
        $this->load->vars($data);
		$this->load->template('default');
    }
    
    function print_out($id){
        $data['title']=$id;
        $data['id']=$id;
        $data['periode']=indo_tgl($id);
        $data['group']=$this->Josh_summary->getGroup();
        //$data['records']=$this->Josh_summary->getRecords($id);
        //template data
        $this->load->vars($data);
		$this->load->template('summary');
    }
	
      function excel($id) {
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
	  
	  $sql="  SELECT jj.code,jj.name as client,SUM(jddt.time)+ SUM(jddt.over_time_app) as time ,jj.approve_charge as fee";
	  $sql.=" FROM josh_details_day_tr jddt";
	  $sql.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code";
      $sql.=" JOIN josh_job jj ON jj.code=jdt.job_code";
      $sql.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code";
      $sql.=" JOIN josh_staff js ON js.no=jht.staff_no";
	  $sql.=" WHERE jht.periode='".$id."'  GROUP BY jdt.job_code ORDER BY jdt.job_code ASC";
	  $q=$this->db->query($sql);
      $rows=$q->result_array();
	  $i=2;
      foreach($rows as $row):
	    $objPHPExcel->getActiveSheet()->setCellValue("A".$i,$row['code']);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$row['client']);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i,$row['time']);
        $sql2 = " SELECT SUM(jddt.time)+ SUM(jddt.over_time_app) as time,jj.SP,jj.PC as PIC,jj.SM,jj.M,jj.AM,jj.S2,jj.S1,jj.AS,jj.TA "; 
		$sql2.= " FROM josh_details_day_tr jddt ";
		$sql2.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code ";
		$sql2.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
		$sql2.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code ";
		$sql2.=" JOIN josh_staff js ON js.no=jht.staff_no ";
		$sql2.=" WHERE jht.periode='".$id."' ";
		$sql2.=" AND jdt.job_code='".$row['code']."' ";
		
		
		//for SP
		$sqlSP = $sql2. " AND jht.pos_code ='SP' ";
		$sqlSP.=" GROUP BY jdt.job_code ";
		$sp=$this->db->query($sqlSP);
        $sp=$sp->row_array();
		if(COUNT($sp) > 0 ):
			$rp=$sp['SP'];
			$sp=$sp['time'];
		else:
		    $rp=0;
			$sp=0;
		endif;
		$rp_sp = $sp * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("C".$i,$sp);
		
		//for PIC
		$sqlPIC = $sql2. " AND jht.pos_code ='PIC' ";
		$sqlPIC.=" GROUP BY jdt.job_code ";
		$pic=$this->db->query($sqlPIC);
        $pic=$pic->row_array();
		if(COUNT($pic) > 0 ):
			$pic=$pic['time'];
			$rp =$pic['PIC'];
			
		else:
		    $rp=0;
			$pic=0;
			
		endif;
		$rp_pic = $pic * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("D".$i,$pic);
		
		//for SM
		$sqlSM = $sql2. " AND jht.pos_code ='SM' ";
		$sqlSM.=" GROUP BY jdt.job_code ";
		$sm=$this->db->query($sqlSM);
        $sm=$sm->row_array();
		if(COUNT($sm) > 0 ):
			$rp =$sm['SM'];
			$sm=$sm['time'];
		else:
		    $rp=0;
			$sm=0;
			//$rp =$sm['SM'];
		endif;
		$rp_sm = $sm * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("E".$i,$sm);
		
		//for M
		$sqlM = $sql2. " AND jht.pos_code ='M' ";
		$sqlM.=" GROUP BY jdt.job_code ";
		$m=$this->db->query($sqlM);
        $m=$m->row_array();
		if(COUNT($m) > 0 ):
		    $rp =$m['M'];
			$m=$m['time'];
		else:
		     $rp=0;
			$m=0;
		endif;
		$rp_m = $m * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("F".$i,$m);
		//for AM
        $sqlAM = $sql2. " AND jht.pos_code ='AM' ";
		$sqlAM.=" GROUP BY jdt.job_code ";
		$am=$this->db->query($sqlAM);
        $am=$am->row_array();
		if(COUNT($am) > 0 ):
		    $rp =$am['AM'];
			$am=$am['time'];
		else:
		     $rp=0;
			$am=0;
		endif;
		$rp_am = $am * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("G".$i,$am);
		
		//for S2
        $sqlS2 = $sql2. " AND jht.pos_code ='S2' ";
		$sqlS2.=" GROUP BY jdt.job_code ";
		$s2=$this->db->query($sqlS2);
        $s2=$s2->row_array();
		if(COUNT($s2) > 0 ):
		    $rp =$s2['S2'];
			$s2=$s2['time'];
		else:
		     $rp=0;
			$s2=0;
		endif;
		$rp_s2 = $s2 * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("H".$i,$s2);
		
		//for S1
        $sqlS1 = $sql2. " AND jht.pos_code ='S1' ";
		$sqlS1.=" GROUP BY jdt.job_code ";
		$s1=$this->db->query($sqlS1);
        $s1=$s1->row_array();
		if(COUNT($s1) > 0 ):
		    $rp =$s1['S1'];
			$s1= $s1['time'];
		else:
		    $rp=0;
			$s1=0;
		endif;
		$rp_s1 = $s1 * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("I".$i,$s1);
		
		//for AS
        $sqlAS = $sql2. " AND jht.pos_code ='AS' ";
		$sqlAS.=" GROUP BY jdt.job_code ";
		$as=$this->db->query($sqlAS);
        $as=$as->row_array();
		if(COUNT($as) > 0 ):
		    $rp =$as['AS'];
			$as=$as['time'];
		else:
		     $rp=0;
			$as=0;
		endif;
		$rp_as = $as * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("J".$i,$as);
		
		//for TA
        $sqlTA = $sql2. " AND jht.pos_code ='TA' ";
		$sqlTA.=" GROUP BY jdt.job_code ";
		$ta=$this->db->query($sqlTA);
        $ta=$ta->row_array();
		if(COUNT($ta) > 0 ):
		    $rp=$ta['TA'];
			$ta=$ta['time'];
		else:
		     $rp=0;
			$ta=0;
		endif;
		$rp_ta = $ta * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("K".$i,$ta);
		
		$total = $rp_sp+$rp_pic+$rp_sm+$rp_m+$rp_am+$rp_s2+$rp_s1+$rp_as+$rp_ta;
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i,number_format($total,2));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i,number_format($row['fee'],2));
		
		$i++;
      endforeach; 		
      /*$objPHPExcel->createSheet();
      $objPHPExcel->setActiveSheetIndex(1);
      $objPHPExcel->getActiveSheet()->setCellValue("A1", "cell value here 222");
	  */
      // Save it as an excel 2003 file
      $objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
      $file=$id.".xls";
	  $objWriter->save($file);
      $this->index(); //CALL DISPLAY
	  redirect('/'.$file,301);
    }
    
    function print_time(){
	    $per_1 = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
        $per_2 = $this->input->post('year2').'-'.$this->input->post('month2').'-'.$this->input->post('day2');
		$type  = $this->input->post('type');
          	
        if(isset($type)=='excel'):
                    $this->printexcel($per_1,$per_2);
                    //echo $per_2; 
		else:
		    redirect(printpaper($id));
		endif;
    }
	
	function printpaper($id=0){
		$data['title']=$id;
        $data['id']=$id;
        $data['periode']=$this->input->post('day').'-'.$this->input->post('month').'-'.$this->input->post('year').' To '.$this->input->post('day2').'-'.$this->input->post('month2').'-'.$this->input->post('year2');
        $data['title']=$data['periode'];
				
        $data['group']=$this->Josh_summary->getGroup();
        //template data
        $this->load->vars($data);
		$this->load->template('summary_time');
	}
        //function printexcel($t1,$t2)	

	function printexcel($t1,$t2){
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
	  
	  $sql="  SELECT jj.code,jj.name as client,SUM(jddt.time)+ SUM(jddt.over_time_app) as time ,jj.approve_charge as fee";
	  $sql.=" FROM josh_details_day_tr jddt";
	  $sql.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code";
      $sql.=" JOIN josh_job jj ON jj.code=jdt.job_code";
      $sql.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code";
      $sql.=" JOIN josh_staff js ON js.no=jht.staff_no";
	  $sql.=" WHERE jht.periode >= '".$t1."' AND jht.periode <= '".$t2."' GROUP BY jdt.job_code ORDER BY jdt.job_code ASC";
	  $q=$this->db->query($sql);
      $rows=$q->result_array();
	  $i=2;
      foreach($rows as $row):
	    $objPHPExcel->getActiveSheet()->setCellValue("A".$i,$row['code']);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i,$row['client']);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i,$row['time']);
        $sql2 = " SELECT SUM(jddt.time)+ SUM(jddt.over_time_app) as time,jj.SP,jj.PC as PIC,jj.SM,jj.M,jj.AM,jj.S2,jj.S1,jj.AS,jj.TA "; 
		$sql2.= " FROM josh_details_day_tr jddt ";
		$sql2.=" JOIN josh_details_tr jdt ON jdt.day_code=jddt.code ";
		$sql2.=" JOIN josh_job jj ON jj.code=jdt.job_code ";
		$sql2.=" JOIN josh_head_tr jht ON jht.tr_code=jdt.tr_code ";
		$sql2.=" JOIN josh_staff js ON js.no=jht.staff_no ";
		$sql2.=" WHERE jht.periode >= '".$t1."' AND jht.periode <= '".$t2."' ";
		$sql2.=" AND jdt.job_code='".$row['code']."' ";
		
		
		//for SP
		$sqlSP = $sql2. " AND jht.pos_code ='SP' ";
		$sqlSP.=" GROUP BY jdt.job_code ";
		$sp=$this->db->query($sqlSP);
        $sp=$sp->row_array();
		if(COUNT($sp) > 0 ):
			$rp=$sp['SP'];
			$sp=$sp['time'];
		else:
		    $rp=0;
			$sp=0;
		endif;
		$rp_sp = $sp * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("C".$i,$sp);
		
		//for PIC
		$sqlPIC = $sql2. " AND jht.pos_code ='PIC' ";
		$sqlPIC.=" GROUP BY jdt.job_code ";
		$pic=$this->db->query($sqlPIC);
        $pic=$pic->row_array();
		if(COUNT($pic) > 0 ):
			$pic=$pic['time'];
			$rp =$pic['PIC'];
			
		else:
		    $rp=0;
			$pic=0;
			
		endif;
		$rp_pic = $pic * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("D".$i,$pic);
		
		//for SM
		$sqlSM = $sql2. " AND jht.pos_code ='SM' ";
		$sqlSM.=" GROUP BY jdt.job_code ";
		$sm=$this->db->query($sqlSM);
        $sm=$sm->row_array();
		if(COUNT($sm) > 0 ):
			$rp =$sm['SM'];
			$sm=$sm['time'];
		else:
		    $rp=0;
			$sm=0;
			//$rp =$sm['SM'];
		endif;
		$rp_sm = $sm * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("E".$i,$sm);
		
		//for M
		$sqlM = $sql2. " AND jht.pos_code ='M' ";
		$sqlM.=" GROUP BY jdt.job_code ";
		$m=$this->db->query($sqlM);
        $m=$m->row_array();
		if(COUNT($m) > 0 ):
		    $rp =$m['M'];
			$m=$m['time'];
		else:
		     $rp=0;
			$m=0;
		endif;
		$rp_m = $m * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("F".$i,$m);
		//for AM
        $sqlAM = $sql2. " AND jht.pos_code ='AM' ";
		$sqlAM.=" GROUP BY jdt.job_code ";
		$am=$this->db->query($sqlAM);
        $am=$am->row_array();
		if(COUNT($am) > 0 ):
		    $rp =$am['AM'];
			$am=$am['time'];
		else:
		     $rp=0;
			$am=0;
		endif;
		$rp_am = $am * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("G".$i,$am);
		
		//for S2
        $sqlS2 = $sql2. " AND jht.pos_code ='S2' ";
		$sqlS2.=" GROUP BY jdt.job_code ";
		$s2=$this->db->query($sqlS2);
        $s2=$s2->row_array();
		if(COUNT($s2) > 0 ):
		    $rp =$s2['S2'];
			$s2=$s2['time'];
		else:
		     $rp=0;
			$s2=0;
		endif;
		$rp_s2 = $s2 * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("H".$i,$s2);
		
		//for S1
        $sqlS1 = $sql2. " AND jht.pos_code ='S1' ";
		$sqlS1.=" GROUP BY jdt.job_code ";
		$s1=$this->db->query($sqlS1);
        $s1=$s1->row_array();
		if(COUNT($s1) > 0 ):
		    $rp =$s1['S1'];
			$s1= $s1['time'];
		else:
		    $rp=0;
			$s1=0;
		endif;
		$rp_s1 = $s1 * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("I".$i,$s1);
		
		//for AS
        $sqlAS = $sql2. " AND jht.pos_code ='AS' ";
		$sqlAS.=" GROUP BY jdt.job_code ";
		$as=$this->db->query($sqlAS);
        $as=$as->row_array();
		if(COUNT($as) > 0 ):
		    $rp =$as['AS'];
			$as=$as['time'];
		else:
		     $rp=0;
			$as=0;
		endif;
		$rp_as = $as * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("J".$i,$as);
		
		//for TA
        $sqlTA = $sql2. " AND jht.pos_code ='TA' ";
		$sqlTA.=" GROUP BY jdt.job_code ";
		$ta=$this->db->query($sqlTA);
        $ta=$ta->row_array();
		if(COUNT($ta) > 0 ):
		    $rp=$ta['TA'];
			$ta=$ta['time'];
		else:
		     $rp=0;
			$ta=0;
		endif;
		$rp_ta = $ta * $rp;
        $objPHPExcel->getActiveSheet()->setCellValue("K".$i,$ta);
		
		$total = $rp_sp+$rp_pic+$rp_sm+$rp_m+$rp_am+$rp_s2+$rp_s1+$rp_as+$rp_ta;
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i,number_format($total,2));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i,number_format($row['fee'],2));
		
		$i++;
      endforeach; 		
      /*$objPHPExcel->createSheet();
      $objPHPExcel->setActiveSheetIndex(1);
      $objPHPExcel->getActiveSheet()->setCellValue("A1", "cell value here 222");
	  */
      // Save it as an excel 2003 file
      $objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
      $file='activity_code'.".xls";
	  $objWriter->save($file);
      $this->index(); //CALL DISPLAY
	  redirect('/'.$file,301);
	}
}    
