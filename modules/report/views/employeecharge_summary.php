        <h3 style="padding:10px 20px;border-bottom:1px solid #CCC ">Employee Charge Summary Report</h3>
		
		<div id="search" style="width:900px">
		<?=form_open('report/user/employeecharge_summary_query','style="margin:0"')?>
		   <?=form_input(array('name' => 'query','value' => $this->session->userdata('employeecharge_summary.name'),'placeholder'=>'Search By NIK Or Name','style'=>'padding:7px;width:180px;border:1px solid #CCC'));?>
		   <?=form_dropdown('group', $bind_group, $this->session->userdata('employeecharge_summary.group'),'style="padding:5px;border:1px solid #CCC;color:#333"')?>
		   <?=form_dropdown('day_from',config_item('daystart'),!$this->session->userdata('employeecharge_summary.date_from')?'':substr($this->session->userdata('employeecharge_summary.date_from'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_from',config_item('month'),!$this->session->userdata('employeecharge_summary.date_from')?'':substr($this->session->userdata('employeecharge_summary.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_from',config_item('year'),!$this->session->userdata('employeecharge_summary.date_from')?'':substr($this->session->userdata('employeecharge_summary.date_from'),0,4),'style="padding:7px"');?>
		   
		   To
		   
		   <?=form_dropdown('day_to',config_item('dayend'),!$this->session->userdata('employeecharge_summary.date_to')?'':substr($this->session->userdata('employeecharge_summary.date_to'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_to',config_item('month'),!$this->session->userdata('employeecharge_summary.date_to')?'':substr($this->session->userdata('employeecharge_summary.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_to',config_item('year'),!$this->session->userdata('employeecharge_summary.date_to')?'':substr($this->session->userdata('employeecharge_summary.date_to'),0,4),'style="padding:7px"');?>
		   
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>report/user/employeecharge_summary_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
		
		<div class="note" style="padding:5px 20px">
			Minimal Hour Per Year : 1.544 Hour , Leave : 12 Days/Year , Training 5 Days/Year , Low Season : 42 Days , Work Day : 8 Hour / Day
		</div>
    
		<div class="table-outter wrapper">
		 <table cellpadding="1" cellspacing="1" class="table" id="resultTable">
			<thead>
			<tr>
				<th style="width:20px">No</th>
				<th style="width:100px">NIK</th>
				<th style="width:250px">Name</th>
				<th style="width:80px">Pos</th>
				<th style="width:120px">Chargeable</th>
				<th style="width:120px">Non Chargeable</th>
			</tr>
			  </thead>
			  <tbody>
				<?=$table?>
			  </tbody>
		</table>
		</div>
	