        <div id="search" style="width:1000px">
		
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            
			<a class="button" href="<?php echo base_url();?>job_desc/user/outstanding">Back</a>
			
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th style="width:20px" rowspan="2">No</th>
			  <th style="width:30px" rowspan="2">Date</th>
			  <th rowspan="2">Job Code</th>
			  <th rowspan="2">Hour</th>
			  <th colspan="9">Overtime</th>
			  <th rowspan="2">Transport</th>
			  <th style="width:50px" rowspan="2">App</th>
			  <th rowspan="2">Total</th>
			  <th rowspan="2">Activity</th>
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
   	