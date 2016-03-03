        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
		  
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th style="width:80%">Report Type</th>	
			  <th style="width:20%">Access</th>
            </tr>
          </thead>
          <tbody>
          <tr>
               <td>Activity Report</td>
               <td><center><a href="<?=base_url()?>report/user/activity">Access</a></center</td>
			</tr>
           <tr>
               <td>Job Progress</td>
               <td><center><a href="<?=base_url()?>job_desc/user/progress">Access</a></center</td>
			</tr>
			<tr>
               <td>Job Project Report</td>
               <td><center><a href="<?=base_url()?>job_desc/user/outstanding">Access</a></center</td>
			</tr>
			<tr>
               <td>Time Charge Summary Report</td>
               <td><center><a href="<?=base_url()?>report/user/timecharge_summary">Access</a></center</td>
			</tr>
            <tr>
               <td>Time Charge Details Report</td>
               <td><center><a href="<?=base_url()?>report/user/timecharge_details">Access</a></center</td>
			</tr>
			<?php if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='M') || ($_SESSION['level']=='AM')){ ?>
			   <tr>
               <td>Employee Charge Summary Report</td>
               <td><center><a href="<?=base_url()?>report/user/employeecharge_summary">Access</a></center</td>
			</tr>
			<?php } ?>
			 <tr>
               <td>Chargeable Report</td>
               <td><center><a href="<?=base_url()?>report/user/chargeable">Access</a></center</td>
			</tr>
			 <tr>
               <td>Over Budget Job Setup</td>
               <td><center><a href="<?=base_url()?>report/user/maxjobhour">Access</a></center</td>
			</tr>
			<?php if($_SESSION['level']=='HRD'){ ?>
			   <tr>
               <td>Employee Details Time Salary</td>
               <td><center><a href="<?=base_url()?>salary/accounting/payroll_details">Access</a></center</td>
			</tr>
			<?php } ?>
			 
			
          </tbody>
        </table>