<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/salary/style.css"  type="text/css"/>
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
                <div class="name">THIS PERIODE END : <?php echo $_SESSION['periode']; ?></div>
                <div class="no"><?php // echo $no; ?></div>
                <div class="periode">
                  <?php
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
                    
                  ?>
                  LAST PERIODE END : <?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
				<div class="codePro">Staff No</div>
				<div class="namePro">Name</div>
				
				<div class="salmon" align="center">Per Month</div>
				<div class="salmon2" align="center">Allowance I</div>
                <div class="salmon2" align="center">Allowance II</div>
				<div class="salmon" align="center">Per Half</div>
				<div class="salmon2" align="center">Per Hour</div>
				<div class="ot" align="center">(O.x.1)</div>
				<div class="ot" align="center">(O.x.2)</div>
				<div class="ot" align="center">(O.x.3)</div>
				<div class="ot" align="center">(O.x.4)</div>
				<div class="ot" align="center">TOT</div>
                <div class="salmon" align="center">OutMeal</div>
				<div class="salmon" align="center">Total OT(Rp)</div>
				<div class="ot">Day</div>
				<div class="salmon" align="center">Transp(Day)</div>
				<div class="salmon" align="center">Transp Net</div>
				<div class="salmon" align="center">Reimbu't</div>
                <div class="salmon" align="center">Adjust</div>
                <div class="salmon" align="center">Debt</div>
				<div class="total" align="center">THP(This Periode)</div>
				<div class="total" align="center">THP(Last Periode)</div>
                <div class="total" align="center">Total(Payroll)</div>
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
      $tot_adjustment=0;
      $tot_adjust=0;
      $tot_thp=0;
      $tot_tlp=0;
      $tot_tp=0;
   ?>
         
  <?php foreach($group as $row):  ?>
          <br /> 
          <div class="content contol">
                <div class="codePro"><?php echo $row['code']; ?></div>
				<div class="namePro"><b style="font-weight: bold;"><?php echo $row['name_p']; ?></b></div>
				
				<div class="salmon" align="center"></div>
				<div class="salmon2" align="center"></div>
                <div class="salmon2" align="center"></div>
				<div class="salmon" align="center"></div>
				<div class="salmon2" align="center"></div>
				<div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
				<div class="ot"></div>
                <div class="salmon"></div>
				<div class="salmon" align="right"></div>
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
        $this->db->select('jst.group_id,jht.tr_code,jht.periode,jht.staff_no,jht.staff_name,jht.pos_name,js.basic_salary,js.allowance,js.allowance_2,(js.basic_salary)* 0.5 as bas_salary,(js.basic_salary)/ 173 as hour_salary,SUM(over_time_app) as app,js.transport_salary as transport,sum(jddt.transport_chf) as transport2,SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4)as x4,js.ot_salary as over_meal,SUM(jddt.meal) as meal,js.debt,js.adjust');
        $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no','LEFT');
        $this->db->join('josh_details_day_tr jddt','jddt.tr_code=jht.tr_code','LEFT');
        $this->db->join('josh_staff jst','jst.no=jht.staff_no','LEFT');
        $this->db->join('josh_position jp','jp.code=jst.pos_code','LEFT');
        $this->db->where('js.per_salary',$id);
        $this->db->where('jht.periode',$id);
        $this->db->where('jst.pos_code',$row['code']);
		//$this->db->where('jht.status_manager','approval');
        $this->db->where('jht.status_hrd','approval');
		$this->db->group_by('jht.tr_code');
        //$this->db->group_by('jst.group_id');
        $this->db->order_by('jp.order','ASC');
		$this->db->order_by('jst.no','ASC');
        $Q=$this->db->get("josh_salary js");
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
      $adjustment=0;
      $adjust=0;
      $thp=0;
      $tlp=0;
      $tp=0;
   ?>
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
		   <div class="codePro"><?php echo $rec['staff_no']; ?></div>
		   <div class="namePro"><?php echo $rec['staff_name']; ?></div>
		   
		   <div class="salmon" align="right"><?php echo number_format($rec['basic_salary'],2); $month=$month + $rec['basic_salary']; ?></div>
		   <div class="salmon2" align="right"><?php echo number_format($allow=$rec['allowance'] * 0.5 ,2); $allowt=$allowt + $allow; ?></div>
           <div class="salmon2" align="right"><?php echo number_format($allow_2=$rec['allowance_2'] * 0.5 ,2); $allowt_2=$allowt_2 + $allow_2; ?></div>
		   <div class="salmon" align="right"><?php echo number_format($salary_half=$rec['bas_salary'],2); $half=$half + $salary_half; ?></div>
		   <div class="salmon2" align="right"><?php echo number_format($salary_hour=$rec['hour_salary'],2); $hour=$hour + $salary_hour; ?></div>
		   <div class="ot" align="right"><?php echo $x1= $rec['x1'];$x1t=$x1t+$x1;?></div>
		   <div class="ot" align="right"><?php echo $x2=$rec['x2'];$x2t=$x2t+$x2;?></div>
		   <div class="ot" align="right"><?php echo $x3=$rec['x3'];$x3t=$x3t+$x3;?></div>
		   <div class="ot" align="right"><?php echo $x4=$rec['x4'];$x4t=$x4t+$x4;?></div>
		   <div class="ot" align="right"><?php echo $xx=$x1+$x2+$x3+$x4; $xtott=$xtott+$xx; ?></div>
           <div class="salmon" align="right"><?php echo number_format($salary_meal=$rec['over_meal'] * $rec['meal'] ,2);$mealt=$mealt+$salary_meal;?></div>
		   <div class="salmon" align="right">
            <?php 
              $xx1=$x1 * 1.5;
              $xx2=$x2 * 2;
              $xx3=$x3 * 3;
              $xx4=$x4 * 4;
              $xtot=($rec['hour_salary'] * $xx1) + ($rec['hour_salary'] * $xx2) + ($rec['hour_salary'] * $xx3) + ($rec['hour_salary'] * $xx4);  
              $salary_overtime=$xtot;
             ?>
            <?php echo number_format($xtot,2); $totOT=$totOT + $xtot;  ?>
           </div>
		   <div class="ot" align="right">
              <?php 
                   //$day=$rec['day'];
                   $sql="SELECT COUNT(DISTINCT(jddt.date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$rec['tr_code']."' ";
                   $q=$this->db->query($sql);
                   $row=$q->row_array();
                   $day1=$row['acc'];

$sql="SELECT COUNT(DISTINCT(jddt.date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$rec['tr_code']."' AND jdt.job_code='NC1001' ";
$q=$this->db->query($sql);
                   $row=$q->row_array();
                  $day2=$row['acc'];

$sql="SELECT COUNT(DISTINCT(jddt.date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$rec['tr_code']."' AND jdt.job_code='NC1002' ";
$q=$this->db->query($sql);
                   $row=$q->row_array();
                   $day3=$row['acc'];

                   echo $day = $day1 - ($day2+$day3);                     
 
                   $tday=$tday+($day);
               ?>
           </div>
		   <div class="salmon" align="right"><?php echo number_format($rec['transport'],2); $transpp=$transpp+$rec['transport'] ?></div>
		   <div class="salmon" align="right"><?php echo number_format($salary_transp=$rec['transport'] * $day,2); $transnet=$transnet+$salary_transp ?></div>
		   <div class="salmon" align="right"><?php echo number_format($salary_alow_transp=$rec['transport2'],2); $reimbush=$reimbush+$salary_alow_transp; ?></div>
           <div class="salmon" align="right"><?php echo number_format($ad=$rec['adjust'],2); $adjustment=$adjustment+$ad; ?></div>
           <div class="salmon" align="right"><?php echo number_format($debt=$rec['debt'],2); $adjust=$adjust+$debt; ?></div>
		   <div class="total" align="right">
           <?php
                $this_periode=($salary_half +  $allow + $allow_2 + $salary_overtime + $salary_meal + $salary_transp + $salary_alow_transp + $ad)- $debt;  
                echo number_format($this_periode,2);
                $thp=$thp + $this_periode;
                
            ?>
           </div>
		   <div class="total" align="right">
           
           <?php
                    $sql="SELECT per_salary as periode FROM josh_salary WHERE per_salary <> '".$_SESSION['periode']."' AND per_salary  < '".$_SESSION['periode']."' GROUP BY per_salary ORDER BY per_salary DESC ";
                    $q=$this->db->query($sql);
                    if ($q->num_rows()>=1){
                    $row=$q->row_array();
                    $periode=$row['periode'];
                    }
                    else
                    {
                        $periode="";
                    }
                    
                    $SQ="SELECT tr_code as tr_code FROM josh_head_tr WHERE periode = '".$periode."' AND staff_no='".$rec['staff_no']."' GROUP BY tr_code";
                    $tr=$this->db->query($SQ);
                    if ($tr->num_rows()>=1){
                    $tr=$tr->row_array();
                    $tr_code=$tr['tr_code'];
                    }
                    else
                    {
                        $tr_code="1222";
                    }
                    
           ?>
           <?php
            $this->db->select('jht.tr_code,jht.periode,jht.staff_no,jht.staff_name,jht.pos_name,js.basic_salary,js.allowance,js.allowance_2,(js.basic_salary)* 0.5 as bas_salary,(js.basic_salary)/ 173 as hour_salary,SUM(over_time_app) as app,js.transport_salary as transport,sum(jddt.transport_chf) as transport2,SUM(jddt.x1) as x1,SUM(jddt.x2) as x2,SUM(jddt.x3) as x3,SUM(jddt.x4) as x4,js.ot_salary as over_meal,SUM(jddt.meal) as meal,js.adjust,js.debt');
            $this->db->join('josh_head_tr jht','jht.staff_no=js.staff_no','LEFT');
            $this->db->join('josh_details_day_tr jddt','jddt.tr_code=jht.tr_code','LEFT');
            $this->db->where('jht.tr_code',$tr_code);
            $this->db->where('jht.periode',$periode);
            $this->db->where('js.per_salary',$periode);
            $this->db->where('jht.staff_no',$rec['staff_no']);
            $this->db->where('jht.status_hrd','approval');
		    $this->db->group_by('jht.tr_code');
            $this->db->order_by('jht.staff_no','ASC');
            $Q=$this->db->get("josh_salary js");
            //echo $Q;
            if($Q->num_rows()>= 1 )
		     {
			    $row=$Q->row_array(); }
	        else{$row[]=0;} 
            
            //$row=$Q->row_array();
            if($Q->num_rows()>= 1 ) {
                $salary_last_half=$row['bas_salary'];
                $salary_last_hour=$row['hour_salary'];
                //perhitungan tunjangan
                $allow_last=$row['allowance'] * 0.5;
                $allow_last_2=$row['allowance_2'] * 0.5;  
                //perhitungan perkalian
                $xl1= $row['x1'];
                $xl2= $row['x2'];
                $xl3= $row['x3'];
                $xl4= $row['x4'];
                //perhitungan perkalian overtime
                $xxl1=$xl1 * 1.5;
                $xxl2=$xl2 * 2;
                $xxl3=$xl3 * 3;
                $xxl4=$xl4 * 4;
                //perhitungan uang overtime
                $salary_last_overtime=($row['hour_salary'] * $xxl1) + ($row['hour_salary'] * $xxl2)  + ($row['hour_salary'] * $xxl3) + ($row['hour_salary'] * $xxl4);  
                //echo $salary_last_overtime;
                //salary meal
                $salary_last_meal=$row['over_meal'] * $row['meal'];
                //day active 
                //$day=$rec['day'];
                $SQL="SELECT COUNT(DISTINCT(date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$row['tr_code']."' AND jdt.job_code<>'NC1001' AND jdt.job_code<>'NC1002' ";
                $w=$this->db->query($SQL);
                $r=$w->row_array();
                $day11=$r['acc'];

                
                //end day  ]
                //transport / day
                $salary_last_transport= $row['transport'] * $day11;
                // reimbust transport
                $salary_alow_transp=$row['transport2'];
                //total
                $adjust_last=$row['adjust'];
                //total
                $deb_last=$row['debt'];
                              
                $last_periode =($salary_last_half + $allow_last + $allow_last_2 + $salary_last_overtime + $salary_last_meal + $salary_last_transport + $salary_alow_transp + $adjust_last ) - $deb_last;
                //echo  $salary_last_overtime;
                echo number_format($last_periode,2);
              } else 
              {
                echo number_format($last_periode=0,2);
              }
              
              $tlp=$tlp + $last_periode;  
            ?>
           </div>
           <div class="total" align="right"><?php  echo number_format($j=$this_periode + $last_periode,2); $tp=$tp + $j; ?></div>
		   		
                <div class="clear"></div>
         </div>       
   <?php endforeach; ?>
    
    <!-- TOTAL PER GROUP -->
    <div class="content contol bold">
                <div class="codePro"></div>
				<div class="namePro"><b style="font-weight: bold;">TOTAL</b></div>
				
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($month,2); $tot_month=$tot_month + $month; ?></div>
				<div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($allowt,2);$tot_allowt=$tot_allowt + $allowt; ?></div>
                <div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($allowt_2,2);$tot_allowt_2=$tot_allowt_2 + $allowt_2; ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($half,2);$tot_half=$tot_half+$half ?></div>
				<div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($hour,2);$tot_hour + $hour; ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($x1t,0); $tot_x1t=$tot_x1t + $x1t;  ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($x2t,0); $tot_x2t=$tot_x2t + $x2t; ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($x3t,0); $tot_x3t=$tot_x3t + $x3t; ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($x4t,0); $tot_x4t=$tot_x4t + $x4t; ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($xtott,0);$tot_xtott=$tot_xtott + $xtott; ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($mealt,2); $tot_mealt=$tot_mealt+$mealt;  ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($totOT,2); $tot_totOT=$tot_totOT+$totOT;?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tday,0);$tot_tday=$tot_tday + $tday; ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($transpp,2);$tot_transpp=$tot_transpp+$transpp; ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($transnet,2); $tot_transnet=$tot_transnet+$transnet; ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($reimbush,2);$tot_reimbush=$tot_reimbush+$reimbush; ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($adjustment,2);$tot_adjustment=$tot_adjustment+$adjustment; ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($adjust,2);$tot_adjust=$tot_adjust+$adjust; ?></div>
				<div class="total" align="right" style="font-weight: bold;"><?php echo number_format($thp,2); $tot_thp=$tot_thp+$thp; ?></div>
				<div class="total" align="right" style="font-weight: bold;"><?php echo number_format($tlp,2);$tot_tlp=$tot_tlp+$tlp; ?></div>
                <div class="total" align="right" style="font-weight: bold;"><?php echo number_format($tp,2);$tot_tp=$tot_tp + $tp; ?></div>
				<div class="clear"></div>
           </div>     
             
    <!-- TOTAL PER GROUP -->
    
     
 <?php endforeach;  ?>   
 
 
 <!-- GRAND TOTAL -->
 <br />
         <div class="menu total2">
                <div class="codePro"></div>
				<div class="namePro"><b style="font-weight: bold;">GRAND TOTAL</b></div>
				
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_month,2); ?></div>
				<div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($tot_allowt,2); ?></div>
				<div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($tot_allowt_2,2); ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_half,2); ?></div>
				<div class="salmon2" align="right" style="font-weight: bold;"><?php echo number_format($tot_hour,2); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_x1t,0); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_x2t,0); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_x3t,0); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_x4t,0); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_xtott,0); ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_mealt,2); ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_totOT,2); ?></div>
				<div class="ot" align="right" style="font-weight: bold;"><?php echo number_format($tot_tday,0); ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_transpp,2); ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_transnet,2); ?></div>
				<div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_reimbush,2); ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_adjustment,2); ?></div>
                <div class="salmon" align="right" style="font-weight: bold;"><?php echo number_format($tot_adjust,2); ?></div>
				<div class="total" align="right" style="font-weight: bold;"><?php echo number_format($tot_thp,2); ?></div>
				<div class="total" align="right" style="font-weight: bold;"><?php echo number_format($tot_tlp,2); ?></div>
                <div class="total" align="right" style="font-weight: bold;"><?php echo number_format($tot_tp,2); ?></div>
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
