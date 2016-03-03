<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>holiday/admin/update">
<input type="hidden" id="date" name="date" value="<?php echo $date;?>" />
<fieldset>
	    <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" value="<?php echo $description;?>" />
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>holiday/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


