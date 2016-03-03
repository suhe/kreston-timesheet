<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>job_desc/admin/save">
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
		<option value="GA">GA</option>
        <option value="TA">TA</option>
        <option value="AU">AU</option>
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
                    for($i=2008;$i<=2016;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
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
        
        <p>
			<label for="remarks">Remarks</label>
			<select name="remarks" id="remarks">
               <option value="Confirmed">Confirmed</option>
               <option value="Pending">Pending</option>
            </select>
		</p>  
        
        <!--
        <p>
			<label for="check">Check</label>
			<select name="check" id="check">
               <option value="Ok">Ok</option>
               <option value="No">No</option>
            </select>
		</p>
        -->
        
        <p>
			<label for="job">Group</label>
			<select name="group" id="group">
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







