<!-- CSS File -->
<link  rel="stylesheet" href="<?php echo base_url();?>assets/css/tr/style_20.css"  type="text/css"/>
<!-- End OF CSS File -->

        <div id="search">
           <b><label for="filter">Name :</label> <?php echo $name; ?></b>
        </div>
        
        <div id="navigation">
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/admin/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/admin/periode/<?php echo $_SESSION['periode'];?>">Come Back</a>
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
           //$a6=0;
           //$a7=0;
           //$a8=0;
           //$a9=0;
           //$a10=0;
           //$a11=0;
           //$a12=0;
           //$a13=0;
           //$a14=0;
           //$a15=0;
           //$a16=0;
           //$a17=0;
           //$a18=0;
           //$a19=0;
           //$a20=0;
           $transport=0;
        ?>
        <?php foreach($chf as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                         <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                         <?php $exe=mysql_query($sql);?>
                         <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?> <?php if (day($day['date_h'])== day($rec2['date'])){ ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '06') { echo $rec2['time']; } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '07') { echo $rec2['time'];} ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '08') { echo $rec2['time']; } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '09') { echo $rec2['time'];} ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '10') { echo $rec2['time'];} ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '11') { echo $rec2['time'];} ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '12') { echo $rec2['time'];} ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '13') { echo $rec2['time'];} ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '14') { echo $rec2['time'];} ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '15') { echo $rec2['time'];} ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '16') { echo $rec2['time'];} ?></div>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '17') { echo $rec2['time'];} ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '18') { echo $rec2['time'];} ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '19') { echo $rec2['time'];} ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day):?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '20') { echo $rec2['time'];} ?></div>
                            <?php //$total_a=$a6+$a7+$a8+$a9+$a10+$a11+$a12+$a13+$a14+$a15+$a16+$a17+$a18+$a19+$a20;?>
                            
                         <?php } ?>
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php echo $rec2['timetot'];?>
                </div>
                
                
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
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
                      $a16=0;
                      $a17=0;
                      $a18=0;
                      $a19=0;
                      $a20=0;
                    
                    ?>
                    <?php foreach($chf as $rec): ?>
                    <?php $trcode=substr($rec['day_code'],0,16);?>
                        <div class="cola1">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='06' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a6=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola2">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='07' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a7=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='08' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a8=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='09' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a9=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='10' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a10=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='11' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a11=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='12' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a12=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='13' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a13=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='14' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a14=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='15' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a15=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        
                        <div class="cola11">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='16' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a16=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div> 
                        <div class="cola12">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='17' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a17=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='18' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a18=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='19' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a19=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='20' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a20=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                       
                       <?php endforeach;?> 
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
           //$b6=0;
           //$b7=0;
           //$b8=0;
           //$b9=0;
           //$b10=0;
           //$b11=0;
           //$b12=0;
           //$b13=0;
           //$b14=0;
           //$b15=0;
           //$b16=0;
           //$b17=0;
           //$b18=0;
           //$b19=0;
           //$//b20=0;
        ?>
        <?php foreach($cho as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                          
                       <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                        <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '06') { echo $rec2['time']; } ?></div>
                        <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '07') { echo $rec2['time']; } ?></div>
                        <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '08') { echo $rec2['time'];} ?></div>
                        <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '09') { echo $rec2['time'];} ?></div>
                        <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '10') { echo $rec2['time']; } ?></div>
                        <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '11') { echo $rec2['time']; } ?></div>
                        <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '12') { echo $rec2['time']; } ?></div>
                        <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '13') { echo $rec2['time']; } ?></div>
                        <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '14') { echo $rec2['time']; } ?></div>
                        <div class="cola10 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '15') { echo $rec2['time']; } ?></div>
                        <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '16') { echo $rec2['time']; } ?></div>
                        <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '17') { echo $rec2['time']; } ?></div>
                        <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '18') { echo $rec2['time']; } ?></div>
                        <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '19') { echo $rec2['time'];} ?></div>
                        <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '20') { echo $rec2['time']; } ?></div>
                        <?php //$total_b=$b6+$b7+$b8+$b9+$b10+$b11+$b12+$b13+$b14+$b15+$b16+$b17+$b18+$b19+$b20;?>
                        
                        <?php } ?>
                        
                    </div>
                </div>
                
                <div class="total">
                    <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='cho' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php echo $rec2['timetot'];?>
                </div>
                
                
                <div class="charge">
                    <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?>    
                </div>
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time"> 
                    <?php
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
                    ?>
                        <?php foreach($cho as $rec): ?> 
                        <div class="cola1 b">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='06' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b6=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola2">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='07' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b7=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='08' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b8=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='09' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b9=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='10' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b10=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='11' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b11=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='12' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b12=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='13' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b13=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='14' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b14=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='15' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b15=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola11">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='16' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b16=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola12">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='17' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b17=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='18' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b18=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='19' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b19=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='20' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b20=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        
                     <?php endforeach;?>
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
           //$c6=0;
           //$c7=0;
           //$c8=0;
           //$c9=0;
           //$c10=0;
           //$c11=0;
           //$c12=0;
           //$c13=0;
           //$c14=0;
           //$c15=0;
           //$c16=0;
           //$c17=0;
           //$c18=0;
           //$c19=0;
           //$c20=0;
        ?>
        <?php foreach($nch as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                       <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                       <?php $exe=mysql_query($sql);?>
                       <?php while($rec2=mysql_fetch_array($exe)){ ?>
                        
                        <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '06') { echo $rec2['time'];} ?></div>
                        <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '07') { echo $rec2['time'];} ?></div>
                        <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '08') { echo $rec2['time'];} ?></div>
                        <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '09') { echo $rec2['time'];} ?></div>
                        <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '10') { echo $rec2['time'];} ?></div>
                        <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '11') { echo $rec2['time'];} ?></div>
                        <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '12') { echo $rec2['time'];} ?></div>
                        <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '13') { echo $rec2['time'];} ?></div>
                        <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"> <?php if(day($rec2['date'])== '14') { echo $rec2['time'];} ?></div>
                        <div class="cola10 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '15') { echo $rec2['time'];} ?></div>
                        <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '16') { echo $rec2['time'];} ?></div>
                        <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '17') { echo $rec2['time'];} ?></div>
                        <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '18') { echo $rec2['time'];} ?></div>
                        <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '19') { echo $rec2['time'];} ?></div>
                        <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?> <?php endforeach;?>"><?php if(day($rec2['date'])== '20') { echo $rec2['time'];} ?></div>
                        <?php //$total_c=$c6+$c7+$c8+$c9+$c10+$c11+$c12+$c13+$c14+$c15+$c16+$c17+$c18+$c19+$c20;?>
                        
                        <?php } ?>
                       
                    </div>
                </div>
                
                <div class="total">
                    <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php $rec2=mysql_fetch_array($exe);?>
                    <?php echo $rec2['timetot'];?>
                </div>
                
                
                <div class="charge">
                   <?php if ($rec['staff_approval']=='no'){ ?>
                              -
                    <?php } else { ?>
                          <img class="sign" src="<?php echo base_url().$rec['staff_signature'];?>"/>
                          <span class="name"><?php echo $rec['staff_name']; ?></span>  
                    <?php } ?>   
                </div>
                <div class="clear"></div>
        </div>
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="namePro"></div>
                <div class="codePro">TOTAL</div>
                <div class="timePro">
                    <div class="time">
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
                           $c16=0;
                           $c17=0;
                           $c18=0;
                           $c19=0;
                           $c20=0;
                        ?> 
                        <?php foreach($nch as $rec): ?> 
                        <div class="cola1 b">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='06' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c6=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>  
                        
                        <div class="cola2">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='07' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c7=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='08' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c8=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='09' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c9=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='10' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c10=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='11' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c11=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='12' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c12=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='13' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c13=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='14' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c14=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='15' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c15=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        
                        <div class="cola11">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='16' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c16=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola12">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='17' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c17=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='18' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c18=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='19' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c19=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='20' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c20=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <?php endforeach;?>
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
                    <?php foreach($records as $rec): ?>
                        
                    <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' order by date ASC "; ?>
                    <?php $exe=mysql_query($sql);?>
                    <?php while($rec2=mysql_fetch_array($exe)){ ?>
                     
                        <div class="cola1">
                         <?php
                            if (day($rec2['date'])=='06') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot6=0;
                                    $totA6=$a6+$b6+$c6;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA6=$a6+$b6+$c6;
                                        $tot6=0; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec06 == '06'){
                                                    echo '-';
                                                    $tot6=0;
                                                    $totA6=$a6+$b6+$c6;
                                                } else {
                                                        $tot6=$a6+$b6+$c6;
                                                        if($tot6 > 8){
                                                            $totA6=$tot6-8;
                                                            $tot6=8;
                                                            echo $tot6;
                                                        }
                                                        else{
                                                            //$tot6=$a6+$b6+$c6;
                                                            echo $tot6;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        </div>
                        <div class="cola2">
                         <?php
                            if (day($rec2['date'])=='07') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA7=$a7+$b7+$c7;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA7=$a7+$b7+$c7; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec07 == '07'){
                                                    echo '-';
                                                    $tot7=0;
                                                    $totA7=$a7+$b7+$c7;
                                                } else {
                                                        $tot7=$a7+$b7+$c7;
                                                        if($tot7 > 8){
                                                            $totA7=$tot7-8;
                                                            $tot7=8;
                                                            echo $tot7;
                                                        }
                                                        else{
                                                            //$tot7=$a7+$b7+$c7;
                                                            echo $tot7;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        </div>
                        <div class="cola3">
                            <?php
                            //echo $rec08;
                            if (day($rec2['date'])=='08') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot8=0;
                                    $totA8=$a8+$b8+$c8;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot8=0;
                                        $totA8=$a8+$b8+$c8; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec08 == '08'){
                                                    echo '-';
                                                    $tot8=0;
                                                    $totA8=$a8+$b8+$c8;
                                                } else {
                                                        $tot8=$a8+$b8+$c8;
                                                        if($tot8 > 8){
                                                            $totA8=$tot8-8;
                                                            echo '8';
                                                        }
                                                        else{
                                                            //$tot8=$a8+$b8+$c8;
                                                            echo $tot8;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $a8; ?>
                        </div>
                        <div class="cola4">
                        <?php
                            if (day($rec2['date'])=='09') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot9=0;
                                    $totA9=$a9+$b9+$c9;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot9=0;
                                        $totA9=$a9+$b9+$c9; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec09 == '09'){
                                                    echo '-';
                                                    $tot9=0;
                                                    $totA9=$a9+$b9+$c9;
                                                } else {
                                                        $tot9=$a9+$b9+$c9;
                                                        if($tot9 > 8){
                                                            $totA9=$tot9-8;
                                                            $tot9=8;
                                                            echo $tot9;
                                                        }
                                                        else{
                                                            //$tot9=$a9+$b9+$c9;
                                                            echo $tot9;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot9=$a9+$b9+$c9;?>
                        </div>
                        <div class="cola5">
                        <?php
                            if (day($rec2['date'])=='10') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot10=0;
                                    $totA10=$a10+$b10+$c10;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot10=0;
                                        $totA10=$a10+$b10+$c10; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec10 == '10'){
                                                    echo '-';
                                                    $tot10=0;
                                                    $totA10=$a10+$b10+$c10;
                                                } else {
                                                        $tot10=$a10+$b10+$c10;
                                                        if($tot10 > 8){
                                                            $totA10=$tot10-8;
                                                            $tot10=8;
                                                            echo '8';
                                                        }
                                                        else{
                                                            //$tot10=$a10+$b10+$c10;
                                                            echo $tot10;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot10=$a10+$b10+$c10;?>
                        </div>
                        <div class="cola6">
                        <?php
                            if (day($rec2['date'])=='11') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot11=0;
                                    $totA11=$a11+$b11+$c11;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot11=0;
                                        $totA11=$a11+$b11+$c11; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec11 =='11'){
                                                    echo '-';
                                                    $tot11=0;
                                                    $totA11=$a11+$b11+$c11;
                                                } else {
                                                        //$tot11=0; 
                                                        $tot11=$a11+$b11+$c11;
                                                        if($tot11 > 8){
                                                            $totA11=$tot11-8;
                                                            $tot11=8;
                                                            echo $tot11;
                                                        }
                                                        else{
                                                            //$tot11=$a11+$b11+$c11;
                                                            echo $tot11;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot11=$a11+$b11+$c11;?>
                        </div>
                        <div class="cola7">
                        <?php
                            if (day($rec2['date'])=='12') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot12=0;
                                    $totA12=$a12+$b12+$c12;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot12=0;
                                        $totA12=$a12+$b12+$c12; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec12=='12'){
                                                    echo '-';
                                                    $totA12=$a12+$b12+$c12;
                                                } else {
                                                        $tot12=$a12+$b12+$c12;
                                                        if($tot12 > 8){
                                                            $totA12=$tot12-8;
                                                            $tot12 = 8;
                                                            echo $tot12;
                                                        }
                                                        else{
                                                            //$tot12=$a12+$b12+$c12;
                                                            echo $tot12;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot12=$a12+$b12+$c12;?>
                        </div>
                        <div class="cola8">
                        <?php
                            if (day($rec2['date'])=='13') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot13=0;
                                    $totA13=$a13+$b13+$c13;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot13=0;
                                        $totA13=$a13+$b13+$c13; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec13=='13'){
                                                    echo '-';
                                                    $tot13=0;
                                                    $totA13=$a13+$b13+$c13;
                                                } else {
                                                        $tot13=$a13+$b13+$c13;
                                                        if($tot13 > 8){
                                                            $totA13=$tot13-8;
                                                            $tot13=8;
                                                            echo $tot13;
                                                        }
                                                        else{
                                                            //$tot13=$a13+$b13+$c13;
                                                            echo $tot13;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot13=$a13+$b13+$c13;?>
                        </div>
                        <div class="cola9">
                        <?php
                            if (day($rec2['date'])=='14') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot14=0;
                                    $totA14=$a14+$b14+$c14;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot14=0;
                                        $totA14=$a14+$b14+$c14; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec14 == '14'){
                                                    echo '-';
                                                    $tot14=0;
                                                    $totA14=$a14+$b14+$c14;
                                                } else {
                                                        $tot14=$a14+$b14+$c14;
                                                        if($tot14 > 8){
                                                            $totA14=$tot14-8;
                                                            $tot14=8;
                                                            echo $tot14;
                                                        }
                                                        else{
                                                            //$tot14=$a14+$b14+$c14;
                                                            echo $tot14;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot14=$a14+$b14+$c14;?>
                        </div>
                        <div class="cola10">
                        <?php
                            if (day($rec2['date'])=='15') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot15=0;
                                    $totA15=$a15+$b15+$c15;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot15=0;
                                        $totA15=$a15+$b15+$c15; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec15 == '15'){
                                                    echo '-';
                                                    $tot15=0;
                                                    $totA15=$a15+$b15+$c15;
                                                } else {
                                                        $tot15=$a15+$b15+$c15;
                                                        if($tot15 > 8){
                                                            $totA15=$tot15-8;
                                                            $tot15=8;
                                                            echo $tot15;
                                                        }
                                                        else{
                                                            //$tot15=$a15+$b15+$c15;
                                                            echo $tot15;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php //echo $tot15=$a15+$b15+$c15;?>
                        </div>
                        <div class="cola11">
                        <?php
                            if (day($rec2['date'])=='16') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot16=0;
                                    $totA16=$a16+$b16+$c16;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot16=0;
                                        $totA16=$a16+$b16+$c16; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec16 =='16'){
                                                    echo '-';
                                                    $tot16=0;
                                                    $totA16=$a16+$b16+$c16;
                                                } else {
                                                        $tot16=$a16+$b16+$c16;
                                                        if($tot16 > 8){
                                                            $totA16=$tot9-8;
                                                            $tot16=8;
                                                            echo $tot16;
                                                        }
                                                        else{
                                                            //$tot16=$a16+$b16+$c16;
                                                            echo $tot16;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php // echo $tot16=$a16+$b16+$c16;?>
                        </div>
                        <div class="cola12">
                        <?php
                            if (day($rec2['date'])=='17') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot17=0;
                                    $totA17=$a17+$b17+$c17;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot17=0;
                                        $totA17=$a17+$b17+$c17; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec17 == '17'){
                                                    echo '-';
                                                    $tot17=0;
                                                    $totA17=$a17+$b17+$c17;
                                                } else {
                                                        $tot17=$a17+$b17+$c17;
                                                        if($tot17 > 8){
                                                            $totA17=$tot17-8;
                                                            $tot17=8;
                                                            echo $tot17;
                                                        }
                                                        else{
                                                            //$tot17=$a17+$b17+$c17;
                                                            echo $tot17;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>    
                        <?php  // echo $tot17=$a17+$b17+$c17;?>
                        </div>
                        <div class="cola13">
                        <?php
                            if (day($rec2['date'])=='18') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot18=0;
                                    $totA18=$a18+$b18+$c18;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot18=0;
                                        $totA18=$a18+$b18+$c18; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec18 =='18'){
                                                    echo '-';
                                                    $tot18=0;
                                                    $totA18=$a18+$b18+$c18;
                                                } else {
                                                        $tot18=$a18+$b18+$c18;
                                                        if($tot18 > 8){
                                                            $totA18=$tot18-8;
                                                            $tot18=8;
                                                            echo $tot18;
                                                        }
                                                        else{
                                                            //$tot18=$a18+$b18+$c18;
                                                            echo $tot18;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        </div>
                        <div class="cola14">
                        <?php
                            if (day($rec2['date'])=='19') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot19=0;
                                    $totA19=$a19+$b19+$c19;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot19=0;
                                        $totA19=$a19+$b19+$c19; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec19 =='19'){
                                                    echo '-';
                                                    $tot19=0;
                                                    $totA19=$a19+$b19+$c19;
                                                } else {
                                                        $tot19=$a19+$b19+$c19;
                                                        if($tot19 > 8){
                                                            $totA19=$tot19-8;
                                                            $tot19=8;
                                                            echo $tot19;
                                                        }
                                                        else{
                                                            //$tot19=$a19+$b19+$c19;
                                                            echo $tot19;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php // echo $tot19=$a19+$b19+$c19;?>
                        </div>
                        <div class="cola15">
                        <?php
                            if (day($rec2['date'])=='20') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $tot20=0;
                                    $totA20=$a20+$b20+$c20;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $tot20=0;
                                        $totA20=$a20+$b20+$c20; 
                                        }
                                      else{
                                            //foreach($holiday_mm as $rec3):
                                                if ($rec20 == '20'){
                                                    echo '-';
                                                    $tot20=0;
                                                    $totA20=$a20+$b20+$c20;
                                                } else {
                                                        $tot20=$a20+$b20+$c20;
                                                        if($tot20 > 8){
                                                            $totA20=$tot20-8;
                                                            $tot20=8;
                                                            echo $tot20;
                                                        }
                                                        else{
                                                            //$tot20=$a20+$b20+$c20;
                                                            echo $tot20;
                                                            //$totA8='0';
                                                        }
                                                }
                                            //endforeach;  
                                        
                                      }     
                                }
                        ?>
                        <?php // echo $tot20=$a20+$b20+$c20;?>
                        </div>
                        
                        <?php } ?>
                        
                     <?php endforeach; ?>   
                     
                    </div>
                </div>
                <?php $tot=0;?>
                <div class="total"><?php echo $tot=$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12+$tot13+$tot14+$tot15+$tot16+$tot17+$tot18+$tot19+$tot20;?></div>
                
                <div class="charge"><b class="b"><?php $overal=($tot/80)*100; echo $overal; ?>%</b></div>
                <div class="clear"></div>
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL OVERTIME</div>
                <div class="timePro">
                    <div class="time">
                        <?php
                            //$totA6=0;
                            //$totA7=0;
                            //$totA8=0;
                            //$totA9=0;
                            //$totA10=0;
                            //$totA11=0;
                            //$totA12=0;
                            //$totA13=0;
                            //$totA14=0;
                            //$totA15=0;
                            //$totA16=0;
                            //$totA17=0;
                            //$totA18=0;
                            //$totA19=0;
                            //$totA20=0;
                        ?> 
                        <div class="cola1"> <?php echo $totA6;//if ($tot6 > 8) { echo $totA6=$tot6-8; } else { echo '-';}?></div>
                        <div class="cola2"> <?php echo $totA7;//if ($tot7 > 8) { echo $totA7=$tot7-8; } else { echo '-';}?></div>
                        <div class="cola3"> <?php echo $totA8;//if ($tot8 > 8) { echo $totA8=$tot8-8; } else { echo '-';}?></div>
                        <div class="cola4"> <?php echo $totA9;//if ($tot9 > 8) { echo $totA9=$tot9-8; } else { echo '-';}?></div>
                        <div class="cola5"> <?php echo $totA10;//if ($tot10 > 8) { echo $totA10=$tot10-8; } else { echo '-';}?></div>
                        <div class="cola6"> <?php echo $totA11;//if ($tot11 > 8) { echo $totA11=$tot11-8; } else { echo '-';}?></div>
                        <div class="cola7"> <?php echo $totA12;//if ($tot12 > 8) { echo $totA12=$tot12-8; } else { echo '-';}?></div>
                        <div class="cola8"> <?php echo $totA13;//if ($tot13 > 8) { echo $totA13=$tot13-8; } else { echo '-';}?></div>
                        <div class="cola9"> <?php echo $totA14;//if ($tot14 > 8) { echo $totA14=$tot14-8; } else { echo '-';}?></div>
                        <div class="cola10"><?php echo $totA15;//if ($tot15 > 8) { echo $totA15=$tot15-8; } else { echo '-';};?></div>
                        <div class="cola11"><?php echo $totA16;//if ($tot16 > 8) { echo $totA16=$tot16-8; } else { echo '-';}?></div>
                        <div class="cola12"><?php echo $totA17;//if ($tot17 > 8) { echo $totA17=$tot17-8; } else { echo '-';};?></div>
                        <div class="cola13"><?php echo $totA18; //if ($tot18 > 8) { echo $totA18=$tot18-8; } else { echo '-';};?></div>
                        <div class="cola14"><?php echo $totA19;//if ($tot19 > 8) { echo $totA19=$tot19-8; } else { echo '-';};?></div>
                        <div class="cola15"><?php echo $totA20;//if ($tot20 > 8) { echo $totA20=$tot20-8; } else { echo '-';};?></div>
                    </div>
                </div>
                <div class="total"><?php echo $totA6+$totA7+$totA8+$totA9+$totA10+$totA11+$totA12+$totA14+$totA15+$totA16+$totA17+$totA18+$totA19+$totA20;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
 
 </div>       