<?php echo $this->session->flashdata('message'); ?>
<br />
        
<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>holiday/admin/save">
<fieldset>
	    <p>
			<label for="birthday">Holiday(dd/mm/yyyy)</label>
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
                    for($i=2010;$i<=2014;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>holiday/admin/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>
