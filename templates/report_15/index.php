<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/report_20/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1></h1></div>
                <div class="titleLap"><h2></h2></div>
				<br/><br/><br/><br/><br/>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">NAME : <?php echo $name; ?></div>
                <div class="no">STAFF NUMBER : <?php echo $no; ?></div>
                <div class="periode">PERIODE END : <?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu">
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="codePro">Job Code</div>
                <div class="timePro">
                     <div class="timePro1">TIME DISTRIBUTION</div>
                    <div class="time">
                        <div class="cola1">	01</div>
                        <div class="cola2">	02</div>
                        <div class="cola3">	03</div>
                        <div class="cola4">	04</div>
                        <div class="cola5">	05</div>
                        <div class="cola6">	06</div>
                        <div class="cola7">	07</div>
                        <div class="cola8">	08</div>
                        <div class="cola9">	09</div>
                        <div class="cola10">10</div>
                        <div class="cola11">11</div>
                        <div class="cola12">12</div>
                        <div class="cola13">13</div>
                        <div class="cola14">14</div>
                        <div class="cola15">15</div>
                    </div>
                </div>
                <div class="total">Total</div>
                <div class="work">Work Description</div>
                <div class="transp">Transport </div>
				<div class="transp">Approval </div>
                <div class="charge">Aproval(AM)</div>
                <div class="charge2">Aproval(M)</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK --> 
        <div class="type">
            CHARGEABLE HOURS - FIELDWORK
        </div>
        
       <?php
           $a1=0;
           $a2=0;
           $a3=0;
           $a4=0;
           $a5=0;
           $a6=0;
           $a7=0;
           $a8=0;
           $a9=0;
           $a10=0;
           $a11=0;
           $a12=0;
           $a13=0;
           $a14=0;
           $a15=0;
           $transport=0;
		   $transport_app=0;
           $cba=0;
           
        ?>
        
        <?php
 		   $o1=0;
           $o2=0;
           $o3=0;
           $o4=0;
           $o5=0;
           $o6=0;
           $o7=0;
           $o8=0;
           $o9=0;
           $o10=0;
           $o11=0;
           $o12=0;
           $o13=0;
           $o14=0;
           $o15=0;
		?>
		
        
        <?php foreach($chf as $rec): ?>
        
        <?php
			$a=0;
			$b=0;
			$c=0;
			$d=0;
			$e=0;
			$f=0;
			$g=0;
			$h=0;
			$i=0;
			$j=0;
			$l=0;
			$m=0;
			$n=0;
			$o=0;
		    $p=0;
								
		?> 
		
        
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        <?php 
                            $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='chf' order by date ASC";
							
						?> 
                       <?php $Q=$this->db->query($sql); ?>
                       <?php $records2=$Q->result_array(); ?>
                       <?php foreach($records2 as $rec2): ?>   
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>">  <?php if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $a=$rec2['time'] + $rec2['over_time']; $a1=$a1+$a;   $o1=$o1   + $rec2['over_time'];} else {echo $a=$rec2['time'] + $rec2['over_time_app'];$a1=$a1+$a;   $o1=$o1   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $b=$rec2['time'] + $rec2['over_time']; $a2=$a2+$b;   $o2=$o2   + $rec2['over_time'];} else {echo $b=$rec2['time'] + $rec2['over_time_app'];$a2=$a2+$b;   $o2=$o2   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $c=$rec2['time'] + $rec2['over_time']; $a3=$a3+$c;   $o3=$o3   + $rec2['over_time'];} else {echo $c=$rec2['time'] + $rec2['over_time_app'];$a3=$a3+$c;   $o3=$o3   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $d=$rec2['time'] + $rec2['over_time']; $a4=$a4+$d;   $o4=$o4   + $rec2['over_time'];} else {echo $d=$rec2['time'] + $rec2['over_time_app'];$a4=$a4+$d;   $o4=$o4   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $e=$rec2['time'] + $rec2['over_time']; $a5=$a5+$e; $o5=$o5 + $rec2['over_time'];} else {echo $e=$rec2['time'] + $rec2['over_time_app'];$a5=$a5+$e; $o5=$o5 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $f=$rec2['time'] + $rec2['over_time']; $a6=$a6+$f; $o6=$o6 + $rec2['over_time'];} else {echo $f=$rec2['time'] + $rec2['over_time_app'];$a6=$a6+$f; $o6=$o6 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $g=$rec2['time'] + $rec2['over_time']; $a7=$a7+$g; $o7=$o7 + $rec2['over_time'];} else {echo $g=$rec2['time'] + $rec2['over_time_app'];$a7=$a7+$g; $o7=$o7 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $h=$rec2['time'] + $rec2['over_time']; $a8=$a8+$h; $o8=$o8 + $rec2['over_time'];} else {echo $h=$rec2['time'] + $rec2['over_time_app'];$a8=$a8+$h; $o8=$o8 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $i=$rec2['time'] + $rec2['over_time']; $a9=$a9+$i; $o9=$o9 + $rec2['over_time'];} else {echo $i=$rec2['time'] + $rec2['over_time_app'];$a9=$a9+$i; $o9=$o9 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola10<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?> red <?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $j=$rec2['time'] + $rec2['over_time'];$a10=$a10+$j; $o10=$o10 + $rec2['over_time'];} else {echo $j=$rec2['time'] + $rec2['over_time_app'];$a10=$a10+$j; $o10=$o10 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $l=$rec2['time'] + $rec2['over_time']; $a11=$a11+$l; $o11=$o11 + $rec2['over_time'];} else {echo $l=$rec2['time'] + $rec2['over_time_app'];$a11=$a11+$l; $o11=$o11 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $m=$rec2['time'] + $rec2['over_time']; $a12=$a12+$m; $o12=$o12 + $rec2['over_time'];} else {echo $m=$rec2['time'] + $rec2['over_time_app'];$a12=$a12+$m; $o12=$o12 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $n=$rec2['time'] + $rec2['over_time']; $a13=$a13+$n; $o13=$o13 + $rec2['over_time'];} else {echo $n=$rec2['time'] + $rec2['over_time_app'];$a13=$a13+$n; $o13=$o13 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $o=$rec2['time'] + $rec2['over_time']; $a14=$a14+$o; $o14=$o14 + $rec2['over_time'];} else {echo $o=$rec2['time'] + $rec2['over_time_app'];$a14=$a14+$o; $o14=$o14 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $p=$rec2['time'] + $rec2['over_time']; $a15=$a15+$p; $o15=$o15 + $rec2['over_time'];} else {echo $p=$rec2['time'] + $rec2['over_time_app'];$a15=$a15+$p; $o15=$o15 + $rec2['over_time_app'];}  } ?></div>
                            
                            
         
                         <?php endforeach; ?> 
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $abc = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $l + $m + $n + $o + $p;
						 echo $abc;
                         $cba=$cba + $abc;
                     ?>    	
                </div>
                
                <div class="work"><?php echo $rec['work_description']; ?></div>
                <div class="transp" align="right">
                    <?php $sql="SELECT SUM(transport_chf) as transporttot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php $transport=$transport + $rec2['transporttot'];?>
                    <?php echo number_format($rec2['transporttot'],2);?>
                </div>
				
				<div class="transp" align="right">
				<?php if(($rec['staff_approval']=='yes') || ($rec['staff_approval2']=='yes')  ): ?>
                    <?php $sql="SELECT SUM(transport_chf) as transporttot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php $transport_app=$transport_app + $rec2['transporttot'];?>
                    <?php echo number_format($rec2['transporttot'],2);?>
				<?php else:?>
					<?php echo number_format(0,2);?>	
				<?php endif;?>	
                </div>
                
                <!-- For AM / S -->
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?>    
                </div>
                <!-- For AM / S -->
                
                <!-- For P / M -->
                <div class="charge2">
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?>    
                </div>
                <!-- For P / M -->
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time">
                        
                        <div class="cola1">
                           <?php echo $a1; ?>
                        </div>
                        <div class="cola2">
                            <?php echo $a2; ?>
                        </div>
                        <div class="cola3">
							<?php echo $a3; ?>
                        </div>
                        <div class="cola4">
							<?php echo $a4; ?>
                        </div>
                        <div class="cola5">
							<?php echo $a5; ?>
                        </div>
                        <div class="cola6">
							<?php echo $a6; ?>
                        </div>
                        <div class="cola7">
							<?php echo $a7; ?>
                        </div>
                        <div class="cola8">
							<?php echo $a8; ?>
                        </div>
                        <div class="cola9">
							<?php echo $a9; ?>                        
						</div>
                        <div class="cola10">
							<?php echo $a10; ?>
                        </div>
                        
                        <div class="cola11">
							<?php echo $a11; ?>
                        </div>
                        <div class="cola12">
							<?php echo $a12; ?>
                        </div>
                        <div class="cola13">
							<?php echo $a13; ?>
                        </div>
                        <div class="cola14">
							<?php echo $a14; ?>
                        </div>
                        <div class="cola15">
							<?php echo $a15; ?>
                        </div>
                        
                    </div>
                </div>
                <div class="total"><?php echo $total_a=$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8+$a9+$a10+$a11+$a12+$a13+$a14+$a15;?></div>
                <div class="work"></div>
                <div class="transp" align="right"><?php echo number_format($transport,2);?></div>
				<div class="transp" align="right"><?php echo number_format($transport_app,2);?></div>
                <div class="charge">-</div>
                <div class="charge2">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start CHARGEABLE HOURS - OFFICE --> 
        <div class="type">
            CHARGEABLE HOURS - OFFICE
        </div>
        
       <?php
           $ccbbaa=0;
           $b1=0;
           $b2=0;
           $b3=0;
           $b4=0;
           $b5=0;
           $b6=0;
           $b7=0;
           $b8=0;
           $b9=0;
           $b10=0;
           $b11=0;
           $b12=0;
           $b13=0;
           $b14=0;
           $b15=0;
           
           $transport=0;
        ?>
        
        <?php
           $ov1=0;
           $ov2=0;
           $ov3=0;
           $ov4=0;
           $ov5=0;
           $ov6=0;
           $ov7=0;
           $ov8=0;
           $ov9=0;
           $ov10=0;
           $ov11=0;
           $ov12=0;
           $ov13=0;
           $ov14=0;
           $ov15=0;
           
        ?>
		
		
        <?php foreach($cho as $rec): ?>
        
		
		<?php
			$aa=0;
			$bb=0;
			$cc=0;
			$dd=0;
			$ee=0;
			$ff=0;
			$gg=0;
			$hh=0;
			$ii=0;
			$jj=0;
			$ll=0;
			$mmx=0;
			$nn=0;
			$oo=0;
		    $pp=0;				
		?>
        
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                          
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $aa=$rec2['time'] + $rec2['over_time']; $b1=$b1  + $aa;  $ov1 =$ov1 +$rec2['over_time']; } else {echo  $aa =$rec2['time'] + $rec2['over_time_app'];$b1 =$b1+$aa;  $ov1 = $ov1 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola2  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $bb=$rec2['time'] + $rec2['over_time']; $b2=$b2  + $bb;  $ov2 =$ov2 +$rec2['over_time']; } else {echo  $bb =$rec2['time'] + $rec2['over_time_app'];$b2 =$b2+$bb;  $ov2 = $ov2 +$rec2['over_time_app']; }  } ?></div>
                            <div class="cola3  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $cc=$rec2['time'] + $rec2['over_time']; $b3=$b3  + $cc;  $ov3 =$ov3 +$rec2['over_time']; } else {echo  $cc =$rec2['time'] + $rec2['over_time_app'];$b3 =$b3+$cc;  $ov3 = $ov3 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola4  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $dd=$rec2['time'] + $rec2['over_time']; $b4=$b4  + $dd;  $ov4 =$ov4 +$rec2['over_time']; } else {echo  $dd =$rec2['time'] + $rec2['over_time_app'];$b4 =$b4+$dd;  $ov4 = $ov4 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola5  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $ee=$rec2['time'] + $rec2['over_time']; $b5=$b5+ $ee;  	 $ov5 =$ov5+$rec2['over_time']; } else {echo  $ee =$rec2['time'] + $rec2['over_time_app'];$b5=$b5+$ee; 	  $ov5= $ov5+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola6  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $ff=$rec2['time'] + $rec2['over_time']; $b6=$b6+ $ff;    $ov6 =$ov6+$rec2['over_time']; } else {echo  $ff =$rec2['time'] + $rec2['over_time_app'];$b6=$b6+$ff; 	  $ov6= $ov6+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola7  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $gg=$rec2['time'] + $rec2['over_time']; $b7=$b7+ $gg;    $ov7 =$ov7+$rec2['over_time']; } else {echo  $gg =$rec2['time'] + $rec2['over_time_app'];$b7=$b7+$gg;    $ov7= $ov7+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola8  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $hh=$rec2['time'] + $rec2['over_time']; $b8=$b8+ $hh;    $ov8 =$ov8+$rec2['over_time']; } else {echo  $hh =$rec2['time'] + $rec2['over_time_app'];$b8=$b8+$hh; 	  $ov8= $ov8+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola9  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $ii=$rec2['time'] + $rec2['over_time']; $b9=$b9+ $ii;    $ov9 =$ov9+$rec2['over_time']; } else {echo  $ii =$rec2['time'] + $rec2['over_time_app'];$b9=$b9+$ii; 	  $ov9= $ov9+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $jj=$rec2['time'] + $rec2['over_time']; $b10=$b10+ $jj;  $ov10=$ov10+$rec2['over_time']; } else {echo  $jj =$rec2['time'] + $rec2['over_time_app'];$b10=$b10+$jj; $ov10= $ov10+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $ll=$rec2['time'] + $rec2['over_time']; $b11=$b11+ $ll;  $ov11=$ov11+$rec2['over_time']; } else {echo  $ll =$rec2['time'] + $rec2['over_time_app'];$b11=$b11+$ll; $ov11= $ov11+$rec2['over_time_app'];} } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $mmx=$rec2['time']+ $rec2['over_time']; $b12=$b12+$mmx;  $ov12=$ov12+$rec2['over_time']; } else {echo  $mmx=$rec2['time'] + $rec2['over_time_app'];$b12=$b12+$mmx;$ov12= $ov12+$rec2['over_time_app'];} } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $nn=$rec2['time'] + $rec2['over_time']; $b13=$b13+ $nn;  $ov13=$ov13+$rec2['over_time']; } else {echo  $nn =$rec2['time'] + $rec2['over_time_app'];$b13=$b13+$nn; $ov13= $ov13+$rec2['over_time_app'];} } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $oo=$rec2['time'] + $rec2['over_time']; $b14=$b14+ $oo;  $ov14=$ov14+$rec2['over_time']; } else {echo  $oo =$rec2['time'] + $rec2['over_time_app'];$b14=$b14+$oo; $ov14= $ov14+$rec2['over_time_app'];} } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $pp=$rec2['time'] + $rec2['over_time']; $b15=$b15+ $pp;  $ov15=$ov15+$rec2['over_time']; } else {echo  $pp =$rec2['time'] + $rec2['over_time_app'];$b15=$b15+$pp; $ov15= $ov15+$rec2['over_time_app'];} } ?></div>
                        
                        <?php } ?>
                        
                    </div>
                </div>
                
                <div class="total">
                    <?php $aabbcc=$aa + $bb + $cc + $dd + $ee + $ff + $gg + $hh + $ii + $jj  + $ll + $mmx + $nn + $oo + $pp; ?>
					<?php echo $aabbcc;  ?>
                </div>
                
                <div class="work"><?php echo $rec['work_description']; ?></div>
                <div class="transp" align="center"> Office </div>
				<div class="transp" align="center"> Office </div>
                <!-- For AM / S -->
                <div class="charge">
                
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?>    
                </div>
                <!-- For AM / S -->
                
                <!-- For M / P -->
                <div class="charge2">
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?>    
                </div>
                <!-- For M / P -->
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time"> 
                     <div class="cola1">
                        <?php echo $b1;?>
                        </div>
                        <div class="cola2">
                        <?php echo $b2;?>
                        </div>
                        <div class="cola3">
                        <?php echo $b3;?>
                        </div>
                        <div class="cola4">
                        <?php echo $b4;?>
                        </div>
                        <div class="cola5">
                        <?php echo $b5;?>
                        </div>
                        <div class="cola6">
                        <?php echo $b6;?>
                        </div>
                        <div class="cola7">
                        <?php echo $b7;?>
                        </div>
                        <div class="cola8">
                        <?php echo $b8;?>
                        </div>
                        <div class="cola9">
                        <?php echo $b9;?>
                        </div>
                        <div class="cola10">
                        <?php echo $b10;?>
                        </div>
                        <div class="cola11">
                        <?php echo $b11;?>
                        </div>
                        <div class="cola12">
                        <?php echo $b12;?>
                        </div>
                        <div class="cola13">
                       <?php echo $b13;?>
                        </div>
                        <div class="cola14">
                       <?php echo $b14;?>
                        </div>
                        <div class="cola15">
                        <?php echo $b15;?>
                        </div>
                    </div>
                    
                </div>
                <div class="total"><?php echo $total_b=$b1+$b2+$b3+$b4+$b5+$b6+$b7+$b8+$b9+$b10+$b11+$b12+$b13+$b14+$b15;?></div>
                <div class="work"></div>
                <div class="transp"></div>
				<div class="transp"></div>
                <div class="charge">-</div>
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start NON-CHARGEABLE HOURS --> 
        <div class="type">
            NON-CHARGEABLE HOURS
        </div>
        
       <?php
           $c1=0;
           $c2=0;
           $c3=0;
           $c4=0;
           $c5=0;
           $c6=0;
           $c7=0;
           $c8=0;
           $c9=0;
           $c10=0;
           $c11=0;
           $c12=0;
           $c13=0;
           $c14=0;
           $c15=0;
           $transport=0;
        ?>
		
		
        
        <?php foreach($nch as $rec): ?>
        <?php
			$aaa=0;
			$bbb=0;
			$ccc=0;
			$ddd=0;
			$eee=0;
			$fff=0;
			$ggg=0;
			$hhh=0;
			$iii=0;
			$jjj=0;
			$lll=0;
			$mmm=0;
			$nnn=0;
			$ooo=0;
		    $ppp=0;				
		?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php   if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $aaa=$rec2['time'] + $rec2['over_time']; $c1 =$c1 +$aaa;} else {echo $aaa=$rec2['time'] + $rec2['over_time_app'];$c1 =$c6 +$aaa;}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $bbb=$rec2['time'] + $rec2['over_time']; $c2 =$c2 +$bbb;} else {echo $bbb=$rec2['time'] + $rec2['over_time_app'];$c2 =$c7 +$bbb;}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $ccc=$rec2['time'] + $rec2['over_time']; $c3 =$c3 +$ccc;} else {echo $ccc=$rec2['time'] + $rec2['over_time_app'];$c3 =$c8 +$ccc;}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $ddd=$rec2['time'] + $rec2['over_time']; $c4 =$c4 +$ddd;} else {echo $ddd=$rec2['time'] + $rec2['over_time_app'];$c4 =$c9 +$ddd;}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $eee=$rec2['time'] + $rec2['over_time']; $c5 =$c5+$eee;} else {echo $eee=$rec2['time'] + $rec2['over_time_app'];$c5=$c5+$eee;}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $fff=$rec2['time'] + $rec2['over_time']; $c6 =$c6+$fff;} else {echo $fff=$rec2['time'] + $rec2['over_time_app'];$c6=$c6+$fff;}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $ggg=$rec2['time'] + $rec2['over_time']; $c7 =$c7+$ggg;} else {echo $ggg=$rec2['time'] + $rec2['over_time_app'];$c7=$c7+$ggg;}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $hhh=$rec2['time'] + $rec2['over_time']; $c8 =$c8+$hhh;} else {echo $hhh=$rec2['time'] + $rec2['over_time_app'];$c8=$c8+$hhh;}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $iii=$rec2['time'] + $rec2['over_time']; $c9 =$c9+$iii;} else {echo $iii=$rec2['time'] + $rec2['over_time_app'];$c9=$c9+$iii;}  } ?></div>
                            <div class="cola10<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $jjj=$rec2['time'] + $rec2['over_time']; $c10=$c10+$jjj;} else {echo $jjj=$rec2['time'] + $rec2['over_time_app'];$c10=$c10+$jjj;}  } ?></div>
                            <div class="cola11<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $lll=$rec2['time'] + $rec2['over_time']; $c11=$c11+$lll;} else {echo $lll=$rec2['time'] + $rec2['over_time_app'];$c11=$c11+$lll;}  } ?></div>
                            <div class="cola12<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $mmm=$rec2['time'] + $rec2['over_time']; $c12=$c12+$mmm;} else {echo $mmm=$rec2['time'] + $rec2['over_time_app'];$c12=$c12+$mmm;}  } ?></div>
                            <div class="cola13<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $nnn=$rec2['time'] + $rec2['over_time']; $c13=$c13+$nnn;} else {echo $nnn=$rec2['time'] + $rec2['over_time_app'];$c13=$c13+$nnn;}  } ?></div>
                            <div class="cola14<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $ooo=$rec2['time'] + $rec2['over_time']; $c14=$c14+$ooo;} else {echo $ooo=$rec2['time'] + $rec2['over_time_app'];$c14=$c14+$ooo;}  } ?></div>
                            <div class="cola15<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $ppp=$rec2['time'] + $rec2['over_time']; $c15=$c15+$ppp;} else {echo $ppp=$rec2['time'] + $rec2['over_time_app'];$c15=$c15+$ppp;}  } ?></div>
                        
                        <?php } ?>
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $aaabbbccc=$aaa + $bbb + $ccc + $ddd + $eee + $fff + $ggg + $hhh + $iii + $jjj + $lll + $mmm + $nnn + $ooo + $ppp; ?>
					<?php echo $aaabbbccc;  ?>
                </div>
                
                <div class="work"><?php echo $rec['work_description']; ?></div>
                <div class="transp" align="center"> - </div>
				<div class="transp" align="center"> - </div>
                
                <!-- AM / S -->
                <div class="charge">
                   <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?>   
                </div>
                <!-- AM / S -->
                
                <!-- M / P -->
                <div class="charge2" >
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?>    
                </div>
                
                <!-- M / P -->
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1 ">
                            
                            <?php echo $c1;?>
                        </div>  
                        
                        <div class="cola2">
                            <?php echo $c2;?>
                        </div>
                        <div class="cola3">
                            <?php echo $c3;?>
                        </div>
                        <div class="cola4">
                            <?php echo $c4;?>
                        </div>
                        <div class="cola5">
                           <?php echo $c5;?>
                        </div>
                        <div class="cola6">
                            <?php echo $c6;?>
                        </div>
                        <div class="cola7">
                            <?php echo $c7;?>
                        </div>
                        <div class="cola8">
                            <?php echo $c8;?>
                        </div>
                        <div class="cola9">
                            <?php echo $c9;?>
                        </div>
                        <div class="cola10">
                            <?php echo $c10;?>
                        </div>
    
                        <div class="cola11">
                            <?php echo $c11;?>
                        </div>
                        <div class="cola12">
                            <?php echo $c12;?>
                        </div>
                        <div class="cola13">
                            <?php echo $c13;?>
                        </div>
                        <div class="cola14">
                            <?php echo $c14;?>
                        </div>
                        <div class="cola15">
                            <?php echo $c15;?>
                        </div>
                    </div>
                </div>
                <div class="total"><?php echo $total_c=$c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8+$c9+$c10+$c11+$c12+$c13+$c14+$c15;?></div>
                <div class="work"></div>
                <div class="transp">-</div>
				<div class="transp">-</div>
                <div class="charge">-</div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <br />
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL HOURS</div>
                <div class="timePro">
                    <div class="time">
                    <?php
                             //standart
                            $tot1=0;
                            $tot2=0;
                            $tot3=0;
                            $tot4=0;
                            $tot5=0;
                            $tot6=0;
                            $tot7=0;
                            $tot8=0;
                            $tot9=0;
                            $tot10=0;
                            $tot11=0;
                            $tot12=0;
                            $tot13=0;
                            $tot14=0;
                            $tot15=0;   
                            
                            //overtime
                            $totA1=0;
                            $totA2=0;
                            $totA3=0;
                            $totA4=0;
                            $totA5=0;
                            $totA6=0;
                            $totA7=0;
                            $totA8=0;
                            $totA9=0;
                            $totA10=0;
                            $totA11=0;
                            $totA12=0;
                            $totA13=0;
                            $totA14=0;
                            $totA15=0;
                        ?>     
                    <div class="cola1">
		               <?php echo $tot1=$a1 + $b1 + $c1; ?>
                    </div>
                            
                    <div class="cola2">
                       <?php echo $tot2=$a2 + $b2 + $c2; ?>  
                    </div>
                            
                    <div class="cola3">
                        <?php echo $tot3=$a3 + $b3 + $c3; ?>  
                    </div>
                            
                    <div class="cola4">
                        <?php echo $tot4=$a4 + $b4 + $c4; ?>
                    </div>
                            
                    <div class="cola5">
                        <?php echo $tot5=$a5 + $b5 + $c5; ?> 
                    </div>
							
                    <div class="cola6">
                        <?php echo $tot6=$a6 + $b6 + $c6; ?> 
                    </div>
                    
                    <div class="cola7">
                        <?php echo $tot7=$a7 + $b7 + $c7; ?>
                    </div>
                    
                    <div class="cola8">
                         <?php echo $tot8=$a8 + $b8 + $c8;?>
                    </div>
					
                    <div class="cola9">
                        <?php echo $tot9=$a9 + $b9 + $c9; ?>
                    </div>
                    
                    <div class="cola10">
                        <?php echo $tot10=$a10 + $b10 + $c10;?>
                    </div>
    
                    <div class="cola11">
                        <?php echo $tot11=$a11 + $b11 + $c11; ?>
                    </div>
                            
                    <div class="cola12">
                        <?php echo $tot12=$a12 + $b12 + $c12; ?>
                    </div>
                    
                    <div class="cola13">
                        <?php  echo $tot13=$a13 + $b13 + $c13; ?>   
                    </div>
                    
                    <div class="cola14">
                         <?php echo $tot14=$a14 + $b14 + $c14;  ?>   
                    </div>
                    
                    <div class="cola15">
                          <?php echo $tot15=$a15 + $b15 + $c15;
                             ?>   
                    </div>
                     
                    </div>
                </div>
                <?php $tot=0;?>
                <div class="total"><?php echo $tot=$total_a+$total_b+$total_c; //echo $tot=$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12+$tot13+$tot14+$tot15+$tot16+$tot17+$tot18+$tot19+$tot20;?></div>
                <div class="work"></div>
                <div class="transp"></div>
				<div class="transp"></div>
                <div class="charge"></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL OVERTIME</div>
                <div class="timePro">
                    <div class="time">
                    <?php ?>
                        <div class="cola1"><?php echo  $totA1=$o1+$ov1; ?></div>
                        <div class="cola2"><?php echo  $totA2=$o2+$ov2; ?></div>
                        <div class="cola3"><?php echo  $totA3=$o3+$ov3; ?></div>
                        <div class="cola4"><?php echo  $totA4=$o4+$ov4; ?></div>
                        <div class="cola5"><?php echo  $totA5=$o5+$ov5; ?></div>
                        <div class="cola6"><?php echo  $totA6=$o6+$ov6; ?></div>
                        <div class="cola7"><?php echo  $totA7=$o7+$ov7; ?></div>
                        <div class="cola8"><?php echo  $totA8=$o8+$ov8; ?></div>
                        <div class="cola9"><?php echo  $totA9=$o9+$ov9; ?></div>
                        <div class="cola10"><?php echo $totA10=$o10+$ov10; ?></div>
                    
                        <div class="cola11"><?php echo $totA11=$o11+$ov11; ?></div>
                        <div class="cola12"><?php echo $totA12=$o12+$ov12; ?></div>
                        <div class="cola13"><?php echo $totA13=$o13+$ov13; ?></div>
                        <div class="cola14"><?php echo $totA14=$o14+$ov14; ?></div>
                        <div class="cola15"><?php echo $totA15=$o15+$ov15; ?></div>
                    <?php ?>    
                    </div>
                </div>
                <div class="total"><?php  echo $totA1+$totA2+$totA3+$totA4+$totA5+$totA6+$totA7+$totA8+$totA9+$totA10+$totA11+$totA12+$totA13+$totA14+$totA15;?></div>
                <div class="work"></div>
                <div class="transp">-</div>
				<div class="transp">-</div>
                <div class="charge">-</div>
                <div class="charge"> </div>
                <div class="clear"></div>
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">HOURS</div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1"> <?php echo $ato1 = $tot1  - $totA1;?></div>
                        <div class="cola2"> <?php echo $ato2 = $tot2  - $totA2;?></div>
                        <div class="cola3"> <?php echo $ato3 = $tot3  - $totA3;?></div>
                        <div class="cola4"> <?php echo $ato4 = $tot4  - $totA4;?></div>
                        <div class="cola5"> <?php echo $ato5 = $tot5 -  $totA5;?></div>
                        <div class="cola6"> <?php echo $ato6 = $tot6 -  $totA6;?></div>
                        <div class="cola7"> <?php echo $ato7 = $tot7 -  $totA7;?></div>
                        <div class="cola8"> <?php echo $ato8 = $tot8 -  $totA8;?></div>
                        <div class="cola9"> <?php echo $ato9 = $tot9 -  $totA9;?></div>
                        <div class="cola10"><?php echo $ato10= $tot10 - $totA10;?></div>
                        
                        <div class="cola11"><?php echo $ato11= $tot11 - $totA11;?></div>
                        <div class="cola12"><?php echo $ato12= $tot12 - $totA12;?></div>
                        <div class="cola13"><?php echo $ato13= $tot13 - $totA13;?></div>
                        <div class="cola14"><?php echo $ato14= $tot14 - $totA14;?></div>
						<div class="cola15"><?php echo $ato15= $tot15 - $totA15;?></div>
                    </div>
                </div>
				
                <div class="total"><?php echo  $hour=$ato1+$ato2+$ato3+$ato4+$ato5+$ato6+$ato7+$ato8+$ato9+$ato10+$ato11+$ato12+$ato13+$ato14+$ato15;?></div>
                <div class="work" align="right"><b>Productivity :</b></div>
                <div class="transp"><?php echo $tot=$total_a + $total_b + $total_c .'/'.$hour;?></div>
				<div class="transp"></div>
                <div class="charge"><b class="b"><?php $overal=($tot/$hour)*100; echo number_format($overal,0); ?> %</b></div>
                <div class="charge"> </div>
                <div class="clear"></div>
        </div>
        
        
        <br />
        <div id="keterangan">
            <div class="chargeb">
                
                <div class="ch1">
                    <div class="coder">NC1001</div><div class="namer">Personal/Annual Leave </div>
                    <div class="clear"></div>
                    <div class="coder">NC1002</div><div class="namer">Sick Leave</div>
                    <div class="clear"></div>
                    <div class="coder">NC1003</div><div class="namer">Other Leave</div>
                    <div class="clear"></div>
                    <div class="coder">NC1004</div><div class="namer">Out of Office Training</div>
                    <div class="clear"></div>
					<div class="coder">NC1005</div><div class="namer">Self Study </div>
                    <div class="clear"></div>
                </div>
                
                <div class="ch1">
                    <div class="coder">NC1006</div><div class="namer">Proposal to Client</div>
                    <div class="clear"></div>
                    <div class="coder">NC1007</div><div class="namer">Administration</div>
                    <div class="clear"></div>
                    <div class="coder">NC1008</div><div class="namer">Available Time 	</div>
                    <div class="clear"></div>
					<div class="coder">NC1009</div><div class="namer">Late/Tardiness</div>
                    <div class="clear"></div>
					<div class="coder">NC1010</div><div class="namer">Suspension</div>
                    <div class="clear"></div>
                </div>
                
                <div class="ch1">
                    Red   : Saturday & Sunday  <br />
                    Black : Work Day
                </div>
                
                <div class="ch1">
                    <?php foreach($holiday_mm as $day): ?>
	
                        <p><?php echo indo_tgl($day['date_h']);?> :
                        <?php echo $day['description_h'];?></p> 
                    <?php endforeach;?>
                    
                </div>
                
                <!--<div class="ch1">
                     <center>Approval</center><br/>
                     <center><?php if($manager_signature<>""){ ?><img src="<?php echo base_url().$manager_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /> <?php } ?></center>
                     <center><span class="names"><?php echo $manager_name; ?></span></center>
                     <center class="names">(Manager In Charge)</center>
                </div>-->
                
                <div class="ch1">
                    <center>Approval TR & Payroll</center>
					<br />
                    <center>HRD Approval</center>
                    <center><?php if($hrd_signature<>""){ ?><img src="<?php echo base_url().$hrd_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    
                    <center class="names">(<?php echo $hrd_name;?>)</center>
                </div>
                
            </div>
        </div>
                       
    </div>
</body>
</html>
