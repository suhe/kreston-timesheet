<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>manager/admin/update">
<input type="hidden" id="no" name="no" value="<?php echo $staff_no;?>" />
<fieldset>
	    <p>
			<label for="name">Staff No</label>
			<select id="no_staff" name="no_staff">
		      <option value="<?php echo $staff_no; ?>"><?php echo $staff_no; ?></option>
                <?php foreach($bind as $rec): ?>
		              <option value="<?php echo $staff_no;; ?>"><?php echo $rec['no']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
                <?php endforeach;?>
	           </select>
		</p>
        
		<p>
			<label for="job">Status</label>
			<select name="status" id="status">
               <?php if($status=="Active"){ ?> 
                 <option value="Deactive">Deactive</option>
               <?php } elseif($status="Deactive"){ ?> 
                <option value="Active">Active</option>
               <?php } ?>
               
            </select>
		</p>
        
        <p>
            <?php if($signature<>""){ ?>
                <img src="<?php echo base_url()?><?php echo $signature;?>" width="" height="" />
            <?php } else { ?>
            <?php } ?>
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


