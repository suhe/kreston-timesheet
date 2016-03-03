<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>client/admin/update">
<input type="hidden" id="code" name="code" value="<?php echo $code;?>" />
<fieldset>
	    <p>
			<label for="name">Client Code</label>
			<input id="code1" name="code1"  maxlength="8" disabled="disabled" value="<?php echo $code;?>" />
		</p>
        
		<p>
			<label for="name">Company Name</label>
			<input id="name" name="name" maxlength="255" value="<?php echo $name;?>" />
		</p>
        
        <p>
			<label for="email">Email</label>
			<input id="email" name="email" maxlength="255" value="<?php echo $email;?>" />
		</p>
        
        <p>
			<label for="sector">sector</label>
			<input id="sector" name="sector" maxlength="255" value="<?php echo $sector;?>" />
		</p>
        
		<p>
			<label for="address">Address</label>
			<input id="address" name="address" maxlength="255" value="<?php echo $address;?>" />
		</p>
		
		<p>
			<label for="city">City</label>
			<input id="city" name="city" maxlength="255" value="<?php echo $city;?>" />
		</p>
        
        <p>
			<label for="country">Country</label>
			<input id="country" name="country" maxlength="255" value="<?php echo $country;?>" />
		</p>
        
        
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>client/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


