<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/overtime/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1></h1></div>
                <div class="titleLap"><h2><br /></h2></div>
                <div class="clear"></div>
            </div>
            <div class="title">
                <div class="titleLap"><h1></h1></div>
                <div class="titleLap"><h2><br />Formulir Overtime<br /></h2></div>
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
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="codePro">Job Code</div>
                <div class="transp">Time(From-To)</div>
                <div class="over">Over</div>
                <div class="over">App</div>
                <div class="over">A(X1)</div>
                <div class="over">B(X2)</div>
                <div class="over">C(X3)</div>
                <div class="over">D(X4)</div>
                <div class="charge">App Charge</div>
                <div class="charge">App Manager</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK -->
   <?php
        $time=0;
        $transport=0;
        //$subtime=0;
        //$subtransport=0;
        $totalover=0;
        $totalover_app=0;
        $totalx1=0;
        $totalx2=0;
        $totalx3=0;
        $totalx4=0;
   ?>    
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="namePro"><?php echo $rec['name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="transp"></div>
                <div class="over"></div>
                <div class="over"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
       <?php
           
           $subtransport=0;
           $subtime=0;
           $transport=0;
		   $ot=0;
		   $ot_app=0;
           $ot_x1=0;
           $ot_x2=0;
           $ot_x3=0;
           $ot_x4=0;
        ?>
        
<?php $sql="SELECT date,time,transport_chf,app_charge,signature_charge,app_manager,signature_manager,time_1,time_2,over_time,over_charge,over_charge_sign,over_manager,over_manager_sign,over_time_app,x1,x2,x3,x4  FROM josh_details_day_tr WHERE code LIKE '%".substr($rec['day_code'],0,30)."%' AND over_time <> 0 order by date ASC "; ?>
<?php //echo $sql;?>        
<?php $exe=mysql_query($sql);?>
        <?php while($rec2=mysql_fetch_array($exe)){?>
        <div class="content">
                <div class="namePro"><?php echo $rec2['date'];?></div>
                <div class="codePro" align="center">
                     
                </div>
                
                <div class="charge" align="center">
                  <?php if($rec2['over_charge']=="yes") {?>
                        <img src="<?php echo base_url().$rec2['over_charge_sign'];?>" class="sign left" />
                    <?php } else { ?>
                        -
                    <?php } ?>
                </div>
                <div class="charge" align="center">
                  <?php if($rec2['over_manager']=="yes") {?>
                        <img src="<?php echo base_url().$rec2['over_manager_sign'];?>" class="sign left" />
                    <?php } else { ?>
                        -
                    <?php } ?>
                </div>

                <div class="transp" align="right"> 
                     <?php echo $rec2['time_1'].'-'.$rec2['time_2']; ?>
                </div>
                
                <div class="over" align="right"> 
                     <?php $ot=$ot + $rec2['over_time']; echo $rec2['over_time']; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $ot_app=$ot_app + $rec2['over_time_app']; echo $rec2['over_time_app']; ?>
                </div>
                
                <div class="over" align="right"> 
                     <?php $ot_x1=$ot_x1 + $rec2['x1']; echo $rec2['x1']; ?>
                </div>
                
                <div class="over" align="right"> 
                     <?php $ot_x2=$ot_x2 + $rec2['x2']; echo $rec2['x2']; ?>
                </div>
                
                <div class="over" align="right"> 
                     <?php $ot_x3=$ot_x3 + $rec2['x3']; echo $rec2['x3']; ?>
                </div>
                
                <div class="over" align="right"> 
                     <?php $ot_x4=$ot_x4 + $rec2['x4']; echo $rec2['x4']; ?>
                </div>
                
                <div class="clear"></div>
        </div>
       <?php } ?>
        
        <div class="content contol">
                <div class="namePro">SUB TOTAL</div>
                <div class="codePro" align="center"></div>
                <div class="charge" align="center">
                  
                </div>
                <div class="charge" align="center">
                  
                </div>

                <div class="transp" align="right"> 
                     
                </div>
                
                <div class="over" align="right"> 
                     <?php $totalover=$totalover+$ot; echo $ot; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $totalover_app=$totalover_app+$ot_app; echo $ot_app; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $totalx1=$totalx1+$ot_x1; echo $ot_x1; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $totalx2=$totalx2+$ot_x2; echo $ot_x2; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $totalx3=$totalx3+$ot_x3; echo $ot_x3; ?>
                </div>
                <div class="over" align="right"> 
                     <?php $totalx4=$totalx4+$ot_x4; echo $ot_x4; ?>
                </div>
				 <div class="clear"></div>
        </div>
       <?php endforeach; ?>  
        <!-- Finish -->
        
        <div class="content total2">
                <div class="namePro">GRAND TOTAL</div>
                <div class="codePro" align="center"></div>
                <div class="charge" align="center">
                  
                </div>
                <div class="charge" align="center">
                  
                </div>

                <div class="transp" align="right"> 
                     
                </div>
                
                <div class="over" align="right"> 
                     <?php echo $totalover; ?>
                </div>
                <div class="over" align="right"> 
                     <?php echo $totalover_app; ?>
                </div>
                <div class="over" align="right"> 
                     <?php echo $totalx1; ?>
                </div>
                <div class="over" align="right"> 
                     <?php echo $totalx2; ?>
                </div>
                <div class="over" align="right"> 
                     <?php echo $totalx3; ?>
                </div>
                <div class="over" align="right"> 
                     <?php echo $totalx4; ?>
                </div>
                <div class="clear"></div>
        </div>
        
        
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
                
                <!--
                <div class="ch1">
                    <br />
                    <center>Accounting</center><br/>
                    <center><?php if($acc_signature<>""){ ?><img src="<?php echo base_url().$acc_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    
                    <center class="names">(<?php echo $acc_name;?>)</center>
                </div>
                -->
            </div>
        </div>
       
       
        </div>
                       
    
</body>
</html>
