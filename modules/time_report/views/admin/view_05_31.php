<!-- CSS File -->
<link  rel="stylesheet" href="<?php echo base_url();?>assets/css/tr/style.css"  type="text/css"/>
<!-- End OF CSS File -->

<script language="JavaScript">
function submitform()
{
   document.form1.submit();
}
</script> 


        <div id="search">
          <b><label for="filter">Name : </label><?php echo $name; ?></b> 
        </div>
        
        <div id="navigation">
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/admin/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/admin/periode/<?php echo $_SESSION['periode'];?>">Come Back</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>

<div class="mainpage2">
    
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
                        <div class="cola10">30</div>
                        <div class="cola11">31</div>
                        <div class="cola12">01</div>
                        <div class="cola13">02</div>
                        <div class="cola14">03</div>
                        <div class="cola15">04</div>
                        <div class="cola16">05</div>
                    </div>
                </div>
                <div class="total">Total</div>
                <div class="work">Work Description</div>
                <div class="transp">Transportation</div>
                <div class="charge">Aproval</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK --> 
        <div class="type">
            CHARGEABLE HOURS - FIELDWORK 
        </div>
        
       <?php
           //$a21=0;
           //$a22=0;
           //$a23=0;
           //$a24=0;
           //$a25=0;
           //$a26=0;
           //$a27=0;
           //$a28=0;
           //$a29=0;
           //$a30=0;
           //$a31=0;
           //$a1=0;
           //$a2=0;
           //$a3=0;
           //$a4=0;
           //$a5=0;
           $transport=0;
        ?>
        <?php foreach($chf as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                           <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' AND type_job='chf' order by date ASC "; ?>
                           <?php $exe=mysql_query($sql);?>
                           <?php while($rec2=mysql_fetch_array($exe)){ ?>     
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?> <?php endforeach;?>">  <?php if(day($rec2['date'])== '21') { echo $rec2['time'];} ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '22') { echo $rec2['time'];} ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '23') { echo $rec2['time'];} ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '24') { echo $rec2['time']; } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '25') { echo $rec2['time'];} ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '26') { echo $rec2['time'];} ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '27') { echo $rec2['time'];} ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '28') { echo $rec2['time'];} ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '29') { echo $rec2['time'];} ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '30') { echo $rec2['time'];} ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mn as $day): ?> <?php  if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php  } ?><?php endforeach;?>"> <?php  if(day($rec2['date'])== '31') { echo $rec2['time'];} ?></div>
                            
                            <?php } ?>
                           
                           <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' order by date ASC "; ?>
                           <?php $exe=mysql_query($sql);?>
                           <?php while($rec2=mysql_fetch_array($exe)){ ?>
                             
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '01') { echo $rec2['time']; } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '02') { echo $rec2['time']; } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '03') { echo $rec2['time']; } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '04') { echo $rec2['time']; } ?></div>
                            <div class="cola16 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?><?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '05') { echo $rec2['time']; } ?></div>
                            <?php //$total_a=$a21+$a22+$a23+$a24+$a25+$a26+$a27+$a28+$a29+$a30+$a31+$a1+$a2+$a3+$a4+$a5;?>
                            
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
                        $a31=0;
                        $a1=0;
                        $a2=0;
                        $a3=0;
                        $a4=0;
                        $a5=0; 
                    ?>
                    
                    <?php foreach($chf as $rec): ?>
                    <?php $trcode=substr($rec['day_code'],0,16);?>
                        <div class="cola1">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='21' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a21=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola2">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='22' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a22=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='23' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a23=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='24' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a24=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='25' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a25=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='26' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a26=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='27' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a27=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='28' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a28=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='29' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a29=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='30' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a30=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        
                        <div class="cola11">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='31' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a31=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div> 
                        <div class="cola12">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='01' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a1=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='02' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a2=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='03' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a3=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='04' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a4=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola16">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='05' AND type_job='chf' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $a5=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                       <?php endforeach;?> 
                    </div>
                </div>
                <div class="total">
                <?php $total_a=$a21+$a22+$a23+$a24+$a25+$a26+$a27+$a28+$a29+$a30+$a31+$a1+$a2+$a3+$a4+$a5;?>
                <?php echo $total_a;?>
                </div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start CHARGEABLE HOURS - OFFICE --> 
        <div class="type">
            CHARGEABLE HOURS - OFFICE
        </div>
       
        <?php foreach($cho as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
               
                           <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' order by date ASC "; ?>
                           <?php $exe=mysql_query($sql);?>
                           <?php while($rec2=mysql_fetch_array($exe)){ ?>
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '21') { echo $rec2['time']; } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '22') { echo $rec2['time']; } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '23') { echo $rec2['time'];} ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '24') { echo $rec2['time'];} ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '25') { echo $rec2['time'];} ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '26') { echo $rec2['time'];} ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '27') { echo $rec2['time'];} ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '28') { echo $rec2['time'];} ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"> <?php if(day($rec2['date'])== '29') { echo $rec2['time'];} ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '30') { echo $rec2['time'];} ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>"><?php if(day($rec2['date'])== '31') { echo $rec2['time'];} ?></div>
                            <?php } ?>
                       
                        
                         
                            <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php while($rec2=mysql_fetch_array($exe)){ ?>
                           
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?> <?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>  "><?php if(day($rec2['date'])== '01') { echo $rec2['time'];$b1=$b1+$rec2['time']; } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>  "><?php if(day($rec2['date'])== '02') { echo $rec2['time'];$b2=$b2+$rec2['time']; } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>  "><?php if(day($rec2['date'])== '03') { echo $rec2['time'];$b3=$b3+$rec2['time']; } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>  "><?php if(day($rec2['date'])== '04') { echo $rec2['time'];$b4=$b4+$rec2['time']; } ?></div>
                            <div class="cola16 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?>  "><?php if(day($rec2['date'])== '05') { echo $rec2['time'];$b5=$b5+$rec2['time']; } ?></div>
                            <?php $total_b=$b21+$b22+$b23+$b24+$b25+$b26+$b27+$b28+$b29+$b30+$b1+$b2+$b3+$b4+$b5;?>
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
                <div class="codePro"><b>TOTAL</b></div>
                <div class="timePro">
                    <div class="time">
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
                    ?>
                    <?php foreach($cho as $rec): ?> 
                        <div class="cola1 b">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='21' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b21=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola2">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='22' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b22=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='23' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b23=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='24' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b24=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='25' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b25=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='26' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b26=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='27' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b27=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='28' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b28=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='29' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b29=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='30' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b30=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola11">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='31' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b31=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola12">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='01' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b1=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='02' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b2=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='03' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b3=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='04' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b4=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola16">
                        <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='05' AND type_job='cho' order by date ASC "; ?>
                        <?php $exe=mysql_query($sql);?>
                        <?php $rec2=mysql_fetch_array($exe);?>
                        <?php $b5=$rec2['timetot'];?>
                        <?php echo $rec2['timetot'];?>
                        </div>
                     <?php endforeach;?>   
                    </div>
                </div>
                
                <div class="total">
                <?php echo $total_b=$b21+$b22+$b23+$b24+$b25+$b26+$b27+$b28+$b29+$b30+$b31+$b1+$b2+$b3+$b4+$b5;?>
                </div>
                
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <!-- Start NON-CHARGEABLE HOURS --> 
        <div class="type">
            NON-CHARGEABLE HOURS
        </div>
        
       
        <?php foreach($nch as $rec): ?>
        <div class="content">
                <div class="namePro"><?php echo $rec['job_name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="timePro">
                    <div class="time">
                        
                            <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php while($rec2=mysql_fetch_array($exe)){ ?>
                            
                            <div class="cola1 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '21') { echo $rec2['time']; } ?></div>
                            <div class="cola2 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '22') { echo $rec2['time']; } ?></div>
                            <div class="cola3 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '23') { echo $rec2['time']; } ?></div>
                            <div class="cola4 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '24') { echo $rec2['time']; } ?></div>
                            <div class="cola5 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '25') { echo $rec2['time'];} ?></div>
                            <div class="cola6 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '26') { echo $rec2['time'];} ?></div>
                            <div class="cola7 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '27') { echo $rec2['time'];} ?></div>
                            <div class="cola8 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '28') { echo $rec2['time'];} ?></div>
                            <div class="cola9 <?php if(($rec2['name']=="Sunday") || ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"> <?php if(day($rec2['date'])== '29') { echo $rec2['time'];} ?></div>
                            <div class="cola10 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"><?php if(day($rec2['date'])== '30') { echo $rec2['time'];} ?></div>
                            <div class="cola11 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mn as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach; ?>"><?php if(day($rec2['date'])== '31') { echo $rec2['time'];} ?></div>
                            <?php } ?>
                        
                        
                        
                            <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php while($rec2=mysql_fetch_array($exe)){ ?>
                            <div class="cola12 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?> "><?php if(day($rec2['date'])== '01') { echo $rec2['time'];$c1=$c1+$rec2['time']; } ?></div>
                            <div class="cola13 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?> "><?php if(day($rec2['date'])== '02') { echo $rec2['time'];$c2=$c2+$rec2['time']; } ?></div>
                            <div class="cola14 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?> "><?php if(day($rec2['date'])== '03') { echo $rec2['time'];$c3=$c3+$rec2['time']; } ?></div>
                            <div class="cola15 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?> "><?php if(day($rec2['date'])== '04') { echo $rec2['time'];$c4=$c4+$rec2['time']; } ?></div>
                            <div class="cola16 <?php if(($rec2['name']=="Sunday")|| ($rec2['name']=="Saturday")) {?>red<?php } ?> <?php foreach($holiday_mm as $day): ?><?php if (day($day['date_h'])== day($rec2['date'])) { ?>blue<?php } ?><?php endforeach;?> "><?php if(day($rec2['date'])== '05') { echo $rec2['time'];$c5=$c5+$rec2['time']; } ?></div>
                            <?php //$total_c=$c21+$c22+$c23+$c24+$c25+$c26+$c27+$c28+$c29+$c30+$c31+$c1+$c2+$c3+$c4+$c5;?>
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
                       $c31=0;
                       $c1=0;
                       $c2=0;
                       $c3=0;
                       $c4=0;
                       $c5=0;
                        ?> 
                      <?php foreach($nch as $rec): ?> 
                        <div class="cola1 b">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='21' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c21=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>  
                        
                        <div class="cola2">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='22' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c22=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola3">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='23' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c23=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola4">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='24' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c24=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola5">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='25' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c25=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola6">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='26' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c26=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola7">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='27' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c27=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola8">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='28' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c28=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola9">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='29' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c29=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola10">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='30' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c30=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola11">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='31' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c31=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola12">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='01' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c1=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola13">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='02' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c2=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola14">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='03' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c3=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola15">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='04' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c4=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <div class="cola16">
                            <?php $sql="SELECT SUM(time) as timetot FROM josh_details_day_tr WHERE code like '%$trcode%' AND DAY(date)='05' AND type_job='nch' order by date ASC "; ?>
                            <?php $exe=mysql_query($sql);?>
                            <?php $rec2=mysql_fetch_array($exe);?>
                            <?php $c5=$rec2['timetot'];?>
                            <?php echo $rec2['timetot'];?>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="total"><?php echo $total_c=$c21+$c22+$c23+$c24+$c25+$c26+$c27+$c28+$c29+$c30+$c31+$c1+$c2+$c3+$c4+$c5;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
        
        <!-- Finish -->
        
        <br />
        <?php
                        //$tot21=0;
                        //$tot22=0;
                        //$tot23=0;
                        //$tot24=0;
                        //$tot25=0;
                        //$tot26=0;
                        //$tot27=0;
                        //$tot28=0;
                        //$tot29=0;
                        //$tot30=0;
                        //$tot31=0;
                        //$tot1=0;
                        //$tot1=0;
                        //$tot2=0;
                        //$tot3=0;
                        //$tot4=0;
                        //$tot5=0;
                        
                        //$tot21=$a21+$b21+$c21;
                        //$tot22=$a22+$b22+$c22;
                        //$tot23=$a23+$b23+$c23;
                        //$tot24=$a24+$b24+$c24;
                        //$tot25=$a25+$b25+$c25;
                        //$tot26=$a26+$b26+$c26;
                        //$tot27=$a27+$b27+$c27;
                        //$tot28=$a28+$b28+$c28;
                        //$tot29=$a29+$b29+$c29;
                        //$tot30=$a30+$b30+$c30;
                        //$tot31=$a31+$b31+$c31;
                        
                        //$totA21=0;
                        //$totA22=0;
                        //$totA23=0;
                        //$totA24=0;
                        //$totA25=0;
                        //$totA26=0;
                        //$totA27=0;
                        //$totA28=0;
                        //$totA29=0;
                        //$totA30=0;
                        //$totA31=0;
                        //$totA1=0;
                        //$totA2=0;
                        //$totA3=0;
                        //$totA4=0;
                        //$totA5=0;         
                    ?>
         
                   
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro"><b>TOTAL HOURS</b></div>
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
                            $tot31=0;
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
                            $totA31=0;
                            $totA1=0;
                            $totA2=0;
                            $totA3=0;
                            $totA4=0;
                            $totA5=0;
                        ?>     
                        
                <?php foreach($records as $rec): ?>
                      
                      <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mn' AND code='$rec[day_code]'  order by date ASC "; ?>
                      <?php $exe=mysql_query($sql);?>
                      <?php while($rec2=mysql_fetch_array($exe)){ ?> 
                       
                       <div class="cola1">
                            <?php
                            if (day($rec2['date'])=='21') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA21=$a21+$b21+$c21;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA21=$a21+$b21+$c21; 
                                        }
                                      else{
                                            if ($rec21 == '21') {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA21=$a21+$b21+$c21;
                                                } else {
                                                        $tot21=$a21+$b21+$c21;
                                                        if($tot21 > 8){
                                                            $totA21=$tot21-8;
                                                            $tot21=8;
                                                             //echo '8';
                                                            echo $tot21; 
                                                        }
                                                        else{
                                                            //$tot21=$a21+$b21+$c21;
                                                             echo $tot21;
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
                            if (day($rec2['date'])=='22') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA22=$a22+$b22+$c22;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA22=$a22+$b22+$c22; 
                                        }
                                      else{
                                            if ($rec22['day'] == '22') {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA22=$a22+$b22+$c22;
                                                } else {
                                                        $tot22=$a22+$b22+$c22;
                                                        if($tot22 > 8){
                                                            $totA22=$tot22-8;
                                                             $tot22=8;
                                                             //echo '8';
                                                            echo $tot22; 
                                                        }
                                                        else{
                                                            $tot22=$a22+$b22+$c22;
                                                            echo $tot22;
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
                            if (day($rec2['date'])=='23') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA23=$a23+$b23+$c23;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA23=$a23+$b23+$c23; 
                                        }
                                      else{
                                            if ($rec23['day'] == '23' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA23=$a23+$b23+$c23;
                                                } else {
                                                        $tot23=$a23+$b23+$c23;
                                                        if($tot23 > 8){
                                                            $totA23=$tot23-8;
                                                             //echo '8';
                                                             $tot23=8;
                                                             //echo '8';
                                                            echo $tot23; 
                                                        }
                                                        else{
                                                            $tot23=$a23+$b23+$c23;
                                                            echo $tot23;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                              
                            </div>
                            
                            <div class="cola4">
                              <?php
                            if (day($rec2['date'])=='24') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA24=$a24+$b24+$c24;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA24=$a24+$b24+$c24; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec24 == '24' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA24=$a24+$b24+$c24;
                                                } else {
                                                        $tot24=$a24+$b24+$c24;
                                                        if($tot24 > 8){
                                                            $totA24=$tot24-8;
                                                             //echo '8';
                                                             $tot24=8;
                                                             //echo '8';
                                                            echo $tot24; 
                                                        }
                                                        else{
                                                            $tot24=$a24+$b24+$c24;
                                                            echo $tot24;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            
                            <div class="cola5">
                                <?php
                            if (day($rec2['date'])=='25') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA25=$a25+$b25+$c25;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA25=$a25+$b25+$c25; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec24 == '25' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA25=$a25+$b25+$c25;
                                                } else {
                                                        $tot25=$a25+$b25+$c25;
                                                        if($tot25 > 8){
                                                            $totA25=$tot25-8;
                                                             //echo '8';
                                                             $tot25=8;
                                                             //echo '8';
                                                            echo $tot25; 
                                                        }
                                                        else{
                                                            $tot25=$a25+$b25+$c25;
                                                            echo $tot25;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola6">
                             <?php
                            if (day($rec2['date'])=='26') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA26=$a26+$b26+$c26;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA26=$a26+$b26+$c26; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec26 == '26' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA26=$a26+$b26+$c26;
                                                } else {
                                                        $tot26=$a26+$b26+$c26;
                                                        if($tot26 > 8){
                                                            $totA26=$tot26-8;
                                                             //echo '8';
                                                             $tot26=8;
                                                             //echo '8';
                                                            echo $tot26; 
                                                        }
                                                        else{
                                                            $tot26=$a26+$b26+$c26;
                                                            echo $tot26;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola7">
                              <?php
                            if (day($rec2['date'])=='27') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA27=$a27+$b27+$c27;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA27=$a27+$b27+$c27; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec27 == '27' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA27=$a27+$b27+$c27;
                                                } else {
                                                        $tot27=$a27+$b27+$c27;
                                                        if($tot27 > 8){
                                                            $totA27=$tot27-8;
                                                             //echo '8';
                                                             $tot27=8;
                                                             //echo '8';
                                                            echo $tot27; 
                                                        }
                                                        else{
                                                            $tot27=$a27+$b27+$c27;
                                                            echo $tot27;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola8">
                            <?php
                            if (day($rec2['date'])=='28') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA28=$a28+$b28+$c28;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA28=$a28+$b28+$c28; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec28 == '28' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA28=$a28+$b28+$c28;
                                                } else {
                                                        $tot28=$a28+$b28+$c28;
                                                        if($tot28 > 8){
                                                            $totA28=$tot28-8;
                                                             $tot28=8;
                                                             //echo '8';
                                                            echo $tot28; 
                                                        }
                                                        else{
                                                            $tot28=$a28+$b28+$c28;
                                                            echo $tot28;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola9">
                            <?php
                            if (day($rec2['date'])=='29') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA29=$a29+$b29+$c29;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA29=$a29+$b29+$c29; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec29 == '29' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA29=$a29+$b29+$c29;
                                                } else {
                                                        $tot29=$a29+$b29+$c29;
                                                        if($tot29 > 8){
                                                            $totA29=$tot29-8;
                                                             $tot29=8;
                                                             //echo '8';
                                                            echo $tot29; 
                                                        }
                                                        else{
                                                            //$tot29=$a29+$b29+$c29;
                                                            echo $tot29;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola10">
                            <?php
                            if (day($rec2['date'])=='30') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA30=$a30+$b30+$c30;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA30=$a30+$b30+$c30; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec30 == '30' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA30=$a30+$b30+$c30;
                                                } else {
                                                        $tot30=$a30+$b30+$c30;
                                                        if($tot30 > 8){
                                                            $totA30=$tot30-8;
                                                             $tot30=8;
                                                             //echo '8';
                                                            echo $tot30; 
                                                        }
                                                        else{
                                                            //$tot30=$a30+$b30+$c30;
                                                            echo $tot30;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola11">
                            <?php
                            if (day($rec2['date'])=='31') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA31=$a31+$b31+$c31;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA31=$a31+$b31+$c31; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec31 == '31' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA31=$a31+$b31+$c31;
                                                } else {
                                                        $tot31=$a31+$b31+$c31;
                                                        if($tot31 > 8){
                                                            $totA31=$tot31-8;
                                                             $tot31=8;
                                                             //echo '8';
                                                            echo $tot31; 
                                                        }
                                                        else{
                                                            //$tot31=$a31+$b31+$c31;
                                                            echo $tot31;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                          <?php } ?>  
                            
                      <?php $sql="SELECT DAYNAME(date) as name,date,time FROM josh_details_day_tr WHERE MONTH(date)='$mm' AND code='$rec[day_code]'   order by date ASC "; ?>
                      <?php $exe=mysql_query($sql);?>
                      <?php while($rec2=mysql_fetch_array($exe)){ ?> 
                      
                            <div class="cola12">
                                <?php
                            if (day($rec2['date'])=='01') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA1=$a1+$b1+$c1;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA1=$a1+$b1+$c1; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec01 == '01' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA1=$a1+$b1+$c1;
                                                } else {
                                                        $tot1=$a1+$b1+$c1;
                                                        if($tot1 > 8){
                                                            $totA1=$tot1-8;
                                                             $tot1=8;
                                                             //echo '8';
                                                            echo $tot1; 
                                                        }
                                                        else{
                                                            //$tot1=$a1+$b1+$c1;
                                                            echo $tot1;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>
                            </div>
                            <div class="cola13">
                            <?php
                            if (day($rec2['date'])=='02') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA2=$a2+$b2+$c2;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA31=$a2+$b2+$c2; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec02 == '02' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA2=$a2+$b2+$c2;
                                                } else {
                                                        $tot2=$a2+$b2+$c2;
                                                        if($tot2 > 8){
                                                            $totA2=$tot2-8;
                                                             //echo '8';
                                                             $tot2=8;
                                                             //echo '8';
                                                            echo $tot2; 
                                                        }
                                                        else{
                                                            //$tot2=$a2+$b2+$c2;
                                                            echo $tot2;
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
                            if (day($rec2['date'])=='03') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA3=$a3+$b3+$c3;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA3=$a3+$b3+$c3; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec03 == '03' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA3=$a3+$b3+$c3;
                                                } else {
                                                        $tot3=$a3+$b3+$c3;
                                                        if($tot3 > 8){
                                                            $totA3=$tot3-8;
                                                             $tot3=8;
                                                             //echo '8';
                                                            echo $tot3; 
                                                        }
                                                        else{
                                                            //$tot3=$a3+$b3+$c3;
                                                            echo $tot3;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>   
                            </div>
                            <div class="cola15">
                            <?php
                            if (day($rec2['date'])=='04') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA4=$a4+$b4+$c4;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA4=$a4+$b4+$c4; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec04 == '04' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA4=$a4+$b4+$c4;
                                                } else {
                                                        $tot4=$a4+$b4+$c4;
                                                        if($tot4 > 8){
                                                            $totA4=$tot4-8;
                                                             $tot4=8;
                                                             //echo '8';
                                                            echo $tot4; 
                                                        }
                                                        else{
                                                            //$tot4=$a4+$b4+$c4;
                                                            echo $tot4;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>   
                            </div>
                            <div class="cola16">
                            <?php
                            if (day($rec2['date'])=='05') {
                                if($rec2['name']=='Saturday') {
                                    echo '-';
                                    $totA5=$a5+$b5+$c5;    
                                } elseif($rec2['name']=='Sunday') {
                                        echo '-';
                                        $totA5=$a5+$b5+$c5; 
                                        }
                                      else{
                                            //echo $rec24['day'];
                                            if ($rec05 == '05' ) {
                                                
                                                //if (day($rec3['date_h'])=='21'){
                                                    echo '-';
                                                    $totA5=$a5+$b5+$c5;
                                                } else {
                                                        $tot5=$a5+$b5+$c5;
                                                        if($tot5 > 8){
                                                            $totA5=$tot5-8;
                                                             //echo '8';
                                                             $tot5=8;
                                                            echo $tot5; 
                                                        }
                                                        else{
                                                            //$tot5=$a5+$b5+$c5;
                                                            echo $tot5;
                                                            //$totA8='0';
                                                        }
                                                }
                          
                                            //endforeach;
                                             
                                        
                                      }     
                                }
                         ?>   
                            </div>
                           <?php } ?> 
                            
                    <?php endforeach;?>        
                     
                    </div>
                </div>
                <div class="total">
                <?php $tot=$tot21+$tot22+$tot23+$tot24+$tot25+$tot26+$tot27+$tot28+$tot29+$tot30+$tot31+$tot1+$tot2+$tot3+$tot4+$tot5;?>
                <?php //$tot=$tot21; ?>
                <?php echo $tot;?>
                </div>
                
                <div class="charge"><b class="b"><?php $overal=($tot/80)*100; echo $overal; ?>%</b></div>
                <div class="clear"></div>
                   
        </div>
        
        
        <div class="content contol hour">
                <div class="namePro"></div>
                <div class="codePro">TOTAL OVERTIME</div>
                <div class="timePro">
                    <div class="time">
                        
                        
                             
                      <div class="cola1">
                        <?php echo $totA21; ?>
                      </div>
                      <div class="cola2">
                        <?php echo $totA22; ?>
                      </div>
                      <div class="cola3">
                        <?php echo $totA23; ?>
                      </div>
                        <div class="cola4"><?php echo $totA24; ?><?php //if ($tot24 > 8) { echo $totA24=$tot24-8; } else { echo '-';}?></div>
                        <div class="cola5"><?php echo $totA25; ?><?php //if ($tot25 > 8) { echo $totA25=$tot25-8; } else { echo '-';}?></div>
                        <div class="cola6"><?php echo $totA26; ?><?php //if ($tot26 > 8) { echo $totA26=$tot26-8; } else { echo '-';}?></div>
                        <div class="cola7"><?php echo $totA27; ?><?php //if ($tot27 > 8) { echo $totA27=$tot27-8; } else { echo '-';}?></div>
                        <div class="cola8"><?php echo $totA28; ?><?php //if ($tot28 > 8) { echo $totA28=$tot28-8; } else { echo '-';}?></div>
                        <div class="cola9"><?php echo $totA29; ?><?php //if ($tot29 > 8) { echo $totA29=$tot29-8; } else { echo '-';}?></div>
                        <div class="cola10"><?php echo $totA30; ?><?php //if ($tot30 > 8) { echo $totA30=$tot30-8; } else { echo '-';};?></div>
                        <div class="cola11"><?php echo $totA31; ?><?php  // if ($tot31 > 8) { echo $totA31=$tot31-8; } else { echo '-';}?></div>
                        <div class="cola12"><?php echo $totA1; ?><?php //if ($tot1 > 8) { echo $totA1=$tot1-8; } else { echo '-';}?></div>
                        <div class="cola13"><?php echo $totA2; ?><?php //if ($tot2 > 8) { echo $totA2=$tot2-8; } else { echo '-';};?></div>
                        <div class="cola14"><?php echo $totA3; ?><?php //if ($tot3 > 8) { echo $totA3=$tot3-8; } else { echo '-';};?></div>
                        <div class="cola15"><?php echo $totA4; ?><?php //if ($tot4 > 8) { echo $totA4=$tot4-8; } else { echo '-';};?></div>
                        <div class="cola16"><?php echo $totA5; ?><?php //if ($tot5 > 8) { echo $totA5=$tot5-8; } else { echo '-';};?></div>
                        
                    </div>
                </div>
                <div class="total"><?php echo $totA21+$totA22+$totA23+$totA24+$totA25+$totA26+$totA27+$totA28+$totA29+$totA30+$totA31+$totA1+$totA2+$totA3+$totA4+$totA5;?></div>
                
                <div class="charge">-</div>
                <div class="clear"></div>
        </div>
    
</div>        