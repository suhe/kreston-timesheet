<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/report_05_30/style.css"  type="text/css"/>
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
                        <div class="cola1">21</div>
                        <div class="cola2">22</div>
                        <div class="cola3">23</div>
                        <div class="cola4">24</div>
                        <div class="cola5">25</div>
                        <div class="cola6">26</div>
                        <div class="cola7">27</div>
                        <div class="cola8">28</div>
                        <div class="cola9">29</div>
                        <!--<div class="cola10">30</div>-->
                        <div class="cola11">01</div>
                        <div class="cola12">02</div>
                        <div class="cola13">03</div>
                        <div class="cola14">04</div>
                        <div class="cola15">05</div>
                    </div>
                </div>
                <div class="total">Total</div>
                <div class="work">Work Description</div>
                <div class="transp">Transport</div>
				<div class="transp">Approval</div>
                <div class="charge">Aproval(AM)</div>
                <div class="charge2">Aproval(M)</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK --> 
        <div class="type">
            CHARGEABLE HOURS - FIELDWORK
        </div>
        
       <?php
           $a21=0;
           $a22=0;
           $a23=0;
           $a24=0;
           $a25=0;
           $a26=0;
           $a27=0;
           $a28=0;
           $a29=0;
           $a30=0;
           //$a31=0;
           $a1=0;
           $a2=0;
           $a3=0;
           $a4=0;
           $a5=0;
           $transport=0;
		   $transport_app=0;
        ?>
		
		<?php
 		   $o21=0;
           $o22=0;
           $o23=0;
           $o24=0;
           $o25=0;
           $o26=0;
           $o27=0;
           $o28=0;
           $o29=0;
           $o30=0;
           //$o31=0;
           $o1=0;
           $o2=0;
           $o3=0;
           $o4=0;
           $o5=0;
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
			//$k=0;
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
                         
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?><?php   if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>">  <?php if(day($rec2['date'])== '21')  { if($rec2['over_time_app'] < 1){ echo $a=$rec2['time'] + $rec2['over_time']; $a21=$a21+$a; $o21=$o21 + $rec2['over_time'];} else {echo $a=$rec2['time'] + $rec2['over_time_app'];$a21=$a21+$a; $o21=$o21 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '22') { if($rec2['over_time_app'] < 1) { echo $b=$rec2['time'] + $rec2['over_time']; $a22=$a22+$b; $o22=$o22 + $rec2['over_time'];} else {echo $b=$rec2['time'] + $rec2['over_time_app'];$a22=$a22+$b; $o22=$o22 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '23') { if($rec2['over_time_app'] < 1) { echo $c=$rec2['time'] + $rec2['over_time']; $a23=$a23+$c; $o23=$o23 + $rec2['over_time'];} else {echo $c=$rec2['time'] + $rec2['over_time_app'];$a23=$a23+$c; $o23=$o23 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '24') { if($rec2['over_time_app'] < 1) { echo $d=$rec2['time'] + $rec2['over_time']; $a24=$a24+$d; $o24=$o24 + $rec2['over_time'];} else {echo $d=$rec2['time'] + $rec2['over_time_app'];$a24=$a24+$d; $o24=$o24 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '25') { if($rec2['over_time_app'] < 1) { echo $e=$rec2['time'] + $rec2['over_time']; $a25=$a25+$e; $o25=$o25 + $rec2['over_time'];} else {echo $e=$rec2['time'] + $rec2['over_time_app'];$a25=$a25+$e; $o25=$o25 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '26') { if($rec2['over_time_app'] < 1) { echo $f=$rec2['time'] + $rec2['over_time']; $a26=$a26+$f; $o26=$o26 + $rec2['over_time'];} else {echo $f=$rec2['time'] + $rec2['over_time_app'];$a26=$a26+$f; $o26=$o26 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '27') { if($rec2['over_time_app'] < 1) { echo $g=$rec2['time'] + $rec2['over_time']; $a27=$a27+$g; $o27=$o27 + $rec2['over_time'];} else {echo $g=$rec2['time'] + $rec2['over_time_app'];$a27=$a27+$g; $o27=$o27 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '28') { if($rec2['over_time_app'] < 1) { echo $h=$rec2['time'] + $rec2['over_time']; $a28=$a28+$h; $o28=$o28 + $rec2['over_time'];} else {echo $h=$rec2['time'] + $rec2['over_time_app'];$a28=$a28+$h; $o28=$o28 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '29') { if($rec2['over_time_app'] < 1) { echo $i=$rec2['time'] + $rec2['over_time']; $a29=$a29+$i; $o29=$o29 + $rec2['over_time'];} else {echo $i=$rec2['time'] + $rec2['over_time_app'];$a29=$a29+$i; $o29=$o29 + $rec2['over_time_app'];}  } ?></div>
                            <!--<div class="cola10<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '30') { if($rec2['over_time_app'] < 1) { echo $j=$rec2['time'] + $rec2['over_time']; $a30=$a30+$j; $o30=$o30 + $rec2['over_time'];} else {echo $j=$rec2['time'] + $rec2['over_time_app'];$a30=$a30+$j; $o30=$o30 + $rec2['over_time_app'];}  } ?></div>-->
                        
                        <?php } ?>
                        
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $l=$rec2['time'] + $rec2['over_time']; $a1=$a1+$l; $o1=$o1 + $rec2['over_time'];} else {echo $l=$rec2['time'] + $rec2['over_time_app'];$a1=$a1+$l; $o1=$o1 + $rec2['over_time_app']; } } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $m=$rec2['time'] + $rec2['over_time']; $a2=$a2+$m; $o2=$o2 + $rec2['over_time'];} else {echo $m=$rec2['time'] + $rec2['over_time_app'];$a2=$a2+$m; $o2=$o2 + $rec2['over_time_app']; }  } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $n=$rec2['time'] + $rec2['over_time']; $a3=$a3+$n; $o3=$o3 + $rec2['over_time']; } else {echo $n=$rec2['time'] + $rec2['over_time_app'];$a3=$a3+$n; $o3=$o3 + $rec2['over_time_app']; } } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $o=$rec2['time'] + $rec2['over_time']; $a4=$a4+$o; $o4=$o4 + $rec2['over_time'];} else {echo $o=$rec2['time'] + $rec2['over_time_app'];$a4=$a4+$o; $o4=$o4 + $rec2['over_time_app']; } } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $p=$rec2['time'] + $rec2['over_time']; $a5=$a5+$p; $o5=$o5 + $rec2['over_time'];} else {echo $p=$rec2['time'] + $rec2['over_time_app'];$a5=$a5+$p; $o5=$o5 + $rec2['over_time_app']; } } ?></div>
                            <?php //$total_a=$a21+$a22+$a23+$a24+$a25+$a26+$a27+$a28+$a29+$a30+$a31+$a1+$a2+$a3+$a4+$a5;?>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="total">
                    <?php
                         $abc = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j  + $l + $m + $n + $o + $p;
						 echo $abc;		
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
				<?php //if(($rec['staff_approval']=='yes') || ($rec['staff_approval2']=='yes')  ): ?>
                    <?php $sql="SELECT SUM(transport_chf) as transporttot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='chf' and (app_manager='yes' or app_hrd='yes') order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php $transport_app=$transport_app + $rec2['transporttot'];?>
                    <?php echo number_format($rec2['transporttot'],2);?>
				<?php //else:?>
					<?php // echo number_format(0,2);?>	
				<?php //endif;?>	
                </div>
                
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="charge2">
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1">
                           <?php echo $a21; ?>
                        </div>
                        <div class="cola2">
                            <?php echo $a22; ?>
                        </div>
                        <div class="cola3">
							<?php echo $a23; ?>
                        </div>
                        <div class="cola4">
							<?php echo $a24; ?>
                        </div>
                        <div class="cola5">
							<?php echo $a25; ?>
                        </div>
                        <div class="cola6">
							<?php echo $a26; ?>
                        </div>
                        <div class="cola7">
							<?php echo $a27; ?>
                        </div>
                        <div class="cola8">
							<?php echo $a28; ?>
                        </div>
                        <div class="cola9">
							<?php echo $a29; ?>                        
						</div>
                        <!--<div class="cola10">
							<?php echo $a30; ?>
                        </div>-->
                        
                        <div class="cola11">
							<?php echo $a1; ?>
                        </div>
                        <div class="cola12">
							<?php echo $a2; ?>
                        </div>
                        <div class="cola13">
							<?php echo $a3; ?>
                        </div>
                        <div class="cola14">
							<?php echo $a4; ?>
                        </div>
                        <div class="cola15">
							<?php echo $a5; ?>
                        </div>
                       
                    </div>
                </div>
                <div class="total" ><?php echo $total_a=$a21+$a22+$a23+$a24+$a25+$a26+$a27+$a28+$a29+$a30+$a1+$a2+$a3+$a4+$a5;?></div>
                <div class="work"></div>
                <div class="transp" align="right"><?php echo number_format($transport,2); ?></div>
				<div class="transp" align="right"><?php echo number_format($transport_app,2); ?></div>
                <div class="charge">-</div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start CHARGEABLE HOURS - OFFICE --> 
        <div class="type">
            CHARGEABLE HOURS - OFFICE
        </div>
        
       <?php
           $b21=0;
           $b22=0;
           $b23=0;
           $b24=0;
           $b25=0;
           $b26=0;
           $b27=0;
           $b28=0;
           $b29=0;
           $b30=0;
           $b31=0;
           $b1=0;
           $b2=0;
           $b3=0;
           $b4=0;
           $b5=0;
           $transport=0;
        ?>
		
		<?php
           $ov21=0;
           $ov22=0;
           $ov23=0;
           $ov24=0;
           $ov25=0;
           $ov26=0;
           $ov27=0;
           $ov28=0;
           $ov29=0;
           $ov30=0;
           //$ov31=0;
           $ov1=0;
           $ov2=0;
           $ov3=0;
           $ov4=0;
           $ov5=0;
           //$transport=0;
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
			//$kk=0;
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
                         
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?> <?php endforeach;?>">  <?php  if(day($rec2['date'])== '21')  { if($rec2['over_time_app'] < 1) { echo $aa=$rec2['time'] + $rec2['over_time']; $b21=$b21+$aa; $ov21=$ov21+$rec2['over_time']; } else {echo $aa=$rec2['time'] + $rec2['over_time_app'];$b21=$b21+$aa; $ov21=$ov21+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '22') { if($rec2['over_time_app'] < 1) { echo $bb=$rec2['time'] + $rec2['over_time']; $b22=$b22+$bb;  $ov22=$ov22+$rec2['over_time']; } else {echo $bb=$rec2['time'] + $rec2['over_time_app'];$b22=$b22+$bb; $ov22=$ov22+$rec2['over_time_app']; }  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '23') { if($rec2['over_time_app'] < 1) { echo $cc=$rec2['time'] + $rec2['over_time']; $b23=$b23+$cc;  $ov23=$ov23+$rec2['over_time']; } else {echo $cc=$rec2['time'] + $rec2['over_time_app'];$b23=$b23+$cc; $ov23=$ov23+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '24') { if($rec2['over_time_app'] < 1) { echo $dd=$rec2['time'] + $rec2['over_time']; $b24=$b24+$dd;  $ov24=$ov24+$rec2['over_time']; } else {echo $dd=$rec2['time'] + $rec2['over_time_app'];$b24=$b24+$dd; $ov24=$ov24+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '25') { if($rec2['over_time_app'] < 1) { echo $ee=$rec2['time'] + $rec2['over_time']; $b25=$b25+$ee;  $ov25=$ov25+$rec2['over_time']; } else {echo $ee=$rec2['time'] + $rec2['over_time_app'];$b25=$b25+$ee; $ov25=$ov25+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '26') { if($rec2['over_time_app'] < 1) { echo $ff=$rec2['time'] + $rec2['over_time']; $b26=$b26+$ff;  $ov26=$ov26+$rec2['over_time']; } else {echo $ff=$rec2['time'] + $rec2['over_time_app'];$b26=$b26+$ff; $ov26=$ov26+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '27') { if($rec2['over_time_app'] < 1) { echo $gg=$rec2['time'] + $rec2['over_time']; $b27=$b27+$gg;  $ov27=$ov27+$rec2['over_time']; } else {echo $gg=$rec2['time'] + $rec2['over_time_app'];$b27=$b27+$gg; $ov27=$ov27+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '28') { if($rec2['over_time_app'] < 1) { echo $hh=$rec2['time'] + $rec2['over_time']; $b28=$b28+$hh;  $ov28=$ov28+$rec2['over_time']; } else {echo $hh=$rec2['time'] + $rec2['over_time_app'];$b28=$b28+$hh; $ov28=$ov28+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '29') { if($rec2['over_time_app'] < 1) { echo $ii=$rec2['time'] + $rec2['over_time']; $b29=$b29+$ii;  $ov29=$ov29+$rec2['over_time']; } else {echo $ii=$rec2['time'] + $rec2['over_time_app'];$b29=$b29+$ii; $ov29=$ov29+$rec2['over_time_app'];}  } ?></div>
                            <!--<div class="cola10 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '30') { if($rec2['over_time_app'] < 1) { echo $jj=$rec2['time'] + $rec2['over_time']; $b30=$b30+$jj;  $ov30=$ov30+$rec2['over_time'];} else {echo $jj=$rec2['time'] + $rec2['over_time_app'];$b30=$b30+$jj;  $ov30=$ov30+$rec2['over_time_app'];}  } ?></div>-->
                
                        <?php } ?>
                        
                        <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php while($rec2=mysql_fetch_array($exe)){ ?>
                       
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $ll=$rec2['time'] + $rec2['over_time']; $b1=$b1+$ll;   $ov1=$ov1+$rec2['over_time'];} else {echo $ll=$rec2['time'] + $rec2['over_time_app'];$b1=$b1+$ll; $ov1=$ov1+$rec2['over_time_app'];} } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $mmx=$rec2['time'] + $rec2['over_time']; $b2=$b2+$mmx; $ov2=$ov2+$rec2['over_time']; } else {echo $mmx=$rec2['time'] + $rec2['over_time_app'];$b2=$b2+$mmx; $ov2=$ov2+$rec2['over_time_app'];} } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $nn=$rec2['time'] + $rec2['over_time']; $b3=$b3+$nn;   $ov3=$ov3+$rec2['over_time'];} else {echo $nn=$rec2['time'] + $rec2['over_time_app'];$b3=$b3+$nn; $ov3=$ov3+$rec2['over_time_app'];} } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $oo=$rec2['time'] + $rec2['over_time']; $b4=$b4+$oo;   $ov4=$ov4+$rec2['over_time'];} else {echo $oo=$rec2['time'] + $rec2['over_time_app'];$b4=$b4+$oo; $ov4=$ov4+$rec2['over_time_app'];} } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $pp=$rec2['time'] + $rec2['over_time']; $b5=$b5+$pp;   $ov5=$ov5+$rec2['over_time'];} else {echo $pp=$rec2['time'] + $rec2['over_time_app'];$b5=$b5+$pp; $ov5=$ov5+$rec2['over_time_app'];} } ?></div>
                        
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
                
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="charge2">
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time"> 
                        
                        <div class="cola1">
                        <?php echo $b21;?>
                        </div>
                        <div class="cola2">
                        <?php echo $b22;?>
                        </div>
                        <div class="cola3">
                        <?php echo $b23;?>
                        </div>
                        <div class="cola4">
                        <?php echo $b24;?>
                        </div>
                        <div class="cola5">
                        <?php echo $b25;?>
                        </div>
                        <div class="cola6">
                        <?php echo $b26;?>
                        </div>
                        <div class="cola7">
                        <?php echo $b27;?>
                        </div>
                        <div class="cola8">
                        <?php echo $b28;?>
                        </div>
                        <div class="cola9">
                        <?php echo $b29;?>
                        </div>
                        <!--<div class="cola10">
                        <?php echo $b30;?>
                        </div>-->
                        <div class="cola11">
                        <?php echo $b1;?>
                        </div>
                        <div class="cola12">
                        <?php echo $b2;?>
                        </div>
                        <div class="cola13">
                       <?php echo $b3;?>
                        </div>
                        <div class="cola14">
                       <?php echo $b4;?>
                        </div>
                        <div class="cola15">
                        <?php echo $b5;?>
                        </div>
                     
                    </div>
                </div>
                <div class="total"><?php echo $total_b=$b21+$b22+$b23+$b24+$b25+$b26+$b27+$b28+$b29+$b30+$b1+$b2+$b3+$b4+$b5;?></div>
                <div class="work"></div>
                <div class="transp">-</div>
				<div class="transp">-</div>
                <div class="charge">-</div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start NON-CHARGEABLE HOURS --> 
        <div class="type">
            NON-CHARGEABLE HOURS
        </div>
        
       <?php
           $c21=0;
           $c22=0;
           $c23=0;
           $c24=0;
           $c25=0;
           $c26=0;
           $c27=0;
           $c28=0;
           $c29=0;
           $c30=0;
           //$c31=0;
           $c1=0;
           $c2=0;
           $c3=0;
           $c4=0;
           $c5=0;
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
			//$kkk=0;
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
                         
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?><?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?> <?php endforeach;?>">  <?php  if(day($rec2['date'])== '21')  { if($rec2['over_time_app'] < 1) { echo $aaa=$rec2['time'] + $rec2['over_time']; $c21=$c21+$aaa;} else {echo $aaa=$rec2['time'] + $rec2['over_time_app'];$c21=$c21+$aaa;}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '22') { if($rec2['over_time_app'] < 1) { echo $bbb=$rec2['time'] + $rec2['over_time']; $c22=$c22+$bbb;} else {echo $bbb=$rec2['time'] + $rec2['over_time_app'];$c22=$c22+$bbb;}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '23') { if($rec2['over_time_app'] < 1) { echo $ccc=$rec2['time'] + $rec2['over_time']; $c23=$c23+$ccc;} else {echo $ccc=$rec2['time'] + $rec2['over_time_app'];$c23=$c23+$ccc;}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '24') { if($rec2['over_time_app'] < 1) { echo $ddd=$rec2['time'] + $rec2['over_time']; $c24=$c24+$ddd;} else {echo $ddd=$rec2['time'] + $rec2['over_time_app'];$c24=$c24+$ddd;}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '25') { if($rec2['over_time_app'] < 1) { echo $eee=$rec2['time'] + $rec2['over_time']; $c25=$c25+$eee;} else {echo $eee=$rec2['time'] + $rec2['over_time_app'];$c25=$c25+$eee;}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '26') { if($rec2['over_time_app'] < 1) { echo $fff=$rec2['time'] + $rec2['over_time']; $c26=$c26+$fff; } else {echo $fff=$rec2['time'] + $rec2['over_time_app'];$c26=$c26+$fff;}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '27') { if($rec2['over_time_app'] < 1) { echo $ggg=$rec2['time'] + $rec2['over_time']; $c27=$c27+$ggg;} else {echo $ggg=$rec2['time'] + $rec2['over_time_app'];$c27=$c27+$ggg;}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '28') { if($rec2['over_time_app'] < 1) { echo $hhh=$rec2['time'] + $rec2['over_time']; $c28=$c28+$hhh;} else {echo $hhh=$rec2['time'] + $rec2['over_time_app'];$c28=$c28+$hhh;}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '29') { if($rec2['over_time_app'] < 1) { echo $iii=$rec2['time'] + $rec2['over_time']; $c29=$c29+$iii;} else {echo $iii=$rec2['time'] + $rec2['over_time_app'];$c29=$c29+$iii;}  } ?></div>
                            <!--<div class="cola10 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '30') { if($rec2['over_time_app'] < 1) { echo $jjj=$rec2['time'] + $rec2['over_time']; $c30=$c30+$jjj;} else {echo $jjj=$rec2['time'] + $rec2['over_time_app'];$c30=$c30+$jjj;}  } ?></div>-->
                            
                        <?php } ?>
                        
                        <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php while($rec2=mysql_fetch_array($exe)){ ?>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '01') { if($rec2['over_time_app'] < 1) { echo $lll=$rec2['time'] + $rec2['over_time']; $c1=$c1+$lll;} else {echo $lll=$rec2['time'] + $rec2['over_time_app'];$c1=$c1+$lll;} } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '02') { if($rec2['over_time_app'] < 1) { echo $mmm=$rec2['time'] + $rec2['over_time']; $c2=$c2+$mmm;} else {echo $mmm=$rec2['time'] + $rec2['over_time_app'];$c2=$c2+$mmm;} } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '03') { if($rec2['over_time_app'] < 1) { echo $nnn=$rec2['time'] + $rec2['over_time']; $c3=$c3+$nnn;} else {echo $nnn=$rec2['time'] + $rec2['over_time_app'];$c3=$c3+$nnn;} } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '04') { if($rec2['over_time_app'] < 1) { echo $ooo=$rec2['time'] + $rec2['over_time']; $c4=$c4+$ooo;} else {echo $ooo=$rec2['time'] + $rec2['over_time_app'];$c4=$c4+$ooo;} } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '05') { if($rec2['over_time_app'] < 1) { echo $ppp=$rec2['time'] + $rec2['over_time']; $c5=$c5+$ppp;} else {echo $ppp=$rec2['time'] + $rec2['over_time_app'];$c5=$c5+$ppp;} } ?></div>
                        <?php //$total_c=$c21+$c22+$c23+$c24+$c25+$c26+$c27+$c28+$c29+$c30+$c31+$c1+$c2+$c3+$c4+$c5;?>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="total">
                    <?php echo $aaabbbccc=$aaa + $bbb + $ccc + $ddd + $eee + $fff + $ggg + $hhh + $iii + $jjj  + $lll + $mmm + $nnn + $ooo + $ppp; ?>
                
				</div>
                
                <div class="work"><?php echo $rec['work_description']; ?></div>
                <div class="transp">-</div>
				<div class="transp">-</div>
				
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="charge2">
                    <?php if ($rec['staff_approval2']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature2'];?>"/>
                          <span class="name"><?php echo $rec['staff_name2']; ?></span>  
                    <?php } ?> 
                </div>
                
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time">
                     
                      
                        <div class="cola1 ">
                            
                            <?php echo $c21;?>
                        </div>  
                        
                        <div class="cola2">
                            <?php echo $c22;?>
                        </div>
                        <div class="cola3">
                            <?php echo $c23;?>
                        </div>
                        <div class="cola4">
                            <?php echo $c24;?>
                        </div>
                        <div class="cola5">
                           <?php echo $c25;?>
                        </div>
                        <div class="cola6">
                            <?php echo $c26;?>
                        </div>
                        <div class="cola7">
                            <?php echo $c27;?>
                        </div>
                        <div class="cola8">
                            <?php echo $c28;?>
                        </div>
                        <div class="cola9">
                            <?php echo $c29;?>
                        </div>
                        <!--<div class="cola10">
                            <?php echo $c30;?>
                        </div>-->
    
                        <div class="cola11">
                            <?php echo $c1;?>
                        </div>
                        <div class="cola12">
                            <?php echo $c2;?>
                        </div>
                        <div class="cola13">
                            <?php echo $c3;?>
                        </div>
                        <div class="cola14">
                            <?php echo $c4;?>
                        </div>
                        <div class="cola15">
                            <?php echo $c5;?>
                        </div>
                        
                    </div>
                </div>
                
                <div class="total"><?php echo $total_c=$c21+$c22+$c23+$c24+$c25+$c26+$c27+$c28+$c29+$c30+$c1+$c2+$c3+$c4+$c5;?></div>
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
                            $tot21=0;
                            $tot22=0;
                            $tot23=0;
                            $tot24=0;
                            $tot25=0;
                            $tot26=0;
                            $tot27=0;
                            $tot28=0;
                            $tot29=0;
                            $tot30=0;
                            //$tot31=0;
                            $tot1=0;
                            $tot2=0;
                            $tot3=0;
                            $tot4=0;
                            $tot5=0;   
                            
                            //overtime
                            $totA21=0;
                            $totA22=0;
                            $totA23=0;
                            $totA24=0;
                            $totA25=0;
                            $totA26=0;
                            $totA27=0;
                            $totA28=0;
                            $totA29=0;
                            $totA30=0;
                            //$totA31=0;
                            $totA1=0;
                            $totA2=0;
                            $totA3=0;
                            $totA4=0;
                            $totA5=0;
                        ?>     
                        
                     
                       <div class="cola1">
					      <?php echo $tot21=$a21 + $b21 + $c21; ?>
                        </div>
                            
                        <div class="cola2">
                             <?php echo $tot22=$a22 + $b22 + $c22; ?>  
                        </div>
                            
                         <div class="cola3">
                             <?php echo $tot23=$a23 + $b23 + $c23; ?>  
                         </div>
                            
                            <div class="cola4">
                              <?php
                                 echo $tot24=$a24 + $b24 + $c24; ?>
                               
                            </div>
                            
                            <div class="cola5">
                                <?php
                                    echo $tot25=$a25 + $b25 + $c25; ?> 
                               
                            </div>
							
                            <div class="cola6">
                              <?php
                                    echo $tot26=$a26 + $b26 + $c26; ?> 
                               
                            </div>
                            <div class="cola7">
                              <?php
                                  echo $tot27=$a27 + $b27 + $c27;
                               ?>
                            </div>
                            <div class="cola8">
                            <?php
                                 echo $tot28=$a28 + $b28 + $c28;
                            ?>
                            </div>
                            <div class="cola9">
                            <?php
                                echo $tot29=$a29 + $b29 + $c29;
                             ?>
                            </div>
                            <!--<div class="cola10">
                            <?php
                               echo $tot30=$a30 + $b30 + $c30;
                             ?>
                            </div>-->
    
                            <div class="cola11">
                                <?php
                                    echo $tot1=$a1 + $b1 + $c1;
                                 ?>
                            </div>
                            <div class="cola12">
                            <?php
                                   echo $tot2=$a2 + $b2 + $c2;
                             ?>
                             </div>
                            <div class="cola13">
                             <?php
                                echo $tot3=$a3 + $b3 + $c3;   
                             ?>   
                            </div>
                            <div class="cola14">
                            <?php
                                echo $tot4=$a4 + $b4 + $c4;    
                            ?>   
                            </div>
                            <div class="cola15">
                            <?php
                               echo $tot5=$a5 + $b5 + $c5;
                             ?>   
                            </div>
                          
                    </div>
                </div>
                <div class="total">
                <?php $tot=$tot21+$tot22+$tot23+$tot24+$tot25+$tot26+$tot27+$tot28+$tot29+$tot30+$tot1+$tot2+$tot3+$tot4+$tot5;?>
                <?php //$tot=$tot21; ?>
                <?php echo $tot;?>
                </div>
                <div class="work"><b>Productivity</b></div>
                <div class="transp"><?php echo $totaly=$total_a + $total_b .'/'.$tot;?></div>
				<div class="transp"><?php  //echo $totaly=$total_a + $total_b .'/'.$tot;?></div>
                <div class="charge"><b class="b"><?php $overal=($totaly/$tot)*100; echo $overal; ?>%</b></div>
                <div class="charge"></div>
                <div class="clear"></div>
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL OVERTIME</div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1"><?php echo $totA21=$o21+$ov21; ?></div>
                        <div class="cola2"><?php echo $totA22=$o22+$ov22; ?></div>
                        <div class="cola3"><?php echo $totA23=$o23+$ov23; ?></div>
                        <div class="cola4"><?php echo $totA24=$o24+$ov24; ?></div>
                        <div class="cola5"><?php echo $totA25=$o25+$ov25; ?></div>
                        <div class="cola6"><?php echo $totA26=$o26+$ov26; ?></div>
                        <div class="cola7"><?php echo $totA27=$o27+$ov27; ?></div>
                        <div class="cola8"><?php echo $totA28=$o28+$ov28; ?></div>
                        <div class="cola9"><?php echo $totA29=$o29+$ov29; ?></div>
                        <!--<div class="cola10"><?php echo $totA30=$o30+$ov30; ?></div>-->
                    
                        <div class="cola11"><?php echo $totA1=$o1+$ov1; ?></div>
                        <div class="cola12"><?php echo $totA2=$o2+$ov2; ?></div>
                        <div class="cola13"><?php echo $totA3=$o3+$ov3; ?></div>
                        <div class="cola14"><?php echo $totA4=$o4+$ov4; ?></div>
                        <div class="cola15"><?php echo $totA5=$o5+$ov5; ?></div>
                    </div>
                </div>
                <div class="total"><?php echo $totA21+$totA22+$totA23+$totA24+$totA25+$totA26+$totA27+$totA28+$totA29+$totA30+$totA1+$totA2+$totA3+$totA4+$totA5;?></div>
                <div class="work"></div>
                <div class="transp">-</div>
				<div class="transp">-</div>
                <div class="charge">-</div>
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
		
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">HOURS</div>
                <div class="timePro">
                    <div class="time">     
                    
					
                        <div class="cola1"><?php echo $ato21=$tot21 - $totA21;?></div>
                        <div class="cola2"><?php echo $ato22=$tot22 - $totA22;?></div>
                        <div class="cola3"><?php echo $ato23=$tot23 - $totA23;?></div>
                        <div class="cola4"><?php echo $ato24=$tot24 - $totA24;?></div>
                        <div class="cola5"><?php echo $ato25=$tot25 - $totA25;?></div>
                        <div class="cola6"><?php echo $ato26=$tot26 - $totA26;?></div>
                        <div class="cola7"><?php echo $ato27=$tot27 - $totA27;?></div>
                        <div class="cola8"><?php echo $ato28=$tot28 - $totA28;?></div>
                        <div class="cola9"><?php echo $ato29=$tot29 - $totA29;?></div>
                        <!--<div class="cola10"><?php echo $ato30=$tot30 - $totA30;?></div>-->
                        
                        <div class="cola11"><?php echo $ato1=$tot1 - $totA1;?></div>
                        <div class="cola12"><?php echo $ato2=$tot2 - $totA2;?></div>
                        <div class="cola13"><?php echo $ato3=$tot3 - $totA3;?></div>
                        <div class="cola14"><?php echo $ato4=$tot4 - $totA4;?></div>
						<div class="cola15"><?php echo $ato5=$tot5 - $totA5;?></div>
					
                    </div>
                </div>
                <div class="total"><?php echo $hour=$ato21+$ato22+$ato23+$ato24+$ato25+$ato26+$ato27+$ato28+$ato29+$ato30+$ato1+$ato2+$ato3+$ato4+$ato5;?></div>
                <div class="work" align="right"><b>Productivity :</b></div>
                <div class="transp"><?php echo $tot=$total_a + $total_b + $total_c .'/'.$hour;?></div>
				<div class="transp"><?php //echo $tot=$total_a + $total_b + $total_c .'/'.$hour;?></div>
                <div class="charge">
                 <b class="b"><?php if($hour<>0){$hour=$hour;}else{$hour=1;} $overal=($tot/$hour)*100; if($hour <> 1): echo number_format($overal,0); else:  echo '0'; endif;  ?> %</b>
                </div>
                <div class="charge">-</div>
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
                    <?php foreach($holiday_mn as $day): ?>
                        <p><?php echo indo_tgl($day['date_h']);?> :
                        <?php echo $day['description_h'];?> 
                    <?php endforeach;?></p>
                </div>
                
                <!--<div class="ch1">
                     <center>Approval</center><br/>
                     <center><?php if($manager_signature<>""){ ?><img src="<?php echo base_url().$manager_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /> <?php } ?></center>
                     <center><span class="names"><?php echo $manager_name; ?></span></center>
                     <center class="names">(Manager In Charge)</center>
                </div>
                -->
                <div class="ch1">
                    <br />
                    <center>HR Manager</center>
                    <center><?php if($hrd_signature<>""){ ?><img src="<?php echo base_url().$hrd_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    
                    <center class="names">(<?php echo $hrd_name;?>)</center>
                </div>
                
            </div>
        </div>
                       
    </div>
</body>
</html>
