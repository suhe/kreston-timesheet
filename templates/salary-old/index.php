<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/salary/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1>PAYROLL TIME REPORT V.1.0</h1></div>
                <div class="titleLap"><h2>EPPS</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">PERIODE END : <?php echo $_SESSION['periode']; ?></div>
                <div class="no"><?php // echo $no; ?></div>
                <div class="periode"> <?php //echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
		   <!--
                <div class="codePro">Staff No</div>
				<div class="namePro">Name</div>
                <div class="salary">Position</div>
				<div class="transp">Salary(Month)</div>
				<div class="transp">Salary(Half)</div>
                <div class="transp">Salary(Hour)</div>
				<div class="charge">(O.x.1)</div>
				<div class="charge">(O.x.2)</div>
				<div class="charge">(O.x.3</div>
				<div class="charge">(O.x.4)</div>
				<div class="charge">TOT OT</div>
				<div class="transp">TOT (Rupiah)</div>
				<div class="charge">DAY</div>
				<div class="transp">Transport(Day)</div>
				<div class="transp">Net Transport</div>
				<div class="transp">Take Home</div>
				<div class="transp">Last Periode</div>
				
                <div class="clear"></div>
				-->
				<div class="codePro">Staff No</div>
				<div class="namePro">Name</div>
				<div class="pos">Position</div>
				<div class="salmon" align="center">Salary(Month)</div>
				<div class="salmon2" align="center">Allow</div>
				<div class="salmon" align="center">Salary(Half)</div>
				<div class="salmon2" align="center">Salary(Hour)</div>
				<div class="ot">(O.x.1)</div>
				<div class="ot">(O.x.2)</div>
				<div class="ot">(O.x.3)</div>
				<div class="ot">(O.x.4)</div>
				<div class="ot">TOT</div>
				<div class="salmon">Total OT(Rp)</div>
				<div class="ot">Day</div>
				<div class="salmon" align="center">Transp(Day)</div>
				<div class="salmon" align="center">Transp Net</div>
				<div class="salmon" align="center">Reimbush</div>
				<div class="total" align="center">THP(This Periode)</div>
				<div class="total" align="center">THP(Last Periode)</div>
				<div class="total" align="center">THP(Total)</div>
				<div class="clear"></div>
		</div>
        
       <!-- Start Salary -->
   
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
		   <div class="codePro"><?php echo $rec['no']; ?></div>
		   <div class="namePro"><?php echo $rec['name']; ?></div>
		   <div class="pos"><?php echo $rec['name_p']; ?></div>
		   <div class="salmon" align="right"><?php echo number_format($rec['basic_salary'],2);?></div>
		   <div class="salmon2" align="right"><?php echo number_format($rec['allowance'],2);?></div>
		   <div class="salmon" align="right"><?php echo number_format($rec['bas_salary'],2);?></div>
		   <div class="salmon2" align="right"><?php echo number_format($rec['hour_salary'],2);?></div>
		   <div class="ot">(O.x.1)</div>
		   <div class="ot">(O.x.2)</div>
		   <div class="ot">(O.x.3)</div>
		   <div class="ot">(O.x.4)</div>
		   <div class="ot">(O.x.4)</div>
		   <div class="salmon" align="right"><?php echo number_format($rec['hour_salary'],2);?></div>
		   <div class="ot" align="right"><?php echo $rec['day']; ?></div>
		   <div class="salmon" align="right"><?php echo number_format($rec['transport'],2);?></div>
		   <div class="salmon" align="right"><?php echo number_format($rec['transport'],2);?></div>
		   <div class="salmon" align="right"><?php echo number_format($rec['transport2'],2);?></div>
		   <div class="total" align="right"><?php echo number_format($rec['transport'],2);?></div>
		   <div class="total" align="right"><?php echo number_format($rec['transport'],2);?></div>
		   <div class="total" align="right"><?php echo number_format($rec['transport'],2);?></div>
				
					
                <div class="clear"></div>
         </div>       
   <?php endforeach; ?>  
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