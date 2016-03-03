<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/saveJob">
<fieldset>
	    <p>
			<label for="name">Code (Client/Periode)</label>
			
	
	<select id="combobox2" name="job_code">
		<option value="">Select one...</option>
        <?php foreach($bind as $rec): ?>
		<option value="<?php echo $rec['code']; ?>"><?php echo $rec['code']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
        <?php endforeach;?>
	</select>
    

		</p>
        
		
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
        <p>
			<label for="remarks">Type</label>
			<select name="type" id="type">
               <option value="CHF">CHARGEABLE HOURS - FIELDWORK</option>
               <option value="CHO">CHARGEABLE HOURS - OFFICE</option>
            </select>
		</p>  
         
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/" class="submit">Back</a>
		</p>
	</fieldset>
</form>







