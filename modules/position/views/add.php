<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>position/admin/save">
<fieldset>
	    <p>
			<label for="code">Position Code</label>
			<input id="code" name="code"  maxlength="2" />
		</p>
        
		<p>
			<label for="name">Position Name</label>
			<input id="name" name="name" maxlength="255" />
		</p>
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>position/admin/index" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>
