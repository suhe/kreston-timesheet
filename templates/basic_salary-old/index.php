<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/transport/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1>AUDITOR SALARY REPORT</h1></div>
                <div class="titleLap"><h2>EPPS</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">NAME : <?php echo $name; ?></div>
                <div class="no">STAFF NUMBER : <?php echo $no; ?></div>
                <div class="periode">PERIODE END : <?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
                <div class="namePro">ITEM NAME</div>
                <div class="codePro">Amount Basic</div>
                <div class="transp">Amount</div>
                <div class="charge"></div>
                <div class="charge"></div>
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
                <div class="codePro" align="right"><?php echo number_format($rec['basic_salary'],2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Salary Perh Half Month</div>
                <div class="codePro" align="right"><?php echo number_format($rec['bas_salary'],2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total Salary This Periode</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"><?php echo number_format($salary=$rec['bas_salary'],2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Position Allowance Per Month</div>
                <div class="codePro" align="right"><?php echo number_format($rec['allowance'],2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Position Allowance Half Month</div>
                <div class="codePro" align="right"><?php echo number_format($rec['allowance'] * 0.5 ,2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total Allowance This Periode</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"><?php echo number_format($allowence=$rec['allowance'] * 0.5 ,2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Salary Perh Hour</div>
                <div class="codePro" align="right"><?php echo number_format($rec['hour_salary'],2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">OVERTIME FOR THE PERIOD</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		<div class="content contol">
                <div class="namePro">A (x1.5)</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">B (x2.0)</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">C (x3.0)</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">D (x4.0)</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Total OT Hours / Rupiah</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"><?php $overtime=0;//echo number_format($rec['bas_salary'],2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Daily Transport Allow</div>
                <div class="codePro" align="right"><?php echo number_format($rec['transport'],2); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Days Attended </div>
                <div class="codePro" align="right"><?php echo number_format($rec['day_active'],0); ?></div>
                <div class="transp" align="right"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content total2">
                <div class="namePro">Net Transport Allow</div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"><?php echo number_format($transp_allow=$rec['net_transport'],2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
		
		<div class="content contol">
                <div class="namePro">Client Transport </div>
                <div class="codePro" align="right"></div>
                <div class="transp" align="right"><?php echo number_format($transp_client=$rec['transport2'],2); ?></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>

        <div class="menu total2">
                <div class="namePro">GRAND TOTAL</div>
                <div class="codePro"></div>
                <div class="transp" align="right"><?php echo number_format($salary + $allowence + $overtime + $transp_allow + $transp_client,2); ?>
	  </div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div> 
	   	 
       <?php endforeach; ?>  
        <!-- Finish -->
        
        
        
        <!--
        <div id="keterangan">
            <div class="chargeb">
                
                <div class="ch1">
                     <br />
                     <center>Manager In Charge</center><br/>
                     <center><?php if($manager_signature<>""){ ?><img src="<?php echo base_url().$manager_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /> <?php } ?></center>
                     <center><span class="names"><?php echo $manager_name; ?></span></center>
                     <center class="names">(Manager In Charge)</center>
                </div>
                
                <div class="ch1">
                    <br />
                    <center>HR And GA Manager</center><br/>
                    <center><?php if($hrd_signature<>""){ ?><img src="<?php echo base_url().$hrd_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    <center class="names">(<?php echo $hrd_name;?>)</center>
                </div>
                
                
                <div class="ch1">
                    <br />
                    <center>Accounting</center><br/>
                    <center><?php if($acc_signature<>""){ ?><img src="<?php echo base_url().$acc_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    
                    <center class="names">(<?php echo $acc_name;?>)</center>
                </div>
                
            </div>
        </div>
       
       
        </div>
		-->
                       
    
</body>
</html>