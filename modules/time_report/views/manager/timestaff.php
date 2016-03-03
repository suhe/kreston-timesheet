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
           <b><label for="filter">Name :</label> <?php echo $name; ?> </b> <?php if($checkstatus['status_manager']=='approval'){ print "<b style=color:blue>APPROVED</b>"; } ?> 
        </div>
        
        <div id="navigation">
            <a target="_blank" class="button" href="<?php echo base_url();?>time_report/manage/print_out/<?=$title;?>">Preview</a>
            <a class="button" href="<?php echo base_url();?>time_report/manage/periode/<?php echo $_SESSION['periode'];?>">Back</a>
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
			  <th style="width:50px">H.App</th>
			  <th style="width:50px">Overtime</th>
			  <th style="width:50px">O.App</th>
			  <th style="width:50px">X.1</th>
			  <th style="width:50px">X.2</th>
			  <th style="width:50px">X.3</th>
			  <th style="width:50px">X.4</th>
			  <th style="width:60px">Approve</th>
            </tr>
			<tr>
			 
			</tr>
          </thead>
		  <?=form_open('time_report/manage/aproval/'.$title);?>
		  <?=form_hidden('type_job','CHF');?>
          <tbody>
		   <tr>
				<td colspan="12" style="padding:15px;font-size:13px;font-weight:bold">CHARGEABLE HOURS - FIELDWORK (CHF)</td>
		   </tr>
            <?php 
			  $no=1;
			  foreach($value as $v) {
			  if($v['type_job']=='chf'){
			  ?>
            <tr>
			  <td style="padding:10px"><?=$no?></td>
			  <td style="padding:10px"><?=$v['date']?></td>
			  <td style="padding:10px"><?=$v['job']?> <br/> <?=$v['job_code']?> </td>
			  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
			  <td style="text-align:center;padding:10px">
			  <?=form_dropdown('time'.$v['code'].mysqldate($v['date']),overtime_counter($v['time']),$v['time']?$v['time']:'0','style="width:35px"');?>
			  </td>
			  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
			  <td style="text-align:center;padding:10px">
			  <?php //if($v['over_manager']=='no'){
			            //print form_hidden('code[]',$v['code']); 
                        //print form_hidden('date[]',$v['date']);
                        //print form_hidden('time[]',$v['time']);
                        //print substr($v['code'],18,12); 
						print form_dropdown('overtime'.$v['code'].mysqldate($v['date']),overtime_counter($v['over_time']),$v['over_time_app']?$v['over_time_app']:'','style="width:35px"');
					//} else {
						//print $v['over_time_app'];
					//}
			  ?>
			  </td>
			  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
			  <td style="text-align:center;padding:10px"><?=$v['app_manager']=='yes'?form_checkbox('code[]',$v['code'].';'.$v['date'],TRUE):form_checkbox('code[]',$v['code'].';'.$v['date'],FALSE); ?></td>
			</tr>
			<?php $no++;  }} ?>
			<tr>
			  <td colspan="12" style="text-align:right;background:#FFF">
				<input type="submit" value="Approve" style="width:70px;cursor:pointer;background:#64C1FF"/>
			  </td>
			</tr>
			</tbody>
			<?=form_close()?>
			
		 <?=form_open('time_report/manage/aproval/'.$title);?>
		 <?=form_hidden('type_job','CHO');?>
          <tbody>
		   <tr>
			  <td colspan="12" style="text-align:right;background:#FFF">
				
			  </td>
			</tr>
			
			<tr>
				<td colspan="12" style="padding:15px;font-size:13px;font-weight:bold">CHARGEABLE HOURS - OFFICE (CHO)</td>
		   </tr>
            <?php 
			  $no=$no++;
			  foreach($value as $v) {
			  if($v['type_job']=='cho'){
			  ?>
            <tr>
			  <td style="padding:10px"><?=$no?></td>
			  <td style="padding:10px"><?=$v['date']?> </td>
			  <td style="padding:10px"><?=$v['job']?> <br/> <?=$v['job_code']?> </td>
			  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
			  <td style="text-align:center;padding:10px">
			 <?=form_dropdown('time'.$v['code'].mysqldate($v['date']),overtime_counter($v['time']),$v['time']?$v['time']:'0','style="width:35px"');?>
			  </td>
			  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
			  <td style="text-align:center;padding:10px">
			  <?php 
						print form_dropdown('overtime'.$v['code'].mysqldate($v['date']),overtime_counter($v['over_time']),$v['over_time_app']?$v['over_time_app']:'','style="width:35px"');
					//} else {
						//print $v['over_time_app'];
					//}
			  ?>
			  </td>
			  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
			  <td style="text-align:center;padding:10px"><?=$v['app_manager']=='yes'?form_checkbox('code[]',$v['code'].';'.$v['date'],TRUE):form_checkbox('code[]',$v['code'].';'.$v['date'],FALSE); ?></td>
			</tr>
			<?php $no++;  }} ?>
			<tr>
			  <td colspan="12" style="text-align:right;background:#FFF">
				<input type="submit" value="Approve" style="width:70px;cursor:pointer;background:#64C1FF"/>
			  </td>
			</tr>
			</tbody>
			<?=form_close()?>
			
			<tr>
			  <td colspan="12" style="text-align:right;background:#FFF">
				
			  </td>
			</tr>
			
			<tr>
				<td colspan="12" style="padding:15px;font-size:13px;font-weight:bold">NON CHARGEABLE HOURS (NCH)</td>
		   </tr>
            <?php 
			  $no=$no++;
			  foreach($value as $v) {
			  if($v['type_job']=='nch'){
			  ?>
            <tr>
			  <td style="padding:10px"><?=$no?></td>
			  <td style="padding:10px"><?=$v['date']?></td>
			  <td style="padding:10px"><?=$v['job']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['time']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['over_time']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['over_time_app']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x1']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x2']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x3']?></td>
			  <td style="text-align:center;padding:10px"><?=$v['x4']?></td>	
			  <td style="text-align:center;padding:10px"></td>
			</tr>
			<?php $no++;  }} ?>
			
			
			
          </tbody>

        </table>
		
		
		<style>
			/*td {padding:10px}*/
		</style>
		