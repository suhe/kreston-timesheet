<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/save">
<fieldset>
        
		<p>
			<label for="name">Position</label>
            <input type="text" name="pos" value="<?php echo $_SESSION['pos']; ?>" />
		</p>
        
		<p>
			<label for="periode">Periode(dd/mm/yyyy)</label>
			
			<select name="day" id="day">
               <?php if($_SESSION['division']=='Kuningan'):?>
			   <option value="05">05</option>
               <option value="20">20</option>
			   <?php else:?>
			   
			   <option value="15">15</option>
               <option value="29">29</option>
			   <option value="30">30</option>
			   <option value="31">31</option>
			   
			   <?php endif;?>
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
                    for($i=2015;$i<=2020;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
		</p>
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/index" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>
