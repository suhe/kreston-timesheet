
 
       <div id="search">
		  <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
		  
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>
			<a class="button" href="<?php echo base_url();?>time_report/user/requestapp/<?=$_SESSION['tr_code']?>">Request Approval</a>
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/user/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/">Back</a>
        </div>
        
        <div class="clear"></div>
        
         <?=$this->session->flashdata('message'); ?>
        
		<div class="form">
		<form class="cmxform" id="signupForm" name="form" method="POST" action="<?php echo base_url();?>time_report/user/saved" >  
		<input type="hidden" name="date" value="<?php echo $y.'-'.$m.'-'.$d; ?>" />
			<table cellpadding="0" cellspacing="0" id="resultTable" style="width:50%;margin-left:30px"  >
				<tbody>
					<tr>
						<td colspan="3" style="background:#64C1FF;padding:5px;font-weight:bold" ><?=$daytitle;?></td>
					</tr>
					
					<?php if(($_SESSION['level']=='P')) { ?>
					<?php } else { ?>
					<tr>
						<td colspan="3"> <?=anchor('time_report/user/view/'.$_SESSION['tr_code'],'WEEKDAY')?> | <?=anchor('time_report/user/view/'.$_SESSION['tr_code'].'/holiday','WEEKEND & HOLIDAY')?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="width:150px">Day</td>
						<td style="width:10px;border-top:1px solid #222;border-left:none;border-right:none;border-bottom:none">:</td>
						<td>
						<select name="day" style="padding:5px;width:50px">
						   <?php 
						   echo $xday;
						   $i=$awal;
						   while($i <= $akhir ){?>
								<?php if($i<=9){ ?>
									<?php if(($xday!='holiday') && (checkholiday($y,$m,$i)=='Weekday')){ ?>	 	
										<option value="<?php echo '0'.$i;?>"><?php echo '0'.$i?></option>
									<?php } ?>	
									<?php if(($xday=='holiday') && (checkholiday($y,$m,$i)=='Weekend')){ ?>	 
										<option value="<?php echo $i;?>"><?php echo $i?></option>
									<?php } ?>	
									
								<?php } else { ?>
									<?php if(($xday!='holiday') && (checkholiday($y,$m,$i)=='Weekday')){ ?>	 
										<option value="<?php echo $i;?>"><?php echo $i?></option>
									<?php } ?>
									<?php if(($xday=='holiday') && (checkholiday($y,$m,$i)=='Weekend')){ ?>	 
										<option value="<?php echo $i;?>"><?php echo $i?></option>
									<?php } ?>			
								<?php } ?>
						<?php $i++;} ?>
					<?php 
						   $i=1;
						   while($i <= $makhir){?>
						      <?php if(($xday!='holiday') && (checkholiday($y2,$m2,$i)=='Weekday')){ ?>	 	
										<option value="0<?php echo $i;?>">0<?php echo $i;?></option>
							  <?php } ?>
							  <?php if(($xday=='holiday') && (checkholiday($y2,$m2,$i)=='Weekend')){ ?>	 
										<option value="0<?php echo $i;?>">0<?php echo $i;?></option>
							  <?php } ?>		
								<?php $i++;} ?>
						 </select>
						 
						</td>
					</tr>
					
					<tr>
						<td style="width:150px">Job</td>
						<td style="width:10px;border:none">:</td>
						<td>
						<select name="code" style="padding:5px;width:100%"> 
						   <?php foreach($records as $rec){ ?>
							<option value="<?=$rec['day_code']?>">FIELDWORK - <?=$rec['job_name']?></option>
						   <?php } ?>	
						   <?php foreach($records2 as $rec){?>	
						   <option value="<?=$rec['day_code']?>">OFFICE - <?=$rec['job_name']?></option> 
						    <?php } ?>	
							<?php foreach($records3 as $rec){?>	
						   <option value="<?=$rec['day_code']?>">NON - <?=$rec['job_name']?></option> 
						    <?php } ?>	
						 </select>
						</td>
					</tr>
					
					<tr>
						<td valign="top" style="width:150px"><span style="font-style:italic">Progress (Only For CHF / CHO , If Job is Very Hard Please Note this TextField)</span></td>
						<td style="width:10px;border:none">:</td>
						<td>
						<?php // form_textarea(['name'=>'progress','value'=>'','rows'=>5,'style'=>'width:95%'])?>
						<?=form_textarea(array('name'=>'progress','value'=>'','rows'=>5,'style'=>'width:95%'))?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" style="width:150px"><span style="font-style:italic">Activity</span></td>
						<td style="width:10px;border:none">:</td>
						<td>
						<?=form_textarea(array('name'=>'activity','value'=>'','rows'=>3,'style'=>'width:95%'))?>
						</td>
					</tr>
					
					<?php if($xday=='holiday') {?>
					<input type="hidden" name="time" value="0" />
					<?php } else { ?>
					<tr>
						<td style="width:150px">Work Job * (Normal Hour)</td>
						<td style="width:10px;border:none">:</td>
						<td>
						<?=form_dropdown('hour_1',config_item('hour_start'),'','style="padding:5px;width:80px"');?> - 
						<?=form_dropdown('hour_2',config_item('hour_end'),'','style="padding:5px;width:80px"');?> - 
						</td>
					</tr>
					<?php } ?>
					
					<?php if((($_SESSION['level']=='M') || ($_SESSION['level']=='AM')) && ($xday=='holiday') ) { ?>
					<tr>
						<td style="width:150px">Work Job * (Normal Hour)</td>
						<td style="width:10px;border:none">:</td>
						<td>
						 <input type="hidden" name="time_1" value="00:00:00" />
						<input type="hidden" name="time_2" value="00:00:00" />
						<?=form_dropdown('hour_1',config_item('hour_start'),'','style="padding:5px;width:80px"');?> - 
					    <?=form_dropdown('hour_2',config_item('hour_end2'),'','style="padding:5px;width:80px"');?> 
						</td>
					</tr>
					
					<?php } else if (($_SESSION['level']=='M') || ($_SESSION['level']=='AM')) {?>
					<input type="hidden" name="time_1" value="00:00:00" />
					<input type="hidden" name="time_2" value="00:00:00" />
					<?php } else { ?>
					<tr>
						<td style="width:150px">Overtime *</td>
						<td style="width:10px;border:none">:</td>
						<td>
						<?php 
						  if($xday=='holiday'){
							$str = array(''         => '-',
							             '09:00:00' => '09:00:00',
										 '10:00:00' => '10:00:00',
										 '11:00:00' => '11:00:00',
										 '12:00:00' => '12:00:00',
										 '13:00:00' => '13:00:00',
										 '14:00:00' => '14:00:00',
										 '15:00:00' => '15:00:00',
										 '16:00:00' => '16:00:00',
										 '17:00:00' => '17:00:00',
										 '18:00:00' => '18:00:00',
										 '19:00:00' => '19:00:00',
										 '20:00:00' => '20:00:00',
										 '21:00:00' => '21:00:00',
										 '22:00:00' => '22:00:00',
										 '23:00:00' => '23:00:00',
										 '24:00:00' => '24:00:00',
										 '01:00:00' => '01:00:00',
										 '02:00:00' => '02:00:00',
										 '03:00:00' => '03:00:00',
										 '04:00:00' => '04:00:00',
										 '05:00:00' => '05:00:00',
										 '06:00:00' => '06:00:00',
										 '07:00:00' => '07:00:00',
										 '08:00:00' => '08:00:00',
										 '09:00:00' => '09:00:00'
									   );
							$arr = weekendovertime(); 
						  }	
						  else {
							$str = array(''=>'-','19:00:00'=>'19:00:00');
							$arr = weekdayovertime();	
						  }	
						?>
						<?=form_dropdown('time_1',$str,'','style="padding:5px;width:80px"');?> - 
						<?=form_dropdown('time_2',$arr,'','style="padding:5px;width:80px"');?> 
						</td>
					</tr>
					<?php } ?>
					
					<tr>
						<td colspan="3" style="text-align:right"><input type="submit" value="Post" style="text-align:center;width:50px;cursor:pointer;background:#64C1FF"/></td>
					<tr>
				</tbody>
			</table>
			</form>
		</div>
		
        <table cellpadding="0" cellspacing="0" id="resultTable">
          <thead>
            <tr>
              <th style="width:150px" rowspan="2">Job Code</th>
              <th rowspan="2">Job Name</th>
			  <th rowspan="2"></th>
			  <?php $i=$awal; 
			  while($i <= $akhir ){?>
			  <th  rowspan="2" style="width:15px"><?=digitTwo($i)?></th>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
              <th  rowspan="2" style="width:15px"><?=digitTwo($i)?></th>
              <?php $i++;} ?>
			  <th style="width:15px;text-align:center">**</th>
            </tr>
			<tr>
			 
			</tr>
          </thead>
          <tbody>
		    <tr> 	
			   <td colspan="<?=5+($akhir-$awal+$makhir)?>"><B>CHARGEABLE HOURS - FIELDWORK</B></td>
			</tr> 	
            <?php foreach($records as $rec){ ?>
             <tr> 	
			   <td rowspan="2" style="<?=$rec[$_SESSION['level']]?>" ><?=$rec['job_code'];?></td>
			   <td rowspan="2" style="<?=$rec[$_SESSION['level']]?>"><?=$rec['job_name'];?> <br/>(<small style="font-style:italic">Budget : <?=$rec[$_SESSION['level'].'_time']?> , Use :<?=$rec[$_SESSION['level'].'_hour']?></small>) <br/> (<small style="font-style:italic">Note :<?=$rec['note']?></small>) </td>
			   <td style="width:15px;text-align:center">H</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
               <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
              <?php $i++;} ?>
			  <td class="centerx" rowspan="2"><a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')"><img src="<?=base_url()?>/assets/images/drop.png"/></a></td>
             </tr>
         			 
             <tr>
			   <td style="width:15px;text-align:center">O</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
              <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
              <?php $i++;} ?>
			</tr>			 
			<?php } ?>
			
			<tr> 	
			   <td colspan="<?=5+($akhir-$awal+$makhir)?>"><B>CHARGEABLE HOURS - OFFICE</B></td>
			</tr> 	
            <?php foreach($records2 as $rec){ ?>
             <tr> 	
			   <td rowspan="2" style="<?=$rec[$_SESSION['level']]?>"><?=$rec['job_code'];?></td>
			   <td rowspan="2" style="<?=$rec[$_SESSION['level']]?>"><?=$rec['job_name'];?> <br/> (<small style="font-style:italic">Budget :<?=$rec[$_SESSION['level'].'_time']?> , Use : <?=$rec[$_SESSION['level'].'_hour']?></small>)<br/>(<small style="font-style:italic">Note :<?=$rec['note']?></small>)</td>
			   <td style="width:15px;text-align:center">H</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
               <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
              <?php $i++;} ?>
			 <td class="centerx"  rowspan="2"><a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')"><img src="<?=base_url()?>/assets/images/drop.png"/></a></td>
             </tr>
         			 
             <tr>
			   <td style="width:15px;text-align:center">O</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
              <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
              <?php $i++;} ?>
			</tr>			 
			<?php } ?>
			<tr> 	
			   <td colspan="<?=5+($akhir-$awal+$makhir)?>"><B>CHARGEABLE HOURS - NON</B></td>
			</tr> 	
            <?php foreach($records3 as $rec){ ?>
             <tr> 	
			   <td rowspan="2"><?=$rec['job_code'];?></td>
			   <td rowspan="2"><?=$rec['job_name'];?></td>
			   <td style="width:15px;text-align:center">H</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
               <td class="rightx"><a href="<?php echo base_url().'time_report/user/delete_day/'.$rec['day_code'].'/'.$i; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><?=getTimeReport($rec['day_code'],$i)?></a></td>
              <?php $i++;} ?>
			  <td rowspan="2" class="centerx"><a style="color: blue;" href="<?php echo base_url().'time_report/user/delete_code/'.$rec['day_code'].'/'; ?>" onclick =" return confirm('Are you sure you want to delete?')"><img src="<?=base_url()?>/assets/images/drop.png"/></a></td>
             </tr>
         			 
             <tr>
			   <td style="width:15px;text-align:center">O</td>
			   <?php $i=$awal; 
			   while($i <= $akhir ){?>
			   <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
			  <?php $i++;}  
			   $i=1;
               while($i<=$makhir){?>
              <td class="rightx"><?=getOverTimeReport($rec['day_code'],$i)?></td>
              <?php $i++;} ?>
			</tr>			 
			<?php } ?>
			
			
          </tbody>
        </table>
		
		<div style="padding:20px 30px">
			<p>Red : Over Budget</p>
			<p>Yellow : Warning for Over Budget</p>
			<p>Green : Safe</p>
		</div>
		
		<style>
		  td {background:#FFF;border:1px solid #333;color:#222;}
		  .rightx{text-align:right}
		</style>
