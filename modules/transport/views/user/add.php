<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/save">
<fieldset>
        <!--
        <p>
			<label for="name">Code (Manager)</label>
	<select id="combobox2" name="id">
		<option value="">Select one...</option>
        <?php foreach($bind as $rec): ?>
		<option value="<?php echo $rec['id'];?>"><?php echo $rec['id']; ?><b>(</b><?php echo $rec['name']; ?><b>)</b></option>
        <?php endforeach;?>
	</select>
		</p>
        -->
	    <p>
			<label for="name">Position</label>
			<select name="position" id="position">
               <option value="M">M (Manager)</option>
               <option value="AM">AM (Ass Manager)</option>
               <option value="S2">S2 (Senior 2)</option>
               <option value="S1">S1 (Senior 1)</option>
               <option value="AS">AS (Ass Senior)</option>
               <option value="TA">TA (Technical Assistant)</option> 
            </select>
		</p>
        
		<p>
			<label for="periode">Periode(dd/mm/yyyy)</label>
			<select name="day" id="day">
               <option value="05">05</option>
               <option value="20">20</option>
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
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/index" class="submit">Back</a>
		</p>
	</fieldset>
</form>
