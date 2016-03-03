        <h3 style="padding:10px 20px;border-bottom:1px solid #CCC ">Employee Charge Details : <?=$user['no'].' '.$user['name']?></h3>
		
        <div id="navigation">
			<a class="button" href="<?php echo base_url();?>report/user/employeecharge_summary">Back</a>
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th style="width:20px">No</th>
			  <th style="width:30px">Date</th>
			  <th>Job Code</th>
			  <th>Job Name</th>
			  <th>Job Type</th>
			  <th>Chargeable</th>
			  <th>Non Chargeable</th>
            </tr>
          </thead>
          <tbody>
              <?=$table?>
          </tbody>
        </table>