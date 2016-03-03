        <div id="search" style="width:900px">
		<?=form_open('transport/accounting/bulk_transport','style="margin:0"')?>
		   <?=form_dropdown('client_name', $bind_client, $this->session->userdata('transport.client_name'),'style="padding:7px;width:400px" class="chosen-select"')?>
		   <?=form_dropdown('day',config_item('daystart'),!$this->session->userdata('sdate1')?'':substr($this->session->userdata('sdate1'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month',config_item('month'),!$this->session->userdata('sdate1')?'':substr($this->session->userdata('sdate1'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year',config_item('year'),!$this->session->userdata('sdate1')?'':substr($this->session->userdata('sdate1'),0,4),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('day2',config_item('dayend'),!$this->session->userdata('sdate2')?'':substr($this->session->userdata('sdate2'),8,4),'style="padding:7px"');?>
		   <?=form_dropdown('month2',config_item('month'),!$this->session->userdata('sdate2')?'':substr($this->session->userdata('sdate2'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year2',config_item('year'),!$this->session->userdata('sdate2')?'':substr($this->session->userdata('sdate2'),0,4),'style="padding:7px"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>transport/accounting/export_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Code</th>
			  <th>Client Name</th>
			  <th>NIK</th>
			  <th>Name</th>
			  <th>Tgl</th>
			  <th>Total</th>
            </tr>
          </thead>
          <tbody>
		  <?=$table;?>
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