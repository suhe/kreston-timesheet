<?php echo $this->session->flashdata('message'); ?>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/saveJob/">
<fieldset>
	    <p>
			<label for="name">Code (Client/Periode)</label>
			<select name="job_code" id="type" style="padding:7px">
				 <?php foreach($bind as $rec){?>
				<option value="<?=$rec['code'];?>"><?=$rec['code'].'-'.$rec['name'];?></option>	
				 <?php } ?>
			</select>
			<!--<input type="text" name="job_code" value="<?php echo $jobcode; ?>" /> 
			<input class="confirm submit" type="submit" value="Search"/>-->

		</p>
        	
        
        <p>
			<label for="description">Description</label>
			<input id="description" name="description" maxlength="255" />
		</p>
        
        <p>
			<label for="remarks">Type</label>
			<select name="type" id="type" style="padding:7px">
               <option value="CHF">CHARGEABLE HOURS - FIELDWORK</option>
               <option value="CHO">CHARGEABLE HOURS - OFFICE</option>
            </select>
		</p>  
         
		
		<p align="center">
			<input class="submit" type="submit" value="Submit"/>
            <input class="submit" type="reset" value="Cancel"/>
            <a href="<?php echo base_url()?>time_report/user/" class="submit">Go To Back</a>
		</p>
	</fieldset>
</form>


<div id='confirm'>
			<div class='header'><span>Confirm</span></div>
			<div class='message'>
			   
        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" style="width:500px;" />
        </div>
        
        <div id="navigation">
           <!-- <a class="button" href="<?php echo base_url();?>job_desc/accounting/add">Add New Record</a>-->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
               
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Job Name</th>
              <th>Manager</th>
			  <th>Ass.Manager</th>
			  <th>Senior</th>
              <th ></th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($bind as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
			   <td><?php echo $rec['Ass_Manager_name'];?></td>
			   <td><?php echo $rec['Senior_name'];?></td>
               <th>
               <form class="cmxform"  id="signupForm" method="POST" action="<?php echo base_url()?>time_report/user/addjob/"> 
                 <input type="hidden" id="code" name="code" value="<?php echo $rec['code']; ?>" />
                 <input type="submit" name="go" value="go" style="width:50px;cursor: pointer;"   />
               </form> 
               </th>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
              
			</div>
			<!--
			<div class='buttons'>
				<div class='no simplemodal-close'>No</div>
				<div class='yes'>Yes</div>
			</div>
			-->
		</div>--
		
		<!-- preload the images -->
		<div style='display:none'>
			<img src='img/confirm/header.gif' alt='' />
			<img src='img/confirm/button.gif' alt='' />
</div>
        

       <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/jquery/jquery.js"></script>'; ?>
	   <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/jquery.simplemodal.js"></script>'; ?>
       <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/confirm.js"></script>'; ?>
       <?php //echo '<link type="text/css" href="'.base_url().APPPATH.'libraries/form_modal/css/confirm.css" rel="stylesheet" media="screen" />'; ?>




       







