        <div id="search" >
		   <?=form_open('job_desc/user/searchjob','style="margin:0"')?>
		   <?=form_dropdown('month',config_item('month'),substr($this->session->userdata('jperiode_start'),0,2),'style="padding:7px"');?>
		   <?=form_dropdown('year',config_item('year'),substr($this->session->userdata('jperiode_start'),3,4),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('month2',config_item('month'),substr($this->session->userdata('jperiode_end'),0,2),'style="padding:7px"');?>
		   <?=form_dropdown('year2',config_item('year'),substr($this->session->userdata('jperiode_end'),3,4),'style="padding:7px"');?>
		   
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?> 
        </div>
        
        <div id="navigation">
           <!-- <a class="button" href="<?php echo base_url();?>job_desc/accounting/add">Add New Record</a>-->
		   <?php if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='M') ):?>
		   <a class="button" href="<?php echo base_url();?>job_desc/user/refreshjob">Refresh</a>   
           <a class="button" href="<?php echo base_url();?>job_desc/user/export_excel">Export To Excel</a> 
		   <?php endif; ?>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Periode</th>	
              <th>Job Name</th>
              <th>Manager</th>
			  <th>Budget</th>
			  <th>M</th>
			  <th>Real</th>
			  <th>AM</th>
			  <th>Real</th>
			  <th>S2</th>
			  <th>Real</th>
			  <th>S1</th>
			  <th>Real</th>
			  <th>AS</th>
			  <th>Real</th>
			  <th>TA</th>
			  <th>Real</th>
			  <th>Total Real</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php 
			   if($records){
			   foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['periode'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
			   <td style="text-align:right"><?php echo number_format($rec['approve_charge'],0);?></td>
			   <td style="text-align:right"><?=$rec['M_hour']?></td>
			   <td style="text-align:right"><?=number_format($m=$rec['M_hour']*$rec['M'])?></td>
			   <td style="text-align:right"><?=$rec['AM_hour']?></td>	
			   <td style="text-align:right"><?=number_format($am=$rec['AM_hour']*$rec['AM'])?></td>
			   <td style="text-align:right"><?=$rec['S2_hour']?></td>	
			   <td style="text-align:right"><?=number_format($s2=$rec['S2_hour']*$rec['S2'])?></td>
			   <td style="text-align:right"><?=$rec['S1_hour']?></td>
			   <td style="text-align:right"><?=number_format($s1=$rec['S1_hour']*$rec['S1'])?></td>
			   <td style="text-align:right"><?=$rec['AS_hour']?></td>
               <td style="text-align:right"><?=number_format($as=$rec['AS_hour']*$rec['AS'])?></td>
			   <td style="text-align:right"><?=$rec['TA_hour']?> </td>
			   <td style="text-align:right"><?=number_format($ta=$rec['TA_hour']*$rec['TA'])?></td>
			   <td style="text-align:right"><?=number_format($m+$am+$s2+$s1+$as+$ta,0)?></td>	
            </tr>
			
			<?php $users = $this->Josh_job->selectUserJob($rec['code']);
					if($users){
					foreach($users as $v){
			?>
			<tr>
				  <td></td>
				  <td style="text-align:right"><?=$v['staff_no'];?></td>
				  <td><?php echo $v['staff_name'];?></td>
				  <td style="text-align:center"><?=$v['pos_code'];?></td>
				  <td></td>
				  <td style="text-align:right"><?=$v['M']?></td>
				  <td style="text-align:right"><?=number_format($m_budget=$v['M_budget'])?></td>
				  <td style="text-align:right"><?=$v['AM']?> </td>
				  <td style="text-align:right"><?=number_format($am_budget=$v['AM_budget'])?></td>
				  <td style="text-align:right"><?=$v['S2']?> </td>
				  <td style="text-align:right"><?=number_format($s2_budget=$v['S2_budget'])?></td>
				  <td style="text-align:right"><?=$v['S1']?> </td>
				  <td style="text-align:right"><?=number_format($s1_budget=$v['S1_budget'])?></td>
				  <td style="text-align:right"><?=$v['ASS']?> </td>
				  <td style="text-align:right"><?=number_format($as_budget=$v['ASS_budget'])?></td>
				  <td style="text-align:right"><?=$v['TA']?> </td>
				  <td style="text-align:right"><?=number_format($ta_budget=$v['TA_budget'])?></td>
				  <td style="text-align:right"><?=number_format($m_budget+$am_budget+$s2_budget+$s1_budget+$as_budget+$ta_budget,0)?></td>
			 </tr>
			<?php } } ?>
            <?php endforeach;
			} ?>
            
          </tbody>
        </table>
