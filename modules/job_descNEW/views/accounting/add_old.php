<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/accounting/save">
<fieldset>
	    <p>
			<label for="name">Code (Client/Periode)</label>
			
	
	<select id="combobox2" name="code">
		<option value="">Select one...</option>
        <?php foreach($bind as $rec): ?>
		<option value="<?php echo $rec['code']; ?>"><?php echo $rec['code']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
        <?php endforeach;?>
	</select>
    
    <select id="combobox2" name="job">
		<option value="">Select one...</option>
		<option value="GA">GA(General Audit)</option>
        <option value="SA">SA(Special Audit)</option>
        <option value="RE">RE(Review)</option>
        <option value="AU">AU(Agreed-Upon Procedure)</option>
        <option value="TA">TA(Tax Services)</option>
        <option value="AC">AC(Accounting Services)</option>
        <option value="CO">CO(Consulation Services)</option>
        <option value="OT">OT(Others)</option>
	</select>

            <select name="month" id="month">
               <?php
                    for($i=1;$i<=12;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="year" id="year">
               <?php
                    for($i=2008;$i<=2013;$i++)
                    {  
                            echo "<option value=".$i.">".$i."</option>";}    
               ?> 
            </select>
		</p>
        
		<p>
			<label for="name">Job Name</label>
			<input id="name" name="name" maxlength="255" />
		</p>
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
        <!--
        <p>
			<label for="remarks">Remarks</label>
			<select name="remarks" id="remarks">
               <option value="Confirmed">Confirmed</option>
               <option value="Pending">Pending</option>
            </select>
		</p> 
        --> 
        
        
        <p>
			<label for="status">Status</label>
			<select name="check" id="check">
               <option value="Fieldwork">Fieldwork</option>
               <option value="Release">Release</option>
            </select>
		</p>
       
        
        <p>
			<label for="job">Group</label>
			<select name="group" id="group">
              <?php foreach($bindGroup as $rec): ?>
               <option value="<?php echo $rec['group_id']; ?>"><?php echo $rec['group_name']; ?></option>
              <?php endforeach; ?> 
            </select>
		</p>
        
        <p>Fee Management</p>
        <hr />
        <p>
			<label for="name">Signing Parner</label>
			<input id="sp" name="sp" maxlength="255" value="<?php echo '700000';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Partner In-Charge</label>
			<input id="pc" name="pc" maxlength="255" value="<?php echo '700000';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Senior Manager</label>
			<input id="sm" name="sm" maxlength="255" value="<?php echo '400000';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Manager</label>
			<input id="m" name="m" maxlength="255" value="<?php echo '250000';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Ass.Manager</label>
			<input id="am" name="am" maxlength="255" value="<?php echo '200000';?>" class="double" />
		</p>       
        
        <p>
			<label for="name">Senior 2</label>
			<input id="s2" name="s2" maxlength="255" value="<?php echo '150000';?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Senior 1</label>
			<input id="s1" name="s1" maxlength="255" value="<?php echo '100000';?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Ass.Senior</label>
			<input id="as" name="as" maxlength="255" value="<?php echo '75000';?>" class="double" />
		</p>
        
        <p>
			<label for="name">T.A</label>
			<input id="ta" name="ta" maxlength="255" value="<?php echo '60000';?>" class="double" />
		</p>         
        <br />
        <p style="font-weight: bold;">Client Management</p>
        <br />
        <hr />
        <p>
			<label for="job">HRD</label>
			<select name="hrd" id="hrd">
			  <option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'HRD'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
        </p>
        
        <p>
			<label for="job">Partner</label>
			<select name="partner" id="partner">
			  <option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
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
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'SM'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Manager</label>
			<select name="manager" id="manager">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'M'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Ass.Manager</label>
			<select name="ass_manager" id="ass_manager">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'AM'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
      
      <p>
			<label for="job">Senior</label>
			<select name="senior" id="senior">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S1') || ($rec['pos_code']== 'S2') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
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







