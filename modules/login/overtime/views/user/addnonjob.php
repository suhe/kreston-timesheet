<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/saveNonJob">
<fieldset>
	    <p>
			<label for="name">Code (Client/Periode)</label>
			
	
	<select id="combobox2" name="job_code">
		<option value="">Select one...</option>
		<option value="NC1001">NC1001 (ANNUAL LEAVE)</option>
        <option value="NC1002">NC1002 (SICK LEAVE)</option>
        <option value="NC1003">NC1003 (PERSONAL LEAVE)</option>
        <option value="NC1004">NC1004 (TRAINING)</option>
        <option value="NC1005">NC1005 (SELF STUDY)</option>
        <option value="NC1006">NC1006 (PROPOSAL)</option>
        <option value="NC1007">NC1007 (ADMINISTRATION)</option>
        <option value="NC1008">NC1008 (AVAILABLE TIME)</option>
	</select>
    

		</p>
        
		
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
 
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>







