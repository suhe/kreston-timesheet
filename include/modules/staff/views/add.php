<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>staff/save">
<fieldset>
	    <p>
			<label for="name">Staff No</label>
			<input id="no" name="no" class="number" />
		</p>
        
		<p>
			<label for="name">Name</label>
			<input id="name" name="name" />
		</p>
        
        <p>
			<label for="birthday">Birthday(dd/mm/yyyy)</label>
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
                    for($i=2010;$i<=2012;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
			<label for="email">Email</label>
			<input id="email" name="email" />
		</p>
        
        <p>
			<label for="job">Job Position</label>
			<select name="job" id="job">
               <option value="Auditor">Auditor</option>
               <option value="Supervisor">Supervisor</option>
               <option value="Manager">Manager</option>
            </select>
		</p>
        
        <p>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" />
		</p>
		<p>
			<label for="confirm_password">Confirm password</label>
			<input id="confirm_password" name="confirm_password" type="password" />
		</p>
        
		<p>
			<label for="sex">Sex</label>
			<select name="sex" id="sex">
               <option value="Pria">Pria</option>
               <option value="Wanita">Wanita</option>
            </select>
		</p>
        
        <p>
			<label for="uthumb">Photo (3 X 4 )</label>
			<input type="file" id="uthumb" name="uthumb" />
		</p>
        
		<p>
			<label for="address">Address</label>
			<input id="address" name="address" />
		</p>
		
		<p>
			<label for="city">City</label>
			<input id="city" name="city" />
		</p>
        
        <p>
			<label for="country">Country</label>
			<input id="country" name="country" />
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>staff/index" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>


