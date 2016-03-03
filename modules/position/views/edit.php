<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>position/admin/update">
<input type="hidden" id="code" name="code" value="<?php echo $code;?>" />
<fieldset>
	    <p>
			<label for="name">Client Code</label>
			<input id="code1" name="code1"  maxlength="8" disabled="disabled" value="<?php echo $code;?>" />
		</p>
        
		<p>
			<label for="name">Position Name</label>
			<input id="name" name="name" maxlength="255" value="<?php echo $name;?>" />
		</p>
        
        <p>
			<label for="description">Email</label>
			<input id="description" name="description" maxlength="255" value="<?php echo $description;?>" />
		</p>
        
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>position/admin/index" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>


