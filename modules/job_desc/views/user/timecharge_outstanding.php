        <h3 style="padding:10px 20px;border-bottom:1px solid #CCC ">Outstanding</h3>
		
		<div id="search" style="width:500px">
		<?=form_open('job_desc/user/outstanding_query','style="margin:0"')?>
		   <?=form_input(['name' => 'query','value' => $this->session->userdata('timecharge_summary.name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC']);?>
		   <?=form_dropdown('status',[''=>'All','active'=>'Active','deactive'=>'Non Active'],!$this->session->userdata('timecharge_summary.status')?'':$this->session->userdata('timecharge.status'),'style="padding:5px;border:1px solid #CCC"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
			<a class="button" href="<?php echo base_url();?>report/user/timecharge_correct">Auto Correct</a>
            <a class="button" href="<?php echo base_url();?>report/user/timecharge_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
    
		<div class="table-outter wrapper">
		 <table cellpadding="1" cellspacing="1" class="table" id="resultTable">
			<thead>
			<tr>
				  <th rowspan="2"  style="width:100px">Code</th>
				  <th rowspan="2"  style="width:250px">Name</th>
				  <th rowspan="2"  style="width:80px">P/L</th>
				  <th colspan="2" style="width:120px">Budget</th>
				  <th colspan="2" style="width:120px">Real</th>
				  <th colspan="2" style="width:120px">P/L</th>
				  <th rowspan="2"  style="width:80px">Start</th>
				  <th rowspan="2"  style="width:80px">Finished</th>
				  <th rowspan="2"  style="width:200px">Note</th>
				  <th rowspan="2"  style="width:200px">Progress</th>
			</tr>
			<tr>
				<th style="width:30px">Hour</th>
				<th style="width:90px">Cost</th>
				<th style="width:30px">Hour</th>
				<th style="width:90px">Cost</th>
				<th style="width:30px">Hour</th>
				<th style="width:90px">Cost</th>
			</tr>
			
				
			  </thead>
			  <tbody>
				<?=$table?>
			  </tbody>
		</table>
		</div>
	