<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>staff/hrd/update">
<input type="hidden" id="no" name="no" value="<?php echo $no;?>" />
<fieldset>
	    <p>
			<label for="name">Staff No</label>
			<input id="no1" name="no1" class="number" value="<?php echo $no;?>" disabled="disabled" />
		</p>
        
		<p>
			<label for="name">Name</label>
			<input id="name" name="name" value="<?php echo $name;?>" maxlength="255" />
		</p>
         
        <p>
			<label for="birthday">Date In(dd/mm/yyyy)</label>
			<select name="dayin" id="dayin">
                <option value="<?php echo $dayin; ?>"><?php echo $dayin;?></option>
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
                <option value="<?php echo $monthin; ?>"><?php echo $monthin;?></option>
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
                <option value="<?php echo $yearin; ?>"><?php echo $yearin;?></option>
               <?php
                    for($i=2004;$i<=2014;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
		
		<p>
			<label for="birthday">Resign</label>
			<select name="resign" id="resign">
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
		</p>	
		
		<p>
			<label for="birthday">Date Out(dd/mm/yyyy)</label>
			<select name="dayout" id="dayout">
                <option value="<?php echo $dayout; ?>"><?php echo $dayout;?></option>
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
            <select name="monthout" id="monthin">
                <option value="<?php echo $monthout; ?>"><?php echo $monthout;?></option>
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
            <select name="yearout" id="yearin">
                <option value="<?php echo $yearout; ?>"><?php echo $yearout;?></option>
               <?php
                    for($i=2004;$i<=2014;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
        
        <p>
			<label for="birthday">Birth(dd/mm/yyyy)</label>
			<select name="day" id="day">
                <option value="<?php echo $day; ?>"><?php echo $day;?></option>
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
                <option value="<?php echo $month; ?>"><?php echo $month;?></option>
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
                <option value="<?php echo $year; ?>"><?php echo $year;?></option>
               <?php
                    for($i=1930;$i<=1990;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
			<label for="email">Email</label>
			<input id="email" name="email" value="<?php echo $email;?>" maxlength="255" />
		</p>
        
        <p>
			<label for="pos">Job Position</label>
			<select name="pos" id="pos">
              <option value="<?php echo $pos_code; ?>"><?php echo $pos_code; ?>(<?php echo $name_p; ?>)</option>
              <?php foreach($bindPos as $rec): ?>
               <option value="<?php echo $rec['code']; ?>"><?php echo $rec['code']; ?> (<?php echo $rec['name_p']; ?>)</option>
              <?php endforeach; ?> 
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
        

        
		<p>
			<label for="sex">Sex</label>
			<select name="sex" id="sex">
               <option value="<?php echo $sex?>"><?php echo $sex;?></option> 
               <?php if($sex=="Pria"){ ?> 
                    <option value="Wanita">Wanita</option>
               <?php } elseif($sex=="Wanita"){ ?>
                    <option value="Pria">Pria</option>
               <?php } elseif ($sex=="") { ?>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
               <?php } ?>      
            </select>
		</p>
        
        <p>
			<label for="image">Old Photo (3 X 4 )</label>
			<img src="<?php echo base_url();echo $photo;?>" width="90" height="120"/>
		</p>
        
        <p>
			<label for="image">New Photo (3 X 4 )</label>
			<input type="file" name="image" id="image"  />
		</p>
        
		<p>
			<label for="address">Address</label>
			<input id="address" name="address" value="<?php echo $address;?>" maxlength="255" />
		</p>
        
        <p>
			<label for="handphone">No.Handphone</label>
			<input id="hp" name="hp" value="<?php echo $hp;?>" maxlength="15" />
		</p>
		
		<p>
			<label for="city">City</label>
			<input id="city" name="city" value="<?php echo $city;?>" maxlength="255" />
		</p>
        
        <p>
			<label for="country">Country</label>
			<input id="country" name="country" value="<?php echo $country;?>" maxlength="255" />
		</p>

<p>
			Salary Management
		</p>

<p>
			<label for="country">Basic Salary</label>
			<input id="sal_bas" value="<?php echo $sal_bas;?>" name="sal_bas" maxlength="255" value="0" style="width:150px" />
		</p>

<p>
			<label for="allow_1">Allow 1</label>
			<input id="allow_1" name="allow_1" maxlength="255" value="<?php echo $allow_1;?>" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Allow 2</label>
			<input id="allow_2" name="allow_2" maxlength="255" value="<?php echo $allow_2;?>" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Transport</label>
			<input id="allow_2" name="staff_transport" maxlength="255" value="<?php echo $staff_transport;?>" style="width:150px" />
		</p>
<p>
			<label for="allow_2">Outmeal(Over > 3 Hours)</label>
			<input id="allow_2" name="staff_outmeal" maxlength="255" value="<?php echo $staff_outmeal;?>" style="width:150px" />
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>staff/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>


