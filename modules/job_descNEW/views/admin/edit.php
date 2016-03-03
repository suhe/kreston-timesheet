<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/admin/update">
<input type="hidden" id="code" name="code" value="<?php echo $code;?>" />
<fieldset>
	    <p>
			<label for="name">Job Code</label>
			<input id="code1" name="code1"  maxlength="8" disabled="disabled" value="<?php echo $code;?>" />
		</p>
        
		<p>
			<label for="name">Job Name</label>
			<input id="name" name="name" maxlength="255" value="<?php echo $name;?>" />
		</p>
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" value="<?php echo $description;?>" />
		</p>
        
        <p>
			<label for="remarks">Remarks</label>
			<select name="remarks" id="remarks">
               <option value="<?php echo $remarks;?>"><?php echo $remarks;?></option>
               <?php if ($remarks=="No Confirmed"){ ?>
               <option value="Confirmed">Confirmed</option>
               <?php } else { ?>
                <option value="Pending">Pending</option>  <?php } ?>
            </select>
		</p>  
        
        <!--
        <p>
			<label for="check">Check</label>
			<select name="check" id="check">
               <option value="<?php echo $check;?>"><?php echo $check;?></option>
               <?php if ($check=="Ok"){ ?>
                    <option value="No">No</option>
               <?php } else { ?>
                <option value="Ok">Ok</option>  <?php } ?>  
            </select>
		</p>
        -->        
        
        <p>
			<label for="job">Group</label>
			<select name="group" id="group">
               <option value="<?php echo $group_id; ?>"><?php echo $group_name; ?></option>
              <?php foreach($bindGroup as $rec): ?>
               <option value="<?php echo $rec['group_id']; ?>"><?php echo $rec['group_name']; ?></option>
              <?php endforeach; ?> 
            </select>
		</p>   
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>client/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


