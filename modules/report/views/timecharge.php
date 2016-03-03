        <h3 style="padding:10px 20px;border-bottom:1px solid #CCC ">Timecharge Report</h3>
		
		<div id="search" style="width:500px">
		<?=form_open('report/user/timecharge_query','style="margin:0"')?>
		   <?=form_input(array('name' => 'query','value' => $this->session->userdata('timecharge.name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC'));?>
		   <?=form_dropdown('status',array(''=>'All','active'=>'Active','deactive'=>'Non Active'),!$this->session->userdata('timecharge.status')?'':$this->session->userdata('timecharge.status'),'style="padding:5px;border:1px solid #CCC"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
			<a class="button" href="<?php echo base_url();?>report/user/timecharge_correct">Auto Correct</a>
            <!--<a class="button" href="<?php echo base_url();?>overtime/accounting/export_excel">Export Excel</a>-->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
    
		<div class="table-outter wrapper">
		 <table cellpadding="1" cellspacing="1" class="table" id="resultTable">
			<thead>
			<tr>
				  <th rowspan="2"  style="width:150px">Code</th>
				  <th rowspan="2"  style="width:350px">Name</th>
				  <th rowspan="2"  style="width:50px">P/L</th>
				  <th colspan="20" style="width:1500px">Budget</th>
				  <th colspan="20" style="width:1500px">Real</th>
				  <th colspan="20" style="width:1500px">P/L</th>
				  <th rowspan="2"  style="width:80px">Start</th>
				  <th rowspan="2"  style="width:80px">Finished</th>
				  <th rowspan="2"  style="width:200px">Progress</th>
				 
			</tr>
			<tr>
				<th colspan="10">Hour</th>
				<th colspan="10">Cost</th>
				
				<th colspan="10">Hour</th>
				<th colspan="10">Cost</th>
				
				<th colspan="10">Hour</th>
				<th colspan="10">Cost</th>
			</tr>
			
			<tr>
				<th></th>
				<th></th>
				<th></th>
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				<th>SP</th>
				<th>P</th>
				<th>SM</th>
				<th>M</th>
				<th>AM</th>
				<th>S1</th>
				<th>S2</th>
				<th>AS</th>
				<th>TA</th>
				<th>SUM</th>
				
				<th></th>
				<th></th>
				<th></th>
				
			</tr>
				
			  </thead>
			  <tbody>
				<?=$table?>
			  </tbody>
		</table>
		</div>
	