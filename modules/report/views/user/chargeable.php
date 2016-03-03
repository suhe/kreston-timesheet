        <div id="search" style="width:1000px">
		<?=form_open('report/user/chargeable_query','style="margin:0"')?>
		   <?=form_dropdown('type',[''=>'All Type','CHO'=>'CHO','CHF'=>'CHF','NCH'=>'NCH'], $this->session->userdata('chargeable.type'),'style="padding:6px" class="chosen-select"')?>
		   <?=form_input(['name' => 'query','value' => $this->session->userdata('chargeable.name'),'placeholder'=>'Search By NIK OR Name','style'=>'padding:8px;width:200px;border:1px solid #CCC']);?>
		   <?=form_dropdown('group', $bind_group, $this->session->userdata('chargeable.group'),'style="padding:6px;border:1px solid #CCC" class="chosen-select"')?>
		   
		   <?=form_dropdown('day_from',config_item('daystart'),!$this->session->userdata('chargeable.date_from')?'':substr($this->session->userdata('chargeable.date_from'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_from',config_item('month'),!$this->session->userdata('chargeable.date_from')?'':substr($this->session->userdata('chargeable.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_from',config_item('year'),!$this->session->userdata('chargeable.date_from')?'':substr($this->session->userdata('chargeable.date_from'),0,4),'style="padding:7px"');?>
		   
		   To
		   
		   <?=form_dropdown('day_to',config_item('dayend'),!$this->session->userdata('chargeable.date_to')?'':substr($this->session->userdata('chargeable.date_to'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_to',config_item('month'),!$this->session->userdata('chargeable.date_to')?'':substr($this->session->userdata('chargeable.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_to',config_item('year'),!$this->session->userdata('chargeable.date_to')?'':substr($this->session->userdata('chargeable.date_to'),0,4),'style="padding:7px"');?>
		   
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
			
            <!--<a class="button" href="<?php echo base_url();?>overtime/accounting/export_excel">Export Excel</a>-->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
    
		<div class="table-outter wrapper">
		 <table cellpadding="1" cellspacing="1" class="table" id="resultTable">
			<thead>
			<tr>
				<th style="width:20px">No</th>
				<th style="width:50px">Date</th>
				<th style="width:50px">NIK</th>
				<th>Name</th>
				<th style="width:50px">Pos</th>
				<th style="width:100px">Group Name</th>
				<th>Job Name</th>
				<th>Address</th>
				<th style="width:70px">Total Hour</th>
			</tr>
			  </thead>
			  <tbody>
				<?=$table?>
			  </tbody>
		</table>
		</div>
	