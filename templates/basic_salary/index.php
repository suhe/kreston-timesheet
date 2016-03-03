<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/basic_salary/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1>Slip Gaji </h1></div>
                <div class="titleLap"><h2>ESR</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">NAME : <?php echo $name; ?></div>
                <div class="no">STAFF NUMBER : <?php echo $no; ?></div>
                <div class="periode">PERIODE END : <?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
		
		<hr/>
        <div class="menu total2">
                <div class="namePro">Item Name</div>
                <div class="codePro"><center>Periode 05</center></div>
                <div class="codePro"><center>Periode 20</center></div>
                <div class="codePro"><center>Total</center></div>
                <div class="clear"></div>
        </div>
        
       <!-- Start -->
   
   <?php
      $salary=0;
	  $allowence=0;
	  $overtime=0;
	  $transp_allow=0;
	  $transp_client=0;
	  
   ?>
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="namePro">Basic Salary Per Month</div>
				<?php
				   $this->db->where('staff_no',$no);		
				   $this->db->where('per_salary',$order05);
				   $Q=$this->db->get('josh_salary',1);
				   $query=$Q->row_array();
				   if(COUNT($query)>=1):
						$salary = $query['basic_salary'];
						$hour   = $query['basic_salary']/173;
						$allow  = $query['allowance'] + $query['allowance_2'];
						$outmeal= $query['ot_salary'];
						$transport=$query['transport_salary'];		
				   else:
						$salary = 0 ;
						$hour=0;		
						$allow  = 0 ; 
						$outmeal=0;
						$transport=0;
				   endif;
				?>
				
				<?php
				   $this->db->where('staff_no',$no);		
				   $this->db->where('per_salary',$order20);
				   $Q=$this->db->get('josh_salary',1);
				   $query=$Q->row_array();
				   if(COUNT($query)>=1):
						$salary2 = $query['basic_salary'];
						$hour2   = $query['basic_salary']/173;
						$allow2  = $query['allowance'] + $query['allowance_2'];
						$outmeal2= $query['ot_salary'];
						$transport2=$query['transport_salary'];		
				   else:
						$salary2 = 0 ;
						$hour2=0;		
						$allow2  = 0 ; 
						$outmeal2=0;
						$transport2=0;
				   endif;
				?>
                <div class="codePro" align="right"><?php echo number_format($salary,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($salary2,2); ?></div>
				<div class="codePro" align="right"><?php echo number_format(($salary2+$salary)/2,2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Salary Perh Half Month</div>
				<?php
					$half_salary=$salary/2;
					$half_salary2=$salary2/2;
				?>
                <div class="codePro" align="right"><?php echo number_format($half_salary,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($half_salary2,2); ?></div>
                <div class="codepro" align="right"><b><?php echo number_format(($half_salary2+$half_salary),2); ?></b></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total Salary This Periode</div>
                <div class="codePro" align="right"><b><?php echo number_format($half_salary,2); ?></b></div>
                <div class="codepro" align="right"><b><?php echo number_format($half_salary2,2); ?></b></div>
                <div class="codepro" align="right"><b><?php echo number_format(($half_salary2+$half_salary),2); ?></b></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Total Allowance Per Month</div>
                <div class="codePro" align="right"><?php echo number_format($allow,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($allow2,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format(($allow2+$allow)/2,2); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
		        <?php
					$half_allow=$allow/2;
					$half_allow2=$allow2/2;
				?>
                <div class="namePro">Total Allowance Half Month</div>
                <div class="codePro" align="right"><?php echo number_format($half_allow,2); ?></div>
                <div class="codepro" align="right"><?php echo number_format($half_allow2,2); ?></div>
                <div class="codepro" align="right"><b><?php echo number_format(($half_allow2+$half_allow)/2,2); ?></b></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total Allowance This Periode</div>
                <div class="codePro" align="right"><b><?php echo number_format($half_allow,2); ?></b></div>
                <div class="codepro" align="right"><b><?php echo number_format($half_allow2,2); ?></b></div>
                <div class="codepro" align="right"><b><?php echo number_format(($half_allow2+$half_allow),2); ?></b></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Salary Perh Hour</div>
                <div class="codePro" align="right"><?php echo number_format($hour,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($hour2,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format(($hour2+$hour)/2,2); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<?php 
			$this->db->select('COUNT(DISTINCT(date)) as day,SUM(transport_chf) as reimbust,SUM(meal) as meal,SUM(x1) * 1.5 as x1,sum(x2) * 2 as x2,SUM(x3) * 3 as x3,SUM(x4) * 4 as x4');
			$this->db->where('tr_code',$tr_code);
			$Q=$this->db->get('josh_details_day_tr',1);
			$trans=$Q->row_array();
			if(COUNT($trans)>=1):
				$x1 = $trans['x1'] * $hour;
				$x2 = $trans['x2'] * $hour;
				$x3 = $trans['x3'] * $hour;
				$x4 = $trans['x4'] * $hour;
				$ot  = $trans['meal'];
				$meal= $trans['meal'] * $outmeal;
				$day = $trans['day'];
				$reim = $trans['reimbust'];
			else:
				$x1 = 0 * $hour;
				$x2 = 0 * $hour;
				$x3 = 0 * $hour;
				$x4 = 0 * $hour;
				$ot =0;
				$meal= 0;
				$day = 0;
				$reim =0;
			endif;
		?>
		
		<?php 
			$this->db->select('COUNT(DISTINCT(date)) as day,SUM(transport_chf) as reimbust,SUM(meal) as meal,SUM(x1) * 1.5 as x1,sum(x2) * 2 as x2,SUM(x3) * 3 as x3,SUM(x4) * 4 as x4');
			$this->db->where('tr_code',$tr_code2);
			$Q=$this->db->get('josh_details_day_tr',1);
			$trans=$Q->row_array();
			if(COUNT($trans)>=1):
				$x12 = $trans['x1'] * $hour;
				$x22 = $trans['x2'] * $hour;
				$x32 = $trans['x3'] * $hour;
				$x42 = $trans['x4'] * $hour;
				$ot2  = $trans['meal'];
				$meal2= $trans['meal'] * $outmeal;
				$day2 = $trans['day'];
				$reim2 = $trans['reimbust'];
			else:
				$x12 = 0 * $hour;
				$x22 = 0 * $hour;
				$x32 = 0 * $hour;
				$x42 = 0 * $hour;
				$ot2  = 0;
				$meal2= 0;
				$day2 = 0;
				$reim2 =0;
			endif;
		?>
		
		<div class="content contol">
                <div class="namePro"><b>Overtime</b></div>
                <div class="codePro" align="right"></div>
                <div class="codePro" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		<div class="content contol">
                <div class="namePro">A (x1.5)</div>
                <div class="codePro" align="right"><?php echo $x1; ?></div>
                <div class="codepro" align="right">
                    <?php echo $x12; ?>
                </div>
                <div class="codepro" align="right">
                    <?php echo $x12+$x1; ?>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">B (x2.0)</div>
                <div class="codePro" align="right"><?php echo $x2; ?></div>
                <div class="codepro" align="right">
                  <?php echo $x22; ?>
                </div>
                <div class="codepro" align="right">
                  <?php echo $x22+$x2; ?>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">C (x3.0)</div>
                <div class="codePro" align="right"><?php echo $x3; ?></div>
                <div class="codePro" align="right">
                   <?php echo $x32; ?>
                </div>
                <div class="codePro" align="right">
                   <?php echo $x32+$x3; ?>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">D (x4.0)</div>
                <div class="codePro" align="right"><?php echo $x4; ?></div>
                <div class="codePro" align="right">
                    <?php echo $x42; ?>
                </div>
                <div class="codePro" align="right">
                    <?php echo $x42+$x4; ?>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total Overtime</div>
                <div class="codePro" align="right">
                <b><?php echo number_format($totalx=$x1+$x2+$x3+$x4,2); ?></b>
				</div>
                <div class="codePro" align="right">
                   <b><?php echo number_format($totalx2=$x12+$x22+$x32+$x42,2); ?></b>
                </div>
                <div class="codePro" align="right">
                   <b><?php echo number_format($totalx2+$totalx,2); ?></b>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
		<div class="content contol">
                <div class="namePro">Overtime Meal(Count)</div>
                <div class="codePro" align="right"><?php echo number_format($ot,0); ?></div>
                <div class="codepro" align="right"><?php echo number_format($ot2,0); ?></div>
                <div class="codepro" align="right"><?php echo number_format($ot2+$ot,0); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
        <div class="content contol">
                <div class="namePro">Overtime Meal(Rp.)</div>
                <div class="codePro" align="right"><?php echo number_format($meal,2); ?></div>
                <div class="codepro" align="right"><?php echo number_format($meal2,2); ?></div>
                <div class="codepro" align="right"><?php echo number_format($meal2+$meal,2); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		
		
		<div class="content total2">
                <div class="namePro">Total Outmeal(Rp.)</div>
                <div class="codePro" align="right"><b><?php echo number_format($meal,2); ?></b></div>
                <div class="codePro" align="right">
                  <b><?php echo number_format($meal2,2); ?></b>
                </div>
                <div class="codePro" align="right">
                  <b><?php echo number_format($meal2+$meal,2); ?></b>
                </div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Daily Transport</div>
                <div class="codePro" align="right"><?php echo number_format($transport,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($transport2,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format(($transport2+$transport)/2,2); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Days Attended </div>
                <div class="codePro" align="right">
                    <?php echo $day;?>
                </div>
                <div class="codePro" align="right"><?php echo $day2;?></div>
                <div class="codePro" align="right"><?php echo $day2+$day;?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Net Transport Allow</div>
                <div class="codePro" align="right"><b><?php echo number_format($transp_net=$transport * $day ,2); ?></b></div>
                <div class="codePro" align="right"><?php echo number_format($transp_net2=$transport2 * $day2 ,2); ?></div>
                <div class="codePro" align="right"><?php echo number_format($transp_net2+$transp_net ,2); ?></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Client Transport </div>
                <div class="codePro" align="right"><?php echo number_format($reim,2); ?></div>
                <div class="codepro" align="right"><?php echo number_format($reim2,2); ?></div>
                <div class="codepro" align="right"><?php echo number_format($reim+$reim2,2); ?></div>
                
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Grandtotal </div>
                <div class="codePro" align="right"><b><?php  echo number_format($total1= $half_salary + $half_allow + $totalx + $transp_net + $reim,2); ?></b></div>
                <div class="codepro" align="right"><b><?php  echo number_format($total2= $half_salary2 + $half_allow2 + $totalx2 + $transp_net2 + $reim2,2); ?></b></div>
                <div class="codepro" align="right"><b><?php  echo number_format($total1+$total2,2); ?></b></div>
                
                <div class="clear"></div>
        </div>

        
	   	 
       <?php endforeach; ?>  
        <!-- Finish -->
        
        
        
        
        <div id="keterangan">
            <div class="chargeb">
                
                <div class="ch1">
                     <br />
                     <center>Menerima</center><br/>
                     <center><br /><br /> </center>
                     <center><span class="names"><?php echo '( '.$name .' ) '; ?></span></center>
                     <center class="names">Karyawan</center>
                </div>
                
				<!--
                <div class="ch1">
                    <br />
                    <center>HR And GA Manager</center><br/>
                    <center><img src="<?php echo base_url().$hrd_signature; ?>" class="sign2" /><br /><br /><br /> </center>
                    <center class="names">(<?php echo $hrd_name;?>)</center>
                </div>
                -->
                
                <div class="ch1">
                    <br />
                    <center>Menyetujui</center><br/>
                    <center><br /><br /></center>
                    <center><span class="names"><?php echo '(Selvy Desliana)'; ?></span></center>
                    <center class="names"><?php echo 'Finance';?></center>
                </div>
                
            </div>
        </div>
       
       
        </div>
		
                       
    
</body>
</html>
