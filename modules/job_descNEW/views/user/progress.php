        <div id="search">
           <?=form_open('job_desc/user/progress_query','style="margin:0"')?>
		   <?=form_input(['name' => 'client_name','value' => $this->session->userdata('progress.client_name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC']);?>
		   <?=form_input(['name' => 'staff_name','value' => $this->session->userdata('progress.staff_name'),'placeholder'=>'Search By Staff Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC']);?>
		   
		   <?=form_dropdown('day',config_item('daystart'),!$this->session->userdata('progress.date_from')?'':substr($this->session->userdata('progress.date_from'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month',config_item('month'),!$this->session->userdata('progress.date_from')?'':substr($this->session->userdata('progress.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year',config_item('year'),!$this->session->userdata('progress.date_from')?'':substr($this->session->userdata('progress.date_from'),0,4),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('day2',config_item('dayend'),!$this->session->userdata('progress.date_to')?'':substr($this->session->userdata('progress.date_to'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month2',config_item('month'),!$this->session->userdata('progress.date_to')?'':substr($this->session->userdata('progress.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year2',config_item('year'),!$this->session->userdata('progress.date_to')?'':substr($this->session->userdata('progress.date_to'),0,4),'style="padding:7px"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
			<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
		</div>
        
        <div id="navigation">
        	<?php if($this->session->userdata('progress.date_to')) { ?>
        	<a class="button" href="<?php echo base_url();?>job_desc/user/progress_reset">Reset Search</a>
        	<?php } ?>
            <?php if ($_SESSION['level'] != 'HRD'): ?>
            <a class="button" href="<?php echo base_url();?>job_desc/user/add_progress">Add New Record</a>
           <?php endif;?>
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
			  <th>Progress</th>
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
               <td><?php echo $rec['progress'];?></td>
               </tr>
            <?php $no++; endforeach;?>
            
          </tbody>
        </table>
