<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>client/accounting/update">
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
			<label for="name">Contact Person</label>
			<input id="cp" name="cp" maxlength="255" value="<?php echo $cp;?>" />
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
			<label for="address">Telp</label>
			<input id="address" name="tlp_1" maxlength="255" value="<?php echo $tlp_1;?>" style="width:150px;" />
		</p>
		
		<p>
			<label for="address">Fax</label>
			<input id="address" name="fax" maxlength="255" value="<?php echo $fax;?>" style="width:150px;" />
		</p>
		
		<p>
			<label for="city">City</label>
			<input id="city" name="city" maxlength="255" value="<?php echo $city;?>" style="width:150px;" />
		</p>
        
        <p>
			<label for="country">Country</label>
			<input id="country" name="country" maxlength="255" value="<?php echo $country;?>" style="width:150px;" />
		</p>
		
		<p>
			<label for="country">Transport AK</label>
			<input id="country" name="transport" maxlength="255" value="<?php echo $transport;?>" style="width:150px;text-align: right;" />
		</p>
        
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>client/accounting/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


