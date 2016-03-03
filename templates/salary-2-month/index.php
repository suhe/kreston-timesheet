<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/salary-2-month/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h2></h2></div>
                <br /><br />
                <div class="titleLap"><h1></h1></div>
                 <br /><br />
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">PERIODE: <?php echo $bulan1; ?> & <?php echo $bulan2; ?></div>
                <div class="no"><?php // echo $no; ?></div>
                <div class="periode">
                  <?php
                    /*
                    $sql="SELECT per_salary as periode FROM josh_salary WHERE per_salary <> '".$_SESSION['periode']."' AND per_salary  < '".$_SESSION['periode']."' GROUP BY per_salary ORDER BY per_salary DESC ";
                    $q=$this->db->query($sql);
                    if ($q->num_rows()>=1){
                    $row=$q->row_array();
                    $periode=$row['periode'];
                    }
                    else
                    {
                        $periode="-";
                    }
                    */
                  ?>
                  PERIODE <?php //echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
				<div class="codePro">Staff No</div>
				<div class="namePro">Name</div>
                <div class="salmon" align="center">Month</div>
				<div class="salmon" align="center">Salary</div>
				<div class="salmon2" align="center">Allowance I</div>
                <div class="salmon2" align="center">Allowance II</div>
				<!--<div class="salmon2" align="center">Per Hour</div>-->
				<!--
                <div class="ot" align="center">(O.x.1)</div>
				<div class="ot" align="center">(O.x.2)</div>
				<div class="ot" align="center">(O.x.3)</div>
				<div class="ot" align="center">(O.x.4)</div>
                -->
                <!--
				<div class="ot" align="center">TOT</div>
                <div class="salmon" align="center">OutMeal</div>
				-->
                <div class="salmon" align="center">Total OT(Rp)</div>
				<div class="ot">Day</div>
				<div class="salmon" align="center">Transp(Day) Periode 05</div>
                <div class="salmon" align="center">Transp(Day) Periode 20</div>
				<div class="salmon" align="center">Transp Net</div>
				<div class="salmon" align="center">Reimbu't</div>
                <div class="salmon" align="center">Adjust</div>
                <div class="salmon" align="center">Debt</div>
				<div class="total" align="center">Payroll</div>
				<!--
                <div class="total" align="center">THP(Last Periode)</div>
                <div class="total" align="center">Total(Payroll)</div>
                -->
				<div class="clear"></div>
		</div>
  
  <?php
      $tot_month=0;
      $tot_allowt=0;
      $tot_allowt_2=0;
      $tot_half=0;
      $tot_hour=0;
      $tot_x1t=0;
      $tot_x2t=0;
      $tot_x3t=0;
      $tot_x4t=0;
      $tot_xtott=0;
      $tot_mealt=0;
      $tot_totOT=0;
      $tot_tday=0;
      $tot_transpp=0;
      $tot_transnet=0;
      $tot_reimbush=0;
      $tot_adjust=0;
      $tot_thp=0;
      $tot_tlp=0;
      $tot_tp=0;
      
      //new data
      
      //bulan ke 1
      $grandsalary1=0;
      $grandallow1=0;
      $grandallow21=0;
      
      $grandovertime1=0;
      $grandday1=0;
      $grandtransp05_1=0;
      $grandtransp20_1=0;
      $grandnet1=0;
      
      $grandrem1=0;
      
      $grandadjust1=0;
      $granddebt1=0;
      $grandpayroll1=0;
      
      //bulan ke 2
      $grandsalary2=0;
      $grandallow2=0;
      $grandallow22=0;
      
      $grandovertime2=0;
      $grandday2=0;
      $grandtransp05_2=0;
      $grandtransp20_2=0;
      $grandnet2=0;
      
      $grandrem2=0;
      
      $grandadjust2=0;
      $granddebt2=0;
      $grandpayroll2=0;
   ?>
         
  <?php foreach($group as $row):  ?>
          <br /> 
          <div class="content contol">
                <div class="codePro"><?php echo $row['code']; ?></div>
				<div class="namePro"><b style="font-weight: bold;"><?php echo $row['name_p']; ?></b></div>
				<div class="salmon"></div>
                <div class="salmon" align="center"></div>
				<div class="salmon2" align="center"></div>
                <div class="salmon2" align="center"></div>
				<div class="salmon" align="center"></div>
				<div class="salmon2" align="center"></div>
				<!--
                <div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
                -->
                <!--<div class="salmon" align="right"></div>-->
				<div class="ot"></div>
				<div class="salmon" align="center"></div>
				<div class="salmon" align="center"></div>
				<div class="salmon" align="center"></div>
				<div class="total" align="center"></div>
				<div class="total" align="center"></div>
                <div class="total" align="center"></div>
				<div class="clear"></div>
           </div>         
       <!-- Start Salary -->
   <?php
     /*
        $this->db->select('jst.group_id,jht.tr_code,jht.periode,jht.staff_no,jht.staff_name,jht.pos_name,js.basic_salary,js.allowance,js.allowance_2,(js.basic_salary)* 0.5 as bas_salary,(js.basic_salary)/ 173 as hour_salary,SUM(over_time_app) as app,js.transport_salary as transport,sum(jddt.transport_chf) as transport2,jddt.x1,jddt.x2,jddt.x3,jddt.x4,js.ot_salary as over_meal,jddt.meal,js.debt');
        $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no','LEFT');
        $this->db->join('josh_details_day_tr jddt','jddt.tr_code=jht.tr_code','LEFT');
        $this->db->join('josh_staff jst','jst.no=jht.staff_no','LEFT');
        $this->db->join('josh_position jp','jp.code=jst.pos_code','LEFT');
        //$this->db->where('js.per_salary',$id);
        //$this->db->where('jht.periode',$id);
        $this->db->where('jst.pos_code',$row['code']);
		$this->db->group_by('jht.tr_code');
        //$this->db->group_by('jst.no');
        //$this->db->group_by('jst.group_id');
        $this->db->order_by('jp.order','ASC');
		$this->db->order_by('jst.no','ASC');
        $Q=$this->db->get("josh_salary js");
        $records=$Q->result_array();
        */
        
        $this->db->select('jst.no,jst.name');
        //$this->db->join('josh_head_tr jht','jst.no=jht.staff_no');
        //$this->db->join('josh_salary js','js.staff_no=jst.no');
        $this->db->where("jst.pos_code",$row['code']);
        $this->db->order_by('jst.no');
        $Q=$this->db->get("josh_staff jst");
        $records=$Q->result_array();
        
   ?>
   <?php
      $month=0;
      $allowt=0;
      $allowt_2=0;
      $half=0;
      $hour=0;
      $x1t=0;
      $x2t=0;
      $x3t=0;
      $x4t=0;
      $xtott=0;
      $mealt=0;
      $totOT=0;
      $tday=0;
      $transpp=0;
      $transnet=0;
      $reimbush=0;
      $adjust=0;
      $adjust2=0;
      $thp=0;
      $tlp=0;
      $tp=0;
      
      //new data
      
      //bulan ke 1
      $subsalary1=0;
      $suballow1=0;
      $suballow21=0;
      
      $subovertime1=0;
      $subday1=0;
      $subtransp05_1=0;
      $subtransp20_1=0;
      $subnet1=0;
      
      $subrem1=0;
      
      $subadjust1=0;
      $subdebt1=0;
      $subpayroll1=0;
      
      //bulan ke 2
      $subsalary2=0;
      $suballow2=0;
      $suballow22=0;
      
      $subovertime2=0;
      $subday2=0;
      $subtransp05_2=0;
      $subtransp20_2=0;
      $subnet2=0;
      
      $subrem2=0;
      
      $subadjust2=0;
      $subdebt2=0;
      $subpayroll2=0;
      
   ?>
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
		   <div class="codePro"><?php echo $rec['no']; ?></div>
		   <div class="namePro"><?php echo $rec['name']; ?></div>
           <div class="salmon" align="right">
                <?php // echo number_format($salary_half=$rec['bas_salary'],2); $half=$half + $salary_half; ?>
                <?php echo $bulan1; ?><br />
                <?php echo $bulan2; ?>
           </div>
		   <div class="salmon" align="right">
                <?php //echo number_format($rec['basic_salary'],2); $month=$month + $rec['basic_salary']; ?>
                <?php
                    //tambahan
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $salary1=$row['basic_salary'] * 0.5 ;
                    else:
                        $salary1= 0;
                    endif;        
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $salary2=$row['basic_salary'] * 0.5 ;
                    else:
                        $salary2= 0;
                    endif;   
                    
                    
                    echo  number_format($totsalary1=$salary1 + $salary2,2);
                    $subsalary1 = $subsalary1 + $totsalary1;
                    //$month=$month + $totsalary;
                    echo "<br/>";
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $salary3=$row['basic_salary'] * 0.5 ;
                    else:
                        $salary3= 0;
                    endif;
                    
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        //$salary3=$row['basic_salary'] * 0.5 ;
                        $salary4=$row['basic_salary'] * 0.5 ;
                    else:

                        $salary4= 0;
                    endif;
                    
                    echo  number_format($totsalary2=$salary3 + $salary4,2);
                    $subsalary2 = $subsalary2 + $totsalary2;
                     
                ?>
           </div>
		   
           <div class="salmon2" align="right">
           <?php // echo number_format($allow=$rec['allowance'] * 0.5 ,2); $allowt=$allowt + $allow; ?>
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $allow1=$row['allowance'] * 0.5 ;
                    else:
                        $allow1= 0;
                    endif;
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $allow2=$row['allowance'] * 0.5 ;
                    else:
                        $allow2= 0;
                    endif;
                    
                    
                    echo  number_format($totallow1=$allow1 + $allow2,2);
                    $suballow1=$suballow1 + $totallow1;
                    //$month=$month + $totsalary;
                    echo "<br/>";
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    if($Q->num_rows()>0):
                        $allow3=$row['allowance'] * 0.5 ;
                    else:
                        $allow3= 0;
                    endif;
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $allow4=$row['allowance'] * 0.5 ;
                    else:
                        $allow4= 0;
                    endif;
                    echo  number_format($totallow2=$allow3 + $allow4,2);
                    $suballow2=$suballow2 + $totallow2;
                     
                ?>
           </div>
           
           <div class="salmon2" align="right">
           <?php // echo number_format($allow_2=$rec['allowance_2'] * 0.5 ,2); $allowt_2=$allowt_2 + $allow_2; ?>
           <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $allow_2_1=$row['allowance_2'] * 0.5 ;
                    else:
                        $allow_2_1= 0;
                    endif;
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    
                    if($Q->num_rows()>0):
                        $allow_2_2=$row['allowance_2'] * 0.5 ;
                    else:
                        $allow_2_2= 0;
                    endif;
                    
                    echo  number_format($totallow3=$allow_2_1 + $allow_2_2,2);
                    $suballow21=$suballow21 + $totallow3;
                    //$month=$month + $totsalary;
                    echo "<br/>";
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $allow_2_3=$row['allowance_2'] * 0.5 ;
                    else:
                        $allow_2_3= 0;
                    endif;
                    
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    //tambahan
                    $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $allow_2_4=$row['allowance_2'] * 0.5 ;
                    else:
                        $allow_2_4= 0;
                    endif;
                    echo  number_format($totallow4=$allow_2_3 + $allow_2_4,2);
                    $suballow22=$suballow22 + $totallow4;
                     
                ?>
           </div>
		   
           
           <!--
		   <div class="salmon2" align="right">
           <?php // echo number_format($salary_hour=$rec['hour_salary'],2); $hour=$hour + $salary_hour; ?>
           </div>
           -->
           
           
           <?php
                //overtime bulan 1
              $this->db->select('SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4) as x4,SUM(jddt.meal) as meal');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              //flow 5
              $x1_05_1=$row['x1'];
              $x2_05_1=$row['x2'];
              $x3_05_1=$row['x3'];
              $x4_05_1=$row['x4'];
              $xmeal_05_1=$row['meal'];
              
              //meal
              $this->db->select('ot_salary');
              $this->db->where('per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
              $this->db->where('staff_no',$rec['no']);
              $Q=$this->db->get('josh_salary');
              $row=$Q->row_array();
              if($Q->num_rows()>0):
                 $sal_meal1=$row['ot_salary'];
              else:
                 $sal_meal1=0;
              endif;
              
              $totmeal05_01=$xmeal_05_1 * $sal_meal1;
              
              
              $this->db->select('SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4) as x4,SUM(jddt.meal) as meal');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              //flow 20
              $x1_20_1=$row['x1'];
              $x2_20_1=$row['x2'];
              $x3_20_1=$row['x3'];
              $x4_20_1=$row['x4'];
              $xmeal_20_1=$row['meal'];
              
              //meal
              $this->db->select('ot_salary');
              $this->db->where('per_salary',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
              $this->db->where('staff_no',$rec['no']);
              $Q=$this->db->get('josh_salary');
              $row=$Q->row_array();
              if($Q->num_rows()>0):
                 $sal_meal2=$row['ot_salary'];
              else:
                 $sal_meal2=0;
              endif;
              
              $totmeal20_01=$xmeal_20_1 * $sal_meal2;
              
              //it flow 05 + 20
              $x1_1=$x1_05_1 + $x1_20_1;
              $x2_1=$x2_05_1 + $x2_20_1;
              $x3_1=$x3_05_1 + $x3_20_1;
              $x4_1=$x4_05_1 + $x4_20_1;
              
              $xtot_1=$x1_1 + $x2_1 + $x3_1 + $x4_1;
              $totmeal1=$totmeal05_01 + $totmeal20_01;
                 
           ?>
           
           <?php
                //overtime bulan 2
              $this->db->select('SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4) as x4,SUM(jddt.meal) as meal');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              //flow 5
              $x1_05_2=$row['x1'];
              $x2_05_2=$row['x2'];
              $x3_05_2=$row['x3'];
              $x4_05_2=$row['x4'];
              $xmeal_05_2=$row['meal'];
              
              //meal
              $this->db->select('ot_salary');
              $this->db->where('per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
              $this->db->where('staff_no',$rec['no']);
              $Q=$this->db->get('josh_salary');
              $row=$Q->row_array();
              if($Q->num_rows()>0):
                 $sal_meal3=$row['ot_salary'];
              else:
                 $sal_meal3=0;
              endif;
              
              $totmeal05_02=$xmeal_05_2 * $sal_meal3;
              
              $this->db->select('SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4) as x4,SUM(jddt.meal) as meal');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              //flow 20
              $x1_20_2=$row['x1'];
              $x2_20_2=$row['x2'];
              $x3_20_2=$row['x3'];
              $x4_20_2=$row['x4'];
              
              $xmeal_20_2=$row['meal'];
              
              //meal
              $this->db->select('ot_salary');
              $this->db->where('per_salary',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
              $this->db->where('staff_no',$rec['no']);
              $Q=$this->db->get('josh_salary');
              $row=$Q->row_array();
              if($Q->num_rows()>0):
                 $sal_meal4=$row['ot_salary'];
              else:
                 $sal_meal4=0;
              endif;
              
              $totmeal20_02=$xmeal_20_2 * $sal_meal4;
              
              //it flow 05 + 20
              $x1_2=$x1_05_2 + $x1_20_2;
              $x2_2=$x2_05_2 + $x2_20_2;
              $x3_2=$x3_05_2 + $x3_20_2;
              $x4_2=$x4_05_2 + $x4_20_2;
              
              $xtot_2=$x1_2 + $x2_2 + $x3_2 + $x4_2;
              $totmeal2=$totmeal05_02 + $totmeal20_02;
                 
           ?>
           <!--
		   <div class="ot" align="right"><?php  echo $x1_1;?>  <br /> <?php  echo $x1_2;?>  </div>
		   <div class="ot" align="right"><?php  echo $x2_1;?>  <br /> <?php  echo $x2_2;?>  </div>
		   <div class="ot" align="right"><?php  echo $x3_1;?>  <br /> <?php  echo $x3_2;?>   </div>
		   <div class="ot" align="right"><?php  echo $x4_1;?>  <br /> <?php  echo $x4_2;?>  </div>
		   -->
           <!--
           <div class="ot" align="right"><?php  echo $xtot_1;?><br /> <?php  echo $xtot_2;?></div>
           -->
           <!--<div class="salmon" align="right"><?php  echo number_format($totmeal1,2);?> <br /><?php  echo number_format($totmeal2,2);?></div>
		   -->
           <div class="salmon" align="right">
            <?php
              //overtime 05 bulan 1
              $bas_salary_05_01=($salary1 * 2) / 173 ;
              $xx1_05_01=$x1_05_1 * 1.5;
              $xx2_05_01=$x2_05_1 * 2;
              $xx3_05_01=$x3_05_1 * 3;
              $xx4_05_01=$x4_05_1 * 4;
              
              $xtot_05_01=($bas_salary_05_01 * $xx1_05_01) + ($bas_salary_05_01 * $xx2_05_01) + ($bas_salary_05_01 * $xx3_05_01) + ($bas_salary_05_01 * $xx4_05_01);  
              
              //overtime 20 bulan 1
              $bas_salary_20_01=($salary2 * 2) / 173;
              $xx1_20_01=$x1_20_1 * 1.5;
              $xx2_20_01=$x2_20_1 * 2;
              $xx3_20_01=$x3_20_1 * 3;
              $xx4_20_01=$x4_20_1 * 4;
              
              $xtot_20_01=($bas_salary_20_01 * $xx1_20_01) + ($bas_salary_20_01 * $xx2_20_01) + ($bas_salary_20_01 * $xx3_20_01) + ($bas_salary_20_01 * $xx4_20_01);  
              
              
              //overtime total bulan 1
              //echo number_format($xtot_01=$xtot_05_01 + $xtot_20_01,2);
              $xtot_01=$xtot_05_01 + $xtot_20_01;
              
              //$xx1=$x1 * 1.5;
              //$xx2=$x2 * 2;
              //$xx3=$x3 * 3;
              //$xx4=$x4 * 4;
             // $xtot=($rec['hour_salary'] * $xx1) + ($rec['hour_salary'] * $xx2) + ($rec['hour_salary'] * $xx3) + ($rec['hour_salary'] * $xx4);  
             // $salary_overtime=$xtot;
             ?>
                
             
             <?php
              //overtime 05 bulan 1
              $bas_salary_05_02=($salary3 * 2)/173;
              $xx1_05_02=$x1_05_2 * 1.5;
              $xx2_05_02=$x2_05_2 * 2;
              $xx3_05_02=$x3_05_2 * 3;
              $xx4_05_02=$x4_05_2 * 4;
              
              $xtot_05_02=($bas_salary_05_02 * $xx1_05_01) + ($bas_salary_05_02 * $xx2_05_02) + ($bas_salary_05_02 * $xx3_05_02) + ($bas_salary_05_02 * $xx4_05_02);  
              
              //overtime 20 bulan 1
              $bas_salary_20_02=($salary4 * 2)/173;
              $xx1_20_02=$x1_20_2 * 1.5;
              $xx2_20_02=$x2_20_2 * 2;
              $xx3_20_02=$x3_20_2 * 3;
              $xx4_20_02=$x4_20_2 * 4;
              
              $xtot_20_02=($bas_salary_20_02 * $xx1_20_02) + ($bas_salary_20_02 * $xx2_20_02) + ($bas_salary_20_02 * $xx3_20_02) + ($bas_salary_20_02 * $xx4_20_02);  
              
              
              //overtime total bulan 1
              //echo number_format($xtot_02=$xtot_05_02 + $xtot_20_02,2);
              $xtot_02=$xtot_05_02 + $xtot_20_02;
              
              //$xx1=$x1 * 1.5;
              //$xx2=$x2 * 2;
              //$xx3=$x3 * 3;
              //$xx4=$x4 * 4;
             // $xtot=($rec['hour_salary'] * $xx1) + ($rec['hour_salary'] * $xx2) + ($rec['hour_salary'] * $xx3) + ($rec['hour_salary'] * $xx4);  
             // $salary_overtime=$xtot;
             ?>
             <?php
                //bulan 1 =  
                echo number_format($totalover1=$totmeal1 + $xtot_01,2);
                $subovertime1=$subovertime1 + $totalover1;
                echo "<br/>";
                echo number_format($totalover2=$totmeal2 + $xtot_02,2); 
                $subovertime2=$subovertime2 + $totalover2;
                //bulan 2
             ?>   
             
            <?php // echo number_format($xtot,2); $totOT=$totOT + $xtot;  ?>
           </div>
		   <div class="ot" align="right">
              <?php 
                   //$day=$rec['day'];
                   //$sql="SELECT COUNT(DISTINCT(jddt.date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$rec['tr_code']."'   ";
                   //$q=$this->db->query($sql);
                   //$row=$q->row_array();
                   //echo $day=$row['acc'];
                   //$tday=$tday+$day;
                   
              $this->db->select('COUNT(DISTINCT(jddt.date)) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $day1=$row['acc'];
              
              $this->db->select('COUNT(DISTINCT(jddt.date)) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $day2=$row['acc'];
              
              echo $totday=$day1+$day2;
              $subday1=$subday1 + $totday;
              
              echo "<br/>";
              
              $this->db->select('COUNT(DISTINCT(jddt.date)) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $day3=$row['acc'];
              
              $this->db->select('COUNT(DISTINCT(jddt.date)) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $day4=$row['acc'];
              
              echo $totday2=$day3+$day4;
              $subday2=$subday2 + $totday2;
              
               
           ?>
               
           </div>
           
           
           
		   <div class="salmon" align="right">
            <?php // echo number_format($rec['transport'],2); $transpp=$transpp+$rec['transport'] ?>
            <?php
                    $this->db->where('staff_no',$rec['no']);
                    $this->db->where('per_salary',$this->input->post('year').$this->input->post('month').'05');
                    $Q=$this->db->get('josh_salary');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $transp=$row['transport_salary'];
                    else:
                        $transp= 0;
                    endif;
                    
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->where('staff_no',$rec['no']);
                    $this->db->where('per_salary',$this->input->post('year').$this->input->post('month').'20');
                    $Q=$this->db->get('josh_salary');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $transp2=$row['transport_salary'];
                    else:
                        $transp2= 0;
                    endif;
                    
                    $tottransp=$transp + $transp2;
                    echo number_format($transp,2);
                    $subtransp05_1=$subtransp05_1 + $transp;
                    //echo  number_format($tottransp=($transp + $transp2)/2,2);
                ?>
                <br />
                <?php
                    $this->db->where('staff_no',$rec['no']);
                    $this->db->where('per_salary',$this->input->post('year').$this->input->post('month2').'05');
                    $Q=$this->db->get('josh_salary');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $transp3=$row['transport_salary'];
                    else:
                        $transp3= 0;
                    endif;
            
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->where('staff_no',$rec['no']);
                    $this->db->where('per_salary',$this->input->post('year').$this->input->post('month2').'20');
                    $Q=$this->db->get('josh_salary');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $transp4=$row['transport_salary'];
                    else:
                        $transp4= 0;
                    endif;
                    
                    $tottransp2=$transp3 + $transp4;
                    //echo  number_format($tottransp2=($transp3 + $transp4)/2,2);
                    echo number_format($transp3,2);
                    $subtransp05_1=$subtransp05_1 + $transp3;
                ?>
                
            </div>
            
            <div class="salmon" align="right">
               <?php echo number_format($transp2,2);
               $subtransp20_1=$subtransp20_1 + $transp2;
                ?>
               
               <br />
               <?php echo number_format($transp4,2);
               $subtransp20_2=$subtransp20_2 + $transp4;
                ?>
            </div>
            
		   <div class="salmon" align="right">
           <?php // echo number_format($salary_transp=$rec['transport'] * $day,2); $transnet=$transnet+$salary_transp ?>
           <?php 
                 $net1=$day1 * $transp;
                 $net2=$day2 * $transp2;
                 echo number_format($totnet1=$net1 + $net2,2);
                 $subnet1=$subnet1 + $totnet1;
                
            ?>
            <br />
            <?php 
                 $net3=$day3 * $transp3;
                 $net4=$day4 * $transp4;
                 echo number_format($totnet2=$net3 + $net4,2);
                 $subnet2=$subnet2 + $totnet2;
                
            ?>
           </div>
           
		   <div class="salmon" align="right">
           <?php // echo number_format($salary_alow_transp=$rec['transport2'],2); $reimbush=$reimbush+$salary_alow_transp; ?>
           <?php 
              $this->db->select('SUM(jddt.transport_chf) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $rem1=$row['acc'];
              
              $this->db->select('SUM(jddt.transport_chf) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $rem2=$row['acc'];
              
              echo number_format($totrem=$rem1+$rem2,2);
              $subrem1=$subrem1 + $totrem;
              echo "<br/>";
              
              $this->db->select('SUM(jddt.transport_chf) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'05');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $rem3=$row['acc'];
              
              $this->db->select('SUM(jddt.transport_chf) as acc');
              $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
              $this->db->where('jht.periode',$this->input->post('year').'-'.$this->input->post('month2').'-'.'20');
              $this->db->where('jht.staff_no',$rec['no']);
              $this->db->where('jht.status_hrd','approval');
              $Q=$this->db->get('josh_details_day_tr jddt');
              $row=$Q->row_array();
              $rem4=$row['acc'];
              
              echo number_format($totrem2=$rem3+$rem4,2);
              $subrem2=$subrem2 + $totrem2;
              
               
           ?>
           </div>
           
           <div class="salmon" align="right">
               <?php 
                    //adjust 2
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month').'05');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month').'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $adjustment=$row['adjust'];
                    else:
                        $adjustment= 0;
                    endif;
            
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month').'20');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month').'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $adjustment2=$row['adjust'];
                    else:
                        $adjustment2= 0;
                    endif;
            
                    echo  number_format($totadjustment=($adjustment + $adjustment2),2);
                    $subadjust1=$subadjust1 + $totadjustment;
                    
                ?>
                <br />
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month2').'05');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month2').'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $adjustment3=$row['adjust'];
                    else:
                        $adjustment3= 0;
                    endif;
            
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month2').'20');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month2').'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $adjustment4=$row['adjust'];
                    else:
                        $adjustment4= 0;
                    endif;
            
                    echo  number_format($totadjustment2=($adjustment3 + $adjustment4),2);
                    $subadjust2=$subadjust2 + $totadjustment2;
                ?>
           </div>
           
           <div class="salmon" align="right">
           <?php // echo number_format($debt=$rec['debt'],2); $adjust=$adjust+$debt; ?>
           <?php 
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month').'05');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month').'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $adjust=$row['debt'];
                    else:
                        $adjust= 0;
                    endif;
            
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month').'20');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month').'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $adjust2=$row['debt'];
                    else:
                        $adjust2= 0;
                    endif;
            
                    echo  number_format($totadjust=($adjust + $adjust2),2);
                    $subdebt1=$subdebt1 + $totadjust;
                ?>
                <br />
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no');
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month2').'05');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month2').'05');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows()>0):
                        $adjust3=$row['debt'];
                    else:
                        $adjust3= 0;
                    endif;
            
                    //echo  number_format($totallow2_2=$allow_2_3 + $allow_2_4,2);
                ?>
                <?php
                    $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no'); 
                    $this->db->where('js.staff_no',$rec['no']);
                    $this->db->where('js.per_salary',$this->input->post('year').$this->input->post('month2').'20');
                    $this->db->where('jht.periode',$this->input->post('year').$this->input->post('month2').'20');
                    $this->db->where('jht.status_hrd','approval');
                    $Q=$this->db->get('josh_salary js');
                    $row=$Q->row_array();
                    
                    if($Q->num_rows() > 0):
                        $adjust4=$row['debt'];
                    else:
                        $adjust4= 0;
                    endif;
            
                    echo  number_format($totadjust2=($adjust3 + $adjust4),2);
                    $subdebt2=$subdebt2 + $totadjust2;
                ?>
           </div>
           
           
		   
           <div class="total" align="right">
           <?php
                //$this_periode=($salary_half +  $allow + $allow_2 + $salary_overtime + $salary_meal + $salary_transp + $salary_alow_transp)- $debt;  
                //echo number_format($this_periode,2);
                //$thp=$thp + $this_periode;
                $this_periode=($totsalary1 + $totallow1 + $totallow3 + $xtot_01 + $totmeal1 + $totnet1 + $totrem + $totadjustment) - $totadjust;
                echo number_format($this_periode,2);
                $subpayroll1=$subpayroll1 + $this_periode;
            ?>
            <br />
            <?php
                //$this_periode=($salary_half +  $allow + $allow_2 + $salary_overtime + $salary_meal + $salary_transp + $salary_alow_transp)- $debt;  
                //echo number_format($this_periode,2);
                //$thp=$thp + $this_periode;
                $this_periode2=($totsalary2 + $totallow2 + $totallow4 + $xtot_02 + $totmeal2 + $totnet2 + $totrem2 + $totadjustment2 ) - $totadjust2;
                echo number_format($this_periode2,2);
                $subpayroll2=$subpayroll2 + $this_periode2;
            ?>
           </div>
                <div class="clear"></div>
         </div>       
   <?php endforeach; ?>
    
    <!-- TOTAL PER GROUP -->
    <div class="content contol bold">
                <div class="codePro"></div>
				<div class="namePro">SUB TOTAL</div>
                <div class="salmon" align="center">
                   <?php echo $bulan1; ?><br />
                   <?php echo $bulan2; ?>
                </div>
				<div class="salmon" align="right">
                <?php
                    echo number_format($subsalary1,2);
                    $grandsalary1=$grandsalary1 + $subsalary1;
                    echo '<br/>';
                    echo number_format($subsalary2,2);
                    $grandsalary2=$grandsalary2 + $subsalary2;
                ?>
                </div>
				<div class="salmon2" align="right">
                <?php
                    echo number_format($suballow1,2);
                    $grandallow1=$grandallow1 + $suballow1;
                    echo '<br/>';
                    echo number_format($suballow2,2);
                    $grandallow2=$grandallow2 + $suballow2;
                ?>
                </div>
                
                <div class="salmon2" align="right">
                   <?php
                    echo number_format($suballow21,2);
                    $grandallow21=$grandallow21 + $suballow21;
                    echo '<br/>';
                    echo number_format($suballow22,2);
                    $grandallow22=$grandallow22 + $suballow22;
                   ?>
                </div>
				<!--<div class="salmon2" align="center">Per Hour</div>-->
				<!--
                <div class="ot" align="center">(O.x.1)</div>
				<div class="ot" align="center">(O.x.2)</div>
				<div class="ot" align="center">(O.x.3)</div>
				<div class="ot" align="center">(O.x.4)</div>
                -->
                <!--
				<div class="ot" align="center">TOT</div>
                <div class="salmon" align="center">OutMeal</div>
				-->
                <div class="salmon" align="right">
                 <?php
                    echo number_format($subovertime1,2);
                    $grandovertime1=$grandovertime1 + $subovertime1;
                    echo '<br/>';
                    echo number_format($subovertime2,2);
                    $grandovertime2=$grandovertime2 + $subovertime2;
                   ?>
                </div>
				<div class="ot" align="center">
                   <?php
                    echo number_format($subday1,0);
                    $grandday1=$grandday1 + $subday1;
                    echo '<br/>';
                    echo number_format($subday2,0);
                    $grandday2=$grandday2 + $subday2;
                   ?>
                </div>
                
				<div class="salmon" align="right">
                    <?php
                    echo number_format($subtransp05_1,2);
                    $grandtransp05_1=$grandtransp05_1 + $subtransp05_1;
                    echo '<br/>';
                    echo number_format($subtransp05_2,2);
                    $grandtransp05_2=$grandtransp05_2 + $subtransp05_2;
                   ?>
                </div>
                
                <div class="salmon" align="right">
                  <?php
                    echo number_format($subtransp20_1,2);
                    $grandtransp20_1=$grandtransp20_1 + $subtransp20_1;
                    echo '<br/>';
                    echo number_format($subtransp20_2,2);
                    $grandtransp20_2=$grandtransp20_2 + $subtransp20_2;
                   ?>
                </div>
                
				<div class="salmon" align="right">
                    <?php
                    echo number_format($subnet1,2);
                    $grandnet1=$grandnet1 + $subnet1;
                    echo '<br/>';
                    echo number_format($subnet2,2);
                    $grandnet2=$grandnet2 + $subnet2;
                   ?>
                </div>
                
				<div class="salmon" align="right">
                  <?php
                    echo number_format($subrem1,2);
                    $grandrem1=$grandrem1 + $subrem1;
                    echo '<br/>';
                    echo number_format($subrem2,2);
                    $grandrem2=$grandrem2 + $subrem2;
                   ?>
                </div>
                <div class="salmon" align="right">
                  <?php
                    echo number_format($subadjust1,2);
                    $grandadjust1=$grandadjust1 + $subadjust1;
                    echo '<br/>';
                    echo number_format($subadjust2,2);
                    $grandadjust2=$grandadjust2 + $subadjust2;
                   ?>
                </div>
                <div class="salmon" align="right">
                  <?php
                    echo number_format($subdebt1,2);
                    $granddebt1=$granddebt1 + $subdebt1;
                    echo '<br/>';
                    echo number_format($subdebt2,2);
                    $granddebt2=$granddebt2 + $subdebt2;
                   ?>
                </div>
				<div class="total" align="right">
                  <?php
                    echo number_format($subpayroll1,2);
                    $grandpayroll1=$grandpayroll1 + $subpayroll1;
                    echo '<br/>';
                    echo number_format($subpayroll2,2);
                    $grandpayroll2=$grandpayroll2 + $subpayroll2;
                   ?>
                </div>
				
				<div class="clear"></div>
           </div>     
             
    <!-- TOTAL PER GROUP -->
    
     
 <?php endforeach;  ?>   
 
 
 <!-- GRAND TOTAL -->
 <br />
         <div class="menu total2">
                <div class="codePro"></div>
				<div class="namePro">GRAND TOTAL</div>
                <div class="salmon" align="center">
                  <?php
                    echo $bulan1;
                    echo "<br/>";
                    echo $bulan2;
                  ?>
                </div>
				<div class="salmon" align="right">
                <?php
                    //echo number_format($subsalary1,2);
                    //$grandsalary1=$grandsalary1 + $subsalary1;
                    echo number_format($grandsalary1,2);
                    echo '<br/>';
                    //echo number_format($subsalary2,2);
                    //$grandsalary2=$grandsalary2 + $subsalary2;
                    echo number_format($grandsalary2,2);
                ?>
                </div>
				<div class="salmon2" align="right">
                <?php
                    //echo number_format($suballow1,2);
                    //$grandallow1=$grandallow1 + $suballow1;
                    echo number_format($grandallow1,2);
                    echo '<br/>';
                    //echo number_format($suballow2,2);
                    //$grandallow2=$grandallow2 + $suballow2;
                    echo number_format($grandallow2,2);
                ?>
                </div>
                
                <div class="salmon2" align="right">
                   <?php
                    //echo number_format($suballow21,2);
                   // $grandallow21=$grandallow21 + $suballow21;
                    echo number_format($grandallow21,2);
                    echo '<br/>';
                    //echo number_format($suballow22,2);
                    //$grandallow22=$grandallow22 + $suballow22;
                    echo number_format($grandallow22,2);
                   ?>
                </div>
				<!--<div class="salmon2" align="center">Per Hour</div>-->
				<!--
                <div class="ot" align="center">(O.x.1)</div>
				<div class="ot" align="center">(O.x.2)</div>
				<div class="ot" align="center">(O.x.3)</div>
				<div class="ot" align="center">(O.x.4)</div>
                -->
                <!--
				<div class="ot" align="center">TOT</div>
                <div class="salmon" align="center">OutMeal</div>
				-->
                <div class="salmon" align="right">
                 <?php
                    //echo number_format($subovertime1,2);
                    //$grandovertime1=$grandovertime1 + $subovertime1;
                    echo number_format($grandovertime1,2);
                    echo '<br/>';
                    //echo number_format($subovertime2,2);
                    //$grandovertime2=$grandovertime2 + $subovertime2;
                    echo number_format($grandovertime2,2);
                   ?>
                </div>
				<div class="ot" align="center">
                   <?php
                    //echo number_format($subday1,0);
                    //$grandday1=$grandday1 + $subday1;
                    echo number_format($grandday1,0);
                    echo '<br/>';
                    //echo number_format($subday2,0);
                    //$grandday2=$grandday2 + $subday2;
                    echo number_format($grandday2,0);
                   ?>
                </div>
                
				<div class="salmon" align="right">
                    <?php
                    //echo number_format($subtransp05_1,2);
                    //$grandtransp05_1=$grandtransp05_1 + $subtransp05_1;
                    echo number_format($grandtransp05_1,2);
                    echo '<br/>';
                    //echo number_format($subtransp05_2,2);
                    //$grandtransp05_2=$grandtransp05_2 + $subtransp05_2;
                    echo number_format($grandtransp05_2,2);
                   ?>
                </div>
                
                <div class="salmon" align="right">
                  <?php
                    //echo number_format($subtransp20_1,2);
                    //$grandtransp20_1=$grandtransp20_1 + $subtransp20_1;
                    echo number_format($grandtransp20_1,2);
                    echo '<br/>';
                    //echo number_format($subtransp20_2,2);
                    //$grandtransp20_2=$grandtransp20_2 + $subtransp20_2;
                    echo number_format($grandtransp20_1,2);
                   ?>
                </div>
                
				<div class="salmon" align="right">
                    <?php
                    //echo number_format($subnet1,2);
                    //$grandnet1=$grandnet1 + $subnet1;
                    echo number_format($grandnet1,2);
                    echo '<br/>';
                    //echo number_format($subnet2,2);
                   // $grandnet2=$grandnet2 + $subnet2;
                    echo number_format($grandnet2,2);
                   ?>
                </div>
                
				<div class="salmon" align="right">
                  <?php
                    //echo number_format($subrem1,2);
                    //$grandrem1=$grandrem1 + $subrem1;
                    echo number_format($grandrem1,2);
                    echo '<br/>';
                    //echo number_format($subrem2,2);
                    //$grandrem2=$grandrem2 + $subrem2;
                    echo number_format($grandrem2,2);
                   ?>
                </div>
                <div class="salmon" align="right">
                  <?php
                    //echo number_format($subadjust1,2);
                    //$grandadjust1=$grandadjust1 + $subadjust1;
                    echo number_format($grandadjust1,2);
                    echo '<br/>';
                    //echo number_format($subadjust2,2);
                    //$grandadjust2=$grandadjust2 + $subadjust2;
                    echo number_format($grandadjust2,2);
                   ?>
                </div>
                <div class="salmon" align="right">
                  <?php
                    //echo number_format($subdebt1,2);
                    //$granddebt1=$granddebt1 + $subdebt1;
                    echo number_format($granddebt1,2);
                    echo '<br/>';
                    //echo number_format($subdebt2,2);
                    //$granddebt2=$granddebt2 + $subdebt2;
                    echo number_format($granddebt2,2);
                   ?>
                </div>
				<div class="total" align="right">
                  <?php
                    //echo number_format($subpayroll1,2);
                    //$grandpayroll1=$grandpayroll1 + $subpayroll1;
                    echo number_format($grandpayroll1,2);
                    echo '<br/>';
                    //echo number_format($subpayroll2,2);
                    //$grandpayroll2=$grandpayroll2 + $subpayroll2;
                    echo number_format($grandpayroll2,2);
                   ?>
                </div>
				
				<div class="clear"></div>
           </div>     
 <!-- GRAND TOTAL -->
 
        <!-- Finish -->
       <!-- 
        <div class="content total2">
		        <div class="codePro" align="center"><?php // echo $totaltime;?></div>
                <div class="namePro">GRAND TOTAL</div>
				<div class="namePro"></div>
                <div class="salary">Salary(Month)</div>
				<div class="salary">Salary(Half Month)</div>
                <div class="clear"></div>
        </div>
        
        -->
		
		<!--
        <div id="keterangan">
            <div class="chargeb">
                
                <div class="ch1">
                     <br />
                     <center>Manager In Charge</center><br/>
                     <center><?php // if($manager_signature<>""){ ?><img src="<?php // echo base_url().$manager_signature; ?>" class="sign2" /><?php // } else { ?> <br /><br /> <?php // } ?></center>
                     <center><span class="names"><?php // echo $manager_name; ?></span></center>
                     <center class="names">(Manager In Charge)</center>
                </div>
                
                <div class="ch1">
                    <br />
                    <center>HR And GA Manager</center><br/>
                    <center><?php  // if($hrd_signature<>""){ ?><img src="<?php // echo base_url().$hrd_signature; ?>" class="sign2" /><?php // } else { ?> <br /><br /><br /> <?php // } ?></center>
                    <center class="names">(<?php // echo $hrd_name;?>)</center>
                </div>
                
                
                <div class="ch1">
                    <br />
                    <center>Accounting</center><br/>
                    <center><?php // if($acc_signature<>""){ ?><img src="<?php // echo base_url().$acc_signature; ?>" class="sign2" /><?php  // } else { ?> <br /><br /><br /> <?php // } ?></center>
                    
                    <center class="names">(<?php // echo $acc_name;?>)</center>
                </div>
               
            </div>
        </div>
       
       
        </div>
              -->        
    
</body>
</html>
