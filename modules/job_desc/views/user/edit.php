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
		
		<p>
			<label for="name">Note</label>
			<?=form_textarea(['name'=>'note','value'=>$note,'rows'=>5])?>
			
			
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
        
        
        <p style="font-weight: bold;">Fee Management</p>
        <hr />
        
        <p>
			<label for="name">Signing Parner Budget * Time</label>
			<input id="sp" name="sp_budget" maxlength="255" value="<?php echo $sp;?>" class="double" /> *
			<input id="sp_time" name="sp_time" maxlength="255" value="<?php echo $sp_time;?>" class="double" /> =
            <input id="sp_total" name="sp_total" maxlength="255" value="<?php echo number_format($sp * $sp_time,2);?>" class="double" disabled="disabled" /> 
		</p>
        
        <p>
			<label for="name">Partner In-Charge Budget * Time</label>
			<input id="pc" name="pc_budget" maxlength="255" value="<?php echo $pc;?>" class="double" /> *
			<input id="pc_time" name="pc_time" maxlength="255" value="<?php echo $pc_time;?>" class="double" /> =
            <input id="pc_total" name="pc_total" maxlength="255" value="<?php echo number_format($pc * $pc_time,2);?>" class="double" disabled="disabled" />  
		</p>
        
        <p>
			<label for="name">Senior Manager Budget * Time</label>
			<input id="sm" name="sm_budget" maxlength="255" value="<?php echo $sm;?>" class="double" /> *
			<input id="sm_time" name="sm_time" maxlength="255" value="<?php echo $sm_time;?>" class="double" /> =
            <input id="sm_total" name="sm_total" maxlength="255" value="<?php echo number_format($sm * $sm_time,2);?>" class="double" disabled="disabled" /> 
		</p>
        
        <p>
			<label for="name">Manager Budget * Time</label>
			<input id="m" name="m_budget" maxlength="255" value="<?php echo $m;?>" class="double" /> *
			<input id="m_time" name="m_time" maxlength="255" value="<?php echo $m_time;?>" class="double" /> =
            <input id="m_total" name="m_total" maxlength="255" value="<?php echo number_format($m * $m_time,2);?>" class="double" disabled="disabled" />  
		</p>
        
        <p>
			<label for="name">Ass.Manager Budget * Time</label>
			<input id="am" name="am_budget" maxlength="255" value="<?php echo $am;?>" class="double" /> *
			<input id="am_time" name="am_time" maxlength="255" value="<?php echo $am_time;?>" class="double" /> =
            <input id="am_total" name="am_total" maxlength="255" value="<?php echo number_format($am * $am_time,2);?>" class="double" disabled=" disabled" /> 
		</p>       
        
        <p>
			<label for="name">Senior 2 Budget * Time</label>
			<input id="s2" name="s2_budget" maxlength="255" value="<?php echo $s2;?>" class="double" /> *
			<input id="s2_time" name="s2_time" maxlength="255" value="<?php echo $s2_time;?>" class="double" />=
            <input id="s2_total" name="s2_total" maxlength="255" value="<?php echo number_format($s2 * $s2_time,2);?>" class="double"  disabled=" disabled" />
		</p> 
        
        <p>
			<label for="name">Senior 1 Budget * Time</label>
			<input id="s1" name="s1_budget" maxlength="255" value="<?php echo $s1;?>" class="double" /> *
			<input id="s1_time" name="s1_time" maxlength="255" value="<?php echo $s1_time;?>" class="double" />=
            <input id="s1_total" name="s1_total" maxlength="255" value="<?php echo number_format($s1 * $s1_time,2);?>" class="double" disabled=" disabled" />

		</p> 
        
        <p>
			<label for="name">Ass.Senior Budget * Time</label>
			<input id="as" name="as_budget" maxlength="255" value="<?php echo $as;?>" class="double" /> *
			<input id="as_time" name="as_time" maxlength="255" value="<?php echo $as_time;?>" class="double" />=
            <input id="as_total" name="as_total" maxlength="255" value="<?php echo number_format($as*$as_time,2);?>" class="double" disabled="disabled" /> 
		</p>
        
        <p>
			<label for="name">T.A Budget / Time</label>
			<input id="ta" name="ta_budget" maxlength="255" value="<?php echo $ta;?>" class="double" /> *
			<input id="ta_time" name="ta_time" maxlength="255" value="<?php echo $ta_time;?>" class="double" /> = 
            <input id="ta_total" name="ta_total" maxlength="255" value="<?php echo number_format($ta * $ta_time,2);?>" class="double" disabled="disabled" />
		</p> 
 
<hr/> 
<p>
			<label for="name">Total Budget</label>
			
                       <input id="approval1" name="approval1" maxlength="255" value="<?php echo number_format ($budget=($sp * $sp_time)+($pc * $pc_time)+ ($sm * $sm_time)+($m * $m_time)+($am * $am_time) + ($s2 * $s2_time) + ($s1 * $s1_time) + ($as * $as_time) + ($ta * $ta_time),2);?>" class="double"  />
		</p>

<p>
			<label for="name">Approve</label>
			
			<input id="approval" name="approval" maxlength="255" value="<?php echo  $approval;?>" class="double"  />
                       
		</p>

<p>
			<label for="name">Recovery Rate</label>
			
			<input id="recovery" name="recovery" maxlength="255" value="<?php echo  number_format(($approval * 100)/$budget,2);?>" class="double"  /> %
                       
		</p>
 
        
        <hr />
        <br />
         <p style="font-weight: bold;">Client Management </p>
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
			<label for="job">Signing Partner</label>
			<select name="partner2" id="partner2">
             <option value="<?php echo $partner2; ?>"><?php echo $partner2_name; ?></option>
			 
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?>
            	<option value=""></option>		  
            </select>
        </p>
         
         <p>
			<label for="job">Partner In Charge</label>
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
			<label for="job">Senior 2</label>
			<select name="senior2" id="senior2">
            <option value="<?php echo $senior2; ?>"><?php echo $senior2_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S2') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p> 
	  
      <p>
			<label for="job">Senior 1</label>
			<select name="senior" id="senior">
            <option value="<?php echo $senior; ?>"><?php echo $senior_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S1') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p> 
	  
	  <p>
			<label for="job">Ass.Senior</label>
			<select name="as" id="as">
            <option value="<?php echo $ass_senior; ?>"><?php echo $ass_senior_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'AS') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
			  <option value=""></option>
            </select>
      </p> 
	  
	  <p>
			<label for="job">Technical Ass</label>
			<select name="ta" id="ta">
            <option value="<?php echo $tech_ass; ?>"><?php echo $tech_ass_name; ?></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'TA') ): ?> 
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


