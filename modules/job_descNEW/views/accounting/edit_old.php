<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/accounting/update">
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
        
        <!--
        <p>
			<label for="remarks">Status</label>
			<select name="remarks" id="remarks">
               <option value="<?php echo $remarks;?>"><?php echo $remarks;?></option>
               <?php if ($remarks=="Pending"){ ?>
               <option value="Pending">Pending</option>
               <option value="Confirmed">Confirmed</option>
               <?php } else { ?>
                <option value="Confirmed">Confirmed</option>
                <option value="Pending">Pending</option>  
                <?php } ?>
            </select>
		</p>  
        
        -->
        
        <p>
			<label for="check">Status</label>
			<select name="check" id="check">
               <option value="<?php echo $check;?>"><?php echo $check;?></option>
               <?php if ($check=="Release"){ ?>
                    <option value="Release">Release</option>
                    <option value="Fieldwork">Fieldwork</option>
               <?php } else { ?>
                    <option value="Fieldwork">Fieldwork</option> 
                    <option value="Release">Release</option>
               <?php  } ?>     
            </select>
		</p>
        
        
        <p>
			<label for="job">Group</label>
			<select name="group" id="group">
               <option value="<?php echo $group_id; ?>"><?php echo $group_name; ?></option>
              <?php foreach($bindGroup as $rec): ?>
               <option value="<?php echo $rec['group_id']; ?>"><?php echo $rec['group_name']; ?></option>
              <?php endforeach; ?> 
            </select>
		</p>
        
        
        <p style="font-weight: bold;">Fee Standard</p>
        <hr />
        
        <p>
			<label for="name">Signing Parner</label>
			<input id="sp" name="sp" maxlength="255" value="<?php echo $sp;?>" class="double" />
		</p>
        
        <p>
			<label for="name">Partner In-Charge</label>
			<input id="pc" name="pc" maxlength="255" value="<?php echo $pc;?>" class="double" />
		</p>
        
        <p>
			<label for="name">Senior Manager</label>
			<input id="sm" name="sm" maxlength="255" value="<?php echo $sm;?>" class="double" />
		</p>
        
        <p>
			<label for="name">Manager</label>
			<input id="m" name="m" maxlength="255" value="<?php echo $m;?>" class="double" />
		</p>
        
        <p>
			<label for="name">Ass.Manager</label>
			<input id="am" name="am" maxlength="255" value="<?php echo $am;?>" class="double" />
		</p>       
        
        <p>
			<label for="name">Senior 2</label>
			<input id="s2" name="s2" maxlength="255" value="<?php echo $s2;?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Senior 1</label>
			<input id="s1" name="s1" maxlength="255" value="<?php echo $s1;?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Ass.Senior</label>
			<input id="as" name="as" maxlength="255" value="<?php echo $as;?>" class="double" />
		</p>
        
        <p>
			<label for="name">T.A</label>
			<input id="ta" name="ta" maxlength="255" value="<?php echo $ta;?>" class="double" />
		</p> 
        
        <hr />
        <br />
         <p style="font-weight: bold;">Management Client</p>
         <hr />
         
         <p>
			<label for="job">HRD</label>
			<select name="hrd" id="hrd">
             <option value="<?php echo $hrd; ?>"><?php echo $hrd_name; ?></option>
			 
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'HRD'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?>
            	<option value=""></option>		  
            </select>
        </p>
         
         <p>
			<label for="job">Partner</label>
			<select name="partner" id="partner">
             <option value="<?php echo $partner; ?>"><?php echo $partner_name; ?></option>
			 
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?>
            	<option value=""></option>		  
            </select>
        </p>
        
        <!--
        <p>
			<label for="job">Ass Partner</label>
			<select name="ass_partner" id="ass_partner">
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'AP'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
			   
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
        </p>
        -->
      
      <p>
			<label for="job">Senior Manager</label>
			<select name="sn_manager" id="sn_manager">
            <option value="<?php echo $sn_manager; ?>"><?php echo $sn_manager_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'SM'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?>
             <option value=""></option> 			  
            </select>
      </p>
      
      <p>
			<label for="job">Manager</label>
			<select name="manager" id="manager">
              <option value="<?php echo $manager; ?>"><?php echo $manager_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'M'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p>
      
      <p>
			<label for="job">Ass.Manager</label>
			<select name="ass_manager" id="ass_manager">
            <option value="<?php echo $ass_manager; ?>"><?php echo $ass_manager_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'AM'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p>
      
      <p>
			<label for="job">Senior</label>
			<select name="senior" id="senior">
            <option value="<?php echo $senior; ?>"><?php echo $senior_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S1') || ($rec['pos_code']== 'S2') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p>      
        <br />
        <hr />
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>client/accounting/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


