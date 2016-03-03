<?php echo $this->session->flashdata('message'); ?>
<br />
        
<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>group/admin/save">
<fieldset>        
       <p>
			<label for="name">Group Name</label>
			<input id="name" name="name" maxlength="255" />
	  </p>
      
      <p>
			<label for="job">Partner</label>
			<select name="partner" id="partner">
              <?php foreach($bind as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Manager</label>
			<select name="manager" id="manager">
              <?php foreach($bind as $rec): ?>
              <?php if($rec['pos_code']== 'M'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Ass.Manager</label>
			<select name="ass_manager" id="ass_manager">
              <?php foreach($bind as $rec): ?>
              <?php if($rec['pos_code']== 'AM'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Senior</label>
			<select name="senior" id="senior">
              <?php foreach($bind as $rec): ?>
              <?php if (($rec['pos_code']== 'S1') || ($rec['pos_code']== 'S2') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>      
		
		<p align="center">
		<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>group/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>
