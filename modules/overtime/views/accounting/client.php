        <div id="search" style="width:900px">
		<?=form_open('overtime/accounting/bulk_client','style="margin:0"')?>
		   <?=form_dropdown('client_name', $bind_client, $this->session->userdata('overtime.client.name'),'style="padding:7px;width:400px" class="chosen-select"')?>
		   <?=form_dropdown('day',config_item('daystart'),!$this->session->userdata('overtime.client.date_from')?'':substr($this->session->userdata('overtime.client.date_from'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month',config_item('month'),!$this->session->userdata('overtime.client.date_from')?'':substr($this->session->userdata('overtime.client.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year',config_item('year'),!$this->session->userdata('overtime.client.date_from')?'':substr($this->session->userdata('overtime.client.date_from'),0,4),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('day2',config_item('dayend'),!$this->session->userdata('overtime.client.date_to')?'':substr($this->session->userdata('overtime.client.date_to'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month2',config_item('month'),!$this->session->userdata('overtime.client.date_to')?'':substr($this->session->userdata('overtime.client.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year2',config_item('year'),!$this->session->userdata('overtime.client.date_to')?'':substr($this->session->userdata('overtime.client.date_to'),0,4),'style="padding:7px"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>overtime/accounting/client_export_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Code</th>
			  <th colspan="9">Client Name</th>
			  <th>City</th>
			  <th>Country</th>
			  
            </tr>
            <tr>
              <th>Date</th>	
              <th>Day</th>	
              <th>NIK</th>
			  <th>Name</th>
			  <th>Pos</th>
			  <th>OT</th>
			  <th>X.1</th>
			  <th>X.2</th>
			  <th>X.3</th>
			  <th>X.4</th>
			  <th>Meal</th>
			  <th>Total Cost</th>
            </tr>
          </thead>
          <tbody>
		  <?=$table;?>
          </tbody>
        </table>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
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