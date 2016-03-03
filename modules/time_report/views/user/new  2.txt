<!-- Contact Form CSS files -->
<link type='text/css' href='<?php echo base_url()?>assets/css/basic.css' rel='stylesheet' media='screen' />
<!-- IE 6 "fixes" -->
<!--[if lt IE 7]>
<link type='text/css' href='<?php echo base_url()?>assets/css/basic_ie.css' rel='stylesheet' media='screen' />
<![endif]-->

<!-- JS files are loaded at the bottom of the page -->

		 <?php //echo number_format(substr('2010-05-06',5,2));?>
         <div id="search">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/user/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
          <?php echo $this->session->flashdata('message'); ?>
	  
<div class="head">
	<div class="col1">Job Code</div>
	<div class="col2">Job Name</div>
	<div class="col3">Description</div>
</div>
<br/>
<div class="title2"><h1>CHARGEABLE HOURS - FIELDWORK</h1></div>	
<br/>		 
<?php foreach($records as $rec):?>	 
		<div class="accordionButton">
			<div class="col1"><?php echo $rec['job_code'];?> </div>
			<div class="col2"><?php echo $rec['job_name'];?></div>
			<div class="col3"><?php echo $rec['description'];?> (<a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')">Remove</a> )</div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
            <div class="pis1">Overtime</div>
            <!--<div class="pis1">Amount</div>-->
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		 <?php echo form_open('time_report/user/edittime/'); ?>
		  <div class="con">
		    <input type='hidden' name='date' value="<?php echo $rec2['date'];?>" />
			<input type='hidden' name='code' value="<?php echo $rec2['code'];?>" />
			<input type='hidden' name='time_hidden' value="<?php echo $rec2['time'];?>" />
			<div class="pis1">
            <?php // echo day($rec2['date']); ?><?php //echo anchor('time_report/user/delete_day/'.$rec2['code'].'/'.$rec2['date'],day($rec2['date'],'onclick="return confirm("Are you sure you want to delete?")"')); ?>
                       <a href="<?php echo base_url().'time_report/user/delete_day/'.$rec2['code'].'/'.$rec2['date']; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?php echo day($rec2['date']); ?></a>   
            </div>
			<div class="pis1"><input type='text' name='time' value="<?php echo $rec2['time']; ?>" style="width:20px;text-align=right" /></div>
			<div class="pis1"><?php echo $rec2['over_time']; ?></div>
		  </div>
		  <?php echo form_close(); ?>
		  
		  <?php } ?>
		 
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" name="form" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
                          
			<input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
			<input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
            <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />  
               <div class="pis1">
			     <select name="day">
                   <?php 
                   $i=$awal;
                   while($i <= $akhir ){?>
                        <?php if($i<=9){ ?>
                        <option value="<?php echo '0'.$i;?>"><?php echo '0'.$i;?></option>
                        <?php } else { ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                        <?php $i++;} ?>
                        <?php 
                   $i=1;
                   while($i<=$makhir){?>
                        <option value="0<?php echo $i;?>">0<?php echo $i;?></option>
                        <?php $i++;} ?>
                 </select>
			   </div>
			   <div class="pis1">
				  <input name="time" type="text" size="5" class="time" />
			   </div>
               <div class="pis1">
				  <!--<input name="transport" type="text" size="10" class="transport left" />-->
                  <input type="submit" value="go" class="hidden" />
			   </div>
			</form>
		 </div>
         <?php } ?>
         <?php endforeach;?>
         
         <div class="con">
		   <div id='content'>
		 <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
               <?Php if(($_SESSION['level']=='TA') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='S1') || ($_SESSION['level']=='S2') ): ?>
			   <div id='basic-modal'><a href='#' class='basic'>Overtime</a></div>
			   <?php endif; ?>
	     <?php } ?>
         <?php endforeach;?>
		<!-- modal content -->
		<div id="basic-modal-content">
        <form class="cmxform" id="signupForm" name="form" method="POST" action="<?php echo base_url();?>time_report/user/saveOvertime" >
		<input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
        <input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
        <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" /> 	
            <h3>Overtime Formulir</h3>
            <p><code>Client Name  :
                  <select name="client">
                      <?php foreach($records as $rec): ?>
                            <option value="<?php echo $rec['day_code'];?>"><?php echo $rec['job_name'];?></option>						
                      <?php endforeach;?>    
                 </select>
                 </code>
             </p>
			<p><code>Day Overtime: <select name="day">
                   <?php 
                   $i=$awal;
                   while($i<=$akhir){?>
                        <?php if($i<=9){ ?>
                        <option value="<?php echo '0'.$i;?>"><?php echo '0'.$i;?></option>
                        <?php } else { ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                        <?php $i++;} ?>
                        <?php 
                   $i=1;
                   while($i<=$makhir){?>
                        <option value="0<?php echo $i;?>">0<?php echo $i;?></option>
                        <?php $i++;} ?>
                 </select>
                 </code>
             </p>
             <p><code>Time(From-To):<select name="time_1">
                   <?php 
                   $j=8;
                   $akhir2=24;
                   while($j<=$akhir2){?>
                     <?php if($j<10): ?>
                     <option value="<?php echo '0'.$j.':'.'00:00';?>"><?php echo '0'.$j.':'.'00:00';?></option>
                     <?php else: ?>
                    <option value="<?php echo $j.':'.'00:00';?>"><?php echo $j.':'.'00:00';?></option>
                   <?php endif; ?>  
                   <?php $j++;} ?>
                   <?php 
                   $j=1;
                   $akhir2=8;
                   while($j<=$akhir2){?>
                     <option value="<?php echo '0'.$j.':'.'00:00';?>"><?php echo '0'.$j.':'.'00:00';?></option>
                   <?php $j++;} ?>
                 </select>
                 <b>-</b>
                 <select name="time_2">
                   <?php 
                   $j=8;
                   $akhir2=24;
                   while($j<=$akhir2){?>
                     <?php if($j<10): ?> 
                     <option value="<?php echo '0'.$j.':'.'00:00';?>"><?php echo '0'.$j.':'.'00:00';?></option>
                    <?php else: ?>
                    <option value="<?php echo $j.':'.'00:00';?>"><?php echo $j.':'.'00:00';?></option>
                    <?php endif; ?>

                   <?php $j++;} ?>
                   <?php 
                   $j=1;
                   $akhir2=8;
                   while($j<=$akhir2){?>
                     <option value="<?php echo '0'.$j.':'.'00:00';?>"><?php echo '0'.$j.':'.'00:00';?></option>
                   <?php $j++;} ?>
                 </select>
                 </code>
             </p>
             <p><code><center><input type="submit" value="Save"  style="width:100px;"/></center></code></p>
			
         </form>   
		</div>
  
	  </div>
   </div>  	
             	 
		<div class="clear"></div>	
		</div>
<?php endforeach;?>		
		<br/>
<div class="title2"><h1>CHARGEABLE HOURS - OFFICE</h1></div>	
<br/>		 
<?php foreach($records2 as $rec):?>	 
		<div class="accordionButton">
			<div class="col1"><?php echo $rec['job_code'];?></div>
			<div class="col2"><?php echo $rec['job_name'];?></div>
			<div class="col3"><?php echo $rec['description'];?> (<a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')">Remove</a> )</div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
			<div class="pis1">Overtime</div>
			<div class="pis1"></div>
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		  <?php echo form_open('time_report/user/edittime/'); ?>
		  <div class="con">
		    <input type='hidden' name='date' value="<?php echo $rec2['date'];?>" />
			<input type='hidden' name='code' value="<?php echo $rec2['code'];?>" />
			<input type='hidden' name='time_hidden' value="<?php echo $rec2['time'];?>" />
			<div class="pis1"><?php //echo day($rec2['date']); ?>
              <a href="<?php echo base_url().'time_report/user/delete_day/'.$rec2['code'].'/'.$rec2['date']; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?php echo day($rec2['date']); ?></a>   
            </div>
			<div class="pis1"><input type='text' name='time' value="<?php echo $rec2['time']; ?>" style="width:20px;text-align=right" /></div>
			<div class="pis1"><?php echo $rec2['over_time']; ?></div>
			<div class="pis1"></div>
		  </div>
		  <?php echo form_close(); ?>
		  
		  
		  <?php } ?>
		  
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
			   <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
			   <input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
               <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />
               <div class="pis1">
			     <select name="day">
                        <?php 
                   $k=$awal;
                   while($k<=$akhir){?>
                        <?php if($k<=9){ ?>
                        <option value="<?php echo '0'.$k;?>"><?php echo '0'.$k;?></option>
                        <?php } else { ?>
                        <option value="<?php echo $k;?>"><?php echo $k;?></option>
                        <?php } ?>
                        <?php $k++;} ?>
                        <?php 
                   $k=1;
                   while($k<=$makhir){?>
                        <option value="0<?php echo $k;?>">0<?php echo $k;?></option>
                        <?php $k++;} ?>
                 </select>
			   </div>
			   <div class="pis1">
				  <input name="time" type="text" size="5" class="time" />
			   </div>
			</form>
		 </div>
         <?php } ?>
         <?php endforeach; ?>
                 
		   <div class="con">
		   <div id='content'>
		 <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
               <?Php if(($_SESSION['level']=='TA') || ($_SESSION['level']=='AS') || ($_SESSION['level']=='S1') || ($_SESSION['level']=='S2') ): ?>
			   <div id='basic-modal2'><a href='#' class='basic2'>Overtime</a></div>
			   <?php endif;?>
	     <?php } ?>
         <?php endforeach;?>
		<!-- modal content -->
		<div id="basic-modal-content2">
        <form class="cmxform" id="signupForm" name="form" method="POST" action="<?php echo base_url();?>time_report/user/saveOvertime" >
		<input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
        <input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
        <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" /> 	
            <h3>Overtime Formulir</h3>
            <p><code>Client Name  :
                  <select name="client">
                      <?php foreach($records2 as $rec): ?>
                            <option value="<?php echo $rec['day_code'];?>"><?php echo $rec['job_name'];?></option>							
                      <?php endforeach;?>    
                 </select>
                 </code>
             </p>
			<p><code>Day Overtime: <select name="day">
                   <?php 
                   $l=$awal;
                   while($l<=$akhir){?>
                        <?php if($l<=9){ ?>
                        <option value="<?php echo '0'.$l;?>"><?php echo '0'.$l;?></option>
                        <?php } else { ?>
                        <option value="<?php echo $l;?>"><?php echo $l;?></option>
                        <?php } ?>
                        <?php $l++;} ?>
                        <?php 
                   $l=1;
                   while($l<=$makhir){ ?>
                        <option value="0<?php echo $l;?>">0<?php echo $l;?></option>
                        <?php $l++;} ?>
                 </select>
                 </code>
             </p>
             <p><code>Time(From-To):<select name="time_1">
                   <?php 
                   $mxc=8;
                   $akhir2=24;
                   while($mxc<=$akhir2){?>
                     <?php if($mxc < 10): ?>
                     <option value="<?php echo '0'.$mxc.':'.'00:00';?>"><?php echo '0'.$mxc.':'.'00:00';?></option>
                   <?php else: ?>
                    <option value="<?php echo $mxc.':'.'00:00';?>"><?php echo $mxc.':'.'00:00';?></option>
                   <?php endif;?> 
                   <?php $mxc++;} ?>
                   
                   <?php 
                   $j=1;
                   $akhir2=8;
                   while($j<=$akhir2){?>
                     <option value="<?php echo '0'.$j.':'.'00:00';?>"><?php echo '0'.$j.':'.'00:00';?></option>
                   <?php $j++;} ?>
                   
                 </select>
                 <b>-</b>
                 <select name="time_2">
                   <?php 
                   $mxc=8;
                   $akhir3=24;
                   while($mxc<=$akhir3){?>
                     <?php if($mxc<10): ?>
                     <option value="<?php echo '0'.$mxc.':'.'00:00';?>"><?php echo '0'.$mxc.':'.'00:00';?></option>
                   <?php else: ?>
                   <option value="<?php echo $mxc.':'.'00:00';?>"><?php echo $mxc.':'.'00:00';?></option>
                  <?php endif;?>  
                   <?php $mxc++;} ?>
                   
                   <?php 
                   $mxc=1;
                   $akhir3=8;
                   while($mxc<=$akhir3){?>
                     <option value="<?php echo '0'.$mxc.':'.'00:00';?>"><?php echo '0'.$mxc.':'.'00:00';?></option>
                   <?php $mxc++;} ?>
                   
                 </select>
                 </code>
             </p>
             <p><code><center><input type="submit" value="Save"  style="width:100px;"/></center></code></p>
			
         </form>   
		</div>
  
	  </div>
   </div>  
   
		<div class="clear"></div>	
		</div>
<?php endforeach;?>		
		
	    <br/>
<div class="title2"><h1>NON-CHARGEABLE HOURS</h1></div>	
<br/>		 
<?php foreach($records3 as $rec):?>	 
		<div class="accordionButton">
			<div class="col1"><?php echo $rec['job_code'];?></div>
			<div class="col2"><?php echo $rec['job_name'];?></div>
			<div class="col3"><?php echo $rec['description'];?> (<a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')">Remove</a> )</div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]'   order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		  <?php echo form_open('time_report/user/edittime/'); ?>
		  <div class="con">
		    <input type='hidden' name='date' value="<?php echo $rec2['date'];?>" />
			<input type='hidden' name='code' value="<?php echo $rec2['code'];?>" />
			<input type='hidden' name='time_hidden' value="<?php echo $rec2['time'];?>" />
			<div class="pis1">
            <?php // echo day($rec2['date']); ?>
            <a href="<?php echo base_url().'time_report/user/delete_day/'.$rec2['code'].'/'.$rec2['date']; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?php echo day($rec2['date']); ?></a>   
            </div>
			<div class="pis1"><input type='text' name='time' value="<?php echo $rec2['time']; ?>" style="width:20px;text-align=right" /></div>
		  </div>
		  <?php echo form_close(); ?>
		  
		  <?php } ?>
		  
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
			   <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
               <input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
               <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />
               <div class="pis1">
			     <select name="day">
                   <?php 
                   //$n=$awal;
                   $n=$awal;
                   while($n<=$akhir){?>
                        <?php if($n<=9){ ?>
                        <option value="<?php echo '0'.$n;?>"><?php echo '0'.$n;?></option>
                        <?php } else { ?>
                        <option value="<?php echo $n;?>"><?php echo $n;?></option>
                        <?php } ?>
                        <?php $n++;} ?>
                        <?php 
                   $n=1;
                   while($n<=$makhir){?>
                        <option value="0<?php echo $n;?>">0<?php echo $n;?></option>
                        <?php $n++;} ?>
                 </select>
			   </div>
			   <div class="pis1">
				  <input name="time" type="text" size="5" class="time" />
			   </div>
			</form>
		 </div>
         <?php } ?>
         <?php endforeach; ?>	
             	 
		<div class="clear"></div>	
		</div>
<?php endforeach;?>		

<br/>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.simplemodal.js'></script>  
<script type="text/javascript">
    jQuery(function ($) {
	$('#basic-modal .basic').click(function (e) {
		$('#basic-modal-content').modal();
		  return false;
	});
});
jQuery(function ($) {
	$('#basic-modal2 .basic2').click(function (e) {
		$('#basic-modal-content2').modal();
		  return false;
	});
});
</script>      				
