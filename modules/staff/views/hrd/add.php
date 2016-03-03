<?php echo $this->session->flashdata('message'); ?>
<br />
        
<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>staff/hrd/save">
<fieldset>
	    <p>
			<label for="name">Staff No</label>
			<input id="no" name="no" class="number" maxlength="5" />
		</p>
        
		<p>
			<label for="name">Name</label>
			<input id="name" name="name" maxlength="255" />
		</p>

       <p>
			<label for="datein">Date IN(dd/mm/yyyy)</label>
			<select name="dayin" id="dayin">
               <?php
                    for($i=1;$i<=31;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="monthin" id="monthin">
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
            <select name="yearin" id="yearin">
               <?php
                    for($i=2004;$i<=2017;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
		
		<p>
			<label for="datein">Date OUT(dd/mm/yyyy)</label>
			<select name="dayout" id="dayout">
               <?php
                    for($i=0;$i<=31;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="monthout" id="monthout">
               <?php
                    for($i=0;$i<=12;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="yearout" id="yearout">
               <?php
			        echo "<option value=0000>0000</option>";
                    for($i=2010;$i<=2017;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
			<label for="birthday">Birth(dd/mm/yyyy)</label>
			<select name="day" id="day">
               <?php
                    for($i=1;$i<=31;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
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
                    for($i=1930;$i<=2010;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
			<label for="email">Email</label>
			<input id="email" name="email" maxlength="255" />
		</p>
        
        <p>
			<label for="pos">Job Position</label>
			<select name="pos" id="pos">
              <?php foreach($bindPos as $rec): ?>
               <option value="<?php echo $rec['code']; ?>"><?php echo $rec['code']; ?> (<?php echo $rec['name_p']; ?>)</option>
              <?php endforeach; ?> 
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
        
        <p>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" maxlength="15" />
		</p>
		<p>
			<label for="confirm_password">Confirm password</label>
			<input id="confirm_password" name="confirm_password" type="password" maxlength="15" />
		</p>
        
		<p>
			<label for="sex">Sex</label>
			<select name="sex" id="sex">
               <option value="Pria">Pria</option>
               <option value="Wanita">Wanita</option>
            </select>
		</p>
        
        <p>
			<label for="image">Photo (3 X 4 )</label>
			<input type="file" id="image" name="image" />
		</p>
        
		<p>
			<label for="address">Address</label>
			<input id="address" name="address" maxlength="255" />
		</p>
        
        <p>
			<label for="address">No.Handphone</label>
			<input id="hp" name="hp" maxlength="15" />
		</p>
		
		<p>
			<label for="city">City</label>
			<input id="city" name="city" maxlength="255" />
		</p>
        
        <p>
			<label for="country">Country</label>
			<input id="country" name="country" maxlength="255" />
		</p>

<p>
			Salary Management
		</p>

<p>
			<label for="country">Basic Salary</label>
			<input id="sal_bas" name="sal_bas" maxlength="255" value="0" style="width:150px" />
		</p>

<p>
			<label for="allow_1">Allow 1</label>
			<input id="allow_1" name="allow_1" maxlength="255" value="0" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Allow 2</label>
			<input id="allow_2" name="allow_2" maxlength="255" value="0" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Transport</label>
			<input id="allow_2" name="staff_transport" maxlength="255" value="25000" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Outmeal(Over > 3 Hours)</label>
			<input id="allow_2" name="staff_outmeal" maxlength="255" value="10000" style="width:150px" />
		</p>
		
		<p align="center">
		<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>staff/hrd/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>
