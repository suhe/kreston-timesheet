<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/user/save_progress">
<fieldset>
        
		<p>
			<label for="name">Job Name</label>
			 <?=form_dropdown('job_code', $bind_client, $this->session->userdata('overtime.client_name'),'style="padding:7px" class="chosen-select"')?>
		</p>
        
        <p>
			<label for="description">Progress</label>
			<?=form_textarea(['name'=>'progress','rows'=>5,'style'=>'width:80%'])?>
		</p>
        
        
	  
        <br />
        <hr />

		<p style="text-align: center;">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>job_desk/user/progress" class="submit">Back</a>
		</p>
	</fieldset>
</form>

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






