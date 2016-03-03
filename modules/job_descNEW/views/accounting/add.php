<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/accounting/save">
<fieldset>
	    <p>
        <label for="name">Job Code</label>
        <?php if($_SESSION['division']=='Kuningan'):?>
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
                    for($i=2002;$i<=2016;$i++)
                    {  
                        echo "<option value=".$i.">".$i."</option>";
                    }    
               ?> 
            </select>
        <?php else:?>
            <input id="job_code" name="job_code" style="width:150px;" maxlength="25" />
        <?php endif;?>    
		</p>
        
        <?php if($_SESSION['division']!='Kuningan'):?>
        <p>
            <label for="name">Client Code</label>
            <select id="combobox2" name="code">
        		<option value="">Select one...</option>
                <?php foreach($bind as $rec): ?>
        		  <option value="<?php echo $rec['code']; ?>"><?php echo $rec['code']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
                <?php endforeach;?>
        	</select>
        </p>    
        <?php endif;?>
        
		<p>
			<label for="name">Job Name</label>
			<input id="name" name="name" maxlength="255" />
		</p>
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
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
			<label for="name">Signing Parner Budget / Time </label>
			<input id="sp" name="sp_budget" maxlength="255" value="<?php echo '1000000';?>" class="double" />*
			<input id="sp_time" name="sp_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Partner In-Charge Budget / Time</label>
			<input id="pc" name="pc_budget" maxlength="255" value="<?php echo '1000000';?>" class="double" />*
			<input id="pc_time" name="pc_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Senior Manager Budget / Time</label>
			<input id="sm" name="sm_budget" maxlength="255" value="<?php echo '450000';?>" class="double" />*
			<input id="sm_time" name="sm_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Manager Budget / Time</label>
			<input id="m" name="m_budget" maxlength="255" value="<?php echo '300000';?>" class="double" />*
			<input id="m_time" name="m_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>
        
        <p>
			<label for="name">Ass.Manager Budget * Time</label>
			<input id="am" name="am_budget" maxlength="255" value="<?php echo '250000';?>" class="double" />*
			<input id="am_time" name="am_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>       
        
        <p>
			<label for="name">Senior 2 Budget * Time</label>
			<input id="s2" name="s2_budget" maxlength="255" value="<?php echo '160000';?>" class="double" />*
			<input id="s2_time" name="s2_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Senior 1 Budget * Time</label>
			<input id="s1" name="s1_budget" maxlength="255" value="<?php echo '130000';?>" class="double" />*
			<input id="s1_time" name="s1_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p> 
        
        <p>
			<label for="name">Ass.Senior Budget * Time</label>
			<input id="as" name="as_budget" maxlength="255" value="<?php echo '100000';?>" class="double" />*
			<input id="as_time" name="as_time" maxlength="255" value="<?php echo '0';?>" class="double" />
		</p>
        
        <p>
			<label for="name">T.A Budget * Time</label>
			<input id="ta" name="ta_budget" maxlength="255" value="<?php echo '80000';?>" class="double" />*
			<input id="ta_time" name="ta_time" maxlength="255" value="<?php echo '0';?>" class="double" />
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
			<label for="job">Signing Partner</label>
			<select name="partner2" id="partner2">
			  <option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
        </p>
		
        <p>
			<label for="job">Partner In Charge</label>
			<select name="partner" id="partner">
			  <option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if($rec['pos_code']== 'P'): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
        </p>
        
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
              <?php if(($rec['pos_code']== 'M') && ($rec['status']== 'active')): ?> 
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
              <?php if(($rec['pos_code']== 'AM') && ($rec['status']== 'active') ): ?> 
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>
	  
	  <p>
			<label for="job">Senior 2</label>
			<select name="senior2" id="senior2">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S2') ): ?>
              <?php if ($rec['status']== 'active'): ?>
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif;?>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>     
      
      <p>
			<label for="job">Senior 1</label>
			<select name="senior" id="senior">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'S1') ): ?>
              <?php if ($rec['status']== 'active'): ?>
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif;?>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>

	 <p>
			<label for="job">Ass.Senior</label>
			<select name="as" id="as">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'AS') ): ?>
              <?php if ($rec['status']== 'active'): ?>
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif;?>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p> 

	  <p>
			<label for="job">Technical Ass</label>
			<select name="ta" id="ta">
			<option value=""></option>
              <?php foreach($bind2 as $rec): ?>
              <?php if (($rec['pos_code']== 'TA') ): ?>
              <?php if ($rec['status']== 'active'): ?>
               <option value="<?php echo $rec['no']; ?>"><?php echo $rec['name']; ?></option>
              <?php endif;?>
              <?php endif; ?> 
              <?php endforeach; ?> 
            </select>
      </p>   	
	  
        <br />
        <hr />

		<p style="text-align: center;">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>client/accounting/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>







