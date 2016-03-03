<!-- CSS File -->
<link  rel="stylesheet" href="<?php echo base_url();?>assets/css/tr/style_20.css"  type="text/css"/>
<!-- End OF CSS File -->

        <div id="search">
           <b><label for="filter">Name :</label> <?php echo $name; ?></b>
        </div>
        
        <div id="navigation">
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/manage/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/manage/periode/<?php echo $_SESSION['periode'];?>">Come Back</a>
        </div>
        
        <div class="clear"></div>
 
 <div class="mainpage2">
 
 <div class="menu">
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="codePro">Job Code</div>
                <div class="timePro">
                     <div class="timePro1">TIME DISTRIBUTION</div>
                    <div class="time">
                        <div class="cola1">06</div>
                        <div class="cola2">07</div>
                        <div class="cola3">08</div>
                        <div class="cola4">09</div>
                        <div class="cola5">10</div>
                        <div class="cola6">11</div>
                        <div class="cola7">12</div>
                        <div class="cola8">13</div>
                        <div class="cola9">14</div>
                        <div class="cola10">15</div>
                        <div class="cola11">16</div>
                        <div class="cola12">17</div>
                        <div class="cola13">18</div>
                        <div class="cola14">19</div>
                        <div class="cola15">20</div>
                    </div>
                </div>
                <div class="total">Total</div>
                
                <div class="charge">Aproval</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK --> 
        <div class="type">
            CHARGEABLE HOURS - FIELDWORK
        </div>
        
       <?php
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
           //$a31=0;
           $a16=0;
           $a17=0;
           $a18=0;
           $a19=0;
           $a20=0;
           $transport=0;
           $cba=0;
        ?>
        
        <?php
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
           //$o31=0;
           $o16=0;
           $o17=0;
           $o18=0;
           $o19=0;
           $o20=0;
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
		
        <!-- Start OF CHF -->
        <?php if ( ($rec['HRD']== $_SESSION['no']) OR  ($rec['Partner']== $_SESSION['no']) OR ($rec['Senior_Manager']== $_SESSION['no']) OR ($rec['Manager']== $_SESSION['no']) OR (isset($rec['Ass_Manager'])== $_SESSION['no']) OR ($rec['Senior']== $_SESSION['no'])  ) : ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                         <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                         <?php $exe=mysql_query($sql);?>
                         <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>">  <?php if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $a=$rec2['time'] + $rec2['over_time']; $a6=$a6+$a;   $o6=$o6   + $rec2['over_time'];} else {echo $a=$rec2['time'] + $rec2['over_time_app'];$a6=$a6+$a;   $o6=$o6   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $b=$rec2['time'] + $rec2['over_time']; $a7=$a7+$b;   $o7=$o7   + $rec2['over_time'];} else {echo $b=$rec2['time'] + $rec2['over_time_app'];$a7=$a7+$b;   $o7=$o7   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $c=$rec2['time'] + $rec2['over_time']; $a8=$a8+$c;   $o8=$o8   + $rec2['over_time'];} else {echo $c=$rec2['time'] + $rec2['over_time_app'];$a8=$a8+$c;   $o8=$o8   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $d=$rec2['time'] + $rec2['over_time']; $a9=$a9+$d;   $o9=$o9   + $rec2['over_time'];} else {echo $d=$rec2['time'] + $rec2['over_time_app'];$a9=$a9+$d;   $o9=$o9   + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $e=$rec2['time'] + $rec2['over_time']; $a10=$a10+$e; $o10=$o10 + $rec2['over_time'];} else {echo $e=$rec2['time'] + $rec2['over_time_app'];$a10=$a10+$e; $o10=$o10 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $f=$rec2['time'] + $rec2['over_time']; $a11=$a11+$f; $o11=$o11 + $rec2['over_time'];} else {echo $f=$rec2['time'] + $rec2['over_time_app'];$a11=$a11+$f; $o11=$o11 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $g=$rec2['time'] + $rec2['over_time']; $a12=$a12+$g; $o12=$o12 + $rec2['over_time'];} else {echo $g=$rec2['time'] + $rec2['over_time_app'];$a12=$a12+$g; $o12=$o12 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $h=$rec2['time'] + $rec2['over_time']; $a13=$a13+$h; $o13=$o13 + $rec2['over_time'];} else {echo $h=$rec2['time'] + $rec2['over_time_app'];$a13=$a13+$h; $o13=$o13 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $i=$rec2['time'] + $rec2['over_time']; $a14=$a14+$i; $o14=$o14 + $rec2['over_time'];} else {echo $i=$rec2['time'] + $rec2['over_time_app'];$a14=$a14+$i; $o14=$o14 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola10<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $j=$rec2['time'] + $rec2['over_time']; $a15=$a15+$j; $o15=$o15 + $rec2['over_time'];} else {echo $j=$rec2['time'] + $rec2['over_time_app'];$a15=$a15+$j; $o15=$o15 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '16') { if($rec2['over_time_app'] < 1) { echo $l=$rec2['time'] + $rec2['over_time']; $a16=$a16+$l; $o16=$o16 + $rec2['over_time'];} else {echo $l=$rec2['time'] + $rec2['over_time_app'];$a16=$a16+$l; $o16=$o16 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '17') { if($rec2['over_time_app'] < 1) { echo $m=$rec2['time'] + $rec2['over_time']; $a17=$a17+$m; $o17=$o17 + $rec2['over_time'];} else {echo $m=$rec2['time'] + $rec2['over_time_app'];$a17=$a17+$m; $o17=$o17 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '18') { if($rec2['over_time_app'] < 1) { echo $n=$rec2['time'] + $rec2['over_time']; $a18=$a18+$n; $o18=$o18 + $rec2['over_time'];} else {echo $n=$rec2['time'] + $rec2['over_time_app'];$a18=$a18+$n; $o18=$o18 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '19') { if($rec2['over_time_app'] < 1) { echo $o=$rec2['time'] + $rec2['over_time']; $a19=$a19+$o; $o19=$o19 + $rec2['over_time'];} else {echo $o=$rec2['time'] + $rec2['over_time_app'];$a19=$a19+$o; $o19=$o19 + $rec2['over_time_app'];}  } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '20') { if($rec2['over_time_app'] < 1) { echo $p=$rec2['time'] + $rec2['over_time']; $a20=$a20+$p; $o20=$o20 + $rec2['over_time'];} else {echo $p=$rec2['time'] + $rec2['over_time_app'];$a20=$a20+$p; $o20=$o20 + $rec2['over_time_app'];}  } ?></div>
                            
                         <?php } ?>
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $abc = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $l + $m + $n + $o + $p;
						 echo $abc;
                         $cba=$cba + $abc;
                     ?>   
                </div>
                
                
                <div class="charge">
                    <form name="form1"  action="<?php echo base_url().$action;?>" method="POST">
                    <input type="hidden" name="code" value="<?php echo $rec['day_code']; ?>" />
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if( ('AM' == $_SESSION['level']) OR  ('S2' == $_SESSION['level']) OR ('S1' == $_SESSION['level']) ):  ?>
                           <?php if($rec['staff_approval']=="yes") :?>
                                 <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                 <option value="yes">yes</option>
                                 <option value="no">no</option>
                                 </select>
                         <?php endif ?>
                        <?php endif; ?>
                     <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php  if( ('HRD' == $_SESSION['level']) OR ('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ('P' == $_SESSION['level']) ):  ?>
                        <?php if($rec['staff_approval2']=="yes") : ?>
                            <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        <?php endif; ?>
                    <?php   endif; ?>
                     <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if(( 'AM' == $_SESSION['level']) OR ('S2' == $_SESSION['level']) OR  ('S1' == $_SESSION['level']) ):  ?>
                           <?php if($rec['staff_approval']=="no") : ?>
                                   <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                   <option value="no">no</option>
                                   <option value="yes">yes</option>
                                   </select>
                                <?php endif; ?>
                          <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php if( ('HRD' == $_SESSION['level']) OR  ('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ( 'P' == $_SESSION['level']) ):  ?>
                    <?php if($rec['staff_approval2']=="no") : ?>     
                        <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                        <option value="no">no</option>
                        <option value="yes">yes</option>
                        </select>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <?php // if(($rec['staff_approval']=="no") || ($rec['staff_approval2']=="no")) {?>    
                    <input type="submit" name="submit" value="GO" class="right" />
                    <?php // } ?>
                    </form>  
                </div>
                
                <div class="clear"></div>
        </div>
        <!-- End of CHF -->
        <?php endif; ?>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time">
                    <div class="cola1">
                           <?php echo $a6; ?>
                        </div>
                        <div class="cola2">
                            <?php echo $a7; ?>
                        </div>
                        <div class="cola3">
							<?php echo $a8; ?>
                        </div>
                        <div class="cola4">
							<?php echo $a9; ?>
                        </div>
                        <div class="cola5">
							<?php echo $a10; ?>
                        </div>
                        <div class="cola6">
							<?php echo $a11; ?>
                        </div>
                        <div class="cola7">
							<?php echo $a12; ?>
                        </div>
                        <div class="cola8">
							<?php echo $a13; ?>
                        </div>
                        <div class="cola9">
							<?php echo $a14; ?>                        
						</div>
                        <div class="cola10">
							<?php echo $a15; ?>
                        </div>
                        
                        <div class="cola11">
							<?php echo $a16; ?>
                        </div>
                        <div class="cola12">
							<?php echo $a17; ?>
                        </div>
                        <div class="cola13">
							<?php echo $a18; ?>
                        </div>
                        <div class="cola14">
							<?php echo $a19; ?>
                        </div>
                        <div class="cola15">
							<?php echo $a20; ?>
                        </div>
                        
                    </div>
                </div>
                <div class="total"><?php echo $total_a=$a6+$a7+$a8+$a9+$a10+$a11+$a12+$a13+$a14+$a15+$a16+$a17+$a18+$a19+$a20;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start CHARGEABLE HOURS - OFFICE --> 
        <div class="type">
            CHARGEABLE HOURS - OFFICE
        </div>
        
       <?php
           $ccbbaa=0;
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
           $b16=0;
           $b17=0;
           $b18=0;
           $b19=0;
           $b20=0;
           
           $transport=0;
        ?>
        
        <?php
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
           //$ov31=0;
           $ov16=0;
           $ov17=0;
           $ov18=0;
           $ov19=0;
           $ov20=0;
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
        <!-- Start Of CHO -->
        <?php if ( ($rec['HRD']== $_SESSION['no']) OR  ($rec['Partner']== $_SESSION['no']) OR ($rec['Senior_Manager']== $_SESSION['no'])  OR  ($rec['Manager']== $_SESSION['no']) OR ($rec['Ass_Manager']== $_SESSION['no']) OR ($rec['Senior']== $_SESSION['no'])  ) : ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                          
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $aa=$rec2['time'] + $rec2['over_time']; $b6=$b6  + $aa;  $ov6 =$ov6 +$rec2['over_time']; } else {echo  $aa =$rec2['time'] + $rec2['over_time_app'];$b6 =$b6+$aa;  $ov6 = $ov6 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola2  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $bb=$rec2['time'] + $rec2['over_time']; $b7=$b7  + $bb;  $ov7 =$ov7 +$rec2['over_time']; } else {echo  $bb =$rec2['time'] + $rec2['over_time_app'];$b7 =$b7+$bb;  $ov7 = $ov7 +$rec2['over_time_app']; }  } ?></div>
                            <div class="cola3  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $cc=$rec2['time'] + $rec2['over_time']; $b8=$b8  + $cc;  $ov8 =$ov8 +$rec2['over_time']; } else {echo  $cc =$rec2['time'] + $rec2['over_time_app'];$b8 =$b8+$cc;  $ov8 = $ov8 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola4  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $dd=$rec2['time'] + $rec2['over_time']; $b9=$b9  + $dd;  $ov9 =$ov9 +$rec2['over_time']; } else {echo  $dd =$rec2['time'] + $rec2['over_time_app'];$b9 =$b9+$dd;  $ov9 = $ov9 +$rec2['over_time_app'];}  } ?></div>
                            <div class="cola5  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $ee=$rec2['time'] + $rec2['over_time']; $b10=$b10+ $ee;  $ov10=$ov10+$rec2['over_time']; } else {echo  $ee =$rec2['time'] + $rec2['over_time_app'];$b10=$b10+$ee; $ov10= $ov10+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola6  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $ff=$rec2['time'] + $rec2['over_time']; $b11=$b11+ $ff;  $ov11=$ov11+$rec2['over_time']; } else {echo  $ff =$rec2['time'] + $rec2['over_time_app'];$b11=$b11+$ff; $ov11= $ov11+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola7  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $gg=$rec2['time'] + $rec2['over_time']; $b12=$b12+ $gg;  $ov12=$ov12+$rec2['over_time']; } else {echo  $gg =$rec2['time'] + $rec2['over_time_app'];$b12=$b12+$gg; $ov12= $ov12+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola8  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $hh=$rec2['time'] + $rec2['over_time']; $b13=$b13+ $hh;  $ov13=$ov13+$rec2['over_time']; } else {echo  $hh =$rec2['time'] + $rec2['over_time_app'];$b13=$b13+$hh; $ov13= $ov13+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola9  <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $ii=$rec2['time'] + $rec2['over_time']; $b14=$b14+ $ii;  $ov14=$ov14+$rec2['over_time']; } else {echo  $ii =$rec2['time'] + $rec2['over_time_app'];$b14=$b14+$ii; $ov14= $ov14+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $jj=$rec2['time'] + $rec2['over_time']; $b15=$b15+ $jj;  $ov15=$ov15+$rec2['over_time']; } else {echo  $jj =$rec2['time'] + $rec2['over_time_app'];$b15=$b15+$jj; $ov15= $ov15+$rec2['over_time_app'];}  } ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '16') { if($rec2['over_time_app'] < 1) { echo $ll=$rec2['time'] + $rec2['over_time']; $b16=$b16+ $ll;  $ov16=$ov16+$rec2['over_time']; } else {echo  $ll =$rec2['time'] + $rec2['over_time_app'];$b16=$b16+$ll; $ov16= $ov16+$rec2['over_time_app'];} } ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '17') { if($rec2['over_time_app'] < 1) { echo $mmx=$rec2['time']+ $rec2['over_time']; $b17=$b17+$mmx;  $ov17=$ov17+$rec2['over_time']; } else {echo  $mmx=$rec2['time'] + $rec2['over_time_app'];$b17=$b17+$mmx;$ov17= $ov17+$rec2['over_time_app'];} } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '18') { if($rec2['over_time_app'] < 1) { echo $nn=$rec2['time'] + $rec2['over_time']; $b18=$b18+ $nn;  $ov18=$ov18+$rec2['over_time']; } else {echo  $nn =$rec2['time'] + $rec2['over_time_app'];$b18=$b18+$nn; $ov18= $ov18+$rec2['over_time_app'];} } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '19') { if($rec2['over_time_app'] < 1) { echo $oo=$rec2['time'] + $rec2['over_time']; $b19=$b19+ $oo;  $ov19=$ov19+$rec2['over_time']; } else {echo  $oo =$rec2['time'] + $rec2['over_time_app'];$b19=$b19+$oo; $ov19= $ov19+$rec2['over_time_app'];} } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '20') { if($rec2['over_time_app'] < 1) { echo $pp=$rec2['time'] + $rec2['over_time']; $b20=$b20+ $pp;  $ov20=$ov20+$rec2['over_time']; } else {echo  $pp =$rec2['time'] + $rec2['over_time_app'];$b20=$b20+$pp; $ov20= $ov20+$rec2['over_time_app'];} } ?></div>
                        
                        
                        <?php } ?>
                        
                    </div>
                </div>
                
                <div class="total">
                    <?php $aabbcc=$aa + $bb + $cc + $dd + $ee + $ff + $gg + $hh + $ii + $jj  + $ll + $mmx + $nn + $oo + $pp; ?>
					<?php echo $aabbcc;  ?>
                </div>
                
                
                <div class="charge">
                    <form name="form1"  action="<?php echo base_url().$action;?>" method="POST">
                    <input type="hidden" name="code" value="<?php echo $rec['day_code']; ?>" />
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if( ('AM' == $_SESSION['level']) OR  ('S2' == $_SESSION['level']) ):  ?>
                           <?php if($rec['staff_approval']=="yes") :?>
                                 <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                 <option value="yes">yes</option>
                                 <option value="no">no</option>
                                 </select>
                         <?php endif ?>
                        <?php endif; ?>
                     <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php  if(('HRD' == $_SESSION['level']) OR ('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ('P' == $_SESSION['level']) ):  ?>
                        <?php if($rec['staff_approval2']=="yes") : ?>
                            <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        <?php endif; ?>
                    <?php   endif; ?>
                     <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if(( 'AM' == $_SESSION['level']) OR ('S2' == $_SESSION['level'])):  ?>
                           <?php if($rec['staff_approval']=="no") : ?>
                                   <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                   <option value="no">no</option>
                                   <option value="yes">yes</option>
                                   </select>
                                <?php endif; ?>
                          <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php if( ('HRD' == $_SESSION['level']) OR ('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ( 'P' == $_SESSION['level']) ):  ?>
                    <?php if($rec['staff_approval2']=="no") : ?>     
                        <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                        <option value="no">no</option>
                        <option value="yes">yes</option>
                        </select>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <?php // if(($rec['staff_approval']=="no") || ($rec['staff_approval2']=="no")) {?>    
                    <input type="submit" name="submit" value="GO" class="right" />
                    <?php // } ?>
                    </form>  
                </div>
                
                <div class="clear"></div>
        </div>
        <?php endif;?>
        <!-- End of CHO  -->
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time"> 
                    
                         <div class="cola1">
                        <?php echo $b6;?>
                        </div>
                        <div class="cola2">
                        <?php echo $b7;?>
                        </div>
                        <div class="cola3">
                        <?php echo $b8;?>
                        </div>
                        <div class="cola4">
                        <?php echo $b9;?>
                        </div>
                        <div class="cola5">
                        <?php echo $b10;?>
                        </div>
                        <div class="cola6">
                        <?php echo $b11;?>
                        </div>
                        <div class="cola7">
                        <?php echo $b12;?>
                        </div>
                        <div class="cola8">
                        <?php echo $b13;?>
                        </div>
                        <div class="cola9">
                        <?php echo $b14;?>
                        </div>
                        <div class="cola10">
                        <?php echo $b15;?>
                        </div>
                        <div class="cola11">
                        <?php echo $b16;?>
                        </div>
                        <div class="cola12">
                        <?php echo $b17;?>
                        </div>
                        <div class="cola13">
                       <?php echo $b18;?>
                        </div>
                        <div class="cola14">
                       <?php echo $b19;?>
                        </div>
                        <div class="cola15">
                        <?php echo $b20;?>
                        </div>
                        
                    </div>
                </div>
                <div class="total"><?php echo $total_b=$b6+$b7+$b8+$b9+$b10+$b11+$b12+$b13+$b14+$b15+$b16+$b17+$b18+$b19+$b20;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start NON-CHARGEABLE HOURS --> 
        <div class="type">
            NON-CHARGEABLE HOURS
        </div>
        
       <?php
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
           //$c31=0;
           $c16=0;
           $c17=0;
           $c18=0;
           $c19=0;
           $c20=0;
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
        <!-- Start OF NCH -->
        <?php if ( (isset($_SESSION['level'])== 'M') OR (isset($_SESSION['level'])== 'SM') ) : ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                       <?php $sql="SELECT DAYNAME(date) as name,date,time,over_time,over_time_app FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                        <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php   if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '06') { if($rec2['over_time_app'] < 1) { echo $aaa=$rec2['time'] + $rec2['over_time']; $c6 =$c6 +$aaa;} else {echo $aaa=$rec2['time'] + $rec2['over_time_app'];$c6 =$c6 +$aaa;}  } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '07') { if($rec2['over_time_app'] < 1) { echo $bbb=$rec2['time'] + $rec2['over_time']; $c7 =$c7 +$bbb;} else {echo $bbb=$rec2['time'] + $rec2['over_time_app'];$c7 =$c7 +$bbb;}  } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '08') { if($rec2['over_time_app'] < 1) { echo $ccc=$rec2['time'] + $rec2['over_time']; $c8 =$c8 +$ccc;} else {echo $ccc=$rec2['time'] + $rec2['over_time_app'];$c8 =$c8 +$ccc;}  } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '09') { if($rec2['over_time_app'] < 1) { echo $ddd=$rec2['time'] + $rec2['over_time']; $c9 =$c9 +$ddd;} else {echo $ddd=$rec2['time'] + $rec2['over_time_app'];$c9 =$c9 +$ddd;}  } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '10') { if($rec2['over_time_app'] < 1) { echo $eee=$rec2['time'] + $rec2['over_time']; $c10=$c10+$eee;} else {echo $eee=$rec2['time'] + $rec2['over_time_app'];$c10=$c10+$eee;}  } ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '11') { if($rec2['over_time_app'] < 1) { echo $fff=$rec2['time'] + $rec2['over_time']; $c11=$c11+$fff;} else {echo $fff=$rec2['time'] + $rec2['over_time_app'];$c11=$c11+$fff;}  } ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '12') { if($rec2['over_time_app'] < 1) { echo $ggg=$rec2['time'] + $rec2['over_time']; $c12=$c12+$ggg;} else {echo $ggg=$rec2['time'] + $rec2['over_time_app'];$c12=$c12+$ggg;}  } ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '13') { if($rec2['over_time_app'] < 1) { echo $hhh=$rec2['time'] + $rec2['over_time']; $c13=$c13+$hhh;} else {echo $hhh=$rec2['time'] + $rec2['over_time_app'];$c13=$c13+$hhh;}  } ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '14') { if($rec2['over_time_app'] < 1) { echo $iii=$rec2['time'] + $rec2['over_time']; $c14=$c14+$iii;} else {echo $iii=$rec2['time'] + $rec2['over_time_app'];$c14=$c14+$iii;}  } ?></div>
                            <div class="cola10<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '15') { if($rec2['over_time_app'] < 1) { echo $jjj=$rec2['time'] + $rec2['over_time']; $c15=$c15+$jjj;} else {echo $jjj=$rec2['time'] + $rec2['over_time_app'];$c15=$c15+$jjj;}  } ?></div>
                            <div class="cola11<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '16') { if($rec2['over_time_app'] < 1) { echo $lll=$rec2['time'] + $rec2['over_time']; $c16=$c16+$lll;} else {echo $lll=$rec2['time'] + $rec2['over_time_app'];$c16=$c16+$lll;}  } ?></div>
                            <div class="cola12<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '17') { if($rec2['over_time_app'] < 1) { echo $mmm=$rec2['time'] + $rec2['over_time']; $c17=$c17+$mmm;} else {echo $mmm=$rec2['time'] + $rec2['over_time_app'];$c17=$c17+$mmm;}  } ?></div>
                            <div class="cola13<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '18') { if($rec2['over_time_app'] < 1) { echo $nnn=$rec2['time'] + $rec2['over_time']; $c18=$c18+$nnn;} else {echo $nnn=$rec2['time'] + $rec2['over_time_app'];$c18=$c18+$nnn;}  } ?></div>
                            <div class="cola14<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '19') { if($rec2['over_time_app'] < 1) { echo $ooo=$rec2['time'] + $rec2['over_time']; $c19=$c19+$ooo;} else {echo $ooo=$rec2['time'] + $rec2['over_time_app'];$c19=$c19+$ooo;}  } ?></div>
                            <div class="cola15<?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '20') { if($rec2['over_time_app'] < 1) { echo $ppp=$rec2['time'] + $rec2['over_time']; $c20=$c20+$ppp;} else {echo $ppp=$rec2['time'] + $rec2['over_time_app'];$c20=$c20+$ppp;}  } ?></div>
                        
                        
                        <?php } ?>
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $aaabbbccc=$aaa + $bbb + $ccc + $ddd + $eee + $fff + $ggg + $hhh + $iii + $jjj + $lll + $mmm + $nnn + $ooo + $ppp; ?>
					<?php echo $aaabbbccc;  ?>
                </div>
                
                
                <div class="charge">
                    <form name="form1"  action="<?php echo base_url().$action;?>" method="POST">
                    <input type="hidden" name="code" value="<?php echo $rec['day_code']; ?>" />
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if( ('AM' == $_SESSION['level']) OR  ('S2' == $_SESSION['level']) ):  ?>
                           <?php if($rec['staff_approval']=="yes") :?>
                                 <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                 <option value="yes">yes</option>
                                 <option value="no">no</option>
                                 </select>
                         <?php endif ?>
                        <?php endif; ?>
                     <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php  if(('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ('P' == $_SESSION['level']) ):  ?>
                        <?php if($rec['staff_approval2']=="yes") : ?>
                            <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        <?php endif; ?>
                    <?php   endif; ?>
                     <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <!-- AM and Senior -->
                    <?php // foreach($group as $row): ?>
                      <?php  if(( 'AM' == $_SESSION['level']) OR ('S2' == $_SESSION['level'])):  ?>
                           <?php if($rec['staff_approval']=="no") : ?>
                                   <select name="approval" id="approval" onchange='this.form1.submit()' class="left"  >
                                   <option value="no">no</option>
                                   <option value="yes">yes</option>
                                   </select>
                                <?php endif; ?>
                          <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- AM and Senior -->
                    
                    <!-- Partner AND Manager  -->
                    <?php // foreach($group as $row): ?>
                    <?php if(('SM' == $_SESSION['level']) OR ('M' == $_SESSION['level']) OR ( 'P' == $_SESSION['level']) ):  ?>
                    <?php if($rec['staff_approval2']=="no") : ?>     
                        <select name="approval2" id="approval2" onchange='this.form1.submit()' class="left"  >
                        <option value="no">no</option>
                        <option value="yes">yes</option>
                        </select>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php // endforeach;?>
                    <!-- Partner AND Manager  -->
                    
                    <?php // if(($rec['staff_approval']=="no") || ($rec['staff_approval2']=="no")) {?>    
                    <input type="submit" name="submit" value="GO" class="right" />
                    <?php // } ?>
                    </form>  
                </div>
                
                <div class="clear"></div>
        </div>
        <!-- END NCH -->
        <?php endif; ?>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1 ">
                            
                            <?php echo $c6;?>
                        </div>  
                        
                        <div class="cola2">
                            <?php echo $c7;?>
                        </div>
                        <div class="cola3">
                            <?php echo $c8;?>
                        </div>
                        <div class="cola4">
                            <?php echo $c9;?>
                        </div>
                        <div class="cola5">
                           <?php echo $c10;?>
                        </div>
                        <div class="cola6">
                            <?php echo $c11;?>
                        </div>
                        <div class="cola7">
                            <?php echo $c12;?>
                        </div>
                        <div class="cola8">
                            <?php echo $c13;?>
                        </div>
                        <div class="cola9">
                            <?php echo $c14;?>
                        </div>
                        <div class="cola10">
                            <?php echo $c15;?>
                        </div>
    
                        <div class="cola11">
                            <?php echo $c16;?>
                        </div>
                        <div class="cola12">
                            <?php echo $c17;?>
                        </div>
                        <div class="cola13">
                            <?php echo $c18;?>
                        </div>
                        <div class="cola14">
                            <?php echo $c19;?>
                        </div>
                        <div class="cola15">
                            <?php echo $c20;?>
                        </div>
                        
                    </div>
                </div>
                <div class="total"><?php echo $total_c=$c6+$c7+$c8+$c9+$c10+$c11+$c12+$c13+$c14+$c15+$c16+$c17+$c18+$c19+$c20;?></div>
                <div class="charge">-</div>
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
                            $tot16=0;
                            $tot17=0;
                            $tot18=0;
                            $tot19=0;
                            $tot20=0;   
                            
                            //overtime
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
                            $totA16=0;
                            $totA17=0;
                            $totA18=0;
                            $totA19=0;
                            $totA20=0;
                        ?>     
                    <div class="cola1">
		               <?php echo $tot6=$a6 + $b6 + $c6; ?>
                    </div>
                            
                    <div class="cola2">
                       <?php echo $tot7=$a7 + $b7 + $c7; ?>  
                    </div>
                            
                    <div class="cola3">
                        <?php echo $tot8=$a8 + $b8 + $c8; ?>  
                    </div>
                            
                    <div class="cola4">
                        <?php echo $tot9=$a9 + $b9 + $c9; ?>
                    </div>
                            
                    <div class="cola5">
                        <?php echo $tot10=$a10 + $b10 + $c10; ?> 
                    </div>
							
                    <div class="cola6">
                        <?php echo $tot11=$a11 + $b11 + $c11; ?> 
                    </div>
                    
                    <div class="cola7">
                        <?php echo $tot12=$a12 + $b12 + $c12; ?>
                    </div>
                    
                    <div class="cola8">
                         <?php echo $tot13=$a13 + $b13 + $c13;?>
                    </div>
                    <div class="cola9">
                        <?php echo $tot14=$a14 + $b14 + $c14; ?>
                    </div>
                    
                    <div class="cola10">
                        <?php echo $tot15=$a15 + $b15 + $c15;?>
                    </div>
    
                    <div class="cola11">
                        <?php echo $tot16=$a16 + $b16 + $c16; ?>
                    </div>
                            
                    <div class="cola12">
                        <?php echo $tot17=$a17 + $b17 + $c17; ?>
                    </div>
                    
                    <div class="cola13">
                        <?php  echo $tot18=$a18 + $b18 + $c18; ?>   
                    </div>
                    
                    <div class="cola14">
                         <?php echo $tot19=$a19 + $b19 + $c19;  ?>   
                    </div>
                    
                    <div class="cola15">
                          <?php echo $tot20=$a20 + $b20 + $c20;
                             ?>   
                    </div>   
                     
                    </div>
                </div>
                <?php $tot=0;?>
                <div class="total"><?php echo $tot=$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12+$tot13+$tot14+$tot15+$tot16+$tot17+$tot18+$tot19+$tot20;?></div>
                <div class="charge"><b class="b"><?php $overal=($tot/80)*100; // echo $overal; ?>%</b></div>
                <div class="clear"></div>
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL OVERTIME</div>
                <div class="timePro">
                    <div class="time">
                        <div class="cola1"><?php echo  $totA6=$o6+$ov6; ?></div>
                        <div class="cola2"><?php echo  $totA7=$o7+$ov7; ?></div>
                        <div class="cola3"><?php echo  $totA8=$o8+$ov8; ?></div>
                        <div class="cola4"><?php echo  $totA9=$o9+$ov9; ?></div>
                        <div class="cola5"><?php echo  $totA10=$o10+$ov10; ?></div>
                        <div class="cola6"><?php echo  $totA11=$o11+$ov11; ?></div>
                        <div class="cola7"><?php echo  $totA12=$o12+$ov12; ?></div>
                        <div class="cola8"><?php echo  $totA13=$o13+$ov13; ?></div>
                        <div class="cola9"><?php echo  $totA14=$o14+$ov14; ?></div>
                        <div class="cola10"><?php echo $totA15=$o15+$ov15; ?></div>
                        <div class="cola11"><?php echo $totA16=$o16+$ov16; ?></div>
                        <div class="cola12"><?php echo $totA17=$o17+$ov17; ?></div>
                        <div class="cola13"><?php echo $totA18=$o18+$ov18; ?></div>
                        <div class="cola14"><?php echo $totA19=$o19+$ov19; ?></div>
                        <div class="cola15"><?php echo $totA20=$o20+$ov20; ?></div>
                    </div>
                </div>
                <div class="total"><?php echo $totA6+$totA7+$totA8+$totA9+$totA10+$totA11+$totA12+$totA14+$totA15+$totA16+$totA17+$totA18+$totA19+$totA20;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        <!--
		<div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">OVERTIME APPROVAL</div>
                <div class="timePro">
                    <div class="time">
					<?php
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
						$o16=0;
						$o17=0;
						$o18=0;
						$o19=0;
						$o20=0;
					?>
					<?php foreach($overtime as $over): ?>
                        <div class="cola1"><?php if($over['day']=='06'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o6=$over['over_time_app'];} }?></div>
                        <div class="cola2"><?php if($over['day']=='07'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o7=$over['over_time_app'];} }?></div>
                        <div class="cola3"><?php if($over['day']=='08'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o8=$over['over_time_app'];} }?></div>
                        <div class="cola4"><?php if($over['day']=='09'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o9=$over['over_time_app'];} }?></div>
                        <div class="cola5"><?php if($over['day']=='10'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o10=$over['over_time_app'];} }?></div>
                        <div class="cola6"><?php if($over['day']=='11'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o11=$over['over_time_app'];} }?></div>
                        <div class="cola7"><?php if($over['day']=='12'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o12=$over['over_time_app'];} }?></div>
                        <div class="cola8"><?php if($over['day']=='13'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o13=$over['over_time_app'];} }?></div>
                        <div class="cola9"><?php if($over['day']=='14'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o14=$over['over_time_app'];} }?></div>
                        <div class="cola10"><?php if($over['day']=='15'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o15=$over['over_time_app'];} }?></div>
                        <div class="cola11"><?php if($over['day']=='16'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o16=$over['over_time_app'];} }?></div>
                        <div class="cola12"><?php if($over['day']=='17'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o17=$over['over_time_app'];} }?></div>
                        <div class="cola13"><?php if($over['day']=='18'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o18=$over['over_time_app'];} }?></div>
                        <div class="cola14"><?php if($over['day']=='19'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o19=$over['over_time_app'];} }?></div>
                        <div class="cola15"><?php if($over['day']=='20'){ if ($over['over_time_app']== 0 ){ echo '-';} else { echo $o20=$over['over_time_app'];} }?></div>
					 <?php endforeach;?>	
                    </div>
                </div>
                <div class="total"><?php echo $o6+$o7+$o8+$o9+$o10+$o11+$o12+$o13+$o14+$o15+$o16+$o17+$o18+$o19+$o20;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        -->
 
 </div>       