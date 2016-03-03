        <div id="search">
           <?=form_open('report/user/activity_query','style="margin:0"')?>
		   <?=form_input(array('name' => 'client_name','value' => $this->session->userdata('activity.client_name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;width:150px;border:1px solid #CCC'));?>
		   <?=form_input(array('name' => 'staff_name','value' => $this->session->userdata('activity.staff_name'),'placeholder'=>'Search By Staff Name','style'=>'padding:7px;width:150px;border:1px solid #CCC'));?>
		   
		   <?=form_dropdown('day_from',config_item('daystart'),!$this->session->userdata('activity.date_from')?'':substr($this->session->userdata('activity.date_from'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month_from',config_item('month'),!$this->session->userdata('activity.date_from')?'':substr($this->session->userdata('activity.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_from',config_item('year'),!$this->session->userdata('activity.date_from')?'':substr($this->session->userdata('activity.date_from'),0,4),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('day_to',config_item('dayend'),!$this->session->userdata('activity.date_to')?'':substr($this->session->userdata('activity.date_to'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month_to',config_item('month'),!$this->session->userdata('activity.date_to')?'':substr($this->session->userdata('activity.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_to',config_item('year'),!$this->session->userdata('activity.date_to')?'':substr($this->session->userdata('activity.date_to'),0,4),'style="padding:7px"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
			<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
		</div>
        
        <div id="navigation">
        	<?php if($this->session->userdata('activity.date_to')) { ?>
        	<a class="button" href="<?php echo base_url();?>report/user/activity_reset">Reset Search</a>
        	<?php } ?>
            
			<!--<a class="button" href="<?php echo base_url();?>job_desc/user/export_excel">Export To Excel</a> -->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th style="width:20px">No</th>
              <th style="width:50px">Date</th>		
              <th style="width:50px">Job Code</th>
              <th style="width:200px">Job Name</th>
              <th style="width:20px">Nik</th>
              <th style="width:200px">Name</th>
			  <th>Activity</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php
			$no = 1;  
			foreach($records as $rec):?>
               <td><?=$no?></td>
               <td><?=$rec['date']?></td>
               <td><?=$rec['job_code']?></td>
               <td><?=$rec['job_name']?></td>
               <td><?php echo $rec['staff_no'];?></td>
               <td><?php echo $rec['staff_name'];?></td>
               <td><?php echo $rec['activity'];?></td>
               </tr>
            <?php $no++; endforeach;?>
            
          </tbody>
        </table>
