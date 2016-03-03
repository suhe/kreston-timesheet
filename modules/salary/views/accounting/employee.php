        <div id="search" style="width:1000px">
		<?=form_open('salary/accounting/payroll_details_query','style="margin:0"')?>
		   <?=form_dropdown('staff_no', $bind_staff, $this->session->userdata('payroll_details.staff_no'),'style="padding:7px" class="chosen-select"')?>
		   
		   <?=form_dropdown('day_from',config_item('daystart'),!$this->session->userdata('payroll_details.date_from')?'':substr($this->session->userdata('payroll_details.date_from'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_from',config_item('month'),!$this->session->userdata('payroll_details.date_from')?'':substr($this->session->userdata('payroll_details.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_from',config_item('year'),!$this->session->userdata('payroll_details.date_from')?'':substr($this->session->userdata('payroll_details.date_from'),0,4),'style="padding:7px"');?>
		   
		   To
		   
		   <?=form_dropdown('day_to',config_item('dayend'),!$this->session->userdata('payroll_details.date_to')?'':substr($this->session->userdata('payroll_details.date_to'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_to',config_item('month'),!$this->session->userdata('payroll_details.date_to')?'':substr($this->session->userdata('payroll_details.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_to',config_item('year'),!$this->session->userdata('payroll_details.date_to')?'':substr($this->session->userdata('payroll_details.date_to'),0,4),'style="padding:7px"');?>
		   
		  
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            <!--
			<a class="button" href="<?php echo base_url();?>payroll_details/accounting/export_excel">Export Excel</a>
			-->
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th style="width:20px" rowspan="2">No</th>
			  <th style="width:30px" rowspan="2">Date</th>
			  <th rowspan="2">Job Code</th>
			  <th rowspan="2">Type</th>
			  <th colspan="9">Overtime</th>
			  <th rowspan="2">Transport</th>
			  <th style="width:50px" rowspan="2">App Manager</th>
			  <th style="width:50px" rowspan="2">App HRD</th>
			  <th style="width:50px" rowspan="2">Payroll</th>
			  <th rowspan="2">Total</th>
            </tr>
			<tr>
			  <th colspan="2">X1</th>
			  <th colspan="2">X2</th>
			  <th colspan="2">X3</th>
			  <th colspan="2">X4</th>
			  <th rowspan="2">Meal</th>
            </tr>
			<tr>
              <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
			  
			  <th style="width:30px">Hour</th>
			  <th style="width:70px ">Cost</th>
			  <th style="width:30px">Hour</th>
			  <th style="width:70px ">Cost</th>
			  <th style="width:30px">Hour</th>
			  <th style="width:70px ">Cost</th>
			  <th style="width:30px">Hour</th>
			  <th style="width:70px ">Cost</th>
			  
			  
			  <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
            </tr>
          </thead>
          <tbody>
              <?=$table?>
          </tbody>
        </table>
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
       <?php //echo '<script type="text/" src="'.base_url().APPPATH.'libraries/jquery/jquery.js"></script>'; ?>
	   <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/jquery.simplemodal.js"></script>'; ?>
       <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/confirm.js"></script>'; ?>
       <?php //echo '<link type="text/css" href="'.base_url().APPPATH.'libraries/form_modal/css/confirm.css" rel="stylesheet" media="screen" />'; ?>
	   <link rel="stylesheet" href="<?=base_url()?>/assets/css/chosen.css">
	   <script src="<?=base_url()?>/assets/js/chosen.jquery.js" type="text/javascript"></script>
  
	<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
   	