        <div id="search">
		  <?php //form_open('job_desc/searchjob')?>
           <!--<label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />-->
		   <?php // form_dropdown('year_start',config_item('year'))?> 
		   <?php //form_dropdown('year_end',config_item('year'))?>
		   <?php //form_close()?>
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
             <!-- <th>Remarks</th>-->
			 <?php if($_SESSION['level']<>'M'):?>
              <th>Check</th>
              <th>Manager</th>
			 <?php endif;?>
			  <?php if($_SESSION['level']<>'M'):?>
              <th>Ass.Manager</th>
			  <th>Senior</th>
			  <?php else:?>
			  <th>Budget</th>
			  <!--<th>Hour</th>-->
			  <th>SM</th>
			  <th>SM Budget</th>
			  <th>M</th>
			  <th>M Budget</th>
			  <th>AM</th>
			  <th>AM Budget</th>
			  <th>S2</th>
			  <th>S2 Budget</th>
			  <th>S1</th>
			  <th>S1 Budget</th>
			  <th>AS</th>
			  <th>AS Budget</th>
			  <th>TA</th>
			  <th>TA Budget</th>
			  <!--<th>MG</th>-->
			  <th>Realisasi</th>
			  <?php endif;?>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
			<?php //if($_SESSION['no']==$rec['Manager']):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['periode'];?></td>
               <td><?php echo $rec['name'];?></td>
               <!--<td><?php echo $rec['remarks'];?></td>-->
			   <?php if($_SESSION['level']<>'M'):?>
               <td><?php echo $rec['check'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
			   <?php endif;?>
			   <?php if($_SESSION['level']<>'M'):?>
			   <td><?php echo $rec['Ass_Manager_name'];?></td>
			   <td><?php echo $rec['Senior_name'];?></td>
			   <?php else:?>
			   <td style="text-align:right"><?php echo number_format($rec['approve_charge'],0);?></td>
			   <td style="text-align:right"><?=$rec['SM_hour']?></td>
			   <td style="text-align:right"><?=number_format($sm=$rec['SM_hour']*$rec['SM'])?></td>
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
			   <td style="text-align:right"><?=number_format($sm+$m+$am+$s2+$s1+$as+$ta,0)?></td>		
			   <?php endif;?>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
