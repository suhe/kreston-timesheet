
	
<?php echo $this->session->flashdata('message'); ?>
<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/saveJob/">
<fieldset style="width:96%">
	    <p>
			<label for="name">Code (Client/Periode)</label>
			<select data-placeholder="Choose A Job..." class="chosen-select" name="job_code" id="type" style="padding:7px">
				 <?php foreach($bind as $rec){?>
				<option value="<?=$rec['code'];?>"><?=$rec['code'].'-'.$rec['name'].' - '.$rec['Manager_name'];?></option>	
				 <?php } ?>
			</select>
			

		</p>
        	
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" style="padding:7px" />
		</p>
        
        <p>
			<label for="remarks">Type</label>
			<select name="type" id="type" style="padding:7px">
               <option value="CHF">CHARGEABLE HOURS - FIELDWORK</option>
               <option value="CHO">CHARGEABLE HOURS - OFFICE</option>
            </select>
		</p>  
         
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/" class="submit">Go To Back</a>
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
   