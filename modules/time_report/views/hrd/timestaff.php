<style>
    .wrapper2 {
	width: 800px;
	margin-left: auto;
	margin-right: auto;
	}


    .accordionButton {	
	width: 800px;
	float: left;
	_float: none;  /* Float works in all browsers but IE6 */
	background: #003366;
	border-bottom: 1px solid #FFFFFF;
	cursor: pointer;
	}
	
.accordionContent {	
	width: 800px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	background: #95B1CE;
	}
	
/***********************************************************************************************************************
 EXTRA STYLES ADDED FOR MOUSEOVER / ACTIVE EVENTS
************************************************************************************************************************/

.on {
	background: #990000;
	}
	
.over {
	background: #CCCCCC;
	}
h1{font-size:15px ;}   
.time{width:5% ;} 

.button2{width:100px;cursor: pointer;}
</style>
   
        <div id="search">
           <b><label for="filter">Name :</label> <?php echo $name; ?> </b> <?php if($checkstatus['status_hrd']=='approval'){ print "<b style=color:blue>APPROVED</b>"; } ?> 
        </div>
        
        <div id="navigation">
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/manage/print_out/<?=$title;?>">Preview</a>
        
        </div>
        
        <div class="clear"></div>
        
    
       <?php echo $this->session->flashdata('message'); ?>
		 
        <table cellpadding="0" cellspacing="0" id="resultTable">
          <thead>
            <tr>
			  <th style="width:15px">No</th>
              <th style="width:150px">Date</th>
              <th>Job Name</th>
			  <th style="width:50px">Hour</th>
			  <th style="width:50px">App</th>
			  <th style="width:50px">Overtime</th>
			  <th style="width:50px">Ov-App</th>
			  <th style="width:50px">X.1</th>
			  <th style="width:50px">X.2</th>
			  <th style="width:50px">X.3</th>
			  <th style="width:50px">X.4</th>
			  <th style="width:50px">M/AM</th>
			  <th style="width:50px">Transport</th>
			  <th style="width:50px">HRD</th>
            </tr>
			<tr>
			 
			</tr>
          </thead>
		  <?=form_open('time_report/hrd/aproval/'.$title);?>
          <tbody>
		    <tr>
				<td colspan="14" style="padding:15px;font-size:13px;font-weight:bold">CHARGEABLE HOURS - FIELDWORK (CHF)</td>
			</tr>
            <?php 
			  $no=1;
			  $chf_hour = 0 ; 
			  $chf_overtime = 0;
			  $chf_overtime_app = 0;
			  $chf_x1 = 0;
			  $chf_x2 = 0;
			  $chf_x3 = 0;
			  $chf_x4 = 0;
			  $chf_transport = 0;
			  foreach($value as $v) { 
				if($v['type_job']=='chf'){
			  ?>
				<tr>
				  <td style="padding:10px"><?=$no?></td>
				  <td style="padding:10px"><?=$v['date']?></td>
				  <td style="padding:10px"><?=$v['job']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
				  <td style="text-align:center;padding:10px">
				  <?=form_dropdown('time'.$v['code'].mysqldate($v['date']),overtime_counter($v['time']),$v['time']?$v['time']:'0','style="width:35px"');?>
				  <?=form_hidden('app_manager'.$v['code'].mysqldate($v['date']),$v['app_manager']);?>
				  </td>
				  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
				  <td style="text-align:center;padding:10px"><?=form_dropdown('over_time_app'.$v['code'].mysqldate($v['date']),overtime_counter($v['over_time']),$v['over_time_app']?$v['over_time_app']:'0','style="width:35px"');?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
				  <td style="text-align:center;padding:10px"><?=$v['app_manager']?></td>	
				  <td style="text-align:center;padding:10px">
				     <?=form_input('transport'.$v['code'].mysqldate($v['date']),$v['transport_chf'],'style="width:50px;text-align:right"');?>
				  </td>
				  <td style="text-align:center;padding:10px">
						<?=form_hidden('code[]',$v['code'].';'.$v['date']);?>
						<?=$v['app_hrd']=='YES'?form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",TRUE):form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",FALSE); ?>
				  </td>		
				</tr>
			<?php 
			    $chf_hour +=$v['time'];
				$chf_overtime +=$v['over_time'];
				$chf_overtime_app +=$v['over_time_app'];
				$chf_x1 +=$v['x1'];
				$chf_x2 +=$v['x2'];
				$chf_x3 +=$v['x3'];
				$chf_x4 +=$v['x4'];
				$chf_transport +=$v['transport_chf'];
			    $no++;  } } ?>
			
			<tr>
				  <td style="padding:10px" colspan="3">CHF Sub Total</td>
				  <td style="text-align:center;padding:10px"><?=$chf_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_overtime?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_overtime_app?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x1?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x2?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x3?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x4?></td>
				  <td style="text-align:center;padding:10px"></td>	
				  <td style="text-align:center;padding:10px;text-align:right"><?=number_format($chf_transport,0)?></td>
				  <td style="text-align:center;padding:10px"></td>		
			</tr>
			
			 <tr>
			  <td colspan="14" style="text-align:right;background:#FFF">
			    <?php //if($checkstatus['status_manager']!='approval'){ ?>
					<input type="submit" value="Approve" style="width:70px;cursor:pointer;background:#64C1FF"/>
			    <?php  // } else { print "<b style=color:blue>APPROVED</b>"; } ?>
				
			  </td>
			</tr>
			
			 </tbody>
			 
			 <?=form_close()?>
			 
			 <tr>
				<td colspan="14" style="padding:15px;font-size:13px;font-weight:bold"></td>
			</tr>
			 
		  <?=form_open('time_report/hrd/aproval/'.$title);?>
          <tbody>
			<tr>
				<td colspan="14" style="padding:15px;font-size:13px;font-weight:bold"> CHO - CHARGEABLE HOURS - OFFICE (CHO)</td>
			</tr>
			
			<?php 
			  $no=$no++;
			  $cho_hour = 0 ; 
			  $cho_overtime = 0;
			  $cho_overtime_app = 0;
			  $cho_x1 = 0;
			  $cho_x2 = 0;
			  $cho_x3 = 0;
			  $cho_x4 = 0;
			  $cho_transport = 0;
			  foreach($value as $v) { 
				if($v['type_job']=='cho'){
			  ?>
				<tr>
				  <td style="padding:10px"><?=$no?></td>
				  <td style="padding:10px"><?=$v['date']?></td>
				  <td style="padding:10px"><?=$v['job']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
				  <td style="text-align:center;padding:10px">
				  <?=form_dropdown('time'.$v['code'].mysqldate($v['date']),overtime_counter($v['time']),$v['time']?$v['time']:'0','style="width:35px"');?>
				  <?php //if($v['over_manager']=='no'){
					//print form_hidden('code[]',$v['code']); 
					//print form_hidden('date[]',$v['date']);
					//print form_dropdown('time[]',overtime_counter($v['time']),$v['time']?$v['time']:'','style="width:35px"');
					 print form_hidden('app_manager'.$v['code'].mysqldate($v['date']),$v['app_manager']);
				  ?>
				  </td>
				  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
				  <td style="text-align:center;padding:10px"><?=form_dropdown('over_time_app'.$v['code'].mysqldate($v['date']),overtime_counter($v['over_time']),$v['over_time_app']?$v['over_time_app']:'0','style="width:35px"');?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
				  <td style="text-align:center;padding:10px"><?=$v['app_manager']?></td>
				  <td style="text-align:center;padding:10px">
				     <?=form_input('transport'.$v['code'].mysqldate($v['date']),$v['transport_chf'],'style="width:50px;text-align:right"');?>
				  </td>	
				  <td style="text-align:center;padding:10px">
						<?=form_hidden('code[]',$v['code'].';'.$v['date']);?>
						<?=$v['app_hrd']=='YES'?form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",TRUE):form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",FALSE); ?>
				  </td>	
				</tr>
			<?php $no++; 
				$cho_hour +=$v['time'];
				$cho_overtime +=$v['over_time'];
				$cho_overtime_app +=$v['over_time_app'];
				$cho_x1 +=$v['x1'];
				$cho_x2 +=$v['x2'];
				$cho_x3 +=$v['x3'];
				$cho_x4 +=$v['x4'];
				$cho_transport +=$v['transport_chf'];	
			} } ?>
			
			<tr>
				  <td style="padding:10px" colspan="3">CHO Sub Total</td>
				  <td style="text-align:center;padding:10px"><?=$cho_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_overtime?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_overtime_app?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_x1?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_x2?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_x3?></td>
				  <td style="text-align:center;padding:10px"><?=$cho_x4?></td>
				  <td style="text-align:center;padding:10px"></td>	
				  <td style="text-align:center;padding:10px;text-align:right"><?=number_format($cho_transport,0)?></td>
				  <td style="text-align:center;padding:10px"></td>		
			</tr>
			
			<tr>
			  <td colspan="14" style="text-align:right;background:#FFF">
			    <?php //if($checkstatus['status_manager']!='approval'){ ?>
					<input type="submit" value="Approve" style="width:70px;cursor:pointer;background:#64C1FF"/>
			    <?php  // } else { print "<b style=color:blue>APPROVED</b>"; } ?>
				
			  </td>
			</tr>
			 </tbody>
			 
			 <?=form_close()?>
			
			<tr>
				<td colspan="14" style="padding:15px;font-size:13px;font-weight:bold"></td>
			</tr>
			
			<?=form_open('time_report/hrd/aproval/'.$title);?>
            <tbody>
			<tr>
				<td colspan="14" style="padding:15px;font-size:13px;font-weight:bold">NCH - NON-CHARGEABLE HOURS</td>
			</tr>
			
			<?php 
			  $no=$no++;
			  $nch_hour = 0 ; 
			  $nch_overtime = 0;
			  $nch_overtime_app = 0;
			  $nch_x1 = 0;
			  $nch_x2 = 0;
			  $nch_x3 = 0;
			  $nch_x4 = 0;
			  foreach($value as $v) { 
				if($v['type_job']=='nch'){
			  ?>
				<tr>
				  <td style="padding:10px"><?=$no?></td>
				  <td style="padding:10px"><?=$v['date']?></td>
				  <td style="padding:10px"><?=$v['job']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
				  <td style="text-align:center;padding:10px">
				  <?=form_dropdown('time'.$v['code'].mysqldate($v['date']),overtime_counter($v['time']),$v['time']?$v['time']:'0','style="width:35px"');?>
				  <?php
					print form_hidden('app_manager'.$v['code'].mysqldate($v['date']),$v['app_manager']);
				  ?>
				  </td>
				  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
				  <td style="text-align:center;padding:10px"><?=form_dropdown('over_time_app'.$v['code'].mysqldate($v['date']),overtime_counter($v['over_time']),$v['over_time_app']?$v['over_time_app']:'0','style="width:35px"');?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
				  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
				  <td style="text-align:center;padding:10px"><?=$v['app_manager']?></td>
				  <td></td>	
				  <td style="text-align:center;padding:10px">
						<?=form_hidden('code[]',$v['code'].';'.$v['date']);?>
						<?=$v['app_hrd']=='YES'?form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",TRUE):form_checkbox('app'.$v['code'].mysqldate($v['date']),"1",FALSE); ?>
				  </td>	
				</tr>
			<?php $no++;
				$nch_hour +=$v['time'];
				$nch_overtime +=$v['over_time'];
				$nch_overtime_app +=$v['over_time_app'];
				$nch_x1 +=$v['x1'];
				$nch_x2 +=$v['x2'];
				$nch_x3 +=$v['x3'];
				$nch_x4 +=$v['x4'];
			} } ?>
			
			<tr>
				  <td style="padding:10px" colspan="3">NCH Sub Total</td>
				  <td style="text-align:center;padding:10px"><?=$nch_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_overtime?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_overtime_app?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_x1?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_x2?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_x3?></td>
				  <td style="text-align:center;padding:10px"><?=$nch_x4?></td>
				  <td style="text-align:center;padding:10px"></td>	
				  <td style="text-align:center;padding:10px"></td>
				  <td style="text-align:center;padding:10px"></td>		
			</tr>
			
			
			<tr>
			  <td colspan="14" style="text-align:right;background:#FFF">
			    <?php //if($checkstatus['status_manager']!='approval'){ ?>
					<input type="submit" value="Approve" style="width:70px;cursor:pointer;background:#64C1FF"/>
			    <?php  // } else { print "<b style=color:blue>APPROVED</b>"; } ?>
				
			  </td>
			</tr>
			
			<tr>
				  <td style="padding:10px" colspan="3"><strong>GRAND TOTAL</strong></td>
				  <td style="text-align:center;padding:10px"><?=$chf_hour+$cho_hour+$nch_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_hour+$cho_hour+$nch_hour?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_overtime+$cho_overtime+$nch_overtime?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_overtime_app+$cho_overtime_app+$nch_overtime_app?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x1+$cho_x1+$nch_x1?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x2+$cho_x2+$nch_x2?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x3+$cho_x3+$nch_x3?></td>
				  <td style="text-align:center;padding:10px"><?=$chf_x4+$cho_x4+$nch_x4?></td>
				  <td style="text-align:center;padding:10px"></td>	
				  <td style="text-align:center;padding:10px;text-align:right"><?=number_format($chf_transport+$cho_transport,0)?></td>
				  <td style="text-align:center;padding:10px"></td>		
			</tr>
			
			 </tbody>
			 
			 <?=form_close()?>
			
         

        </table>
		
		
		<style>
			/*td {padding:10px}*/
		</style>
		