<?php echo $this->session->flashdata('message'); ?>
<br />
        
<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>manager/admin/save">
<fieldset>
	    <p>
			<label for="name">Staff No</label>
			<select id="no_staff" name="no_staff">
		      <option value="">Select one...</option>
                <?php foreach($bind as $rec): ?>
		              <option value="<?php echo $rec['no']; ?>"><?php echo $rec['no']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
                <?php endforeach;?>
	           </select>
		</p>
        
		        
        <p>
			<label for="job">Status</label>
			<select name="status" id="status">
               <option value="Active">Active</option>
               <option value="Deactive">Deactive</option>
            </select>
		</p>
        
        <p>
			<label for="uimage">Signature</label>
			<input type="file" id="simage" name="simage" />
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>manager/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>
