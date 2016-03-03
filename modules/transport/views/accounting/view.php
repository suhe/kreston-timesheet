		 <?php //echo number_format(substr('2010-05-06',5,2));?>
         <div id="search">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
        </div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>transport/accounting/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>transport/accounting/index">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
          <?php echo $this->session->flashdata('message'); ?>


<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Date</th>	
              <th>Job Desc</th>
              <th>Client</th>
              <th>Time</th>
              <th >Transport</th>
          </thead>
          <tbody>
            <?php 
                $no=1;
                $trans=0;
            ?>
            <?php foreach($records as $rec):?>
               <tr>
               <td><?php echo $no;?></td>
               <td><?php echo indo_tgl($rec['date']);?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['time'];?></td>
               <td align="right"><?php echo number_format($rec['transport'],2);$trans=$trans+$rec['transport'];?></td>
               </tr>
             <?php $no++;?>  
            <?php endforeach;?>
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td>Total</td>
               <td align="right"><?php echo number_format($trans,2);?></td>
              </tr>
          </tbody>
        </table>
        
        <?php //foreach($total as $rec):?>
        <?php //echo number_format($rec['transport']);?>
        <?php //endforeach;?>

<br />
<br />
<br />
<br />


<!--	  
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
			<div class="col1"><?php echo $rec['job_code'];?></div>
			<div class="col2"><?php echo $rec['job_name'];?></div>
			<div class="col3"><?php echo $rec['description'];?></div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
            <div class="pis1">Trans</div>
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		  <div class="con">
			<div class="pis1"><?php echo day($rec2['date']); ?></div>
			<div class="pis1"><?php echo $rec2['time']; ?></div>
            <div class="pis1"><?php echo $rec2['transport_chf']; ?></div>
		  </div>
		  
		  <?php } ?>
		 
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" name="form" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
             
             
			   <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
			   <input type="hidden" name="date" value="<?php echo $y.'-'.'0'.$m.'-'.$d; ?>" />
               <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />  
                  
               <div class="pis1">
			     <select name="day">
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
			   </div>
			   <div class="pis1">
				  <input name="time" type="text" size="5" class="time" />
			   </div>
               <div class="pis1">
				  <input name="transport" type="text" size="10" class="transport left" />
                  <input type="submit" value="go" class="hidden" />
			   </div>
               
			</form>
		 </div>
         <?php } ?>
         <?php endforeach;?>	
             	 
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
			<div class="col3"><?php echo $rec['description'];?></div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		  <div class="con">
			<div class="pis1"><?php echo day($rec2['date']); ?></div>
			<div class="pis1"><?php echo $rec2['time']; ?></div>
		  </div>
		  
		  <?php } ?>
		  
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
			   <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
			   <input type="hidden" name="date" value="<?php echo $y.'-'.'0'.$m.'-'.$d; ?>" />
               <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />
               <div class="pis1">
			     <select name="day">
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
<div class="title2"><h1>NON-CHARGEABLE HOURS</h1></div>	
<br/>		 
<?php foreach($records3 as $rec):?>	 
		<div class="accordionButton">
			<div class="col1"><?php echo $rec['job_code'];?></div>
			<div class="col2"><?php echo $rec['job_name'];?></div>
			<div class="col3"><?php echo $rec['description'];?></div>
			<div class="clear"></div>
		</div>
		<div class="accordionContent">
		  <div class="con">
			<div class="pis1">Day</div>
			<div class="pis1">Time</div>
		  </div>
		  
		  <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
          <?php $exe=mysql_query($sql);?>
          <?php while($rec2=mysql_fetch_array($exe)){?>
          
		  <div class="con">
			<div class="pis1"><?php echo day($rec2['date']); ?></div>
			<div class="pis1"><?php echo $rec2['time']; ?></div>
		  </div>
		  
		  <?php } ?>
		  
         <?php foreach($recapp as $recap):?>
         <?php if(($recap['status_manager']=='pending') AND ($recap['status_hrd']=='pending') ){ ?>
         <div class="con">		   
			<form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
			   <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />  
			   <input type="hidden" name="date" value="<?php echo $y.'-'.'0'.$m.'-'.$d; ?>" />
               <input type="hidden" name="type" value="<?php echo $rec['code_type'];?>" />
               <div class="pis1">
			     <select name="day">
                        <?php 
                   $i=$awal;
                   while($i<=$akhir){?>
                        <?php if($i<=9){ ?>
                        <option value="<?php echo '0'.$i;?>"><?php echo '0'.$i;?></option>
                        <?php } else {?>
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
			</form>
		 </div>
         <?php } ?>
         <?php endforeach; ?>	
             	 
		<div class="clear"></div>	
		</div>
<?php endforeach;?>		
		
	    <br/>
<!-- Akhir -->        				